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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix'=>'category-product'],function(){
	Route::post('save','Admin\CategoryProductController@store');
	Route::get('list','Admin\CategoryProductController@allCategory');
	Route::get('/{cate}','Admin\CategoryProductController@show');
	Route::delete('/{cate}','Admin\CategoryProductController@destroy');
	
});



Route::group(['prefix'=>'category-blog'],function(){
	Route::post('save','Admin\BlogCategoryController@store');
	Route::get('list','Admin\BlogCategoryController@allCategory');
	Route::get('/{cate}','Admin\BlogCategoryController@show');
	Route::delete('/{cate}','Admin\BlogCategoryController@destroy');
	
});



Route::group(['prefix'=>'product'],function(){
	Route::get('get-ajax-product-and-page','Api\ProductController@getAjaxProductAndPage');
	Route::post('get-size-price','Api\ProductController@getSizePrice');
});
Route::group(['prefix'=>'bill'],function(){
	Route::post('add-new','Api\BillController@addnew');
	Route::get('get-ajax-bill-page', 'Api\BillController@getAjaxBillAndPage');
});
Route::post('check-bill','Api\BillController@checkBill');