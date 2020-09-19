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
              <th>price</th>
              <th>total</th>
              <th>
                <a data-toggle="modal" data-target="#AddNewBillDetail" ><i class="fa fa-plus-square text-success"></i> New Product</a></th>
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
              <th>{{$bill->price}}</th>
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
<div class="modal fade" id="AddNewBillDetail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="titleProduct">Add new Product</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="md-form mt-0">
          <input class="form-control" type="text" placeholder="Search" aria-label="Search" id="searh_product">
        </div>

        <hr>
        <h6 class="totalsearch">total search :</h6>
        <table id="tableAddProduct" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Color</th>
              <th>size</th>
              <th>quantity</th>
              <th>price</th>
              <th>
                
              </th>

            </tr>
          </thead>
          <tbody id="search_show_product">
           {{--  @foreach($bill->bill_details as $billdetail)
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
            @endforeach --}}

          </tbody>
        </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

@endsection
@section('js')
<script  type="text/javascript" charset="utf-8" async defer>
//add product
function AddProduct(event){
  // console.log(event.parentNode.parentNode);
  let rowId = event.parentNode.parentNode.rowIndex;
  let tableAddProduct = document.getElementById('tableAddProduct');

  
  const cells = tableAddProduct.rows[rowId].cells;
  let name =cells[0].innerHTML;
  let color =cells[1].children[0].value;
  console.log(name)
}
//get size
function showSize(r){
  console.log(r);

  let rowId = r.parentNode.parentNode.rowIndex;
  let val = $(r).val();
  let color_id = val.split(' ')[1];
  let product_id = val.split(' ')[2];
  let tableAddProduct = document.getElementById('tableAddProduct');
  // console.log(color_id,product_id);
  $.ajax({
    url: '../../../api/product/get-size-price',
    type: 'POST',
    data: {color_id: color_id,product_id:product_id},
    success:function(data){
      let showsize = '';
      for(const x of data.data){
        showsize +=` <option value="`+x.size.size+' '+x.price+' '+x.stock+ `">`+x.size.size+`</option>`;
      }
      const cells = tableAddProduct.rows[rowId].cells;
          
          cells[2].innerHTML = `<select class="form-control" name="size" id="size" onchange="GetPriceStock(this)">
                          <option value="">-- chọn --</option> 
                          `+showsize+`
                        </select>`;
                         console.log(showsize);
         
     
    }
  })
  
  
}
//get price stock
function GetPriceStock(event){
  const tableAddProduct = document.getElementById('tableAddProduct');
  const rowId = event.parentNode.parentNode.rowIndex;
  const array = $(event).val().split(' ');
  const cells = tableAddProduct.rows[rowId].cells;
  const price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(array[1]);
  const stock = array[2];
  cells[3].innerHTML= `<input class="mtext-104 cl3 txt-center quantity" type="number" name="quantity">
                          <p class="text-info">số lượng còn: `+stock+`</p>`;
  cells[4].innerHTML = price;
  console.log(array);
}
// search product
$(document).ready(function(){
  $('#searh_product').on('keyup',function(){
    var search = $(this).val();
    console.log(search);
    $.ajax({
      url:"../../../api/product/search-product",
      method:"get",
      data:{search:search},
      success:function(data){
       
        // return false;
        const countProduct = data.products.length;
        // console.log(countProduct)
            $('.totalsearch').html(`total search : `+countProduct+``);
            // return false;
            let showsearch = ``;
          
            for (const product of data.products) {
              let arrayColor =[];
              for(const color of product.attributes){
                if(arrayColor.length<1){
                  arrayColor.push(color);
                }
                filter = arrayColor.filter(function(index) {
                  if (index.color_id == color.color_id) {
                    return color;
                  }
                });
                if (filter.length <1) {
                  arrayColor.push(color);
                }
              }
              // console.log(arrayColor);
             
              let ColorShow = '';
              for(const x of arrayColor){
               ColorShow += `<option value="`+x.color+' '+x.color_id+' '+product.id+`">`+x.color+`</option>`;
              }
              showsearch +=`<tr>
                      <td>`+product.name+`</td>
                      <td><select class="form-control" name="color" id="color" onchange="showSize(this)">
                       <option value="">-- chọn --</option> 
                         `+ColorShow+` 
                          
                          
                        </select>
                      </td>
                      <td>
                        <select class="form-control" name="size" id="size" >
                          <option value="">-- chọn --</option> 
                        </select>
                      </td>
                      <td>
                          <input class="mtext-104 cl3 txt-center quantity" type="number" name="quantity">
                          <p class="text-info">số lượng còn: 0</p>

                      </td>
                      <td>null</td>
                      <td><a class="btn btn-app" class="btn btn-primary" id="addnew" onclick="AddProduct(this)" >
                      add new</a> 
                      </td>
                    </tr>`;
            }
            // console.log(showsearch);
            // console.log(showsearch);
            $('#search_show_product').html(showsearch);
            
          }
        })
  })
});
</script>

@endsection