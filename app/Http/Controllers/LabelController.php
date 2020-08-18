<?php

namespace App\Http\Controllers;

use App\Product;
use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index(Product $product)
    {
        $labels = Label::get();
        return view('admin.ecommerce.products.label', compact('product','labels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Label::create($request->except('_token'));

        return redirect()->back()->with('success','Etiqueta guardada con exito');
    }

    public function savelabel(Request $request, Product $product)
    {
        foreach($request->labels as $label){
            $product->labels()->attach($label);
        }

        return redirect()->back()->with('success','Etiquetas registradas en el producto');
    }

    public function destroy(Request $request, Product $product)
    {
        $product->labels()->detach($request->label);

        return redirect()->back()->with('success','Etiqueta eliminada con éxito');
    }
}
