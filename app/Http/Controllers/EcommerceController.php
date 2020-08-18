<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Label;
use App\Order;
use App\Invoice;
use App\Product;
use App\Category;
use App\Catalogue;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShippingController;

class EcommerceController extends Controller
{
    public function index()
    {
        $destacado = Label::find(1);
        $destacados = $destacado->products;
        $oferta = Label::find(2);
        $ofertas = $oferta->products;
        $cart = (new CartController)->show();
        return view('ecommerce.index',compact('destacados','ofertas','cart'));
    }

    public function contact()
    {
        $cart = (new CartController)->show();
        return view('ecommerce.contact',compact('cart'));
    }

    public function cart()
    {
        $cart = (new CartController)->show();
        $subtotal = (new CartController)->subtotal();
        $shipping = (new ShippingController)->shipping();
        return view('ecommerce.cart.index', compact('cart','subtotal','shipping'));
    }

    public function shipping()
    {
        $dataShipping = (new ShippingController)->show();
        $subtotal = (new CartController)->subtotal();
        $shipping = (new ShippingController)->shipping();
        $cart = (new CartController)->show();
        if(count($cart)==0){
            return redirect()->route('ecommerce.cart');
        }else{
            return view('ecommerce.cart.shipping', compact('dataShipping','subtotal','shipping','cart'));
        }
    }

    public function saveshipping(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'direction' => 'required',
            'number' => 'required',
            'city' => 'required',
            'state' => 'required',
            'cp' => 'required',
            'phone' => 'required'
        ]);

        (new ShippingController)->add($request);

        return redirect()->route('ecommerce.checkout');
    }

    public function checkout()
    {
        $subtotal = (new CartController)->subtotal();
        $shipping = (new ShippingController)->shipping();
        $cart = (new CartController)->show();
        $session = (new StripeController)->checkoutsession();

        if(count($cart)==0){
            return redirect()->route('ecommerce.cart');
        }else{
            return view('ecommerce.cart.checkout', compact(['cart','subtotal', 'shipping','session']));
        }
    }

    public function catalogue()
    {
        $catalogues = Catalogue::get();
        $cart = (new CartController)->show();
        return view('ecommerce.catalogue', compact('catalogues','cart'));
    }

    public function success($payment)
    {
        $subtotal = (new CartController)->subtotal();
        $shipping = (new ShippingController)->shipping();
        $cart = (new CartController)->show();
        $total = (new CartController)->total();
        (new OrderController)->saveOrder($cart,$subtotal,$shipping,$total,'onlineshop',$payment);
        return redirect()->route('ecommerce.index')->with('success','Gracias por su compra');
    }

    public function details(Product $product)
    {
        $label = Label::where('name','Oferta')->first();
        $products = $label->products()->paginate(5);
        $cart = (new CartController)->show();
        return view('ecommerce.detail',compact('product','products','cart'));
    }

    public function products()
    {
        $cart = (new CartController)->show();
        $products = Product::where('status',2)->paginate(15);
        $brands = Brand::get();
        return view('ecommerce.products',compact('cart','products','brands'));
    }

    public function brand($marca)
    {
        $brand = Brand::where('name',$marca)->first();
        $cart = (new CartController)->show();
        $products = $brand->products()->where('status',2)->paginate(15);
        $categories = $brand->categories;
        return view('ecommerce.products',compact('cart','products','categories','brand'));
    }

    public function brand_category($marca,$categoria)
    {
        $brand = Brand::where('name',$marca)->first();
        $category = Category::where('name',$categoria)->first();
        $products = $category->products()->where('status',2)->where('brand_id',$brand->id)->paginate(15);
        $cart = (new CartController)->show();
        $subcategories = $category->subcategories;
        return view('ecommerce.products_category',compact('cart','products','subcategories','brand','category'));
    }

    public function brand_category_subcategory($marca,$categoria,$subcategoria)
    {
        $brand = Brand::where('name',$marca)->first();
        $category = Category::where('name',$categoria)->first();
        $subcategory = Subcategory::where('name',$subcategoria)->first();
        $products = $subcategory->products()->where('status',2)->where('brand_id',$brand->id)->paginate(15);
        $cart = (new CartController)->show();
        return view('ecommerce.products_category',compact('cart','products','subcategory','brand','category'));
    }

    public function invoice($slug)
    {

        $exist = Order::where('slug',$slug)->get();
        if(count($exist)==0){
            abort(404);
        }else{
            $order = $exist[0];
            return view('ecommerce.invoice', compact('order'));
        }
    }

    public function invoicesave(Order $order, Request $request)
    {
        $request->validate([
            'rfc' => 'required',
            'razon' => 'required',
            'cfdi' => 'required',
            'calle' => 'required',
            'colonia' => 'required',
            'localidad' => 'required',
            'cp' => 'required',
            'state' => 'required',
            'email' => 'required'
        ]);

        Invoice::create([
            'order_id' => $order->id,
            'rfc' => $request->rfc,
            'razon_social' => $request->razon,
            'cfdi' => $request->cfdi,
            'calle' => $request->calle,
            'colonia' => $request->colonia,
            'municipio' => $request->localidad,
            'cp' => $request->cp,
            'estado' => $request->state,
            'email' => $request->email
        ]);

        return redirect()->route('ecommerce.index')->with('success','Gracias por su compra, le estaremos enviando su factura lo mas pronto posible');
    }
}
