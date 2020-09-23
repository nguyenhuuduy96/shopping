@extends('layouts.layout_admins.main')    
@section('title','product')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="dataTables_length" id="example1_length">
								<label>Show 
									<select name="example1_length" class="form-control-sm" >
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select> entries</label>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<form  method="get">
									<div id="dataTables_length" class="dataTables_filter">
										<label class="form-control-sm">Search:
											<input type="search" id="searh_product" class="form-control-sm" name="search" placeholder=""></label>
										</div>

									</form>
								</div> 
							</div>
						</div>
						<div id="sign-in-button" style="display: none;"></div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">

								{{-- 	<div id="example1"><label>Search:<input type="search" id="searh_product" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div> --}}
								<thead>
									<tr>
										<th>#</th>
										<th>Name Product</th>
										<th>Source</th>
										<th>Time_expired</th>
										<th><a data-toggle="modal" data-target="#ModalProduct" onclick="productFormRest()"><i class="fa fa-plus-square text-success"></i> New Product</a></th>
										<th>
											<a data-toggle="modal" data-target="#modalTableSize"> <i class="fas fa-table"></i> Table Size</a>
											<a data-toggle="modal" data-target="#modalTableColor"> <i class="fas fa-table"></i> Table Color</a>
										</th>
									</tr>
								</thead>
								<tbody id="search_Show">
									@foreach($products as $product)
									<tr>
										<td>{{$product->id}}</td>
										<td>{{$product->name}}</td>
										<td>{{$product->source}}</td>
										<td>{{$product->time_expired}}</td>
										<td><a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" id="updateProduct" onclick="onclickupdate(this,'{{$product->id}}')"><i class="fa fa-edit text-primary" ></i>Edit</a></td>
										<td><a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,'{{$product->id}}')"><i class="fas fa-trash-alt text-danger"></i>delete</a> 
										</td>
									</tr>
									@endforeach
								</tfoot>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>
		</div>
		<!--Modal form products-->
		@include('admin.product.form-product')
		<!--Modal Talbe size-->
		@include('admin.product.form-size')
		<!--Modal Talbe size-->
		@include('admin.product.form-color')
	@endsection
	@section('js')
	<script src="{{asset('admin/js/admin/product.js')}}"></script>

	@endsection