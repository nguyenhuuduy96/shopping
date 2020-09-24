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
  <script type="text/javascript">
    $(document).ready(function() {

      $('#submit_phone').click( function(){
        console.log('sadasd')
        let search_phone = document.getElementById('search_phone').value;
        let tablecheckbill = document.getElementById('tablecheckbill');
        $.ajax({
          url: '../api/check-bill',
          type: 'POST',
          data: {phone:search_phone},
          success:function(data){
            console.log(data)
            let list ='';
            // for(const bill of data.data.bills){
            //   console.log(bill);
            // }
            if (data =="") {
              $('.error_check').html('không tìm thấy dữ liệu!');
            }else {

              for (const bill of data.data.bills) {

                const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(bill.total);
                const status =bill.status.name == null ? 'null':bill.status.name;
                list +=  `<tr>
                        <td><a href="check-out-seccess/`+bill.bill_code+`" title="">`+bill.bill_code+`</a></td>
                        <td>`+bill.created_at+`</td>
                        <td>`+status+`</td>
                        <td>`+price+`</td>
                      </tr>`;
              }
              // console.log(list)
              $('#search_show_bill').html(list);
            }
          }
        })


      })
    });

  </script>
  @endsection
