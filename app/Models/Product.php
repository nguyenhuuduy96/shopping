<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Middle;
class Product extends Model
{
	protected $table ='products';
	protected $fillable=['name','source','time_expired','product_category_id'];
	public function sizes(){
		return $this->belongstomany('App\Models\Size','middle','product_id','size_id')->withPivot('price','stock','id')->withTimestamps();
	}
	public function colors(){
		return $this->belongstomany('App\Models\Color','middle','product_id','color_id')->select('colors.name as color','middle.color_id as color_id','middle.price as price','middle.stock as stock','middle.size_id as size_id','middle.id as middle_id','middle.product_id as product_id')->withTimestamps();
	}
	public function images(){
		return $this->hasmany('App\Models\Image','product_id','id')->orderby('sort','desc');
	}
	public function firstImage(){
		return $this->hasmany('App\Models\Image','product_id','id')->orderby('sort','desc')->limit(1);
	}
	public function firstprice(){
		return $this->hasmany('App\Models\Middle','product_id','id')->orderby('price','asc')->limit(1);
	}
	public function cate(){
		return $this->belongsto('App\Models\ProductCategory','product_category_id','id');
	}
	// public function lastPrice($product_id){
	// 	return Middle::where('product_id',$product_id)->orderby('price','asc')->first();
	// }
	
	// public function delete()    
 //    {
 //        DB::transaction(function() 
 //        {
 //            $this->images()->delete();
 //            parent::delete();
 //        });
 //    }
    //
}
