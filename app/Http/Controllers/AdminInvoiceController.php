<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    public function __construct(){
        if(!\Session::has('invoiceorder')) \Session::put('invoiceorder',array());
    }

    public function index()
    {
        $orders = Order::get();
        return view('admin.ecommerce.invoices.index', compact('orders'));
    }

    public function create()
    {
        $order = \Session::get('invoiceorder');
        return view('admin.ecommerce.invoices.create',compact('order'));
    }

    public function save(Request $request)
    {
        $invoiceorder = \Session::get('invoiceorder');
        $total = $this->total();

        (new OrderController)->saveOrder($invoiceorder,$total,0,$total,$request->channel,'ml');

        return redirect()->route('admininvoice.index')->with('success','Orden guardada');
    }

    public function search(Request $request)
    {
        $products = Product::where('code','like', '%'.$request->search.'%')
                                ->orWhere('title','like','%'.$request->search.'%')
                                ->paginate(10);

        return response([
            $products
        ]);
    }

    /* ----- ----- ----- Acctiones para nuestra orden en una sesion ----- ----- ----- */

    public function add(Product $product){

        $invoiceorder = \Session::get('invoiceorder');

        $productInfo = (object)[
            'id' => $product->id,
            'title' => $product->title,
            'code' => $product->code,
        ];

        $invoiceorder[$product->id] = $productInfo;
        \Session::put('invoiceorder', $invoiceorder);

        return redirect()->back()->with('success','Producto agregado');

    }

    public function delete(Product $product){

        $invoiceorder = \Session::get('invoiceorder');
        unset($invoiceorder[$product->id]);
        \Session::put('invoiceorder',$invoiceorder);

        return redirect()->back()->with('success','Producto eliminado');

    }

    public function update(Product $product, $quantity, $price){
        $invoiceorder = \Session::get('invoiceorder');
        $invoiceorder[$product->id]->quantity = $quantity;
        $invoiceorder[$product->id]->price = $price;
        \Session::put('invoiceorder',$invoiceorder);

        return redirect()->back()->with('success','Producto actualizado');
    }

    public function total(){
        $invoiceorder = \Session::get('invoiceorder');
        $total = 0;

        foreach($invoiceorder as $item){
            $total += $item->quantity * $item->price;
        }

        return $total;
    }
}
