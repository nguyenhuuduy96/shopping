@extends('layouts.home.main')
@section('title','product')
@section('content')
<div class="bg0 m-t-100 p-b-140">
	<div class="container">
		{{-- search filter --}}
		<div class="flex-w flex-sb-m p-b-5 ">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<a href="/" class="stext-106 cl6 hov-cl1 bor3 trans-04 m-r-32 m-tb-5" data-filter="*">
					Trang chủ
					<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
				</a>

				<a href="{{route('home.product')}}" class="stext-106 cl6 hov-cl1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
					Danh mục
					<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
				</a>

				<a class="stext-106 cl6 hov-cl1 bor3 trans-04 m-r-32 m-tb-5 " data-filter=".men">
					@if(isset($cate))
					<input type="hidden" name="slug_cate" value="{{$cate->slug}}" id="slug_cate">
					{{$cate->name}}
					@else
					<input type="hidden" name="slug_cate" value="" id="slug_cate">
					@endif
				</a>

				
			</div>

			<div class="flex-w flex-c-m m-tb-10">
				
				<div >
					<select class="stext-106 cl6 size-104 bor4 m-r-8 m-tb-4" id="count-show-product">
						<option value="12" >Show 12</option>
						<option value="16">Show 16</option>
						<option value="32" >Show 32</option>
						<option value="64" >Show 64</option>
						<option value="128">Show 128</option>
						{{-- <option value="-1">Show All</option> --}}
					</select>
				</div>
				<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
					<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
					<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Search
				</div>
			</div>

			<!-- Search product -->
			<div class="dis-none panel-search w-full p-t-10 p-b-15">
				
				<div class="bor8 dis-flex p-l-15">
					<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>

					<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
				</div>	
			</div>

			<!-- Filter -->

		</div>

		<div class="row isotope-grid">
			@foreach($productsPage as $product)
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="{{asset(isset($product->firstImage[0]->image)?$product->firstImage[0]->image:'img/default.jpg')}}" alt="IMG-PRODUCT">

						<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 Quick_View" onclick="modalQV({{$product->id}})">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="{{route('detail.product',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								{{$product->name}}
							</a>

							<span class="stext-105 cl3" id="home_price">
								{{ number_format(isset($product->firstprice[0]->price)?$product->firstprice[0]->price:'0', 0, '.', '.') }} đ
								
								
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="{{asset('home/images/icons/icon-heart-01.png')}}" alt="ICON">
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('home/images/icons/icon-heart-02.png')}}" alt="ICON">
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach

			
		</div>

		<!-- Load more -->
		<div class="flex-c-m flex-w w-full p-t-20 total-page">
			{{-- <nav >
				<ul class="pagination" id="parent_page">
					<li class="page-item disabled pre" aria-disabled="true" aria-label="« Previous">
						<span class="page-link" aria-hidden="true">‹</span>
					</li>
					<li class="page-item page active" value="1"  aria-current="page"><span class="page-link">1</span></li> <li class="page-item page" value="2"  aria-current="page"><span class="page-link">2</span></li> <li class="page-item page" value="3"  aria-current="page"><span class="page-link">3</span></li>  <li class="page-item next">
						<a class="page-link" rel="next" aria-label="Next »">›</a>
					</li>
				</ul>
			</nav> --}}
		</div>
	</div>
</div>	
@endsection
@section('js')
{{-- <script type="text/javascript">
	window.addEventListener('load', function(e) {
		const priceproduct ={{isset($product->firstprice[0]->price)?$product->firstprice[0]->price:'0'}};
		const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(priceproduct);
		document.getElementById('price_detail').innerHTML=price;
		console.log(price)
	});
</script> --}}
<script type="text/javascript" src="{{asset('home/js/product.js')}}"></script>
@endsection

