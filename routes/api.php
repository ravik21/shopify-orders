<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('orders/webhook/{status?}', 'ShopifyController@orderWebhook');
Route::post('{shopId}/carts/create', 'ShopifyController@shopCartCreate');
Route::post('{shopId}/webhook/orders', 'ShopifyController@webhookOrders');
