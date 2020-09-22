@extends('layouts.layout_admins.main')    
@section('title','category Blog')
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
                      <input type="search" id="searh_product" class="form-control-sm" name="search" placeholder="">
                    </label>
                  </div>
                </form>
              </div> 
            </div>
          </div>
          <div class="card-body">
            <table id="tableCategoryProduct" class="table table-bordered table-striped">

              {{--  <div id="example1"><label>Search:<input type="search" id="searh_product" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div> --}}
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>category parent</th>
                  <th>
                    <a data-toggle="modal" data-target="#modalcategory" onclick="newform()" ><i class="fa fa-plus-square text-primary"></i> New Category
                    </a>
                  </th>

                </tr>
              </thead>
              <tbody id="search_Show">
                @foreach($cates as $cate)
                <tr>
                  <th>{{$cate->id}}</th>
                  <th>{{$cate->name }}</th>
                  <th>{{isset($cate->cate)?$cate->cate->name:''}}</th>
                  <th>
                    <a class="btn btn-primary" onclick="update(this,{{$cate->id}})" data-toggle="modal" data-target="#modalcategory">
                    update</a>
                    <a class="btn btn-danger" onclick="DeleteCategory(this,{{$cate->id}})">delete</a>
                  </th>
                </tr>
                @endforeach

              </tbody>
            </table>
            <div class="d-flex justify-content-center mt-2 " id="paga-link"></div>
          </div>
          <!-- /.card-body -->

        </div>
      </div>
    </div>
  </div>
  {{-- modal category product --}}
  @include('admin.blogCategory.form')
  @endsection
  @section('js')
<script src="{{asset('admin/js/admin/cateBlog.js')}}"></script>
  <script type="text/javascript">
    
    

 </script>
 @endsection