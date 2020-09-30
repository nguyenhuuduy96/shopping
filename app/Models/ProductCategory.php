<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table ='product_categories';
    protected $fillable= ['name','parent_id','slug'];
    public function cate(){
    	return $this->belongsto('App\Models\ProductCategory','parent_id','id');
    }
    public function cates(){
    	return $this->hasmany('App\Models\ProductCategory','parent_id','id');
    }
    public function products_cates(){
    	return $this->hasManyThrough('App\Models\Product','App\Models\ProductCategory','parent_id','product_category_id','id');
    }
    public function products(){
        return $this->hasMany('App\Models\Product','product_category_id','id');
    }
}
