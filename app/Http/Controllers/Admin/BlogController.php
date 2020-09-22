<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Str;
class BlogController extends Controller
{
    public function index(Request $request){
    	$blogs = Blog::paginate(10);
    	// dd($blogs)
    	return view('admin.blog.list',compact('blogs'));
    }
    public function save(Request $request){
    	// 
    	$blog = isset($request->id)? Blog::find($request->id) : new Blog();

		$blog->slug = Str::slug($request->title.'-'.microtime());
		
		if ($request->hasFile('image')>0) {

            $ext = $request->images->extension();

            // lay ten anh go
            $filename = $request->images->getClientOriginalName();
            
            // ten anh + string random + duoi
            $filename = $filename . "-" . str::random(20) . "." . $ext;
            $file=$request->file('images');
           
            $file->move("img/",$filename);
            $blog->image_title ='img/'.$filename;
            // $model->image=$request->file('images')->store('img/uploads');
        }else{
         $blog->image_title=$request->anh;
        }
		$blog->fill($request->all());
		// return response()->json(['data'=>$blog]);
		$blog->save();
		
		
	
	
		return response()->json(['blog'=>$blog]);
    }
}
