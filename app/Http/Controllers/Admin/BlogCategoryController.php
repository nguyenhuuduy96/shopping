<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Str;
use App\Http\Resources\CategoryBlog as JsonCategoryBlog;
class BlogCategoryController extends Controller
{
    public function index()
    {
        $cate = BlogCategory::find(17);
        // dd($cate->products_cates,$cate->cates);
        $cates= BlogCategory::paginate(2);
       
        return view('admin.blogCategory.list',compact('cates'));
        
    }
    public function allCategory(){
        return BlogCategory::all();
    }
    public function page(Request $request){
        $cates= BlogCategory::paginate(2);
        return $cates;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request->all();
        if (isset($request->id)) {
            $cate = BlogCategory::find($request->id);
            $cate->slug=str::slug($request->name.'-'.microtime());
            $cate->fill($request->all());
            $cate->save();
           
        }else{
            $cate = new BlogCategory();
            $cate->slug=Str::slug($request->name.'-'.microtime());
            $cate->fill($request->all());
            $cate->save();
            
        }
        // $cate = BlogCategory::find(10);
        return new JsonCategoryBlog($cate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $cate)
    {
        // $cate = BlogCategory::find($id);
        return new JsonCategoryBlog($cate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $cate)
    {
        $cate->delete();
    }
}
