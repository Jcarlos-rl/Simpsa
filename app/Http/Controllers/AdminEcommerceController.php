<?php

namespace App\Http\Controllers;

use App\Label;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\StripeController;

class AdminEcommerceController extends Controller
{
    public function index()
    {
        return view('admin.ecommerce.index');
    }

    /* ----- ----- ----- Pestaña de productos ----- ----- ----- */
    public function products()
    {
        $products = Product::where('status','!=',0)
                    ->paginate(5);
        $categories = Category::get();
        $labels = Label::get();
        return view('admin.ecommerce.products.index', compact('products','categories','labels'));
    }

    public function create(Product $product)
    {

        $product->status = 1;
        $product->save();

        return redirect()->route('adminecommerce.products')->with('success','Producto agregado a la tienda en linea');
    }

    public function search(Request $request)
    {
        $products = Product::where('code','like', '%'.$request->search.'%')
                                ->where('status',false)
                                ->orWhere('title','like','%'.$request->search.'%')
                                ->where('status',false)
                                ->paginate(10);

        return response([
            $products
        ]);
    }

    public function destroy(Product $product)
    {

        $product->status = 0;
        $product->save();

        if($product->info != null){

            /* ----- ----- ----- Eliminamos el registro de la tabla infoproducts ----- ----- ----- */
            (new InfoProductController)->destroy($product->info);

            /* ----- ----- ----- Eliminamos las categorias del producto ----- ----- ----- */
            $categories = $product->categories;
            foreach($categories as $category){
                $product->categories()->detach($category->id);
            }

            /* ----- ----- ----- Eliminamos las etiquetas del producto ----- ----- ----- */
            $labels = $product->labels;
            foreach($labels as $label){
                $product->labels()->detach($label->id);
            }

        }


        return redirect()->route('adminecommerce.products')->with('success','Producto eliminado de la tienda en linea');
    }
}
