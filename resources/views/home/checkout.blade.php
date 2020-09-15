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
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li>

				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li><li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li><li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li><li class="list-group-item d-flex justify-content-between lh-condensed">
					<div class="flex-w">
						<img src="{{asset('img/default.jpg')}}" style="border-radius: 5px" width="75px" alt="">
						<div class="my-0" >Product name
							<p class="text-muted" style="font-size: 12px">Brief description</p></div>
						
					</div>
					<span class="text-muted">$12000000</span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div>
						<h6 class="my-0">Provisional price</h6>
						
					</div>
					<span class="text-muted">$8</span>
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
					<strong>$20</strong>
				</li>
			</ul>

			<form class="card p-2">
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
					<label for="Name">Name </label>
					<input type="text" class="form-control" placeholder="name" name="name" id="name"  >
					<div class="error_name text-danger">
						Please enter a valid Name address for shipping updates.
					</div>
				</div>

				<div class="mb-3">
					<label for="Name">Phone </label>
					<input type="text" class="form-control" placeholder="Phone" name="phone" id="phone"  >
					<div class="error_phone text-danger">
						Please enter a valid Name address for shipping updates.
					</div>
				</div>

				

				<div class="row">
					<div class="col-md-5 mb-3">
						<label for="country">Country</label>
						<select class="custom-select d-block w-100" id="country" name="country">
							<option value="">Choose...</option>
							<option>United States</option>
						</select>
						<div class="error_country text-danger">
							Please select a valid country.
						</div>
					</div>
					<div class="col-md-4 mb-3">
						<label for="state">State</label>
						<select class="custom-select d-block w-100" id="state" name="state">
							<option value="">Choose...</option>
							<option>California</option>
						</select>
						<div class="error_state text-danger">
							Please provide a valid state.
						</div>
					</div>
					
				</div>

				<div class="mb-3">
					<label for="address">Address</label>
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
<script type="text/javascript">
window.onload = function () {
	$('.text-danger').css('display','none');

}
$(document).ready(function() {
	$('#submitaddress').on('submit',function(){
		const name = $('#name').val();
		const phone = $('#phone').val();
		 var phone_regex =/((92|86|96|97|98|32|33|34|35|36|37|38|39|89|90|93|70|79|77|76|78|88|91|94|83|84|85|81|82|56|58|99|59)+([0-9]{7})\b)/g;
		const country = $('#country').val();
		const state = $('#state').val();
		const address = $('#address').val();
		console.log(name,phone)
		if (name=="") {
			$('.error_name').css('display','block');
			return false;
		} else {
			$('.error_name').css('display','none');
		}
		if (phone=="") {
			$('.error_phone').css('display','block');
			return false;
		} else  if(phone_regex.test(phone) ==false){
        $('.error_phone').css('display','block');
       
        $('.error_phone').html('vui lòng nhập phone đúng sdt số!');
        return false;
        }else {
			$('.error_phone').css('display','none');
		}
		
		if (country=="") {
			$('.error_country').css('display','block');
			return false;
		} else {
			$('.error_country').css('display','none');
		}
		if (state=="") {
			$('.error_state').css('display','block');
			return false;
		} else {
			$('.error_state').css('display','none');
		}
		if (address=="") {
			$('.error_address').css('display','block');
			return false;
		} else {
			$('.error_address').css('display','none');
		}
		return false;
		
	})
});


</script>


@endsection