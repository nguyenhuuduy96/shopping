@extends('layouts.home.main')
@section('title', 'member')
@section('content')
    <div class="bg0 m-t-100 p-b-140">
        <div class="container ">
            <h1 class="rounded mx-auto d-block text-center">Tài khoản của bạn</h1>
            <hr>
            <div class="row">
                <div class="col-sm-3 border-right">
                    <h3>Tài khoản</h3>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column " id="menu-right">

                            <li class="nav-item menu-open menu-r font-weight-bold">
                                <a href="#" class="nav-link text-dark " data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Thông tin tài khoản
                                </a>
                            </li>
                            <li class="nav-item menu-r">
                                <a href="#" class="nav-link text-dark" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Đơn mua
                                </a>

                            </li>
                            <li class="nav-item menu-r" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                <a href="#" class="nav-link text-dark">
                                    Địa chỉ
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="javascript:void(0)" class="nav-link text-dark" data-toggle="modal"
                                    data-target="#FormChangePass">
                                    Đổi mật khẩu
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('logout') }}" class="nav-link text-dark">
                                    Đăng xuất
                                </a>
                            </li>


                        </ul>
                    </nav>
                </div>
                <div class="col-sm-8">
                    <div class="col-sm-12" id="accordionExample">
                        <div>
                            <h3 class="title-member">Thông tin tài khoản </h3>
                            <p class="success text-success"></p>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingThree"
                                data-parent="#accordionExample">

                                <form class="row" action="javascript:void(0)" id="formsubmit">
                                    @csrf

                                    <div class="col-sm-7 row">
                                        <div class="form-group col-sm-5">
                                            <label for="user_name">Họ tên:</label>
                                            <input type="hidden" class="form-control" id="id" name="id"
                                                value="{{ Auth::user()->id }}">

                                        </div>
                                        <div class="form-group col-sm-7">

                                            <input type="type" class="form-control" id="user_name" placeholder="name"
                                                name="name" value="{{ Auth::user()->name }}">
                                            <span class="error_name" style="color: red"></span>
                                        </div>
                                        <div class="form-group col-sm-5">
                                            <label for="email">Email:</label>

                                        </div>
                                        <div class="form-group col-sm-7">

                                            <input type="type" class="form-control" id="email" placeholder="email"
                                                name="email" value="{{ Auth::user()->email }}" @if (Auth::user()->email != null || Auth::user()->email != '')
                                            disabled
                                            @endif
                                            >
                                            <span class="error_email" style="color: red"></span>
                                        </div>
                                        <div class="form-group col-sm-5">
                                            <label for="image">Avatar:</label>
                                            <input type="hidden" name="anh" id="anh" class="anh"
                                                value="{{ Auth::user()->avatar }}">

                                        </div>
                                        <div class="form-group col-sm-7">

                                            <input type="file" class="form-control" id="image" placeholder="image"
                                                name="images">
                                            <span class="error_image" style="color: red"></span>
                                        </div>
                                        <div class="form-group col-sm-5">
                                            <label for="phone">số điện thoại:</label>


                                        </div>
                                        <div class="form-group col-sm-7">

                                            <input type="text" class="form-control" id="phone" placeholder="phone"
                                                name="url" value="{{ Auth::user()->phone }}" @if (Auth::user()->phone !== '')
                                            disabled
                                            @endif
                                            >

                                        </div>

                                    </div>

                                    <div class="col-sm-5 mx-auto  image">


                                        <label for="image" class="text-center rounded mx-auto d-block">
                                            <img src="{{ Auth::user()->avatar !== null ? Auth::user()->avatar : '../../../img/avatar.png' }}"
                                                class="rounded-circle rounded mx-auto d-block showimage" width="100px"
                                                height="100px">
                                            Avatar</label>

                                    </div>
                                    <div class="form-group col-sm-12">
                                        <input type="submit" value="Cập nhật tài khoản" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <table id="tablecheckbill" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>thời gian đặt</th>
                                            <th>trạng thái</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_bill">
                                        @foreach (Auth::user()->bills as $bill)
                                            <tr>
                                                <td><a
                                                        href="{{ route('check.out.success', $bill->bill_code) }}">{{ $bill->bill_code }}</a>
                                                </td>
                                                <td>{{ $bill->created_at->format('d/m/Y H:i:s') }}</td>
                                                <td>{{ isset($bill->status->name) ? $bill->status->name : null }}</td>
                                                <td>{{ number_format($bill->total, 0, '.', '.') }}
                                                    đ</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">

                                @foreach (Auth::user()->addresses as $address)
                                    <div class="row shadow-sm mb-2">
                                        <div class="col-sm-12 bg-secondary text-white">{{ $address->name }}</div>
                                        <div class="col-sm-3">
                                            <p>Tên:</p>
                                            <p>Địa chỉ: </p>
                                            <p>Số điện thoại: </p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p>{{ $address->name }}</p>
                                            <p>{{ $address->address }}, {{ $address->district }}, {{ $address->city }}</p>
                                            <p>{{ $address->phone }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    
    {{-- Change pass form --}}
    <div class="modal fade changePass" id="FormChangePass" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form method="post" id="submitChangePass" action="javascript:void(0)">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title title-color">Thay đổi mật khẩu</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4">Mật khẩu hiện tại:</label>
                        <input type="password" class="form-control col-sm-7" id="password" name="password" value="">
                        <span class="col-sm-4"></span><span class="text-danger col-sm-7 error_pass"></span>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4">Mật khẩu mới:</label>
                        <input type="password" class="form-control col-sm-7" id="newpasswors" name="newpassword" value="">
                        <span class="col-sm-4"></span><span class="text-danger col-sm-7 error_new_pass"></span>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4">Nhập lại mật khẩu:</label>
                        <input type="password" class="form-control col-sm-7" id="Cfpasswors" name="cfpasswors" value="">
                        <span class="col-sm-4"></span><span class="text-danger col-sm-7 error_cf_pass"></span>
                    </div>
                    <input type="submit" value="cập nhật" class="btn btn-primary">
                    <div class="modal-footer">
                        <button type="button" class="btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('home/js/member.js')}}"></script>
@endsection
