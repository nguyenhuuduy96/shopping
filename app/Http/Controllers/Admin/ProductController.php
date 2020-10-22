<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image as FileUpload;
use App\Models\Size;
use App\Models\Color;
use App\Models\Middle;
use App\Models\ProductCategory;
use App\User;
use Str;
use Auth;
use URL;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{
    public function list(Request $req){
    
            $products=Product::paginate(10);
    		$sizes = Size::all();
    		$colors = Color::all();
    		
    		$cates= ProductCategory::all();
  
	return view('admin.product.list',['products'=>$products,'sizes'=>$sizes,'colors'=>$colors,'cates'=>$cates]);
    	
	}
	
    public function getAjaxProduct(Request $req){
		
		$product=Product::find($req->id);
		$productSizes=$product->sizes;
		$productColors = $product->colors;
		$colors= Color::all();
		$sizes=Size::all();
		$cates = ProductCategory::all();
		$images=$product->images;
		$parent_id=!empty($product->cate->cate)?$product->cate->cate:['id'=>null];
		
		return response()->json(['product'=>$product,'productSizes'=>$productSizes,'sizes'=>$sizes,'images'=>$images,'colors'=>$colors,'productColors'=>$productColors,'cates'=>$cates,'parent_id'=>$parent_id]);
	}
	public function GetAllCates(Request $req){
		$check = ProductCategory::find($req->id);
		$cates =!empty($check->cates)?$check->cates:null;
		return response()->json(['cates'=>$cates]);
	}
	// xóa 1 anh
	public function deleteImage(Request $req){
		$image=FileUpload::find($req->id);
		$image->delete();
	}
	// xóa 1 màu vs size của bang middle
	public function DeleteSizePriceStock(Request $req){
		
		$middle=Middle::find($req->id);
		$middle->delete();
	}
	
	public function getSizeAll(){
		$getsize =Size::all();
		$getColors= Color::all();
		$cates = ProductCategory::all();
		return response()->json(['getsize'=>$getsize,'getColors'=>$getColors,'cates'=>$cates]);
	}
	public function checkphone(Request $req){
		$phone = '0'.$req->phone;
		$user = User::where('phone',$phone)->first();
		if (isset($user)) {
			# code...
			return response()->json(['phone'=>$user]);
		} else {
			# code....
			return response()->json(['phone'=>$phone]);
		}
		
		
	}
	// xóa 1 sản phẩm
	public function deleteproduct(Request $req){
		
		$product=Product::find($req->id);
		$product->delete();
		return response()->json(['product'=>'success']);
	}
	
	// lưu sản phẩm
    public function save(Request $req){
		$product = isset($req->id)? Product::find($req->id) : new Product();
		if(isset($req->date)){
			$product->time_expired=date("Y-m-d",strtotime($req->date));
		}
		$product->slug = Str::slug($req->name.'-'.microtime());
		$product->product_category_id = isset($req->child_id)?$req->child_id:$req->parent_id;
		$product->fill($req->all());
		$product->save();
		foreach ($req->color_id as $key => $color) {
			# code...
			
			if (isset($req->middle_id[$key])) {
				# code...
				$middle = Middle::find($req->middle_id[$key]);
				$middle->price=$req->price[$key];
				$middle->stock=$req->stock[$key];
				$middle->color_id=$color;
				$middle->size_id=$req->size_id[$key];
				$middle->save();
				// $product->sizes()->updateExistingPivot($size,['price'=>$req->price[$key],'stock'=>$req->stock[$key]]);
			} else {
				
				$product->colors()->attach($color,['price'=>$req->price[$key],'stock'=>$req->stock[$key],'size_id'=>$req->size_id[$key]]);

			}
			
		}

		$i=-1;
		
		if (isset($req->sort)) {
			foreach ($req->sort as $key => $value) {
				# code...
				if (isset($req->image_id[$key])) {
					# code...
					$image= FileUpload::find($req->image_id[$key]);
					$image->sort=$value;
					$image->save();

				} else {
					# code...
					$i++;
					
					$img = new FileUpload();
					
					
	        		  $image = $req->file[$i];

			          $name = str::slug(str_replace(time(), '.jpeg', str::random(30))."-".str::random(20).".jpeg");

			          \Image::make($req->file[$i])->save(public_path('img/images/').$name);
			         
        			
					$img->product_id=$product->id;
					$img->sort=$value;
					$img->image=URL::to('/').'/img/images/'.$name;
					$img->save();
					
				}
				
			}
		}
	
	
		return response()->json(['product'=>$product]);
    }
    //table size
    public function getsize(Request $req){

		$size = Size::find($req->id);
		return response()->json(['size'=>$size]);
	}
	public function deleteSizeTable(Request $req){
		Size::find($req->id)->delete();

	}
	public function savesize(Request $req){
		if (isset($req->id)) {
			# code...
			$size = Size::find($req->id);
			$size->size=$req->size;
			$size->save();
		} else {
			$size = new Size();
			$size->size=$req->size;
			$size->save();
		}
		
		
		return response()->json(['size'=>$size]);
	}
      //color	
	public function getcolor(Request $req){

		$color = Color::find($req->id);
		return response()->json(['color'=>$color]);
	}
	public function deleteColorTable(Request $req){
		// return response()->json(['color'=>$req->all()]);
		Color::find($req->id)->delete();

	}
	public function savecolor(Request $req){
		// return response()->json(['color'=>$req->all()]);
		if (isset($req->id_color)) {
			# code...
			$color = Color::find($req->id_color);
			$color->name=$req->name_color;
			$color->save();
		} else {
			$color = new Color();
			$color->name=$req->name_color;
			$color->save();
		}
		
		
		return response()->json(['color'=>$color]);
	}
    
}
