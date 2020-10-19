@extends('layouts.layout_admins.main')
@section('title', 'user')
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
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>avatar</th>
                                    <th>Số điện thoại</th>
                                    <th>chọn quyền</th>
                                    <th>quyền hiện tại</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody id="search_Show">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-center"><img
                                                src="{{ $user->avatar !== null ? $user->avatar : '../../../img/avatar.png' }}"
                                                width="50px" alt=""></td>
                                        <td>{{ $user->phone }}</td>
                                        <td><select class="form-control" name="is_active" id="is_active">
                                                <option value="">-- chọn --</option>
                                                @foreach ($decentralizations as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><p class="btn btn-primary">{{ isset($user->decentralization->name) ? $user->decentralization->name : 'null' }}</p>
                                        </td>
                                        <td><a class="btn btn-primary text-white" onclick="save(this,{{$user->id}})">Lưu</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-2 " id="paga-link">

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('admin/js/admin/user.js') }}"></script>

@endsection
