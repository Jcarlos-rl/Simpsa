<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /* ----- ----- ----- CRUD Category ----- ----- ----- */
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create($request->except('_token'));

        return redirect()->back()->with('success','Categoria guardada con exito');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success','Categoria eliminada con exito');
    }


    /* ----- ----- ----- ----- ----- ----- ----- ----- -----  Categories product ----- ----- ----- */
    public function indexproduct(Product $product)
    {
        $brand = $product->brand;
        $categories = $brand->categories;
        $subcategories = Subcategory::get();
        return view('admin.ecommerce.products.category', compact('product','categories','subcategories'));
    }


    public function savecategory(Request $request, Product $product)
    {
        foreach($request->categories as $category){
            $product->categories()->attach($category);
        }

        return redirect()->back()->with('success','Categorias registradas en el producto');
    }

    public function destroycategory(Product $product, Category $category)
    {
        $product->categories()->detach($category->id);

        return redirect()->back()->with('success','Categoria eliminada con éxito');
    }

    /* ----- ----- ----- ----- ----- ----- ----- ----- -----  Categories brand ----- ----- ----- */

    public function index_brand(Brand $brand)
    {
        $categories = Category::get();
        return view('admin.brands.categories', compact('brand','categories'));
    }

    public function savecategory_brand(Request $request, Brand $brand)
    {
        foreach($request->categories as $category){
            $brand->categories()->attach($category);
        }

        return redirect()->back()->with('success','Categorias registradas en la marca');
    }

    public function destroy_brand(Request $request, Brand $brand)
    {
        $brand->categories()->detach($request->category);

        return redirect()->back()->with('success','Categoria eliminada con éxito');
    }
}
