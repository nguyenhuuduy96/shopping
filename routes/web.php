<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'HomeCotroller@index')->name('home');
Route::get('product/{slug?}','HomeCotroller@product')->name('home.product');
Route::get('detail-product/{id?}','HomeCotroller@detailproduct')->name('detail.product');
Route::get('get-search','HomeCotroller@getsearch')->name('get.search');
Route::get('getQuickView','HomeCotroller@QuickView')->name('get.quick.view');
Route::get('get-quick-view-price-size','HomeCotroller@getQVprice')->name('get.price');
Route::get('search-product-home','HomeCotroller@getSearchHome');
Route::post('get-size-quick-view','HomeCotroller@getMiddlesizes')->name('get.size');
Route::get('get-ajax-home','HomeCotroller@getAjaxHome');
Route::group(['prefix'=>'cart'],function(){
	Route::post('/add','CartController@add')->name('cart.add');
	Route::post('delete','CartController@delete')->name('cart.delete');
	Route::get('shoping-cart','CartController@showCart')->name('cart.show');
	Route::post('update','CartController@update')->name('cart.update');
	Route::get('checkout','CartController@checkout');
});

Route::group(['prefix'=>'admin-product','middleware' => 'auth'],function(){
	Route::get('list','Admin\ProductController@list')->name('list.product');
	Route::post('add-and-update','Admin\ProductController@save')->name('save.add.and.update.product');
	Route::get('get-ajax-product','Admin\ProductController@getAjaxProduct');
	Route::get('get-size-all','Admin\ProductController@getSizeAll')->name('get.size.all');
	Route::post('delete-image','Admin\ProductController@deleteImage');
	Route::post('delete-size-price-stock','Admin\ProductController@DeleteSizePriceStock');
	Route::post('delete-product','Admin\ProductController@deleteproduct');
	Route::post('delete-size-table-row','Admin\ProductController@deleteSizeTable');
	Route::post('get-size','Admin\ProductController@getsize');
	Route::post('save-size','Admin\ProductController@savesize');
	Route::get('search-product','Admin\ProductController@searchProduct');
	Route::post('check','Admin\ProductController@checkphone');
	Route::get('category','Admin\CategoryProductController@index')->name('list.cate');

});

Route::get('register','AuthController@register')->name('register');
Route::post('save-register','AuthController@saveregister')->name('save.register');
Route::get('login','AuthController@login')->name('login');
Route::post('check-phone','AuthController@checkPhonevery');
Route::post('post-login','AuthController@activelogin');
Route::get('logout','AuthController@logout')->name('logout');

Route::get('dashboard',function(){
	return view('admin.dashboard');
});
Route::get('test',function(){
	return view('test');
});