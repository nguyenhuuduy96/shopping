<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Darryldecode\Cart\CartCondition;
use App\Models\Middle;
use Cart;
use Auth;

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
                    'attributes' => array('image'=>$request->image,'color'=>$request->color,'size'=>$request->size)
                ));
            }else{
               Cart::add(array(
                    'id' => $request->middle_id,
                    'price' => $request->price,
                    'quantity' => 1,
                    'name' => $request->name,
                    'attributes' => array('image'=>$request->image,'color'=>$request->color,'size'=>$request->size)
                ));
            }
        
            $carts=Auth::check() ? Cart::session(Auth::user()->id)->getContent() : Cart::getContent();
            // Cart::remove($request->middle_id);
            // dd($cart);
            return response()->json(['carts'=>$carts]);
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
}
