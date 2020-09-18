@extends('layouts.layout_admins.main')    
@section('title','list bill')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
         <div class="card-body">
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Địa chỉ thanh toán
                  <address>
                    <strong>{{isset($bill->address->name)?$bill->address->name:'???'}}</strong><br>
                    {{isset($bill->address->city)?$bill->address->city:'???'}}, {{isset($bill->address->district)?$bill->address->district:'???'}}, 
                    {{isset($bill->address->address)?$bill->address->address:'???'}}<br>
                    Phone: {{isset($bill->address->phone)?$bill->address->phone:'???'}}<br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div cla s="col-sm-4 invoice-col">
                  Địa chỉ gửi hàng
                  <address>
                    <strong>{{isset($bill->address->name)?$bill->address->name:'???'}}</strong><br>
                    {{isset($bill->address->city)?$bill->address->city:'???'}}, {{isset($bill->address->district)?$bill->address->district:'???'}}, 
                    {{isset($bill->address->address)?$bill->address->address:'???'}}<br>
                    Phone: {{isset($bill->address->phone)?$bill->address->phone:'???'}}<br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  
                  <b>bill ID:</b> {{$bill->bill_code}}<br>
                  <b>Thời gian đặt:</b> {{$bill->created_at}}<br>
                  
                </div>
                <!-- /.col -->
            </div>
          </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
       
          <div class="card-body">
            <table id="tablebilldetail" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Color</th>
                  <th>size</th>
                  <th>quantity</th>
                  <th>total</th>
                  <th>

                  </th>

                </tr>
              </thead>
              <tbody id="search_Show">
                @foreach($bill->bill_details as $billdetail)
                <tr>
                  <th><a href="{{route('detail.product',$billdetail->product->id)}}"> {{$billdetail->product->name}}</a></th>
                  <th>{{$billdetail->color }}</th>
                  <th>{{$billdetail->size}}</th>
                  <th>{{$billdetail->quantity}}</th>
                  <th>{{ number_format($billdetail->total, 0, '.', '.') }} đ</th>
                  
                  <th>
                    
                    <a class="btn btn-danger" onclick="canceldetail(this,{{$billdetail->id}})">xoa</a>
                  </th>
                </tr>
                @endforeach

              </tbody>
            </table>
            {{--  <div class="d-flex justify-content-center mt-2 " id="paga-link"></div> --}}
          </div>
          <!-- /.card-body -->

        </div>
      </div>
    </div>
  </div>


  @endsection
  @section('js')
  <script  type="text/javascript" charset="utf-8" async defer>

  </script>

  @endsection