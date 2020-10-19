<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Blog;
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
		// $cate= ProductCategory::find(8);
		// dd($cate->cates);
		$product=Product::find(5);
		$blogs = Blog::take(3)->get();
			
		return view('home.home',['products'=>$products,'blogs'=>$blogs]);
		
	}
	public function getAjaxHome(Request $request){
		$products= Product::take(16)->orderby('created_at','desc')->get();

		return ProductResource::collection($products);
		
	}
	public function product(Request $request,$slug=null){
		
	
		
		$cate = !empty(ProductCategory::where('slug',$slug)->first())?ProductCategory::where('slug',$slug)->first():null;
		// if(isset($request->SearchProduct)){
		// 	$productsPage = Product::where('name','like',"%$request->SearchProduct%")->take(12)->get();
		// 	// dd($products);
		// }else
		// if (isset($cate)) {
		// 	$products = !isset($cate->parent_id)?$cate->products_cates:$cate->products;
			
		// 	$productsPage=$products->skip(0)->take(12);
		// }else {
			
		// 	$productsPage = Product::skip(0)->take(12)->get();

		// }
		return view('home.product',compact('cate'));
		
	}
	// blog 
	public function Blog(Request $request){
		$blogs = Blog::paginate(3);
		$products = Product::take(3)->get();
		$cates = ProductCategory::all();
		return view('home.blog',compact('blogs','cates','products'));
	}
	public function BlogDetail(Request $request,$slug=null){
		if (empty($slug)) {
			# code...
			echo "Error link url";
			die();
		}
		$blog = Blog::where('slug',$slug)->first();
		
		$products = Product::take(3)->get();
		$cates = ProductCategory::all();
		return view('home.blogdetail',compact('blog','cates','products'));
	}
	// phân trang product
	public function getPageProductHome(Request $request){
		$page = isset($request->page)?$request->page-1:0;
		$show = isset($request->show)?$request->show:12;
		$search = isset($request->search)?$request->search:'';
		$skip = $page*$show;
		$slug = isset($request->slug)?$request->slug:'quan-047934300-1603094721';
		$cate = !empty(ProductCategory::where('slug',$slug)->first())?ProductCategory::where('slug',$slug)->first():null;
		if(isset($search)){
			$products = Product::where('name','like',"%$search%")->get();
			$totalProduct = count($products);
			$totalPage = ceil($totalProduct / $show);
			$productsPage=$products->skip($skip)->take($show);
		}
		if (isset($cate)) {
			$products = empty($cate->parent_id)?$cate->products_cates:$cate->products;
			$totalProduct = count($products);
			$totalPage = ceil($totalProduct / $show);
			$productsPage=$products->skip($skip)->take($show);
			
			// return response()->json(['totalPage'=>$totalPage,'showProductPage'=>$showProductPage,'cate'=>$cate]);
		}else {
			$totalProduct = count(Product::all());
			$totalPage = ceil($totalProduct / $show);
			$productsPage = Product::skip($skip)->take($show)->get();

		}
		$showProductPage = ProductResource::collection($productsPage);
		// echo json_encode($showProductPage);die();
		// dd($totalPage,$productsPage);
		return response()->json(['totalPage'=>$totalPage,'showProductPage'=>$showProductPage,'cate'=>$cate]);
		
		
	}
	public function detailproduct(Request $req,$slug=null){
		if (empty($slug)) {
			# code...
			echo "Error link url";
			die();
		}
		$product = Product::where('slug',$slug)->first();
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
