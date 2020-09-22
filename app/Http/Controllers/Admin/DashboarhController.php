<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Blog;

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
}
