@extends('layouts.layout_admins.main')
@section('title', 'slide show')
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
                                        <select name="example1_length" class="form-control-sm" id="show">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <form method="get">
                                    <div id="dataTables_length" class="dataTables_filter">
                                        <label class="form-control-sm">Search:
                                            <input type="search" id="searh_product" class="form-control-sm" name="search"
                                                placeholder="tên sản phẩm"></label>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="sign-in-button" style="display: none;"></div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>image</th>
                                    <th>Description</th>
                                    <th>Active</th>
                                    <th><a data-toggle="modal" data-target="#ModalSlide"><i
                                                class="fa fa-plus-square text-success"></i> New Slide Show</a></th>

                                </tr>
                            </thead>
                            <tbody id="search_Show">
                                @foreach ($slides as $slide)
                                    <tr>
                                        <td>{{ $slide->id }}</td>
                                        <td>{{ $slide->title }}</td>
                                        <td><img src="{{ $slide->image }}" alt="" width="50px"></td>
                                        <td>{{ $slide->desciption }}</td>
                                        <td>
                                            @if ($slide->active == 0)
                                                <a class="btn btn-danger text-white"
                                                    onclick="active(this,{{ $slide->id }})">Disable</a>
                                            @else
                                                <a class="btn btn-success text-white"
                                                    onclick="active(this,{{ $slide->id }})">Enable</a>
                                            @endif

                                        </td>
                                        <td>
                                        <a class="btn btn-app" class="btn btn-success" data-toggle="modal"
                                            data-target="#ModalProduct" id="updateProduct"
                                            onclick="Getupdate(this,'{{ $slide->id }}')"><i
                                                class="fa fa-edit text-primary"></i>Edit</a>
                                        <a class="btn btn-app" class="btn btn-success" id="deleteRow"
                                            onclick="deleteSlide(this,'{{ $slide->id }}')"><i
                                                class="fas fa-trash-alt text-danger"></i>delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-2 " id="paga-link">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal form-->
    @include('admin.slideshow.form')

@endsection
@section('js')
    <script src="{{ asset('admin/js/admin/slideshow.js') }}"></script>
@endsection
