<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- Rutas Ecommerce ----- ----- ----- */
Route::get('/','EcommerceController@index')->name('ecommerce.index');
Route::get('contacto','EcommerceController@contact')->name('ecommerce.contact');
Route::get('catalogos','EcommerceController@catalogue')->name('ecommerce.catalogue');
Route::get('carrito','EcommerceController@cart')->name('ecommerce.cart');
Route::get('carrito/envio','EcommerceController@shipping')->name('ecommerce.shipping');
Route::post('carrito/save','EcommerceController@saveshipping')->name('ecommerce.save');
Route::get('carrito/cobro','EcommerceController@checkout')->name('ecommerce.checkout');
Route::get('carrito/exito/{payment}','EcommerceController@success')->name('ecommerce.success');
Route::get('detalles/{product}','EcommerceController@details')->name('ecommerce.details');
Route::get('productos','EcommerceController@products')->name('ecommerce.products');
Route::get('productos/{brand}','EcommerceController@brand')->name('ecommerce.brand');
Route::get('productos/{brand}/{category}','EcommerceController@brand_category')->name('ecommerce.brand_category');
Route::get('productos/{brand}/{category}/{subcategory}','EcommerceController@brand_category_subcategory')->name('ecommerce.brand_category_subcategory');
Route::get('facturacion/{slug}','EcommerceController@invoice')->name('ecommerce.invoice');
Route::post('facturacion/{order}','EcommerceController@invoicesave')->name('ecommerce.invoice_save');

/* ----- ----- ----- Medios de contacto o registro ----- ----- ----- */
Route::post('newsletter/{channel}','ContactMeanController@newsletter')->name('ecommerce.newsletter');
Route::post('contact','ContactMeanController@contact')->name('ecommerce.contactform');


/* ----- ----- ----- cart ----- ----- ----- */
Route::get('cart/show','CartController@show')->name('cart.show');
Route::get('cart/update/{product}/{quantity}','CartController@update')->name('cart.update');
Route::get('cart/destroy/{product}','CartController@delete')->name('cart.delete');
Route::get('cart/trash','CartController@trash')->name('cart.trash');
Route::get('cart/add/{product}/{quantity}','CartController@add')->name('cart.add');

//* ----- ----- ----- Paypal ----- ----- ----- */
Route::get('payment','PaypalController@postPayment')->name('paypal.payment');
Route::get('payment/status','PaypalController@getPaymentStatus')->name('paypal.status');


//* ----- ----- ----- Stripe ----- ----- ----- */
Route::get('stripe/session','StripeController@checkoutsession')->name('stripe.session');


/* ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----  Rutas Admin ----- ----- ----- */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* ----- ----- ----- Buscar, agregar y eliminar producto de la ecommerce ----- ----- ----- */
Route::get('admin/ecommerce/products/{search}','AdminEcommerceController@search');
Route::get('admin/ecommerce/products/create/{product}','AdminEcommerceController@create');
Route::delete('admin/ecommerce/products/destroy/{product}','AdminEcommerceController@destroy')->name('adminecommerceproduct.destroy');

/* ----- ----- ----- Control de inventario ----- ----- ----- */
Route::get('admin/products/inventory','InventoryController@index')->name('inventory.index');
Route::get('admin/products/inventory/{search}','InventoryController@search');
Route::get('admin/products/inventory/create/{product}','InventoryController@add');
Route::post('admin/products/inventory/update/{inventory}','InventoryController@update')->name('inventory.update');
Route::delete('admin/products/inventory/delete/{inventory}','InventoryController@destroy')->name('inventory.destroy');

//* ----- ----- ----- CRUD de los catalogos del sitio ----- ----- ----- */
Route::get('admin/ecommerce/catalogues','CatalogueController@index')->name('adminecommercecatalogues.index');
Route::post('admin/ecommerce/catalogues','CatalogueController@store')->name('adminecommercecatalogues.store');
Route::delete('admin/ecommerce/catalogues/{catalogue}','CatalogueController@destroy')->name('adminecommercecatalogues.destroy');

/* ----- ----- ----- CRUD categories ----- ----- ----- */
Route::get('admin/products/categories','CategoryController@index')->name('category.index');
Route::post('admin/products/category','CategoryController@store')->name('category.store');
Route::delete('admin/products/category/{category}','CategoryController@destroy')->name('category.destroy');

/* ----- ----- ----- CRUD subcategories categories ----- ----- ----- */
Route::get('admin/products/category/{category}','SubCategoryController@indexsubcategory')->name('subcategory.indexsubcategory');
Route::post('admin/products/category/create/{category}','SubCategoryController@savesubcategory')->name('subcategory.savesubcategory');
Route::post('admin/products/category/destroy/{category}','SubCategoryController@destroysubcategory')->name('subcategory.destroysubcategory');

/* ----- ----- ----- CRUD subcategories product ----- ----- ----- */
Route::post('admin/ecommerce/products/category/subcategory/create/{product}','SubCategoryController@savesubcategory_product')->name('subcategory.savesubcategory_product');
Route::post('admin/ecommerce/products/category/subcategory/destroy/{product}','SubCategoryController@destroysubcategory_product')->name('subcategory.destroysubcategory_product');

/* ----- ----- ----- CRUD subcategories ----- ----- ----- */
Route::get('admin/products/subcategories','SubCategoryController@index')->name('subcategory.index');
Route::post('admin/products/subcategory','SubCategoryController@store')->name('subcategory.store');
Route::delete('admin/products/subcategory/{subcategory}','SubCategoryController@destroy')->name('subcategory.destroy');

/* ----- ----- ----- CRUD categories product ----- ----- ----- */
Route::get('admin/ecommerce/products/category/{product}','CategoryController@indexproduct')->name('category.indexproduct');
Route::post('admin/ecommerce/products/category/create/{product}','CategoryController@savecategory')->name('category.savecategory');
Route::post('admin/ecommerce/products/category/destroy/{product}/{category}','CategoryController@destroycategory')->name('category.destroycategory');

/* ----- ----- ----- CRUD labels product ----- ----- ----- */
Route::post('admin/ecommerce/products/label','LabelController@store')->name('label.store');
Route::get('admin/ecommerce/products/label/{product}','LabelController@index')->name('label.index');
Route::post('admin/ecommerce/products/label/create/{product}','LabelController@savelabel')->name('label.save');
Route::post('admin/ecommerce/products/label/destroy/{product}','LabelController@destroy')->name('label.destroy');

/* ----- ----- ----- CRUD categoties brand ----- ----- ----- */
Route::get('admin/products/brands/categories/{brand}','CategoryController@index_brand')->name('categorybrand.index');
Route::post('admin/products/brands/categories/{brand}','CategoryController@savecategory_brand')->name('categorybrand.save');
Route::post('admin/products/brands/categories/destroy/{brand}','CategoryController@destroy_brand')->name('categorybrand.destroy');

//* ----- ----- ----- CRUD crear ordenes para facturación ----- ----- ----- */
Route::get('admin/ecommerce/invoices','AdminInvoiceController@index')->name('admininvoice.index');
Route::get('admin/ecommerce/invoices/create','AdminInvoiceController@create')->name('admininvoice.create');
Route::get('admin/ecommerce/invoices/products/{search}','AdminInvoiceController@search');
Route::get('admin/ecommerce/invoices/add/{product}','AdminInvoiceController@add');
Route::get('admin/ecommerce/invoices/update/{product}/{quantity}/{price}','AdminInvoiceController@update')->name('admininvoice.update');
Route::get('admin/ecommerce/invoices/delete/{product}','AdminInvoiceController@delete')->name('admininvoice.delete');
Route::post('admin/ecommerce/invoices/save','AdminInvoiceController@save')->name('admininvoice.save');

/* ----- ----- ----- CRUD información del producto ----- ----- ----- */
Route::put('admin/ecommerce/products/{infoproduct}','InfoProductController@update')->name('infoproduct.update');
Route::get('admin/ecommerce/products/{infoproduct}/edit','InfoProductController@edit')->name('infoproduct.edit');
Route::get('admin/ecommerce/products/{product}/info','InfoProductController@create')->name('infoproduct.create');
Route::post('admin/ecommerce/products/{product}/info','InfoProductController@store')->name('infoproduct.store');

/* ----- ----- ----- Pagina inicial de ecommerce ----- ----- ----- */
Route::get('admin/ecommerce/products','AdminEcommerceController@products')->name('adminecommerce.products');

Route::get('admin/ecommerce','AdminEcommerceController@index')->name('adminecommerce.index');

Route::resource('admin/products/brands','BrandController');

Route::resource('admin/products','ProductController');

