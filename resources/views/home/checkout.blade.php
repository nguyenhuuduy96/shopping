@extends('layouts.home.main')
@section('title','checkout')
@section('content')
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-100 p-lr-0-lg">
		<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			Shoping Cart
		</span>
	</div>
</div>
<div class="container p-t-25 p-b-85">
	<div class="row">
		<div class="col-md-4 order-md-2 mb-4">
			<h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="text-muted">Your cart</span>
				<span class="badge badge-secondary badge-pill">3</span>
			</h4>
			<ul class="list-group mb-3">
				@foreach($carts as $cart)
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{$cart->attributes['image']}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >{{$cart->name}}
							<p class="text-muted" style="font-size: 12px">{{$cart->attributes['color'] }} - {{$cart->attributes['size']}}</p></div>
						
						
					</div>
					<span class="text-muted">{{ number_format($cart->price, 0, '.', '.') }}&nbsp;₫</span>
				</li>
				@endforeach
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div>
						<h6 class="my-0">Provisional price</h6>
						
					</div>
					<span class="text-muted">{{ number_format($subtotla, 0, '.', '.') }}&nbsp;₫</span>
				</li>
				
				<li class="list-group-item d-flex justify-content-between bg-light">
					<div class="text-success">
						<h6 class="my-0">Promo code</h6>
						<small class="success_code"></small>
					</div>
					<span class="text-success price_code"></span>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					<span>Total (VND)</span>
					<strong>{{ number_format($subtotla, 0, '.', '.') }}&nbsp;₫</strong>
				</li>
			</ul>

			<form class="card p-2" action="javascript:void(0)">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Promo code">
					<div class="input-group-append">
						<button type="submit" class="btn btn-secondary">Redeem</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-8 order-md-1">
			<h4 class="mb-3">Billing address</h4>
			<form class="needs-validation" novalidate action="javascript:void(0)" id="submitaddress">

				<div class="mb-3">
					<label for="Name">Tên </label>
					<input type="text" class="form-control" placeholder="name" name="name" id="name"  >
					<div class="error_name text-danger">
						Please enter a valid Name address for shipping updates.
					</div>
				</div>

				<div class="mb-3">
					<label for="Name">Số điện thoại </label>
					<input type="text" class="form-control" placeholder="Phone" name="phone" id="phone"  >
					<div class="error_phone text-danger">
						Please enter a valid Name address for shipping updates.
					</div>
				</div>

				

				<div class="row">
					<div class="col-md-5 mb-3">
						<label for="city">Thành phố</label>
						<select class="custom-select d-block w-100" id="city" name="city">
							<option value="">Choose...</option>
							<option >Ha noi</option>
							<option >Hồ chí Minh</option>
						</select>
						<div class="error_city text-danger">
							Please select a valid City.
						</div>
					</div>
					<div class="col-md-4 mb-3">
						<label for="state">Quận huyện</label>
						<select class="custom-select d-block w-100" id="district" name="district">
							<option value="">Choose...</option>
							<option>Bắc Từ Liêm</option>
							<option>Nam Từ Liêm</option>
							<option>Quận 1</option>
							<option>Quận 2</option>
						</select>
						<div class="error_district text-danger">
							Please provide a valid district.
						</div>
					</div>
					
				</div>

				<div class="mb-3">
					<label for="address">Địa chỉ:</label>
					<input type="text" class="form-control" id="address" placeholder="1234 Main St">
					<div class="error_address text-danger">
						Please enter your shipping address.
					</div>
				</div>

				<hr class="mb-4">
				
				<button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
			</form>
		</div>
	</div>
</div>

@endsection
@section('js')
<script type="text/javascript" src="{{asset('home/js/checkout.js')}}"></script>


@endsection