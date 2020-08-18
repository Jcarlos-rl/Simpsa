<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function __construct(){
        if(!\Session::has('shipping')) \Session::put('shipping',array());
    }

    public function show(){
        $shipping = \Session::get('shipping');
        return $shipping;
    }


    public function shipping(){
        $weight = 0;
        $shipping = 100;

        // $cart=\Session::get('cart');
        // foreach($cart as $item){
        //     $weight += $item->weight;
        // }

        // if($weight >= 0 && $weight<=500){
        //     $shipping = 100;
        // }else if($weight > 500 && $weight<=1000 ){
        //     $shipping = 150;
        // }else if($weight > 1000 && $weight <=3000){
        //     $shipping = 200;
        // }else if($weight > 3000 && $weight <= 5000){
        //     $shipping = 250;
        // }else{
        //     $shipping = 300;
        // }

        return $shipping;
    }

    public function add($request){

        $shipping = \Session::get('shipping');
        $shipping = $request->except(['_token']);
        \Session::put('shipping', $shipping);

    }
}
