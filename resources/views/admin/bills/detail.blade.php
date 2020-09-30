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
              <input type="hidden" name="bill_id" id="bill_id" value="{{$bill->id}}">
              <input type="hidden" name="user_id" id="user_id" value="{{$bill->user_id}}">
              <input type="hidden" name="address_id" id="address_id" value="{{$bill->address_id}}">
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
            <b>Trang thai:</b> <span class="status">{{$bill->status->name}} <input type="hidden" name="status_id" value="{{$bill->status_id}}" id="status_id"></span><br>

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
              <td><a href="{{route('detail.product',$billdetail->product->slug)}}"> {{$billdetail->product->name}}</a></td>
              <td>{{$billdetail->color }}</td>
              <td>{{$billdetail->size}}</td>
              <td>{{$billdetail->quantity}}</td>
              <td>{{$billdetail->price}}</td>
              <td>{{ number_format($billdetail->total, 0, '.', '.') }} &nbsp;₫</td>

              <td>

                <a class="btn btn-danger" onclick="deleteDetail(this)">xoa</a>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
        <div class="d-flex justify-content-center mt-2 " id="paga-link">
          <li class="page-item" aria-current="page"><span class="page-link"><a href="javascript:void(0)" class="btn btn-success confirmBill" id="confirmBill">xác nhận đơn</a></span></li> 
          <li class="page-item" aria-current="page"><span class="page-link"><a href="javascript:void(0)" class="btn btn-danger cancelBill" id="cancelBill" >hủy đơn</a></span></li>
          <li class="page-item" aria-current="page"><span class="page-link"><a href="javascript:void(0)" class="btn btn-primary addBill" id="addBill">tạo đơn</a></span></li>
         
        </div>
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
//add bill
$(document).ready(function() {
  let addBill = document.getElementById('addBill');
  
  addBill.addEventListener('click',function(){
    let status_id = document.getElementById('status_id').value;
    console.log(status_id)
    if (status_id!=3) {
      alert('trạng thái đơn hàng bị hủy mới được tao đơn!');
      return false;
    }
    // let color= document.getElementsByClassName('color').value;
   let user_id = $('#user_id').val();
   let address_id = $('#address_id').val();
   let color = $('input[name="color[]"]').map(function(){ 
                    return this.value; 
                }).get();
   let size = $('input[name="size[]"]').map(function(){ 
                    return this.value; 
                }).get();
   let price = $('input[name="price[]"]').map(function(){ 
                    return this.value; 
                }).get();
   let quantity = $('input[name="quantity[]"]').map(function(){ 
                    return this.value; 
                }).get();
   let total = $('input[name="total[]"]').map(function(){ 
                    return this.value; 
                }).get();
   let product_id = $('input[name="product_id[]"]').map(function(){
                return this.value;
   }).get(); 
   let name = $('input[name="name[]"]').map(function(){
                return this.value;
   }).get(); 
    // console.log(color,size,price,quantity,total,name,product_id);
    $.ajax({
      url: '../../../api/bill/add-new',
      type: 'POST',
      data: {user_id:user_id,address_id:address_id,color: color,size:size,price:price,quantity:quantity,total:total,name:name,product_id:product_id},
      success:function(data){
        console.log(data)
        window.location = "./"+data.bill_code+"";
      }
    })
    
    
  })
});
//xac nhan don
$(document).ready(function() {
  let event = document.getElementById('confirmBill');
  event.addEventListener('click', function(){
    let bill_id = document.getElementById('bill_id').value;
    let status_id = document.getElementById('status_id').value;
    if (status_id>2) {
      alert('đơn hàng đã hoàn thành hoặc bị hủy không thể xác nhận đơn được!');
      return false;
    }
    $.ajax({
        url: '../confirm',
        type: 'post',
        data: {_token:CSRF_TOKEN,id:bill_id},
        success:function(data){
          
          const status=``+data.status.name+` <input type="hidden" name="status_id" value="`+data.bill.status_id+`" id="status_id"></span>`;
          $('.status').html(status)
          
        }
      }) 
  })
});
//huy don
$(document).ready(function() {
  let event = document.getElementById('cancelBill');
  event.addEventListener('click', function(){
    let bill_id = document.getElementById('bill_id').value;
    let status_id = document.getElementById('status_id').value;
    if (status_id>3) {
      alert('đơn hàng đã hoàn thành không thể hủy đơn được!');
      return false;
    }
    $.ajax({
        url: '../cancel',
        type: 'post',
        data: {_token:CSRF_TOKEN,id:bill_id},
        success:function(data){
          
          const status=``+data.status.name+` <input type="hidden" name="status_id" value="`+data.bill.status_id+`" id="status_id"></span>`;
          $('.status').html(status)
          
        }
      }) 
  })
});
//delete detail
function deleteDetail(event){
  const rowId = event.parentNode.parentNode.rowIndex;
  document.getElementById("tablebilldetail").deleteRow(rowId);
}
//add product
function AddProduct(event){
  // console.log(event.parentNode.parentNode);
  let rowId = event.parentNode.parentNode.rowIndex;
  let tableAddProduct = document.getElementById('tableAddProduct');
  let tablebilldetail = document.getElementById('tablebilldetail');
  const cells = tableAddProduct.rows[rowId].cells;
  let name =cells[0].innerHTML;
  let ArrayColor =cells[1].children[0].value.split(' ');
  let ArraySizePrice = cells[2].children[0].value.split(' ');
  // cells[2].children[1].innerHTML ="error";
  let color =ArrayColor[0];
  let size = ArraySizePrice[0];
  let price = ArraySizePrice[1];
  let quantity = cells[3].children[0].value;
  let total = price * quantity;
  let product_id = ArrayColor[2];
  // console.log(total);s
  if (color == '') {
    cells[1].children[1].innerHTML ="Vui long chon!";
    cells[1].children[1].style.display = 'block';
    return false;
  }else{
    cells[1].children[1].style.display = 'none';
  }

  if (size == '') {
    cells[2].children[1].innerHTML ="Vui long chon!";
    cells[2].children[1].style.display = 'block';
    return false;
  }else{
    cells[2].children[1].style.display = 'none';
  }

  if (quantity == '') {
    cells[3].children[2].innerHTML ="Vui long chon!";
    cells[3].children[2].style.display = 'block';
    return false;
  } 
  if(parseInt(quantity) > parseInt(ArraySizePrice[2]) || parseInt(quantity)<1){
    console.log(ArraySizePrice[2],quantity)
    cells[3].children[2].innerHTML ="quantity > stock & quantity<1!";
    cells[3].children[2].style.display = 'block';
    return false;
  }else{
    cells[3].children[2].style.display = 'none';
  }
  const row = tablebilldetail.insertRow(1);
  const cell1 = row.insertCell(0);
  const cell2 = row.insertCell(1);
  const cell3 = row.insertCell(2);
  const cell4 = row.insertCell(3);
  const cell5 = row.insertCell(4);
  const cell6 = row.insertCell(5);
  const cell7 = row.insertCell(6);
  const vndPrice = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(price);
  const vndTotal = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total);
  cell1.innerHTML = `<input class="form-control" type="hidden" name="name[]" class="name" value="`+name+`">
  <input class="form-control" type="hidden" name="product_id[]" class="product_id" value="`+product_id+`"><a 
  href="../../../detail-product/`+ArrayColor[3]+`">`+name+`</a>`;
  cell2.innerHTML = `<input class="form-control" type="hidden" name="color[]" class="color" value="`+color+`">`+color+``;
  cell3.innerHTML = `<input class="form-control" type="hidden" name="size[]" class="size" value="`+size+`">`+size+``;
  cell4.innerHTML = `<input class="form-control" type="hidden" name="quantity[]" class="quantity" value="`+quantity+`">`+quantity+``;
  cell5.innerHTML =`<input class="form-control" type="hidden" name="price[]" class="price" value="`+price+`">`+vndPrice+``;
  cell6.innerHTML =`<input class="form-control" type="hidden" name="total[]" class="total" value="`+total+`">`+vndTotal+``;
  cell7.innerHTML =`<a class="btn btn-danger" onclick="deleteDetail(this)">xoa</a>`;
  $('#AddNewBillDetail').modal('hide');
  // console.log(name,quantity,color,size,price)
}
//get size
function showSize(r){
  // console.log(r);

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
      </select><p class="text-danger"></p>`;
      // console.log(showsize);


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
  <p class="text-info">số lượng còn: `+stock+`</p>
  <p class="text-danger"></p>`;
  cells[4].innerHTML = price;
  // console.log(array);
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
               ColorShow += `<option value="`+x.color+' '+x.color_id+' '+product.id+' '+product.slug+`">`+x.color+`</option>`;
             }
             showsearch +=`<tr>
             <td>`+product.name+`</td>
             <td><select class="form-control" name="color" id="color" onchange="showSize(this)">
             <option value="">-- chọn --</option> 
             `+ColorShow+` 


             </select>
             <p class="text-danger"></p>
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