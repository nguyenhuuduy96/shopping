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
		<div class="modal fade" id="ModalProduct">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title" id="titleProduct">Add new Product</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<div class="container">
							<form class="row" id="formnewproductsubmit" class="ShowSearhProduct">
								@csrf
								<div class="col-sm-12" id="getIdproduct">

								</div>
								<div class="col-sm-12">
									<div class="form-group" >
										<div id="product_id">

										</div>
										<label for="type" >Ten san pham:</label>
										<input type="hidden" class="form-control" id="rowid" placeholder="ten san pham" name="rowid" value="" >
										<input type="type" class="form-control" id="name_product" placeholder="ten san pham" name="name" >
										<span class="errorName" style="color: red"></span>
									</div>
									<div class="form-group">
										<label for="source">nguon:</label>
										<input type="type" class="form-control" id="source" placeholder="source" name="source" >
										<span class="errorsource" style="color: red"></span>
									</div>
									<div class="form-group">
										<label for="date">thoi gian het han:</label>
										<input type="date" class="form-control" id="date" placeholder="time_expired" name="date" >
										<span class="errortime_expired" style="color: red"></span>
									</div>
									<div class="form-group">
										<label >file image</label>
										<input type="file" name="image[]" class="form-control-file image" id="image" multiple="">
										<span class="error_image" style="color: red"></span>
									</div>
									<div class="form-group" id="getsizeup">

									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">

												<label>size</label>
												<select class="form-control" name="size_id[]" class="validatesize"  style="width: 100%;">
													<option value="">-- chọn --</option>
													@foreach($sizes as $size)
													<option  
													value="{{$size->id}}">{{$size->size}}</option>
													@endforeach
												</select>
											</div>

											<div class="col-md-5">
												<label>giá</label>
												<input type="number" name="price[]" class="form-control" >
											</div>
											<div class="col-md-2">
												<label>số lượng</label>
												<input type="number" name="stock[]" class="form-control" >	                  
											</div>

											<div class="col-md-2">
												<label><a class="btn btn-outline-primary addSizePriceStock">thêm</a>  </label>
											</div>
										</div>
									</div>
									<div class="form-group" id="getsize">

									</div>

								</div>
								<div class="row col-sm-12" id="shownewImage">


								</div>
								<div class="row col-sm-12" id="showImage">


								</div>

								<input type="submit" value="submit">
							</form>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div>
		<!--Modal Talbe size-->
		<div class="modal fade" id="modalTableSize" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Table Sizes</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<!--Body-->
				<div class="modal-body">

					<table class="table table-hover" id="TableSize">
						<thead>
							<tr>
								<th>#</th>
								<th>Size</th>
								<th>Remove</th>
								<th><a class="btn btn-outline-primary restformsize" data-toggle="modal" data-target="#AddNewSize">add new size</a></th>
							</tr>
						</thead>
						<tbody class="table_size">
							@foreach($sizes as $size)
							<tr>
								<th scope="row">{{$size->id}}</th>
								<td>{{$size->size}}</td>

								<td><a class="btn btn-danger" onclick="tabledeleteSize(this,{{$size->id}})">delete</a></td>
								<td><a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary" onclick="tableGetSize(this,{{$size->id}})">update</a></td>
							</tr>
							@endforeach

						</tbody>
					</table>

				</div>
				<!--Footer-->
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
	</div>
	<!--Modal form Size-->
	<div class="modal fade" id="AddNewSize" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<form method="post" id="submitSize">
					@csrf
					<div class="modal-header">
						<h4 class="modal-title title-size">Thêm mới một size</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>

					</div>
					<div class="modal-body inputsize">
						<div class="id_size_hidden">

						</div>
						<input type="hidden" name="row_id_size" id="row_id_size" value="">
						<input class="newSize" name="size" id="name_size">
						<input type="submit" value="submit" class="btn btn-info"><br>
						<span class="text-danger errorsSize"></span>
						<span class="text-success successSize"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>

			</div>

		</div>
	</div>
	@endsection
	@section('js')
	<script src="{{asset('admin/js/admin/product.js')}}"></script>

	@endsection