<?php

namespace App\Http\Controllers;

use App\Order;
use App\ItemsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function saveOrder($cart,$subtotal,$shipping,$total,$channel,$payment)
    {
        $slug = $channel."_".$total.$shipping;
        $order = Order::create([
            'channel' => $channel,
            'payment' => $payment,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'slug' => $slug,
            'total' => $total
        ]);

        foreach($cart as $item){
            $this->saveOrderItem($item, $order);
        }

        if($channel == 'onlineshop'){
            \Session::forget('cart');
            \Session::forget('shipping');
        }else{
            \Session::forget('invoiceorder');
        }
    }

    public function saveOrderItem($item,Order $order)
    {
        ItemsOrder::create([
            'price' => $item->price,
            'quantity' => $item->quantity,
            'order_id' => $order->id,
            'product_id' => $item->id
        ]);
    }
}
