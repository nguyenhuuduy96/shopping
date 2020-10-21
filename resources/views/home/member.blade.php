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
                                <a href="#" class="nav-link text-dark " data-toggle="collapse" data-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Thông tin tài khoản
                                </a>
                            </li>
                            <li class="nav-item menu-r">
                                <a href="#" class="nav-link text-dark" data-toggle="collapse" data-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Đơn mua
                                </a>

                            </li>
                            <li class="nav-item menu-r">
                                <a href="#" class="nav-link text-dark">
                                    Địa chỉ
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
                            <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
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
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
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
                                        <td><a href="{{route('check.out.success',$bill->bill_code)}}">{{$bill->bill_code}}</a></td>
                                            <td>{{$bill->created_at->format('d/m/Y H:i:s')}}</td>
                                        <td>{{isset($bill->status->name)?$bill->status->name:null}}</td>
                                            <td>{{ number_format($bill->total, 0, '.', '.') }}
                                                đ</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
@section('js')
    <script>
 
        let MenuRight = document.getElementById('menu-right');
        let pages = MenuRight.getElementsByClassName('menu-r');
        for (let i = 0; i < pages.length; i++) {
            pages[i].addEventListener("click", function() {

                $('li').removeClass("font-weight-bold");
                this.className += " font-weight-bold";
                $('.title-member').html($('.font-weight-bold')[0].innerText);
                // if (i = 0) {
                //     $('.title-member').html('Thông tin tài khoản')
                // } else if (i = 1) {
                //     $('.title-member').html('Đơn mua')
                // } else {

                // }



            });
        }
        $(document).ready(function() {
            $('#formsubmit').on('submit', function(event) {
                event.preventDefault();
                let image = $('#image').val();
                let anh = $('#anh').val();
                let name = document.getElementById('user_name').value;
                // console.log(name)

                if (name == "") {
                    $('.error_name').html('vui long nhập!');
                    $('.error_name').css('display', 'block');
                    return false;
                } else {
                    $('.error_name').css('display', 'none');
                }

                if ($("#email").val() == "") {
                    $('.error_email').html('Vui lòng nhập!');
                    $('.error_email').css('display', 'block');
                    return false;
                } else {
                    $('.error_email').css('display', 'none');
                }

                if (image == '' && anh == '') {
                    $('.error_image').html('vui lòng chọn ảnh!');
                    $('.error_image').css('display', 'block');
                    return false;
                } else {
                    $('.error_image').css('display', 'none');
                }

                $.ajax({
                    url: "member/save",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data)
                        if (data.error !== "") {
                            $('.error_email').html(data.error);
                            $('.error_email').css('display', 'block');
                            return false;

                        }
                        $('.error_email').css('display', 'none');
                        document.getElementById("email").disabled = true;
                        $('.success').html('cập nhật thành công!');
                    }
                });

            });

        });
        $(document).ready(function() {
            let img = document.querySelector('input[type="file"]');

            img.onchange = function() {
                $('.img').css('display', 'none');
                let image = img.files[0];
                let maxSize = 1024 * 1024 * 2;

                let test = new FileReader();
                test.readAsDataURL(image);
                test.onload = function() {
                    if (image.size > maxSize || /\.(jpe?g|png|gif|bmp)$/i.test(image.name) == false) {
                        $('.error_image').html(
                            'file filesUpload không được lớn hơn 2 mb và đúng định dạng ảnh!');
                        $('.error_image').css('display', 'block');
                        return false;
                    } else {

                        $('.showimage').attr('src', test.result);
                        $('.error_image').css('display', 'none');
                    }

                }




            }
        });

    </script>
@endsection
