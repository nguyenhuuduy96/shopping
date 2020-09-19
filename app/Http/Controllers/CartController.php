<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Darryldecode\Cart\CartCondition;
use App\Models\Middle;
use Cart;
use Auth;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Address;
use App\User;
use DB;

class CartController extends Controller
{
    public function showCart(){
        $carts=Auth::check() ? Cart::session(Auth::user()->id)->getContent() : Cart::getContent();
       
        $subtotla= Cart::getSubTotal();
        $qtys=[];
        foreach ($carts as $cart) {
            $middle= Middle::find($cart->id);
            array_push($qtys, $middle->stock);
        }
        // dd($subtotla);
        return view('home.shoping-cart',compact('carts','subtotla','qtys'));
    }

    public function add(Request $request){
        // return response()->json(['cart'=>$request->all()]);
            if (Auth::check()) {
               
                  Cart::session(Auth::user()->id)->add(array(
                    'id' => $request->middle_id,
                    'price' => $request->price,
                    'quantity' => 1,
                    'name' => $request->name,
                    'attributes' => array('image'=>$request->image,'color'=>$request->color,'size'=>$request->size,'product_id'=>$request->product_id,'slug'=>$request->slug)
                ));
            }else{
               Cart::add(array(
                    'id' => $request->middle_id,
                    'price' => $request->price,
                    'quantity' => 1,
                    'name' => $request->name,
                    'attributes' => array('image'=>$request->image,'color'=>$request->color,'size'=>$request->size,'product_id'=>$request->product_id,'slug'=>$request->slug)
                ));
            }
        
            $carts=Auth::check() ? Cart::session(Auth::user()->id)->getContent() : Cart::getContent();
            // Cart::remove($request->middle_id);
            // dd($cart);
            $subtotla = Cart::getSubTotal();
            return response()->json(['carts'=>$carts,'subtotla'=>$subtotla]);
    }
    public function delete(Request $request){
        // return response()->json(['cart'=>$request->id]);
            Cart::remove($request->id);
            $subtotla = Cart::getSubTotal();
            return response()->json(['subtotla'=>$subtotla]);
    }
    public function update(Request $request){
        if (Auth::check()) {
            $cart = Cart::session(Auth::user()->id)->update($request->id,array(
              'quantity' => array(
                  'relative' => false,
                  'value' => $request->qty
              ),
            ));
        } else {
            $cart = Cart::update($request->id,array(
              'quantity' => array(
                  'relative' => false,
                  'value' => $request->qty
              ),
            ));
        }
        
        
        $cart = Cart::get($request->id);
        $subtotla= Cart::getSubTotal();
        return response()->json(['cart'=>$cart,'subtotla'=>$subtotla]);
    }
    public function checkout(){
        $carts=Auth::check() ? Cart::session(Auth::user()->id)->getContent() : Cart::getContent();
       
        $subtotla= Cart::getSubTotal();
        return view('home.checkout',compact('carts','subtotla'));
    }
    public function payment(Request $request){
        $carts = Auth::check() ? Cart::session(Auth::user()->id)->getContent() : Cart::getContent();
       
        // $total= Cart::gettotal();
        
        // dd($total);
        // return response()->json(['bill_code'=>$request->all()]);
        $checkuser = User::where('phone',$request->phone)->first();
        if (Auth::check()) {
           $user = Auth::user();
        }else if (empty($checkuser)) {
            $user= new User();
            $user->phone= $request->phone;
            $user->name=$request->name;
            $user->save();
        } else {
            $user=$checkuser;
        }
     
        $address  = new Address();
        $address->user_id= $user->id;
        $address->fill($request->all());
        $address->save();
        $CheckCodeBill= DB::table('bills')->select(DB::raw('max(bill_code) as max'))->first();
        $bill_code= $CheckCodeBill->max !== null ? $CheckCodeBill->max +1:1000000000;
        $bill = new Bill();
        $bill->bill_code = $bill_code;
        $bill->total = Cart::gettotal();
        $bill->address_id = $address->id;
        $bill->status_id = 1;
        $bill->user_id = $user->id;

        $bill->save();
       
       
        foreach ($carts as $cart) {
            $bill_detail = new BillDetail();
            $bill_detail->name_product = $cart->name;
            $bill_detail->color = $cart->attributes['color'];
            $bill_detail->size = $cart->attributes['size'];
            $bill_detail->quantity = $cart->quantity;
            $bill_detail->price = $cart->price;
            $bill_detail->total= $cart->quantity * $cart->price;
            $bill_detail->product_id = $cart->attributes['product_id'];
            $bill_detail->bill_id= $bill->id;
             // return response()->json(['bill_code'=>$carts]);
            $bill_detail->save();
            Auth::check() ? Cart::session(Auth::user()->id)->remove($cart->id) : Cart::remove($cart->id);

        }
        return response()->json(['bill_code'=>$bill_code]);

    }
    public function CheckOutSuccess($bill_code){
        $bill = Bill::where('bill_code',$bill_code)->first();
        return view('home.checkoutsuccess',compact('bill'));
    }
}
