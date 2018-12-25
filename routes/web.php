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
Route::get('/home', 'WelcomeController@index')->name('welcome');

Route::get('/category/{category}/product/{id}/{slug?}', 'ProductController@show')->name('product');
Route::get('/cart', 'ProductController@showCart')->name('product.showCart');
Route::post('/add-to-cart/{id}', 'ProductController@addToCart')->name('product.addToCart');
Route::get('/update-cart/{id}/{size}', 'ProductController@updateCart')->name('product.updateCart');
Route::delete('/delete-from-cart/{id}/{size}', 'ProductController@deleteFromCart')->name('product.deleteFromCart');
Route::get('/order/new', 'ProductController@order')->name('product.order');
Route::post('/transfer/order/new', 'TransferController@order')->name('transfer.order');
Route::post('/transfer/order/callback', 'TransferController@callback')->name('transfer.callback');
Route::get('/transfer/order/success', 'TransferController@success')->name('transfer.success');
Route::get('/transfer/order/error', 'TransferController@error')->name('transfer.error');
Route::get('/category/{category}', 'CategoryController@show')->name('category');

Auth::routes(['verify' => 'true']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
