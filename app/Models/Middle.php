<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class Middle extends Model
{
    protected $table = 'middle';
    protected $fillable = ['product_id','size_id','price','stock','color_id'];
    public function size()
    {
    	return $this->belongsto('App\Models\Size','size_id','id');
    }
    public function color()
    {
    	return $this->belongsto('App\Models\Color','color_id','id');
    }
}
