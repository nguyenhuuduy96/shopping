<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Bill;
use App\Models\Blog;
use URL;
use Str;

class DashboarhController extends Controller
{
    public function index(Request $request){
    	$totalProduct = count(Product::all());
    	$totalBill = count(Bill::all());
    	$totalUser = count(User::all());
    	$totalBlog = count(Blog::all());
    	$productnews = Product::orderby('created_at','asc')->take(4)->get();
    	$bills = Bill::orderby('updated_at','desc')->paginate(10);
    	return view('admin.dashboard',compact('totalBlog','totalUser','totalBill','totalProduct','productnews','bills'));
	}
	public function setting(Request $request){
		$setting = !empty(Setting::first()) ? Setting::first(): null;
		
		return view('admin.setting',compact('setting'));
	}
	public function SaveSetting(Request $request){
		
		$setting = isset($request->id)? Setting::find($request->id) : new Setting();
		
		if ($request->hasFile('images')>0) {
			
            $ext = $request->images->extension();
            // lay ten anh go
            $filename = $request->images->getClientOriginalName();
            
            // ten anh + string random + duoi
            $filename = $filename . "-" . str::random(20) . "." . $ext;
            $file=$request->file('images');
           
            $file->move("img/images/",$filename);
            $setting->logo_image =URL::to('/').'/img/images/'.$filename;
            

            // $model->image=$request->file('images')->store('img/uploads');
        }else{
         $setting->logo_image=$request->anh;
        }
        $setting->choose_logo= $request->active;
		$setting->fill($request->all());
        $setting->save();
        return response()->json(['setting'=>$setting]);
	}
	// chon hien thi logo setting
	public function ChooseLogo(Request $request){
		$setting = Setting::find($request->id);
		$setting->fill($request->all());
		$setting->save();
	}
}
