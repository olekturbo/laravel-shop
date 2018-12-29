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

Route::group(['middleware' => ['social']], function () {
    Route::get('/', 'WelcomeController@index')->name('welcome');
    Route::get('/kategoria/{category}/produkt/{id}/{slug?}', 'ProductController@show')->name('product');
    Route::get('/koszyk', 'ProductController@showCart')->name('product.showCart');
    Route::post('/dodaj-do-koszyka/{id}', 'ProductController@addToCart')->name('product.addToCart');
    Route::get('/aktualizuj-koszyk/{id}/{size}', 'ProductController@updateCart')->name('product.updateCart');
    Route::delete('/usun-z-koszyka/{id}/{size}', 'ProductController@deleteFromCart')->name('product.deleteFromCart');
    Route::get('/zamow/nowy', 'ProductController@order')->name('product.order');
    Route::post('/transfer/order/new', 'TransferController@order')->name('transfer.order');
    Route::post('/transfer/order/callback', 'TransferController@callback')->name('transfer.callback');
    Route::get('/transfer/order/success', 'TransferController@success')->name('transfer.success');
    Route::get('/transfer/order/error', 'TransferController@error')->name('transfer.error');
    Route::get('/kategoria/{category}', 'CategoryController@show')->name('category');
    Route::get('/login/{provider}',          'Auth\SocialAccountController@redirectToProvider')->name('provider.login');
    Route::get('/login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback')->name('provider.callback');
    Route::get('/login/fill-data', 'Auth\SocialAccountController@fillData')->name('provider.fill-data');
    Route::post('/login/store-data', 'Auth\SocialAccountController@storeData')->name('provider.store-data');
});


Auth::routes(['verify' => 'true']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
