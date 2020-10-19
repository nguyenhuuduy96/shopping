@extends('layouts.layout_admins.main')
@section('title', 'profile')
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="card col-sm-12">
                <div class="card-body ">
                    
                    <form class="row" action="javascript:void(0)" id="formsubmit">
                        @csrf
                        <p class="title text-center text-success col-sm-12"></p>
                        <div class="col-sm-7 row">
                            <div class="form-group col-sm-5">
                                <label for="user_name">Họ tên:</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{Auth::user()->id}}">
                                
                            </div>
                            <div class="form-group col-sm-7">
                                
                                <input type="type" class="form-control" id="user_name" placeholder="name" name="name" value="{{Auth::user()->name}}">
                                <span class="error_name" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="email">Email:</label>
                                
                            </div>
                            <div class="form-group col-sm-7">
                                
                                <input type="type" class="form-control" id="email" placeholder="email"
                            name="email" value="{{Auth::user()->email}}" 
                            @if (Auth::user()->email != null || Auth::user()->email != '' )
                            disabled
                            @endif
                            >
                                <span class="error_email" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="image">Avatar:</label>
                            <input type="hidden" name="anh" id="anh" class="anh" value="{{Auth::user()->avatar}}">
                                
                            </div>
                            <div class="form-group col-sm-7">
                                
                                <input type="file" class="form-control" id="image" placeholder="image" name="images">
                                <span class="error_image" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="phone">số điện thoại:</label>
                                
    
                            </div>
                            <div class="form-group col-sm-7">
                                
                                <input type="text" class="form-control" id="phone" placeholder="phone" name="url" value="{{Auth::user()->phone}}"
                                @if (Auth::user()->phone !== '')
                                disabled  
                                @endif
                                >
    
                            </div>
                            
                        </div>
                        
                        <div class ="col-sm-5 mx-auto  image">
                            
                                
                                <label for="image" class="text-center rounded mx-auto d-block">
                                    <img  src="{{ Auth::user()->avatar !== null ? Auth::user()->avatar : '../../../img/avatar.png' }}" class="rounded-circle rounded mx-auto d-block showimage" width="100px" height="100px">
                                    Avatar</label>
                            
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary">
        
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            
        </div>
    </div>

@endsection

@section('js')
<script src="{{asset('admin/js/admin/profile.js')}}"></script>
@endsection
