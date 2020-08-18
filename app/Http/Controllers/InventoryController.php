<?php

namespace App\Http\Controllers;

use App\Product;
use App\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::paginate(15);
        return view('admin.inventory.index',compact('products'));
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

    public function add(Product $product)
    {
        Inventory::create([
            'quantity' => 1,
            'product_id' => $product->id
        ]);

        return redirect()->route('inventory.index')->with('success','Producto agregado al inventario');
    }

    public function update(Request $request,Inventory $inventory)
    {
        $inventory->update($request->except(['_token','_method']));
        return redirect()->route('inventory.index')->with('success','Producto actualizado con exitó');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success','Producto eliminado con exitó');
    }
}
