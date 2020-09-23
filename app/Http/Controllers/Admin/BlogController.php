<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Str;
use URL;
class BlogController extends Controller
{
    public function index(Request $request){
    	$blogs = Blog::paginate(10);
    	// dd($blogs)
    	return view('admin.blog.list',compact('blogs'));
    }
    public function getBlog(Blog $blog){
    	return response()->json(['blog'=>$blog]);
    }
    public function delete(Blog $blog){
    	// return response()->json(['blog'=>$blog]);
    	$blog->delete();
    }
    public function save(Request $request){
    	// 
    	$blog = isset($request->id)? Blog::find($request->id) : new Blog();

		$blog->slug = Str::slug($request->title.'-'.microtime());
		
		if ($request->hasFile('image')>0) {

            $ext = $request->image->extension();

            // lay ten anh go
            $filename = $request->image->getClientOriginalName();
            
            // ten anh + string random + duoi
            $filename = $filename . "-" . str::random(20) . "." . $ext;
            $file=$request->file('image');
           
            $file->move("img/images/",$filename);
            $blog->image_title =URL::to('/').'/img/images/'.$filename;
            // $model->image=$request->file('images')->store('img/uploads');
        }else{
         $blog->image_title=$request->anh;
        }
		$blog->fill($request->all());
		
		$blog->save();
		
		
	
	
		return response()->json(['blog'=>$blog]);
    }
}
