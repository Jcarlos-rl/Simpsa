<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function __construct(){
        if(!\Session::has('cart')) \Session::put('cart',array());
    }

    //Show Cart
    public function show(){

        $cart = \Session::get('cart');
        return $cart;
    }

    //Add item
    public function add(Product $product, $quantity){

        $cart = \Session::get('cart');

        $productInfo = (object)[
            'id' => $product->id,
            'title' => $product->title,
            'code' => $product->code,
            'quantity' => $quantity,
            'image' => $product->info->image,
            'price' => $product->info->price,
        ];

        $cart[$product->id] = $productInfo;
        \Session::put('cart', $cart);

        return redirect()->back()->with('success','Producto agregado al carrito');
    }

    //Delete item
    public function delete(Product $product){
        $cart = \Session::get('cart');
        unset($cart[$product->id]);
        \Session::put('cart',$cart);

        return redirect()->route('ecommerce.cart');
    }

    //Update item
    public function update(Product $product, $quantity){
        $cart = \Session::get('cart');
        $cart[$product->id]->quantity = $quantity;
        \Session::put('cart',$cart);

        return redirect()->route('ecommerce.cart');
    }

    //Trash cart
    public function trash(){
        \Session::forget('cart');

        return redirect()->route('ecommerce.index')->with('success','Carrito eliminado');
    }

    /* ----- ----- ----- Calcular el total del carrito ----- ----- ----- */
    public function subtotal(){
        $cart = \Session::get('cart');
        $subtotal = 0;

        foreach($cart as $item){
            $subtotal += $item->quantity * $item->price;
        }

        return $subtotal;
    }

    /* ----- ----- ----- Calcular el total de la compra ----- ----- ----- */
    public function total(){
        $subtotal = $this->subtotal();
        $shipping = (new ShippingController)->shipping();

        $total = $subtotal+$shipping;
        return $total;
    }
}
