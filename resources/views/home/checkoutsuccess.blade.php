@extends('layouts.home.main')
@section('title','checkout')
@section('content')
<section class="content p-t-75">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              
              <div class="alert alert-primary mt-4">
                Đặt hàng thành công.
              </div>
             
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
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
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      
                      <th>Tên sản phẩm</th>
                      <th>màu</th>
                      <th>size</th>
                      <th>số lượng</th>
                      
                      <th>Giá tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bill->bill_details as $detail)
                    <tr>
                      
                      <td><a href="">{{$detail->product->name}}</a></td>
                      <td>{{$detail->color}}</td>
                      <td>{{$detail->size}}</td>
                      <td>{{$detail->quantity}}</td>
                      
                      <td>{{$detail->total}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  
                </div>
                <!-- /.col -->
                <div class="col-6">
                 

                  <div class="table-responsive">
                    <table class="table">
                     
                        <th>Giá tiền:</th>
                        <td>{{number_format($bill->total ,0 ,'.' ,'.')}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
@section('js')

@endsection