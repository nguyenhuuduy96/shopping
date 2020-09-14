<script type="text/javascript">

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	
		
		// $('#addsize').click(function(){
		// 	$('.size').append('<input type="text" class="sizename" ><button id="saveSize">Save Size</button>');
		// });
//get product show form modal product
$(document).ready(function(){
	$('#formSingup').on('submit', function(event){
		        event.preventDefault();
		       	var email_regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		        if( $("#name").val() == "" ) {
	          	$('.error_singup_name').html('vui long nhập!');
	            return false;
		        }else{
		        	$('.error_singup_name').css('display','none');
		        }
		        if( $("#email").val() == "" ) {
		          	$('.error_singup_email').html('vui lòng nhập nguồn hàng!');
		            return false;
		        }else {
		        	$('.error_singup_email').css('display','none');
		        }
		        if( $("#pass_singup").val() == "" ) {
		          	$('.error_singup_password').html('vui lòng nhập pass word!');
		            return false;
		        }else{
		        	$('.error_singup_password').css('display','none');
		        }
		     
		            $.ajax({
		                url:"{{route('user.singup')}}",
		                method:"post",
		                data: new FormData(this),
		                contentType:false,
		                cache:false,
		                processData:false,
		                headers:{
		            'X-CSRF-TOKEN': "{{ csrf_token() }}"
		            },
		                success:function(data)
		                {
		                	let AlerUserSuccess =confirm("success");
		                	$('#modalRegisterForm').modal('hide');
		                	$('#formSingup').trigger("reset");
		                	// location.reload();
		                }
		            });
		        
		    });
})
$(document).ready(function(){
	$('#formLogin').on('submit', function(event){
		        event.preventDefault();
		       	
		        // if( $("#email").val() == "" ) {
		        //   	$('.error_login_email').html('vui lòng nhập nguồn hàng!');
		        //     return false;
		        // }else {
		        // 	$('.error_login_email').css('display','none');
		        // }
		        // if( $("#pass").val() == "" ) {
		        //   	$('.error_login_password').html('vui lòng nhập pass word!');
		        //     return false;
		        // }else{
		        // 	$('.error_login_password').css('display','none');
		        // }
		     
		            $.ajax({
		                url:"{{route('user.login')}}",
		                method:"post",
		                data: new FormData(this),
		                contentType:false,
		                cache:false,
		                processData:false,
		                headers:{
		            'X-CSRF-TOKEN': "{{ csrf_token() }}"
		            },
		                success:function(data)
		                {
		                	// console.log(data.email);
		                	location.reload();
		                }
		            });
		        
		    });
})	
function onclickupdate(r,id){
				var rowproduct = r.parentNode.parentNode.rowIndex;
				$('#titleProduct').html('Update product');
				$('#showImage').empty();
				$('#shownewImage').empty();

				$('#getsize').empty();
				
				$('#getsizeup').empty();
				
				$.ajax({
					url:"{{route('get.ajax.product')}}",
					method:"get",
					data:{id:id},
					success:function(data){

						$('#name_product').attr("value",data.product.name);
						$('#source').attr("value",data.product.source);
						$('#date').attr("value",data.product.time_expired);
						$('#rowid').attr('value',rowproduct);
						$('#product_id').append('<input type="hidden" name="id" value="'+data.product.id+'">');
						let listup='';
						for (const x of data.productSizes) {
							listup +='<div class="row"><div class="col-md-3"><label>size</label><select class="form-control select2" style="width: 100%;" name="size_id[]" class="validatesize" id="validateSize"><option value="">-- chọn --</option>';
							for (const size of data.sizes) {
								if (size.id==x.id) {
									listup +='<option value="'+size.id+'" selected> '+size.size+'</option>';
								}else{
									listup +='<option value="'+size.id+'"> '+size.size+'</option>';
								}
								
							}
							listup+='</select></div><div class="col-md-5"><label>giá</label><input type="number" name="price[]" class="form-control" value="'+x.pivot.price+'"></div><div class="col-md-2"><label>số lượng</label><input type="number" name="stock[]" class="form-control" value="'+x.pivot.stock+'"><input type="hidden" name="middle_id[]" value="'+x.pivot.id+'"></div><a style="width:75px;" onclick="xoa(event,'+x.pivot.id+')" class="form-control addSizePriceStock btn-danger mt-30">delete</a></div></div>';
						}
						for (const image of data.images) {
							$('#showImage').append('<div class="col-md-2 position-relative" id="showImagediv"><img src="'+image.image+'" class="img-rounded img-thumbnail" alt="Cinque Terre" width="100%" height="236"><div class="form-group"><label>vị trí</label><input type="number" name="sort[]" class="form-control" value="'+image.sort+'"><input type="hidden" name="image_id[]" value="'+image.id+'"></div><button type="button" onclick="deleteImage(event,'+image.id+')" class="btn btn-danger text-white position-absolute " style="left:70%;top:0" >x</button></div>');
							// console.log(image.image);
						}
						$('#getsizeup').append(listup);
						console.log(data.product);
						console.log(data.images);
					}
		})
			console.log(rowproduct);
			console.log(id);
}
		


$(".js-example-placeholder-multiple").select2({
	placeholder: "search"
});
//rest form add new product
function productFormRest(){
	$('#titleProduct').html('New Product');
	$('#showImage').empty();
	$('#getsize').empty();
	$('#getsizeup').empty();
	$('#product_id').empty();
	$('#name').attr("value","");
	$('#source').attr("value","");
	$('#date').attr("value","");
	$('#rowid').attr('value',"");
	$('#ModalProduct form')[0].reset();
}
//delete product		
function tabledeleteProduct(r,id) {
	var i = r.parentNode.parentNode.rowIndex;
	console.log(i);
	console.log(id);
	let alertDeleteProduct = confirm("Are you sure you want to delete!");
	if (alertDeleteProduct == true) {
		$.ajax({
				url:"{{route('delete.product')}}",
				method:"post",
				data:{_token:CSRF_TOKEN,id:id},
				success:function(data){
							// console.log(data.product);
					document.getElementById("myTable").deleteRow(i);
					
		    }
	    })

	}  
}
function tableGetSize(r,id){
	let row_i = r.parentNode.parentNode.rowIndex;

	$('.title-size').html('Update size');
	$('#row_id_size').attr('value',row_i);
	$.ajax({
         url:"{{route('get.size')}}",
         method:"get",
         data:{id:id},
        success:function(data){
                   
             $('.newSize').attr("value",data.size.size);
             $('.id_size_hidden').append('<input class="Size_id" type="hidden" name="id" value="'+data.size.id+'">');

         }
     })
	console.log(row_i);
	console.log(id);
}
//save size and update size
$(document).ready(function(){		
	//add size		
	$('#submitSize').on('submit', function(event){
            event.preventDefault();
            let row_id_size = $('#row_id_size').val();
            let name_size =$('#name_size').val();
            if (name_size=="") {
            	$('.errorsSize').html("vui lòng nhập!");
            } else {
            	$('.errorsSize').css("display","none");
            }
            let table = document.getElementById("TableSize");
                $.ajax({

                url: '{{ route('save.size')}}',
                method:"post",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },

                success: function (data) { 
                	// console.log(data.addsize);
                	if (row_id_size=="") {
                	  $('select').append('<option value="'+data.size.id+'" > '+data.size.size+'</option>');
                      console.log('<option value="'+data.size.id+'" > '+data.size.size+'</option>');
                      
                      var row = table.insertRow(1);
                      var cell1 = row.insertCell(0);
                      var cell2 = row.insertCell(1);
                      var cell3 = row.insertCell(2);
                      var cell4 = row.insertCell(3);
                      cell1.innerHTML = data.size.id;
                      cell2.innerHTML = data.size.size;
                      cell3.innerHTML ='<a class="btn btn-danger" onclick="tabledeleteSize(this,'+data.size.id+')">delete</a>';
                      cell4.innerHTML ='<a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary" onclick="tableGetSize(this,'+data.size.id+')">Update</a>';
                	} else {
                		const cells = table.rows[row_id_size].cells;
						       cells[0].innerHTML = data.size.id;
			                   cells[1].innerHTML = data.size.size;
			                   cells[2].innerHTML = '<a class="btn btn-danger" onclick="tabledeleteSize(this,'+data.size.id+')">delete</a>';
			                   cells[3].innerHTML ='<a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary" onclick="tableGetSize(this,'+data.size.id+')">Update</a>';
			                   
                	}
                    
                    // $('#TableSize').append('<tr><th scope="row">'+data.addsize.id+'</th><td>'+data.addsize.size+'</td><td><a class="btn btn-danger" onclick="tabledeleteSize(this)">delete</a></td><td><a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary">Update</a></td></tr>');
                    $('#AddNewSize').modal('hide');
                    $('#submitSize').trigger("reset");
                    // $('.successSize').html('thêm thành công');
                    confirm('success');
                    
                }
            }); 
        
        });
    
 });

$('.restformsize').click(function(){
	$('.id_size_hidden').empty();
	$('.title-size').html('Add new size');
	$('#row_id_size').attr('value',"");
	$('#size').attr('value',"");
})
// table delete row size tabledeleteSize
function tabledeleteSize(r,id) {
	// console.log(r);
	let tableRow = r.parentNode.parentNode.rowIndex;
	let alertSize = confirm("Are you sure you want to delete!");
	$.ajax({
		url:"{{route('delete.size.table.row')}}",
		method:"post",
		data:{_token:CSRF_TOKEN,id:id},
		success:function(data){
			document.getElementById("TableSize").deleteRow(tableRow);
		}
	})
	console.log(tableRow);
	
		 
}
// search keyup product seclect 2		
$(document).ready(function(){
	$('.select2-search__field').on('keyup',function(){
		var search = $(this).val();
		$.ajax({
			url:"{{route('get.search')}}",
			method:"get",
			data:{search:search},
			success:function(data){
				console.log(data.products);
						// let listsearch ="";
				let showsearch = ``;
				for (const x of data.products) {
							showsearch +='<li role="alert" aria-live="assertive" class="select2-results__option select2-results__message">'+x.name+'</li>';
				}
						$('.select2-results__options').html(showsearch);
						
			}
		})
	})
});

//save add new product and update
$(document).ready(function(){
    $('#formnewproductsubmit').on('submit', function(event){
		        event.preventDefault();
		        if( $("#name_product").val() == "" ) {
	          	$('.errorName').html('vui long nhập!');
	            return false;
		        }else{
		        	$('.errorName').css('display','none');
		        }
		        if( $("#source").val() == "" ) {
		          	$('.errorsource').html('vui lòng nhập nguồn hàng!');
		            return false;
		        }else{
		        	$('.errorsource').css('display','none');
		        }
		        if( $("#data").val() == "" ) {
		          	$('.errortime_expired').html('vui lòng chọn thời gian hết hạn!');
		            return false;
		        }else{
		        	$('.errortime_expired').css('display','none');
		        }
		        let rowid = $('#rowid').val();
		            $.ajax({
		                url:"{{route('save.product')}}",
		                method:"POST",
		                data: new FormData(this),
		                contentType:false,
		                cache:false,
		                processData:false,
		                headers: {
		            'X-CSRF-TOKEN': "{{ csrf_token() }}"
		            },
		                success:function(data)
		                {
		                	
	                    	confirm("success!");
	                    	console.log("success");
	                    	let tableProduct = document.getElementById("myTable");
	                    	if (rowid =="") {
	                    		  const row = tableProduct.insertRow(1);
			                      const cell1 = row.insertCell(0);
			                      const cell2 = row.insertCell(1);
			                      const cell3 = row.insertCell(2);
			                      const cell4 = row.insertCell(3);
			                      const cell5 = row.insertCell(4);
			                      cell1.innerHTML = data.product.name;
			                      cell2.innerHTML = data.product.source;
			                      cell3.innerHTML = data.product.time_expired;
			                      cell4.innerHTML ='<a class="btn btn-danger" onclick="tabledeleteProduct(this,'+data.product.id+')">delete</a>';
			                      cell5.innerHTML ='<a data-toggle="modal" data-target="#ModalProduct" class="btn btn-primary" id="updateProduct" onclick="onclickupdate(this,'+data.product.id+')">Update</a>';

	                    	} else {
	                    		const cells = tableProduct.rows[rowid].cells;
								
								  cells[0].innerHTML = data.product.name;
			                      cells[1].innerHTML = data.product.source;
			                      cells[2].innerHTML = data.product.time_expired;
			                      cells[3].innerHTML ='<a class="btn btn-danger" onclick="tabledeleteProduct(this,'+data.product.id+')">delete</a>';
			                      cells[4].innerHTML ='<a data-toggle="modal" data-target="#ModalProduct" class="btn btn-primary" id="updateProduct" onclick="onclickupdate(this,'+data.product.id+')">Update</a>';
			                     
			                      $('#ModalProduct').modal('hide');
	                    	}
		                      document.getElementById("formnewproductsubmit").reset();
		                     $('#formnewproductsubmit').trigger("reset");
		                      $('#ModalProduct').modal('hide');
		                      
		                     
		                    
			                  // console.log(data.product);
			                  // console.log(data.image);
		                    // $('#image').val('');
		                    // load_images();
		                }
		            });
		        
		    });
		 
		});  
// get size price stock append form
$(document).ready(function(){
			$('.addSizePriceStock').click(function(){
				$.ajax({
					url:"{{ route('get.size.all')}}",
					method: 'get',
					success: function(data){
						console.log(data.getsize);
						var list='<div class="row"><div class="col-md-3"><label>size</label><select class="form-control select2" style="width: 100%;" name="size_id[]" class="validatesize" id="validateSize"><option selected="selected" value="">-- chọn --</option>';
						for(const x of data.getsize){
							list +='<option value="'+x.id+'" > '+x.size+'</option>'
						}
						list +='</select></div><div class="col-md-5"><label>giá</label><input type="number" name="price[]" class="form-control"></div><div class="col-md-2"><label>số lượng</label><input type="number" name="stock[]" class="form-control"></div><a style="width:75px;" onclick="deletesizeMiddle(event)" class="form-control addSizePriceStock btn-danger mt-30">delete</a></div></div>';
						$('#getsize').append(list);
						console.log(list);
					}
				});
			});
});
// change load image input
$(document).ready(function(){
    	var img = document.querySelector('input[type="file"]');

    	img.onchange = function(){
    		$('#shownewImage').empty();
    		var file = this.files[0];

    		if(file == undefined){
    			$('#showImage').append('<img src="{{asset("img/default.jpg")}}" width="20%">');
    		}else{
    			$('.img').css('display','none');
    			const arrayImage =document.getElementsByClassName('image');
    			const listImage =arrayImage[0].files;
    			// console.log(listImage);
    			for (var i = 0; i < listImage.length; i++) {
    				const image =listImage[i];
    				const test = new FileReader();

    				test.readAsDataURL(image);
    				test.onload = function () {		    		
    					$('#shownewImage').append('<div class="col-md-2" id="showImagediv"><img src="'+test.result+'" class="img-rounded img-thumbnail" alt="Cinque Terre" width="100%" height="236"><div class="form-group"><label>vị trí</label><input type="number" name="sort[]" class="form-control"></div></div>');
    				};
    			}
    		}
    	}
    });


 // delete image
function deleteImage(event,id){
	let alertdelete = confirm("Are you sure you want to delete!");
	if (alertdelete == true) {
		$.ajax({
			url:"{{route('delete.image')}}",
			method:"get",
			data:{id:id},
			success:function(data){	
				event.target.parentElement.remove();
			}
		})

	}
	
}    
// delete size price stock
function xoa(event,id){
    let alertdelete = confirm("Are you sure you want to delete!");
	if (alertdelete == true) {
		$.ajax({
			url:"{{route('delete.size.price.stock')}}",
			method:"get",
			data:{id:id},
			success:function(data){	
				event.target.parentElement.remove();
			}
		})

	}
}
//delete size
function deletesizeMiddle(event){
	
  event.target.parentElement.remove();
	
}   

</script>