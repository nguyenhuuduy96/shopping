@extends('layouts.home.main')
@section('title','shoping cart')
@php 
$i=-1;
@endphp
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


<!-- Shoping Cart -->
<form class="bg0 p-t-25 p-b-85">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
				<div class="m-l-0 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart" id="table">
							<tr class="table_head">
								<th class="column-1">Product</th>
								<th class="column-2"></th>
								<th>Color</th>
								<th>Size</th>
								<th class="column-3">Price</th>
								<th class="column-4">Quantity</th>
								<th class="column-5">Total</th>
								<th></th>
							</tr>

							@foreach($carts as $key => $cart)
								@php
									$i+=1;
								@endphp
							<tr class="table_row">
								<td class="column-1">
									<div class="how-itemcart1">
										<img src="{{$cart->attributes['image']}}" alt="IMG">
									</div>
								</td>
								<td class="column-2">{{$cart->name}}</td>
								<td>{{$cart->attributes['color']}}</td>
								<td>{{$cart->attributes['size']}}</td>
								<td class="column-3">{{ number_format($cart->price, 0, '.', '.') }}&nbsp;₫</td>
								<td class="column-4">
									<div class="wrap-num-product flex-w m-l-auto m-r-0">
										<div class="btn-num-product-pre cl8 hov-btn3 trans-04 flex-c-m" onclick="clickpre(this,{{$cart->id}},{{$qtys[$i]}})" >
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="{{$cart->quantity}}">

										<div class="btn-num-product-next hov-btn3 trans-04 flex-c-m" onclick="clicknext(this,{{$cart->id}},{{$qtys[$i]}})" >
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>
									<p class="text-info">số lượng còn: {{$qtys[$i]}}</p>
								</td>
								<td class="column-5">{{ number_format($cart->price*$cart->quantity, 0, '.', '.') }}&nbsp;₫ </td>
								<td ><a class="btn btn-danger text-white" onclick="DeleteShopingCart(this,{{$cart->id}})"><i class="fas fa-trash-alt"></i></a></td>
							</tr>
							@endforeach
						</table>
					</div>

					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<div class="flex-w flex-m m-r-20 m-tb-5">
							<p>
								Totla: &nbsp;<p class="subtotla"> {{ number_format($subtotla, 0, '.', '.') }}&nbsp;₫</p>
							</p>
						</div>

						<div class="flex-c-m stext-101 size-119 bor13 p-lr-15 trans-04 pointer m-tb-10 btn btn-primary text-white">
							Continue
						</div>
					</div>
				</div>
			</div>

			
		</div>
	</div>
</form>	
@endsection
@section('js')
<script type="text/javascript">
	function DeleteShopingCart(r,id){
		const rowId = r.parentNode.parentNode.rowIndex;
		const table = document.getElementById('table');
		// console.log(rowId)
		// table.deleteRow(rowId)
		$.ajax({
			url:'../cart/delete',
			type:'post',
			data:{_token:CSRF_TOKEN,id:id},
			success:function(data){
				table.deleteRow(rowId)
				const subtotla = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.subtotla);
				$('.subtotla').html(subtotla);
			}
		})
	}
	function clickpre(r,id,max){
		const i = r.parentNode.parentNode.parentNode.rowIndex;
    	const table = document.getElementById('table');
    	console.log(max)
    	let number = document.getElementsByClassName('num-product')[i-1].value;
    	let qty=parseInt(number);
    	if (number>1) {
    		qty -= 1;
    	}
    	$.ajax({
    		url:'../cart/update',
    		type:'post',
    		data:{_token:CSRF_TOKEN,id:id,qty:qty},
    		success:function(data){
    			console.log(data.subtotla)
    			const qtyNumber = data.cart.price*data.cart.quantity;
    			// console.log(qtyNumber,data.cart.price,data.cart.quantity)
    			const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(qtyNumber);
    			const cells = table.rows[i].cells;
    			const subtotla = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.subtotla);
    			cells[6].innerHTML = price;
    			document.getElementsByClassName('num-product')[i-1].value = qty;
    			$('.subtotla').html(subtotla)
    		}
    	})
	}
    function clicknext(r,id,max){
    	let i = r.parentNode.parentNode.parentNode.rowIndex;
    	// const max = $(this).attr('id');
    	const table = document.getElementById('table');
    	let number = document.getElementsByClassName('num-product')[i-1].value;
    	let qty=parseInt(number);
    	if (number<max) {
    		qty += 1;
    	}
    	$.ajax({
    		url:'../cart/update',
    		type:'post',
    		data:{_token:CSRF_TOKEN,id:id,qty:qty},
    		success:function(data){
    			// console.log(data.subtotla)
    			const qtyNumber = data.cart.price*data.cart.quantity;
    			// console.log(qtyNumber,data.cart.price,data.cart.quantity)
    			const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(qtyNumber);
    			const subtotla = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.subtotla);
    			const cells = table.rows[i].cells;
    			cells[6].innerHTML = price;
    			document.getElementsByClassName('num-product')[i-1].value = qty;
    			$('.subtotla').html(subtotla)
    		}
    	})
    	
    	console.log(i)
    }
</script>
@endsection

