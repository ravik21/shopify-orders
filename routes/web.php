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

Route::prefix('shopify')->group(function () {
    Route::get('oauth/authorize', 'ShopifyController@getResponse');
    Route::get('products/{id?}', 'ShopifyController@getProduct');
    Route::get('orders/{id?}', 'ShopifyController@getOrders');
    Route::get('webhook/create', 'ShopifyController@createWebhook');
    Route::get('webhook/carts/create', 'ShopifyController@createWebhookForcarts');
    Route::get('webhooks', 'ShopifyController@getWebhooks');
});
