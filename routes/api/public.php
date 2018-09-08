<?php

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| Applied Middleware : Bindings, Throttle
*/

Route::get('customers', 'ShopifyCustomerController@getCustomers');
Route::get('customers/simple', 'ShopifyCustomerController@getCustomersSimplified');
Route::get('customers/count', 'ShopifyCustomerController@getCustomersCount');
Route::get('customers/search/name/{name}', 'ShopifyCustomerController@search');

Route::post('submissions', 'SubmissionController@store');
