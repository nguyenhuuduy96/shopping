<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillDetail;

use App\User;

class BillController extends Controller
{
    public function index(Request $request)
    {
    	$bills = Bill::orderby('updated_at','desc')->paginate(10);
    	// dd($bills);
    	return view('admin.bills.list',compact('bills'));
    }
    public function confirm(Request $request)
    {

    	$bill = Bill::find($request->id);
    	$bill->status_id=2;
    	$bill->save();
    	$status=$bill->status;
    	return response()->json(['bill'=>$bill,'status'=>$status]);
    }
    public function cancel(Request $request)
    {
    	$bill = Bill::find($request->id);
    	$bill->status_id=3;
    	$bill->save();
    	$status=$bill->status;
    	return response()->json(['bill'=>$bill,'status'=>$status]);
    }
    public function detail(Request $request,$bill_code){
    	$bill = Bill::where('bill_code',$bill_code)->first();
    	
    	return view('admin.bills.detail',compact('bill'));
    }

}
