<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Str;
use App\Http\Resources\CategoryProduct as JsonCategoryProduct;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $page = 1;
        // $skip = $page*2;
        // $cates= ProductCategory::find(1);
        // $c= $cates->products_cates;
        // dd($c);
        // dd($cates);
        // dd($cate->products_cates,$cate->cates);
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
        $skip = $page*2;
        $cates= ProductCategory::skip($skip)->take(2)->get();
        $catesShow = JsonCategoryProduct::collection($cates);

         return ['cates'=> $catesShow, 'totalCate'=>$totalCate,'id'=>$request->page];
    }

    public function nullParent(Request $request){
        $cates = ProductCategory::whereNull('parent_id')->get();
        // dd($cates);
        return JsonCategoryProduct::collection($cates);
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
        // $cate = ProductCategory::find(10);
        return new JsonCategoryProduct($cate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $cate)
    {
        // $cate = ProductCategory::find($id);
        return new JsonCategoryProduct($cate);
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
    public function destroy(ProductCategory $cate)
    {
        $cate->delete();
    }
}
