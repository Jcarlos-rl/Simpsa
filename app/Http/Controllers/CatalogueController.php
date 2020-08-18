<?php

namespace App\Http\Controllers;

use App\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CatalogueController extends Controller
{
    public function index()
    {
        $catalogues = Catalogue::get();
        return view('admin.ecommerce.catalogues.index', compact('catalogues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'pdf' => 'required | mimes:pdf',
            'img' => 'required | image'
        ]);

        $route_pdf = $request->pdf->store('catalogues/pdf','public');
        $route_image = $request->img->store('catalogues/image','public');

        Catalogue::create([
            'title' => $request->title,
            'pdf' => $route_pdf,
            'img' => $route_image
        ]);

        return redirect()->route('adminecommercecatalogues.index')->with('success','Catalogo guardado con éxito');
    }

    public function destroy(Catalogue $catalogue)
    {
        Storage::delete(['public/'.$catalogue->img,'public/'.$catalogue->pdf]);
        $catalogue->delete();

        return redirect()->route('adminecommercecatalogues.index')->with('success','Catalogo eliminado con éxito');
    }
}
