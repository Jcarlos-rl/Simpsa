<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Mail\OrderEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\CartController;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{

    private $_api_context;

	public function __construct()
	{
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function postPayment()
	{
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$items = array();
		$subtotal = 0;
		$cart = (new CartController)->show();
        $currency = 'MXN';
        $shipping =(new ShippingController)->shipping();

		foreach($cart as $producto){
			$item = new Item();
			$item->setName($producto->title)
			->setCurrency($currency)
			->setDescription($producto->title)
			->setQuantity($producto->quantity)
			->setPrice($producto->price);

			$items[] = $item;
			$subtotal += $producto->quantity * $producto->price;
		}

		$item_list = new ItemList();
		$item_list->setItems($items);

		$details = new Details();
		$details->setSubtotal($subtotal)
		->setShipping($shipping);

		$total = $subtotal + $shipping;

		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Pedido tienda en linea');

		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('paypal.status'))
			->setCancelUrl(\URL::route('paypal.status'));

		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));

		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Ups! Algo salió mal');
			}
		}

		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}


		\Session::put('paypal_payment_id', $payment->getId());

		if(isset($redirect_url)) {

			return \Redirect::away($redirect_url);
		}

		return \Redirect::route('cart-show')
			->with('message', 'Ups! Error desconocido.');

	}

	public function getPaymentStatus(Request $request)
	{

		$payment_id = \Session::get('paypal_payment_id');


        \Session::forget('paypal_payment_id');

		$payerId = $request->PayerID;
		$token = $request->token;

		if (empty($payerId) || empty($token)) {
			return redirect()->route('ecommerce.checkout')
				->with('error', 'La compra fue cancelada');
		}

		$payment = Payment::get($payment_id, $this->_api_context);

		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);

        $result = $payment->execute($execution, $this->_api_context);

		if ($result->state == 'approved') {
			return redirect()->route('ecommerce.success','PayPal');
		}
		return \Redirect::route('ecommerce.checkout')
			->with('error', 'Lo sentimos hubo un error');
    }

}
