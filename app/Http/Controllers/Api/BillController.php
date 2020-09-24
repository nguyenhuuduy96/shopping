<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillDetail;
use DB;
use App\User;
use App\Http\Resources\UserResource;
class BillController extends Controller
{
    public function addnew(Request $request){

    	$CheckCodeBill= DB::table('bills')->select(DB::raw('max(bill_code) as max'))->first();
        $bill_code= $CheckCodeBill->max !== null ? $CheckCodeBill->max +1:1000000000;
        $bill = new Bill();
        $total= array_sum($request->total);
        $bill->address_id= $request->address_id;
        $bill->user_id = $request->user_id;
        $bill->status_id = 2;
        $bill->total = $total;
        $bill->bill_code = $bill_code;
       	$bill->save();

       	foreach ($request->product_id as $key => $id) {

       		$BillDetail = new BillDetail();
       		$BillDetail->product_id = $id;
       		$BillDetail->price = $request->price[$key];

       		$BillDetail->size = $request->size[$key];

       		$BillDetail->color = $request->color[$key];
       		$BillDetail->quantity = $request->quantity[$key];

       		$BillDetail->total = $request->total[$key];
       		$BillDetail->name_product = $request->name[$key];

       		$BillDetail->bill_id= $bill->id;
       		
       		$BillDetail->save();
       		
       	}
       	return ['bill_code'=>$bill->bill_code];
    }
    public function checkBill(Request $request){
      $user = empty(User::where('phone',$request->phone)->first()) ?'' :new UserResource(User::where('phone',$request->phone)->first());
      return $user;
    }
}
