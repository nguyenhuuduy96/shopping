<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table= 'bills';
    protected $fillable=['total','status_id','user_id','bill_code'];
    public function bill_details()
    {
    	return $this->hasmany('App\Models\BillDetail','bill_id','id');
    } 
    public function address(){
    	return $this->belongsto('App\Models\Address','address_id','id');
    }
    public function status(){
    	return $this->belongsto('App\Models\Status','status_id','id');
    }
}
