<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Decentralization;
use Auth;
use URL;
use Str;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::paginate(10);
        
        $decentralizations = Decentralization::all();
        return view('admin.user.list',compact('users','decentralizations'));
    }
    public function Profile(Request $request){
        return view('admin.user.profile');
    }
    //phân quyền
    public function Active(Request $request){
        
        $user = User::find($request->id);
        if(Auth::user()->id == $user->id){
            $error = 'bạn không thể thay đổi quyền của của bạn được!';
        }else if (Auth::user()->is_active >2 && $user->is_active <3) {
            $user->is_active = $request->is_active;
           
            $user->save();
            
            $error ="";
            
        } else {
            $error = 'bạn không có quyền thay đổi quyền của thành viên!';
        }
        

        $decentralization =$user->decentralization;
        return response()->json(['error'=>$error,'decentralization'=>$decentralization]);
    }
    // cập nhật thông tin tài khoản
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
