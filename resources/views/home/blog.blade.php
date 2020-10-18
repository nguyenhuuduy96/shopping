@extends('layouts.home.main')
@section('title','Tin Tức')
@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center m-top-80 p-lr-15 p-tb-92 " style="background-image: url({{asset('home/images/bg-02.jpg')}});">
    <h2 class="ltext-105 cl0 txt-center">
        Blog
    </h2>
</section>	


<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    @foreach ($blogs as $blog)
                    <div class="p-b-63">
                        <a href="{{route('home.blog.detail',$blog->slug)}}" class="hov-img0 how-pos5-parent">
                        <img src="{{$blog->image_title}}" alt="IMG-BLOG">

                            <div class="flex-col-c-m size-123 bg9 how-pos5">
                                <span class="ltext-107 cl2 txt-center">
                                    {{$blog->updated_at->format('m')}}
                                </span>

                                <span class="stext-109 cl3 txt-center">
                                    {{$blog->updated_at->format('Y')}}
                                </span>
                            </div>
                        </a>

                        <div class="p-t-32">
                            <h4 class="p-b-15">
                                <a href="{{route('home.blog.detail',$blog->slug)}}" class="ltext-108 cl2 hov-cl1 trans-04">
                                    {{$blog->title}}
                                </a>
                            </h4>

                            <p class="stext-117 cl6">
                                {!!Str::limit($blog->content,100,'...')!!}
                            </p>

                            <div class="flex-w flex-sb-m p-t-18">
                                <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
                                    <span>
                                        <span class="cl4">Author</span> {{$blog->author}}  
                                        <span class="cl12 m-l-4 m-r-6">|</span>
                                    </span>
                                </span>

                                <a href="{{route('home.blog.detail',$blog->slug)}}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                    Continue Reading

                                    <i class="fa fa-long-arrow-right m-l-9"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- item blog -->
                    

                  

                    <!-- Pagination -->
                    <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
                        {{$blogs->links()}}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 p-b-80">
                <div class="side-menu">
                    <div class="bor17 of-hidden pos-relative">
                        <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

                        <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </div>

                    <div class="p-t-55">
                        <h4 class="mtext-112 cl2 p-b-33">
                            Categories
                        </h4>

                        <ul>
                            @foreach ($cates as $cate)
                            <li class="bor18">
                            <a href="{{route('home.product',$cate->slug)}}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                    {{$cate->name}}
                                </a>
                            </li>
                            @endforeach
                            

                           
                        </ul>
                    </div>

                    <div class="p-t-65">
                        <h4 class="mtext-112 cl2 p-b-33">
                            Featured Products
                        </h4>

                        <ul>
                            @foreach ($products as $product)
                            <li class="flex-w flex-t p-b-30">
                                <a href="{{route('detail.product',$product->slug)}}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                    <img src="{{asset(isset($product->firstImage[0]->image)?$product->firstImage[0]->image:'img/default.jpg')}}" width="90px" alt="PRODUCT">
                                </a>

                                <div class="size-215 flex-col-t p-t-8">
                                    <a href="{{route('detail.product',$product->slug)}}" class="stext-116 cl8 hov-cl1 trans-04">
                                        {{$product->name}}
                                    </a>

                                    <span class="stext-116 cl6 p-t-20">
                                        {{ number_format(isset($product->firstprice[0]->price)?$product->firstprice[0]->price:'0', 0, '.', '.') }} đ
                                    </span>
                                </div>
                            </li>
                            @endforeach
                            

                        
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>	
    
@endsection
@section('js')
@endsection

