<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
class AuthController extends Controller
{
    public function __construct()
    {
        if (!empty(Auth::user())) {
            # code...
            if (Auth::user()->is_active>0) {
               return redirect(route('list.product'));
            }else{
                return redirect('login-firebase');
            }
        }
        
    }
    public function login(){
        return view('auth.login');
    }
    public function postlogin(Request $request)
    {
        $rem = $request->remember == 1 ? true : false;
        if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password],$rem)){
            return response()->json(['error'=>'']);
            
        }else{
            return response()->json(['error'=>'phone number hoac password ko dung!']);
        }
    }
    public function register(Request $req){
   
        return view('auth.register');
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function checkPhonevery(Request $req){
        // $phone ='0'.$req->phone;
       // return response()->json(['phone'=>$req->phone]);
        $user = !empty(User::where('phone',$req->phone)->first())?'':'số điên thoại ko có trong dky tai khoản';
        if (empty($user)) {
            # code...
            return response()->json(['phone'=>'']);
           
        } else {
            # code....
             return response()->json(['phone'=>'số điên thoại ko có trong dky tai khoản']);
        }
    }
    public function activelogin(Request $req){
        // $phone ='0'.$req->phone;
        // return response()->json(['user'=>$req->phone]);
        $user = User::where('phone',$req->phone)->first();
        $user->is_active=1;
        $user->save();
        Auth::login($user);
        return response()->json(['user'=>Auth::user()]);
        // Auth::user()=$user;
    }
    public function saveregister(Request $req){
        $phone =$req->phone;
        // $user = User::all();
         // return response()->json(['email'=>$req->all(),'phone'=>'']);
        $checkEmail =!empty(User::where('email',$req->email)->first()) ?'Email đã Tồn tại!':'';
        
        $checkphone = !empty(User::where('phone',$phone)->first())?'số điện thoại đã đăng ký':'';
         
        if (!empty($checkEmail)) {
            # code...
            return response()->json(['email'=>$checkEmail,'phone'=>'']);
        }
        if (!empty($checkphone)) {
            return response()->json(['email'=>'','phone'=>$checkphone]);
        }
        // return response()->json(['email'=>$req->all(),'phone'=>'']);
            $user = new User();
            $user->password= Hash::make($req->pass);
            $user->phone=$phone;
            $user->fill($req->all());
            $user->save();

            return response()->json(['email'=>'','phone'=>'']);
        
        // return redirect(route('user.register'));
    }
  
}
