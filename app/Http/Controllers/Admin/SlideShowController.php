<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SlideShow;
use Str;
use URL;

class SlideShowController extends Controller
{
    public function index(Request $request){
        $slides = SlideShow::all();
        return view('admin.slideshow.list',compact('slides'));
    }
    public function show($id){
        $slide = SlideShow::find($id);
        return response()->json(['slide'=>$slide]);
    }
    public function delete($id){
        SlideShow::destroy(1);
        // $silde->delete();

    }
    public function Active(Request $request)
    {
       
        $slide = SlideShow::find($request->id);
        $active = $slide->active == 0 ? 1: 0;
        $slide->active = $active;
        $slide->save();
        return response()->json(['slide'=>$slide]);
    }
    
    public function save(Request $request){
        $slide = isset($request->id)? SlideShow::find($request->id) : new SlideShow();
        
		if ($request->hasFile('images')>0) {

            $ext = $request->images->extension();
            // lay ten anh go
            $filename = $request->images->getClientOriginalName();
            
            // ten anh + string random + duoi
            $filename = $filename . "-" . str::random(20) . "." . $ext;
            $file=$request->file('images');
           
            $file->move("img/images/",$filename);
            $slide->image =URL::to('/').'/img/images/'.$filename;
            

            // $model->image=$request->file('images')->store('img/uploads');
        }else{
         $slide->image=$request->anh;
        }
        
        $slide->fill($request->all());
        
        $slide->save();
        return response()->json(['slide'=>$slide]);
    }
}
