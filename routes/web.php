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

Route::post('/ProductBrand/Store','pBrandController@store');