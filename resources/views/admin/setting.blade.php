@extends('layouts.layout_admins.main')
@section('title', 'setting')
@section('content')

    <div class="container-fluid">
        <div class="row">

            <div class="card col-sm-12">
                <div class="card-body ">

                    <form class="row" action="javascript:void(0)" id="formsubmit" enctype="multipart/form-data">
                        @csrf
                        <p class="title text-center text-success col-sm-12"></p>
                        <div class="col-sm-7 row">
                            <div class="form-group col-sm-5">
                                <label for="logo_text">Logo text:</label>
                                <input type="hidden" class="form-control" id="id" name="id"
                                    value="{{ isset($setting->id) ? $setting->id : null }}">
                                <input type="hidden" name="choose_logo" id="choose_logo"
                                    value="{{ isset($setting->choose_logo) ? $setting->choose_logo : 0 }}">
                            </div>
                            <div class="form-group col-sm-7">

                                <input type="type" class="form-control" id="logo_text" placeholder="logo_text"
                                    name="logo_text" value="{{ isset($setting->logo_text) ? $setting->logo_text : null }}">
                                <span class="error_name" style="color: red"></span>
                            </div>

                            <div class="form-group col-sm-5">
                                <label for="image">Logo image:</label>
                                <input type="hidden" name="anh" id="anh" class="anh"
                                    value="{{ isset($setting->logo_image) ? $setting->logo_image : null }}">

                            </div>
                            <div class="form-group col-sm-7">

                                <input type="file" class="form-control" id="image" placeholder="image" name="images">
                                <span class="error_image" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="phone">Chọn hiễn thị logo:</label>


                            </div>
                            <div class="form-group col-sm-7">
                                <nav>
                                    <ul class="pagination" id="choose">
                                        @if (isset($setting))
                                            @if ($setting->choose_logo == 0)
                                                <li class="page-item page active" value="0" aria-current="page"><span
                                                        class="page-link">Logo text</span></li>
                                                <li class="page-item page" value="1" aria-current="page"><span
                                                        class="page-link">Logo image</span></li>
                                            @else
                                                <li class="page-item page " value="0" aria-current="page"><span
                                                        class="page-link">Logo text</span></li>
                                                <li class="page-item page active" value="1" aria-current="page"><span
                                                        class="page-link">Logo image</span></li>
                                            @endif

                                        @else
                                            <li class="page-item page active" value="0" aria-current="page"><span
                                                    class="page-link">Logo text</span></li>
                                            <li class="page-item page " value="1" aria-current="page"><span
                                                    class="page-link">Logo image</span></li>
                                        @endif
                                    </ul>
                                </nav>

                            </div>
                            <div class="form-group col-sm-5">
                                <label>Url banner 1:</label>


                            </div>
                            <div class="form-group col-sm-7">

                                <input type="text" class="form-control" id="url_banner1" placeholder="url"
                                    name="url_banner1"
                                    value="{{ isset($setting->url_banner1) ? $setting->url_banner1 : null }}">

                            </div>
                            <div class="form-group col-sm-5">
                                <label>Url banner 2:</label>


                            </div>
                            <div class="form-group col-sm-7">

                                <input type="text" class="form-control" id="url_banner2" placeholder="url"
                                    name="url_banner2"
                                    value="{{ isset($setting->url_banner2) ? $setting->url_banner2 : null }}">

                            </div>
                            <div class="form-group col-sm-5">
                                <label>Url banner 3:</label>

                            </div>
                            <div class="form-group col-sm-7">

                                <input type="text" class="form-control" id="url_banner3" placeholder="url"
                                    name="url_banner3"
                                    value="{{ isset($setting->url_banner3) ? $setting->url_banner3 : null }}">

                            </div>
                            <div class="form-group col-sm-5">
                                <label for="email_contact">Email liên hệ:</label>

                            </div>
                            <div class="form-group col-sm-7">

                                <input type="text" class="form-control" id="email_contact" placeholder="Email liên hệ"
                                    name="email_contact"
                                    value="{{ isset($setting->email_contact) ? $setting->email_contact : null }}">

                            </div>
                            <div class="form-group col-sm-5">
                                <label for="address">Địa chỉ:</label>

                            </div>
                            <div class="form-group col-sm-7">
                                <textarea class="form-control" id="address" placeholder="Địa chỉ"
                                    name="address">{{ isset($setting->address) ? $setting->address : null }}</textarea>


                            </div>

                        </div>

                        <div class="col-sm-5 mx-auto  image">


                            <label for="image" class="text-center rounded mx-auto d-block">
                                <img src="{{ Auth::user()->avatar !== null ? Auth::user()->avatar : '../../../img/avatar.png' }}"
                                    class="rounded-circle rounded mx-auto d-block showimage" width="100px" height="100px">
                                Logo</label>

                        </div>
                        <input type="submit" value="Save" class="btn btn-primary">

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')
<script src="{{asset('admin/js/admin/setting.js')}}"></script>

@endsection
