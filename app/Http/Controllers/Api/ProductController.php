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
    public function getAjaxProductAndPage(Request $request){
		
		$page = !empty($request->paga)?$request->paga-1:0;
		$show = isset($request->show)?$request->show:10;
		$search = isset($request->search)?$request->search:'';
		$skip = $page*$show;
		if (isset($search)) {
			$products = Product::where('name','like',"%$search%")->get();
			$totalProduct = count($products);
			$totalPage = ceil($totalProduct / $show);
			$productsPage=$products->skip($skip)->take($show);
		} else {
			$products = Product::all();
			$totalProduct = count($products);
			$totalPage = ceil($totalProduct / $show);
			$productsPage=$products->skip($skip)->take($show);
		}
		
    	 $products =  JsonProduct::collection($productsPage);
    	return ['products'=>$products,'totalPage'=>$totalPage,'skip'=>$page];
    }
    public function getSizePrice(Request $request){
    	$middles= Middle::where([['product_id',$request->product_id],['color_id',$request->color_id]])->get();
		// return $middles;
		return MiddleSize::collection($middles);
    }
}
