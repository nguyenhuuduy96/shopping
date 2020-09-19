<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Middle;
use App\Http\Resources\ProductResource as JsonProduct;
use App\Http\Resources\MiddleSize;
class ProductController extends Controller
{
    public function search(Request $request){
    	// $products = Product::where('name','like',"%$request->name%")->get();
    	$products = Product::where('name','like',"%$request->search%")->get();
    	    	$searchtotal =  JsonProduct::collection($products);
    	return ['products'=>$searchtotal];
    }
    public function getSizePrice(Request $request){
    	$middles= Middle::where([['product_id',$request->product_id],['color_id',$request->color_id]])->get();
		// return $middles;
		return MiddleSize::collection($middles);
    }
}
