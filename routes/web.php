<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Supplier
Route::get('/Supplier', 'SupplierController@index');
Route::get('/Supplier/Create', 'SupplierController@create'); 
Route::get('/Supplier/Edit/id={id}', 'SupplierController@edit');
Route::get('/Supplier/Deactivate/id={id}', 'SupplierController@destroy');
Route::get('/Supplier/Soft', 'SupplierController@soft');
Route::get('/Supplier/Reactivate/id={id}', 'SupplierController@reactivate');
Route::get('/Supplier/Remove/id={id}', 'SupplierController@remove');

Route::post('/Supplier/Store','SupplierController@store');
Route::post('/Supplier/Update/id={id}','SupplierController@update');

//ProductType
Route::get('/ProductType','pTypeController@index');
Route::get('/ProductType/Create','pTypeController@create');
Route::get('/ProductType/Edit/id={id}', 'pTypeController@edit');
Route::get('/ProductType/Deactivate/id={id}', 'pTypeController@destroy');
Route::get('/ProductType/Soft', 'pTypeController@soft');
Route::get('/ProductType/Reactivate/id={id}', 'pTypeController@reactivate');
Route::get('/ProductType/Remove/id={id}', 'pTypeController@remove');

Route::post('/ProductType/Store','pTypeController@store');
Route::post('/ProductType/Update/id={id}','pTypeController@update');

//ProductBrand
Route::get('/ProductBrand','pBrandController@index');
Route::get('/ProductBrand/Create','pBrandController@create');
Route::get('/ProductBrand/Edit/id={id}', 'pBrandController@edit');
Route::get('/ProductBrand/Deactivate/id={id}', 'pBrandController@destroy');
Route::get('/ProductBrand/Soft', 'pBrandController@soft');
Route::get('/ProductBrand/Reactivate/id={id}', 'pBrandController@reactivate');
Route::get('/ProductBrand/Remove/id={id}', 'pBrandController@remove');

Route::post('/ProductBrand/Store','pBrandController@store');
Route::post('/ProductBrand/Update/id={id}','pBrandController@update');

//UOM
Route::get('/UnitMeasurement','UomController@index');
Route::get('/UnitMeasurement/Create','UomController@create');
Route::get('/UnitMeasurement/Edit/id={id}', 'UomController@edit');
Route::get('/UnitMeasurement/Deactivate/id={id}', 'UomController@destroy');
Route::get('/UnitMeasurement/Soft', 'UomController@soft');
Route::get('/UnitMeasurement/Reactivate/id={id}', 'UomController@reactivate');
Route::get('/UnitMeasurement/Remove/id={id}', 'UomController@remove');

Route::post('/UnitMeasurement/Store','UomController@store');
Route::post('/UnitMeasurement/Update/id={id}','UomController@update');

//Variant
Route::get('/ProductVariant','VariantController@index');
Route::get('/ProductVariant/Create','VariantController@create');
Route::get('/ProductVariant/Category/{id}','VariantController@category');
Route::get('/ProductVariant/Edit/id={id}', 'VariantController@edit');
Route::get('/ProductVariant/Deactivate/id={id}', 'VariantController@destroy');
Route::get('/ProductVariant/Soft', 'VariantController@soft');
Route::get('/ProductVariant/Reactivate/id={id}', 'VariantController@reactivate');
Route::get('/ProductVariant/Remove/id={id}', 'VariantController@remove');

Route::post('/ProductVariant/Store','VariantController@store');
Route::post('/ProductVariant/Update/id={id}','VariantController@update');

//Product
Route::get('/Product','ProductController@index');
Route::get('/Product/Create','ProductController@create');
Route::get('/Product/Type/{id}','ProductController@type');
Route::get('/Product/Edit/id={id}', 'ProductController@edit');
Route::get('/Product/Deactivate/id={id}', 'ProductController@destroy');
Route::get('/Product/Soft', 'ProductController@soft');
Route::get('/Product/Reactivate/id={id}', 'ProductController@reactivate');
Route::get('/Product/Remove/id={id}', 'ProductController@remove');

Route::post('/Product/Store','ProductController@store');
Route::post('/Product/Update/id={id}','ProductController@update');

//Transaction
//Stocks
Route::get('/Stock','StockController@index');
Route::get('/Stock/Receive','StockController@receive');
Route::get('/Stock/Item/{id}','StockController@product');
Route::post('/Stock/Receive/Store','StockController@store');

//Purchase Order
// Route::get('/PurchaseOrder','PurchaseController@index');
// Route::get('/PurchaseOrder/Create','PurchaseController@create');
// Route::get('/Purchase/Item/{id}','PurchaseController@product');
// Route::get('/Purchase/Final/{id}','PurchaseController@final');
// Route::get('/PurchaseOrder/Edit/id={id}', 'PurchaseController@edit');
// Route::get('/PurchaseOrder/Deactivate/id={id}', 'PurchaseController@destroy');
// Route::get('/PurchaseOrder/Soft', 'PurchaseController@soft');
// Route::get('/PurchaseOrder/Reactivate/id={id}', 'PurchaseController@reactivate');
// Route::get('/PurchaseOrder/Remove/id={id}', 'PurchaseController@remove');

// Route::post('/PurchaseOrder/Store','PurchaseController@store');
// Route::post('/PurchaseOrder/Finalize/{id}','PurchaseController@finalize');
// Route::post('/PurchaseOrder/Update/id={id}','PurchaseController@update');

// //Delivery
// Route::get('/DeliveryOrder','DeliveryController@index');
// Route::get('/DeliveryOrder/Create','DeliveryController@create');
// Route::get('/DeliveryOrder/Purchase/{id}','DeliveryController@purchase');
// Route::get('/DeliveryOrder/Product/{id}','DeliveryController@product');

// Route::post('/DeliveryOrder/Store','DeliveryController@store');