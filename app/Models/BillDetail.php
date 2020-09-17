<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table= 'bill_details';
    protected $fillable=['total','color','size','quantity','product_id','name_product','bill_id'];
    public function product(){
		return $this->belongsto('App\Models\Product','product_id','id');
	}
    
}
