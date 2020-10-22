<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable =['logo_text','logo_image','url_banner1','url_banner2','url_banner3','address','email_contact','choose_logo'];
}
