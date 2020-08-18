<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /* ----- ----- ----- CRUD Subcategory ----- ----- ----- */

    public function index()
    {
        $subcategories = Subcategory::get();
        return view('admin.subcategories.index',compact('subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Subcategory::create($request->except('_token'));

        return redirect()->back()->with('success','Categoria guardada con exito');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->back()->with('success','Categoria eliminada con exito');
    }

    /* ----- ----- ----- Subcategories to category ----- ----- ----- */
    public function indexsubcategory(Category $category)
    {
        $subcategories = Subcategory::get();
        return view('admin.categories.subcategory',compact('category','subcategories'));
    }

    public function savesubcategory(Request $request,Category $category)
    {
        foreach($request->subcategories as $subcategory){
            $category->subcategories()->attach($subcategory);
        }

        return redirect()->back()->with('success','Subcategoria registrada en la categoria');
    }

    public function destroysubcategory(Request $request, Category $category)
    {
        $category->subcategories()->detach($request->subcategory);

        return redirect()->back()->with('success','Subcategoria eliminada con éxito');
    }

    /* ----- ----- ----- Subcategories product ----- ----- ----- */
    public function savesubcategory_product(Request $request,Product $product)
    {
        foreach($request->subcategories as $subcategory){
            $product->subcategories()->attach($subcategory);
        }

        return redirect()->back()->with('success','Subcategoria registrada en el producto');
    }

    public function destroysubcategory_product(Request $request, Product $product)
    {
        $product->subcategories()->detach($request->subcategory);

        return redirect()->back()->with('success','Subcategoria eliminada con éxito');
    }
}
