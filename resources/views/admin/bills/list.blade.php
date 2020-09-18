@extends('layouts.layout_admins.main')    
@section('title','list bill')
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
                  <select name="example1_length" class="form-control-sm" >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select> entries</label>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <form  method="get">
                  <div id="dataTables_length" class="dataTables_filter">
                    <label class="form-control-sm">Search:
                      <input type="search" id="searh_product" class="form-control-sm" name="search" placeholder="">
                    </label>
                  </div>
                </form>
              </div> 
            </div>
          </div>
          <div class="card-body">
            <table id="tablebill" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Bill code</th>
                  <th>time create</th>
                  <th>total</th>
                  <th>status</th>
                  <th>

                  </th>

                </tr>
              </thead>
              <tbody id="search_Show">
                @foreach($bills as $bill)
                <tr>
                  <th><a href="{{route('admin.bill.detail',$bill->bill_code)}}"> {{$bill->bill_code}}</a></th>
                  <th>{{$bill->created_at }}</th>
                  <th>{{ number_format($bill->total, 0, '.', '.') }} đ</th>
                  <th>{{isset($bill->status)?$bill->status->name:''}}</th>
                  <th>
                    <a class="btn btn-primary" onclick="confirmBill(this,{{$bill->id}})" >
                    Xác nhận đơn</a>
                    <a class="btn btn-danger" onclick="cancelBill(this,{{$bill->id}})">Hủy đơn</a>
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


function confirmBill(r,id){
      let rowid = r.parentNode.parentNode.rowIndex;
      let tableBill = document.getElementById('tablebill');
      console.log(CSRF_TOKEN)
      $.ajax({
        url: './confirm',
        type: 'post',
        data: {_token:CSRF_TOKEN,id:id},
        success:function(data){
          console.log(data.bill);
          console.log(data.status)
          const cells = tableBill.rows[rowid].cells;
          
          cells[3].innerHTML = data.status.name;
          cells[4].innerHTML = `
          <a class="btn btn-danger" onclick="cancelBill(this,`+data.bill.id+`)">Cancel</a>`;
        }
      }) 
    }

function cancelBill(r,id){
      let rowid = r.parentNode.parentNode.rowIndex;
      let tableBill = document.getElementById('tablebill');
      console.log(CSRF_TOKEN)
      $.ajax({
        url: './cancel',
        type: 'post',
        data: {_token:CSRF_TOKEN,id:id},
        success:function(data){
          console.log(data.bill);
          console.log(data.status)
          const cells = tableBill.rows[rowid].cells;
          
          cells[3].innerHTML = data.status.name;
          cells[4].innerHTML = `
          `;
        }
      }) 
    }
  </script>

  @endsection