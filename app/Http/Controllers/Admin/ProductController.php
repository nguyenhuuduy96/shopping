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
class ProductController extends Controller
{
    public function list(Request $req){
    
            $products=Product::paginate(10);
    		$sizes = Size::all();
    		$colors = Color::all();
    		
    		// $product=Product::find(6);
    		// $color= $product->colors;
    		$cates= ProductCategory::all();
  
	return view('admin.product.list',['products'=>$products,'sizes'=>$sizes,'colors'=>$colors,'cates'=>$cates]);
    	
    }
    public function getAjaxProduct(Request $req){
		
		$product=Product::find($req->id);
		$productSizes=$product->sizes;
		$productColors = $product->colors;
		$colors= Color::all();
		$sizes=Size::all();
		$images=$product->images;
		return response()->json(['product'=>$product,'productSizes'=>$productSizes,'sizes'=>$sizes,'images'=>$images,'colors'=>$colors,'productColors'=>$productColors]);
	}
	public function deleteImage(Request $req){
		$image=FileUpload::find($req->id);
		$image->delete();
	}
	public function DeleteSizePriceStock(Request $req){
		
		$middle=Middle::find($req->id);
		$middle->delete();
		// return response()->json(['size'=>$size_id]);
	}
	public function searchProduct(Request $req){
		$products = Product::where('name','like',"%$req->search%")->take(10)->get();
		return response()->json(['products'=>$products]);
	}
	public function getSizeAll(){
		$getsize =Size::all();
		$getColors= Color::all();
		return response()->json(['getsize'=>$getsize,'getColors'=>$getColors]);
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
	public function deleteproduct(Request $req){
		
		$product=Product::find($req->id);
		$product->delete();
		return response()->json(['product'=>'success']);
	}
	public function deleteSizeTable(Request $req){
		Size::find($req->id)->delete();

	}
	public function getsize(Request $req){
		$size = Size::find($req->id);
		return response()->json(['size'=>$size]);
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
    public function save(Request $req){
    	

    
		$product = isset($req->id)? Product::find($req->id) : new Product();

		$product->time_expired=date("Y-m-d",strtotime($req->date));

		$product->slug = Str::slug($req->name.'-'.microtime());
		$product->fill($req->all());
		// return response()->json(['data'=>$product]);
		$product->save();
			
  //   	$product= Product::find(6);
		
		// return response()->json(['product'=>$req->all()]);
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
		// return response()->json(['product'=>$product->colors]);

		$i=-1;
		// if($request->file)
  //       {
  //         $image = $request->get('image');
  //         $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
  //         \Image::make($request->get('image'))->save(public_path('images/').$name);
  //       }
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
					// $ext =$req->image[$i]->extension();
					// $filename = $req->image[$i]->getClientOriginalName();
					// // dd($req->image[$i]);
					// $filename= str::slug(str_replace(".".$ext, "", $filename)."-".str::random(20).".".$ext);
					// $saveImage =$req->image[$i]->move("img/images",$filename);
					// $image="img/images/".$filename;
					
	        		  $image = $req->file[$i];

			          // $name = str::slug(str::random(40).time()."-".str::random(40)).'.'. explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
			          $name = str::slug(str_replace(time(), '.jpeg', str::random(30))."-".str::random(20).".jpeg");

			          \Image::make($req->file[$i])->save(public_path('img/images/').$name);
			          // array_push($as, $name);
        			
					$img->product_id=$product->id;
					$img->sort=$value;
					$img->image=URL::to('/').'/img/images/'.$name;
					$img->save();
					
				}
				
			}
		}
	
	
		return response()->json(['product'=>$product]);
    }
      	
    
}
