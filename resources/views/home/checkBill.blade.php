@extends('layouts.home.main')
@section('title','checkout')
@section('content')
<section class="content p-t-75">
  <div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
      <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
        Home
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <a href="{{route('check.bill.home')}}" class="stext-109 cl8 hov-cl1 trans-04">
        kiểm tra đơn
      </a>


    </div>
  </div>
  <div  class="container">

    <div class="input-group mb-3">
      <input type="text" class="form-control" id="search_phone" placeholder="phone Search">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit" id="submit_phone">tìm kiếm</button>
      </div>
    </div>
    <span class="text-danger error_check"></span>
    <hr>

    <table id="tablecheckbill" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Mã đơn hàng</th>
          <th>thời gian đặt</th>
          <th>trạng thái</th>
          <th>Tổng tiền</th>
        </tr>
      </thead>
      <tbody id="search_show_bill">


      </tbody>
    </table>



  </section>
  @endsection
  @section('js')
<script type="text/javascript" src="{{asset('home/js/checkbill.js')}}"></script>
  @endsection
