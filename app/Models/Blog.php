<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table= "blogs";
    protected $fillable = ['title','content','blog_category_id','slug','author'];
    public function cate(){
    	return $this->belongsto('App\Models\BlogCategory','blog_category_id','id');
    }
}
