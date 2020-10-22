<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Str;
use App\Http\Resources\CategoryProduct as JsonCategoryProduct;

class CategoryProductController extends Controller
{
   
    public function index()
    {
        $cates= ProductCategory::paginate(2);
       
        return view('admin.category_product.list',compact('cates'));
        
    }
    public function getChildCate(Request $request){
        $cate= ProductCategory::find($request->id);
        $cates = $cate->cates;
        return Response()->json(['cates'=>$cates]);
    }
    public function allCategory(Request $request){
        $totalCate = count(ProductCategory::all());
        $page = isset($request->page)?$request->page-1:0;
        $skip = $page*10;
        $cates= ProductCategory::skip($skip)->take(10)->get();
        $catesShow = JsonCategoryProduct::collection($cates);

         return ['cates'=> $catesShow, 'totalCate'=>$totalCate,'id'=>$request->page];
    }

    public function nullParent(Request $request){
        $cates = ProductCategory::whereNull('parent_id')->get();
        // dd($cates);
        return JsonCategoryProduct::collection($cates);
    }
   
    public function store(Request $request)
    {
        if (isset($request->id)) {
            $cate = ProductCategory::find($request->id);
            $cate->slug=str::slug($request->name.'-'.microtime());
            $cate->fill($request->all());
            $cate->save();
           
        }else{
            $cate = new ProductCategory();
            $cate->slug=Str::slug($request->name.'-'.microtime());
            $cate->fill($request->all());
            $cate->save();
            
        }
        return new JsonCategoryProduct($cate);
    }

    
    public function show(ProductCategory $cate)
    {
        
        return new JsonCategoryProduct($cate);
    }

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy(ProductCategory $cate)
    {
        $cate->delete();
    }
}
