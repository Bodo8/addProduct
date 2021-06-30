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
//Product
Route::get('/product/create', 'ProductController@create');
Route::post('/product', 'ProductController@store');
Route::patch('/update{id}', 'ProductController@update');
Route::get('/list', 'ProductController@index');
Route::get('/edit{id}', 'ProductController@edit');
Route::get('/destroy{id}', 'ProductController@destroy');

//Cart
Route::get('cart/list', 'CartController@index');
Route::get('cart/edit{id}', 'CartController@edit');

//Shop
Route::get('shop/products', 'ShopController@index');
Route::post('shop/store', 'ShopAjaxController@store');