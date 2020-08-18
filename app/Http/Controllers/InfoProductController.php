<?php

namespace App\Http\Controllers;

use App\Product;
use App\InfoProduct;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\StripeController;

class InfoProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.ecommerce.products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'required',
            'price' => 'required'
        ]);

        if(is_file($request->image)){
            $route = $request->image->store('products-images','public');
            $route_image = '/storage/'.$route;

            $img = Image::make(public_path("storage/{$route}"))->fit(500,500);
            $img->save();
        }else{
            $route_image = $request->image;
        }

        InfoProduct::create([
            'description' => $request->description,
            'information' => $request->information,
            'image' => $route_image,
            'price' => $request->price,
            'product_id' => $product->id,
            'url_ml' => $request->url_ml,
            'url_am' => $request->url_am,
            'url_ms' => $request->url_ms
        ]);

        $product->status = 2;
        $product->save();

        return redirect()->route('adminecommerce.products')->with('success','Información de producto guardada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InfoProduct  $infoProduct
     * @return \Illuminate\Http\Response
     */
    public function show(InfoProduct $infoProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InfoProduct  $infoProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoProduct $infoproduct)
    {
        return view('admin.ecommerce.products.edit', compact('infoproduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InfoProduct  $infoProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfoProduct $infoproduct)
    {

        $infoproduct->update($request->except(['_token','_method']));
        return redirect()->route('adminecommerce.products')->with('success','Información actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InfoProduct  $infoProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoProduct $infoproduct)
    {
        return $infoproduct->delete();
    }
}
