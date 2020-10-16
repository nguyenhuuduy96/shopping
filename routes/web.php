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
Route::get('contact', function () {
	return view('home.contact');
});
Route::get('check-is-active', function () {
	return view('checkIsActive');
})->name('check');
Route::post('send-contact','ContactController@SenContact');

Route::get('register','AuthController@register')->name('register');
Route::post('save-register','AuthController@saveregister')->name('save.register');
Route::get('login','AuthController@login')->name('login');
Route::post('login','AuthController@postlogin');
Route::post('check-phone','AuthController@checkPhonevery');
Route::post('post-login','AuthController@activelogin');
Route::get('logout','AuthController@logout')->name('logout');


Route::post('payment','CartController@payment');
Route::get('check-out-seccess/{bill_code}','CartController@CheckOutSuccess')->name('check.out.success');
Route::get('check-bill','HomeCotroller@checkbill')->name('check.bill.home');

Route::get('get-page-product','HomeCotroller@getPageProductHome');