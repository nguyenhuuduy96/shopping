<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Decentralization;
use Auth;
use URL;
use Str;
use App\Http\Resources\BillResource;
use Hash;

class MemberController extends Controller
{
    public function index(Request $request){
        Auth::user()->is_active=2;
        Auth::user()->save();
        // dd($user);
        return view('home.member');
    }
   //cập thông tin
    public function save(Request $request){
        $user = isset($request->id)? User::find($request->id) : new User();
        $checkEmail = User::where('email',$request->email)->first();
        
        if( $checkEmail !== null && empty($user->email)){
            return response()->json(['error'=>'email đã tồn tại!']); 
        }
		if ($request->hasFile('images')>0) {

            $ext = $request->images->extension();
            // lay ten anh go
            $filename = $request->images->getClientOriginalName();
            
            // ten anh + string random + duoi
            $filename = $filename . "-" . str::random(20) . "." . $ext;
            $file=$request->file('images');
           
            $file->move("img/images/",$filename);
            $user->avatar =URL::to('/').'/img/images/'.$filename;
            

            // $model->image=$request->file('images')->store('img/uploads');
        }else{
         $user->avatar=$request->anh;
        }
        
        $user->fill($request->all());
        
        $user->save();
        return response()->json(['user'=>$user,'error'=>""]);
    }
    //change password
    public function saveChangePass(Request $request){
        if (!(Hash::check($request->get('password'), Auth::user()->password))){
            return response()->json(['error'=>'Mật khẩu hiện tại không đúng!']);
        }
        Auth::user()->password = Hash::make($request->newpassword);
        Auth::user()->save();
        return response()->json(['error'=>'']);
    }
}
