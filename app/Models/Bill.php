<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table= 'bills';
    protected $fillable=['total','status','user_id','bill_code'];
    public function bill_details()
    {
    	return $this->hasmany('App\Models\BillDetail','bill_id','id');
    } 
}
