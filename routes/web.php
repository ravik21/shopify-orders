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
Route::get('connect', 'ShopifyController@connect');

Route::get('shopify/oauth/authorize', 'ShopifyController@getResponse');
Route::get('shopify/products/{id?}', 'ShopifyController@getProduct');
Route::get('shopify/orders/{id?}', 'ShopifyController@getOrders');
