<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Decentralization;
use Auth;
use URL;
use Str;
use App\Http\Resources\BillResource;

class MemberController extends Controller
{
    public function index(Request $request){
        // $user = Auth::user()->bills->take(1);
        // dd($user);
        return view('home.member');
    }
   
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
}
