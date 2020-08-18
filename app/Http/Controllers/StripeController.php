<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CartController;

class StripeController extends Controller
{

    public function checkoutsession()
    {
        \Stripe\Stripe::setApiKey('sk_test_bXO6aSMopR4HS4z8lWcIK34a00SuoqE1AR');
        $total = (new CartController)->total();
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                'currency' => 'MXN',
                'product_data' => [
                    'name' => 'Carrito de compra',
                ],
                'unit_amount' => $total*100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('ecommerce.success','Stripe'),
            'cancel_url' => route('ecommerce.checkout'),
        ]);

        return $session->id;
    }
}
