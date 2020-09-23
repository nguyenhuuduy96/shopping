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
											<input type="search" id="search_blog" class="form-control-sm" name="search" placeholder=""></label>
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
										<th>title</th>
										<th>author</th>
										<th>image</th>
										<th><a data-toggle="modal" data-target="#ModalBlog" id="new" onclick="restForm()"><i class="fa fa-plus-square text-success"></i> New Product</a></th>
										
									</tr>
								</thead>
								<tbody id="search_Show">
									@foreach($blogs as $blog)
									<tr>
										<td>{{$blog->id}}</td>
										<td>{{$blog->title}}</td>
										<td>{{$blog->author}}</td>
										<td><img src="{{$blog->image_title}}" width="50px;" alt=""></td>
										<td><a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalBlog" id="updateblog" onclick="Getupdate(this,{{$blog->id}})"><i class="fa fa-edit text-primary" ></i>Edit</a>
											<a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="deleteBlog(this,{{$blog->id}})"><i class="fas fa-trash-alt text-danger"></i>delete</a> 
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
		<div class="modal fade" id="ModalBlog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title" id="titleBlog">Add new Blog</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<div class="container">
							<form class="row" id="formblogsubmit" enctype="multipart/form-data">
								@csrf
								<div class="col-sm-12" id="getIdproduct">

								</div>
								<div class="col-sm-12">
									<div class="form-group" >
										
										<label for="type" >Tiêu đề:</label>
										<input type="hidden" class="form-control" id="rowid" placeholder="ten san pham" name="rowid" value="" >
										<input type="hidden" name="id" id="blog_id" value="">
										<input type="type" class="form-control" id="title" placeholder="tiêu đề" name="title" >
										<span class="error_title" style="color: red"></span>
									</div>
									<div class="form-group">
										<label for="source">tác giả:</label>
										<input type="type" class="form-control" id="author" placeholder="author" name="author" >
										<span class="error_author" style="color: red"></span>
									</div>
									<div class="form-group">
										<label for="date">Danh mục:</label>
										<select class="form-control" name="blog_category_id">
											<option value="">chọn</option>
											{{-- @foreach($cates as $cate)
											<option value="{{$cate->id}}">{{$cate->name}}</option>
											@endforeach --}}
										</select>
									</div>
									<div class="form-group">
										<label for="date">image:</label>
										<input type="file" class="form-control" id="image" name="image" >
										<input type="hidden" name="anh" id="anh" value="">
										<span class="error_image" style="color: red"></span>
									</div>
									
								</div>
								
								<div class="row col-sm-12" id="showImage">


								</div>
								<div class="form-group">
									<label >Nội dung</label>
									<textarea id="editor1" class="textarea" class="form-control" rows="15"  cols="80" name="content"></textarea>
									<span  class="error_content" style="color: red"></span>
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
		
	</div>
	
	@endsection
	@section('js')
	<script src="{{asset('admin/js/admin/blog.js')}}"></script>

	@endsection