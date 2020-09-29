<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Size;
use App\Models\Middle;
use Str;
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
use App\Http\Resources\MiddleSize;
use DB;
use App\Http\Resources\ProductResource;
use App\Models\ProductCategory;
use Hash;
use App\User;
class HomeCotroller extends Controller
{
	public function index(){
		$sizes=Size::all();
		$products=Product::paginate(16);
		$product=Product::find(5);
		
		
		return view('home.home',['products'=>$products]);
		
	}
	public function getAjaxHome(Request $request){
		$products= Product::take(16)->orderby('created_at','desc')->get();

		return ProductResource::collection($products);
		
	}
	public function product(Request $request,$slug=null){
		// $pass= Hash::make('123456');
		// $array = [['name'=>'name','email'=>'admin121@gmail.com','password'=>$pass,'created_at'=>'2020-5-25 20:08:20'],['name'=>'name1','email'=>'admin112@gmail.com','password'=>$pass,'created_at'=>'2020-6-25 20:08:20']];
		
	 // // DB::table('users')->insert($array);
		// $year= date('Y');
		
		// $users=User::select(DB::raw('count(id) as `count`'),DB::raw("month(created_at) as month"))
  //       ->groupBy('month')->get();
		// dd($users);
		if (isset($slug)) {
			$cate= ProductCategory::where('slug',$slug)->first();
			$products= $cate->products;
		} else {
			$products=Product::paginate(16);
		}
		return view('home.product',compact('products'));
		
	}
	public function detailproduct(Request $req,$id=null){
		if (empty($id)) {
			# code...
			echo "Error link url";
			die();
		}
		$product = Product::find($id);
		if (empty($product)) {
			# code...
			echo "Error link url";
			die();
		}
		$colors=$product->colors;
		$arrayColors=[];
		foreach ($colors as $color) {
			if (count($arrayColors)<1) {
				array_push($arrayColors, $color);
			}
			$check=array_filter($arrayColors, function($k) use ($color) {
				// echo json_encode($k);
				if ($k->color == $color->color) {
					
					return $color;
				}

				
			});
			
			if (count($check)<1) {
				array_push($arrayColors, $color);
			}
		}
		
		return view('home.product-detail',['product'=>$product,'colors'=>$arrayColors]);
	}

	// get quick view
	public function QuickView(Request $req){
		
		$product = Product::where('id',$req->id)->first();
		// $product=Product::find(5);
		$lastPrice = !empty($product->firstprice[0]->price)?$product->firstprice[0]->price:'0';

		$images=$product->images;

		$sizes=$product->sizes;
		$colors=$product->colors;
		$arrayColors=[];
		foreach ($colors as $color) {
			if (count($arrayColors)<1) {
				array_push($arrayColors, $color);
			}
			$check=array_filter($arrayColors, function($k) use ($color) {
				// echo json_encode($k);
				if ($k->color == $color->color) {
					
					return $color;
				}

				
			});
			// echo json_encode($check);
			if (count($check)<1) {
				array_push($arrayColors, $color);
			}
		}
		$imagefirst = $product->firstImage;
		// dd($arrayColors);

		return response()->json(['product'=>$product,'image'=>$images,'sizes'=>$sizes,'price'=>$lastPrice,'colors'=>$arrayColors,'cartImage'=>$imagefirst]);
	}
	public function getQVprice(Request $req){
		// $arrayId = explode(" ", $req->id);
		$price = Middle::find($req->id);
		return response()->json(['price'=>$price]);
	}
	public function getSearchHome(Request $req){
		$products= Product::where('name','like',"%$req->search%")->take(16)->get();
		$arraySearch=[];
		foreach ($products as $product) {
			$price=isset($product->firstprice[0]->price)?$product->firstprice[0]->price:'0';
			$image=isset($product->firstImage[0]->image)?$product->firstImage[0]->image:'img/default.jpg';
			array_push($arraySearch, ['id'=>$product->id,'name'=>$product->name,'image'=>$image,'price'=>$price]);
		}
		return response()->json(['products'=>$arraySearch]);
	}
	public function getAjaxProduct(Request $req){
		// return response()->json(['product'=>'ss']);
		$product=Product::find($req->id);
		$productSizes=$product->sizes;
		$sizes=Size::all();
		$images=$product->images;
		return response()->json(['product'=>$product,'productSizes'=>$productSizes,'sizes'=>$sizes,'images'=>$images]);
	}
	public function getMiddlesizes(Request $request){
		// return response()->json(['data'=>$request->all()]);
		$middles= Middle::where([['product_id',$request->product_id],['color_id',$request->color_id]])->get();
		// return $middles;
		return MiddleSize::collection($middles);
	}
	
	//check bill
	public function checkbill(){
		return view('home.checkBill');
	}
}
