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