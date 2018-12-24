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

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/product/{id}/{slug?}', 'ProductController@show')->name('product');
Route::get('/cart', 'ProductController@showCart')->name('product.showCart');
Route::post('/add-to-cart/{id}', 'ProductController@addToCart')->name('product.addToCart');
Route::get('/update-cart{id}/{size}', 'ProductController@updateCart')->name('product.updateCart');
Route::delete('/delete-from-cart/{id}/{size}', 'ProductController@deleteFromCart')->name('product.deleteFromCart');
Route::post('/order', 'TransferController@order')->name('transfer.order');
Route::post('/order/callback', 'TransferController@callback')->name('transfer.callback');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
