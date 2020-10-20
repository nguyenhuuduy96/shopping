@extends('layouts.home.main')
@section('title','product detail')
@section('content')
	
		

	
	<section class="col-sm-12 bg0 p-t-90 p-b-60 ">
        <p class="col-sm-6 rounded mx-auto d-block">Số lượng sản phẩm hết hàng hoặc số lượng sản phẩm vượt quá số lượng trong kho!</p>
    <a class="btn btn-primary text-center rounded mx-auto d-block col-sm-2" href="{{route('cart.show')}}">chở về giỏ hàng</a>
	</section>


	
@endsection
@section('js')


@endsection

