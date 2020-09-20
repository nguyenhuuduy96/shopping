<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('dashboard',function(){
	return view('admin.dashboard');
});
Route::group(['prefix'=>'bill'],function(){
	Route::get('list','Admin\BillController@index')->name('admin.list.bill');
	Route::post('confirm','Admin\BillController@confirm');
	Route::post('cancel','Admin\BillController@cancel');
	Route::get('detail/{bill_code}','Admin\BillController@detail')->name('admin.bill.detail');
	
});
Route::group(['prefix'=>'product'],function(){
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