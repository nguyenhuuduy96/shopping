<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table ='blog_categories';
    protected $fillable= ['name','parent_id','slug'];
    public function cate(){
    	return $this->belongsto('App\Models\BlogCategory','parent_id','id');
    }
    public function cates(){
    	return $this->hasmany('App\Models\BlogCategory','parent_id','id');
    }
   
}
