

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


		// $('#addsize').click(function(){
		// 	$('.size').append('<input type="text" class="sizename" ><button id="saveSize">Save Size</button>');
		// });

		window.onload = function (){
			$('#example1_filter').html('<label>Search:<input type="search" id="searh_product" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>');
		}

// search keyup product seclect 2		
$(document).ready(function(){
	$('#searh_product').on('keyup',function(){
		var search = $(this).val();
		console.log(search);
		$.ajax({
			url:"search-product",
			method:"get",
			data:{search:search},
			success:function(data){
				// console.log(data.products);
						// let listsearch ="";
						let showsearch = ``;
						for (const x of data.products) {
							showsearch +=`<tr><td>`+x.id+`</td>
											<td>`+x.name+`</td>
											<td>`+x.source+`</td>
											<td>`+x.time_expired+`</td>
											<td><a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" 
											id="updateProduct" onclick="onclickupdate(this,`+x.id+`)">
											<i class="fa fa-edit text-primary"></i>Edit</a></td>
											<td><a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,`+x.id+`)">
											<i class="fas fa-trash-alt text-danger"></i>delete</a> 
											</td>
										</tr>`;
						}
						$('#search_Show').html(showsearch);
						
					}
				})
	})
});
//onchange <select> <option> color
$(document).ready(function() {
	let showcolor = document.getElementById('color_id');
	// $('#color_id').click(function(){
	// 	console.log('dsad')
	
	// })
	// showcolor.addEventListener('onchange', function(){
	// 	$.ajax({
	// 		url:"get-size-all",
	// 		method: 'get',
	// 		success: function(data){
	// 			// console.log(data.getsize);

	// 			const list=`<option selected="selected" value="">-- chọn --</option>`;
	// 			for(const x of data.getColors){
	// 				list +='<option value="'+x.id+'" > '+x.name+'</option>'
	// 			}
				
	// 			// for(const x of data.getsize){
	// 			// 	list +='<option value="'+x.id+'" > '+x.size+'</option>'
	// 			// }

				
	// 			showcolor.innerHTML=list;
	// 			// console.log(list);
	// 		}
	// 	});
		
		
	// })	
});
//rest form add new product
function productFormRest(){
	$('#titleProduct').html('New Product');
	$('#showImage').empty();
	$('#getsize').empty();
	$('#getsizeup').empty();
	$('#product_id').empty();
	$('#name_product').attr("value","");
	$('#source').attr("value","");
	$('#date').attr("value","");
	$('#rowid').attr('value',"");
	$('#ModalProduct form')[0].reset();
		$.ajax({
			url:"get-size-all",
			method: 'get',
			success: function(data){
				// console.log(data.getColors);

				let listColor=`<option selected="selected" value="">-- chọn --</option>`;
				for(const x of data.getColors){
					listColor +='<option value="'+x.id+'" > '+x.name+'</option>';
					// console.log(x.name)
				}
				let listSize=`<option selected="selected" value="">-- chọn --</option>`;
				for(const x of data.getsize){
					listSize +='<option value="'+x.id+'" > '+x.size+'</option>'
				}

				
				$('#color_id').html(listColor);
				$('#size_id').html(listSize);
				// console.log(list);
			}
		});
}
//delete product		
function tabledeleteProduct(r,id) {
	var i = r.parentNode.parentNode.rowIndex;
	console.log(i);
	console.log(id);
	let alertDeleteProduct = confirm("Are you sure you want to delete!");
	if (alertDeleteProduct == true) {
		$.ajax({
			url:"delete-product",
			method:"post",
			data:{_token:CSRF_TOKEN,id:id},
			success:function(data){
							// console.log(data.product);
							document.getElementById("example1").deleteRow(i);

						}
					})

	}  
}


$('.restformsize').click(function(){
	$('.id_size_hidden').empty();
	$('.title-size').html('Add new size');
	$('#row_id_size').attr('value',"");
	$('#name_size').attr('value',"");
})



//save add new product and update

// get size price stock append form
$(document).ready(function(){
	$('.addSizePriceStock').click(function(){
		$.ajax({
			url:"get-size-all",
			method: 'get',
			success: function(data){
				// console.log(data.getsize);
				let list=`<div class="row"><div class="col-md-2">
				<label>color</label>
				<select class="form-control" name="color_id[]" id="color_id" class="validatecolor"  style="width: 100%;">
				<option selected="selected" value="">-- chọn --</option>`;
				for(const x of data.getColors){
					list +='<option value="'+x.id+'" > '+x.name+'</option>'
				}
				list+=`</select>
				</div>
				<div class="col-md-2">
				<label>size</label>
				<select class="form-control" name="size_id[]" class="validatesize" id="size_id"  style="width: 100%;">
				<option value="">-- chọn --</option>`;
				for(const x of data.getsize){
					list +='<option value="'+x.id+'" > '+x.size+'</option>'
				}

				list +='</select></div><div class="col-md-3"><label>giá</label><input type="number" name="price[]" class="form-control"></div><div class="col-md-2"><label>số lượng</label><input type="number" name="stock[]" class="form-control"></div><a style="width:75px; margin-top:31px" onclick="deletesizeMiddle(event)" class="form-control addSizePriceStock btn-danger">delete</a></div></div>';
				$('#getsize').append(list);
				// console.log(list);
			}
		});
	});
});

// change load image input

$(document).ready(function(){
	let img = document.querySelector('input[type="file"]');

	img.onchange = function(){
    		// console.log('đasads');
    		// $('#showImage').empty();
    		let file = this.files[0];
    		$('.img').css('display','none');
    		let arrayImage =document.getElementsByClassName('image');
    		let listImage =arrayImage[1].files;
    		let maxSize = 1024 * 1024*2;
    		for(const x of listImage){
    			let test = new FileReader();
    			test.readAsDataURL(x);
    			test.onload = function () {	
    				if (x.size>maxSize) {
    					alert('có 1 file anh lớn hơn 2mb đã được loại bỏ vì file filesUpload không được lớn hơn 2 mb')
    				}else{
    					$('#showImage').append(`<div class="col-md-2" id="showImagediv">
    						<img src="`+test.result+`" class="img-rounded img-thumbnail" alt="Cinque Terre" width="100%" height="236"
    						>
    						<div class="form-group"><label>vị trí</label><input type="number" name="sort[]" class="form-control">
    						<input type="hidden" name="file[]" id="filesUpload" value="`+test.result+`">
    						</div>
    						<button type="button" onclick="deleteImage(event)" class="btn btn-danger text-white position-absolute " style="top:0;font-size:10px" >x</button>
    						</div>`);
    				}

    			}

    		}

    		
    	}
    });
$(document).ready(function(){
	$('#formnewproductsubmit').on('submit', function(event){
		event.preventDefault();

		let date=$("input[type=date]").val();
		let fileimage =document.getElementsByClassName('image');
		let maxSize = 1024 * 1024*2;
		let regex_image="/\.(jpeg|jpg|png|gif|bmp)$/i";
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
		if( date == "" ) {
			$('.errortime_expired').html('vui lòng chọn thời gian hết hạn!');
			return false;
		}else{
			$('.errortime_expired').css('display','none');
		}
		if (fileimage!=="") {
			let arrayFiles=fileimage[1].files;
			for(const image of arrayFiles){
		        		// if (image.size>maxSize) {
		        		// 	$('.error_image').html('ko được co file image có dung lượng vượt quá 2M!');
		        		// 	return false;
		        		// }
		        		// let filename ="image/name.jpg";
		        		if (/\.(jpe?g|png|gif|bmp)$/i.test(image.name)==false) {
		        			$('.error_image').css('display','block');
		        			$('.error_image').html('Error định dạng image!');
		        			return false;
		        		}
		        		
		        	}

		        }
		        $('.error_image').css('display','none');

		        let rowid = $('#rowid').val();
		        $.ajax({
		        	url:"add-and-update",
		        	type:"POST",
		        	data: new FormData(this),
		        	contentType:false,
		        	cache:false,
		        	processData:false,
		        	success:function(data)
		        	{
		                	// console.log(data.data)
		                	// return false;
		                	// console.log(data.product);
		                	// return false;
		                	// return false;
		                	confirm("success!");
		                	console.log("success");
		                	let tableProduct = document.getElementById("example1");
		                	if (rowid =="") {
		                		const row = tableProduct.insertRow(1);
		                		const cell1 = row.insertCell(0);
		                		const cell2 = row.insertCell(1);
		                		const cell3 = row.insertCell(2);
		                		const cell4 = row.insertCell(3);
		                		const cell5 = row.insertCell(4);
		                		const cell6 = row.insertCell(5);
		                		cell1.innerHTML = data.product.id;
		                		cell2.innerHTML = data.product.name;
		                		cell3.innerHTML = data.product.source;
		                		cell4.innerHTML = data.product.time_expired;
		                		cell5.innerHTML ='<a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" id="updateProduct" onclick="onclickupdate(this,'+data.product.id+')"><i class="fa fa-edit text-primary"></i>Edit</a>';
		                		cell6.innerHTML ='<a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,'+data.product.id+')"><i class="fas fa-trash-alt text-danger"></i>delete</a>';

		                	} else {
		                		const cells = tableProduct.rows[rowid].cells;
		                		cells[0].innerHTML = data.product.id;
		                		cells[1].innerHTML = data.product.name;
		                		cells[2].innerHTML = data.product.source;
		                		cells[3].innerHTML = data.product.time_expired;
		                		cells[4].innerHTML ='<a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" id="updateProduct" onclick="onclickupdate(this,'+data.product.id+')"><i class="fa fa-edit text-primary"></i>Edit</a>';
		                		cells[5].innerHTML ='<a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,'+data.product.id+')"><i class="fas fa-trash-alt text-danger"></i>delete</a>';

		                		$('#ModalProduct').modal('hide');
		                	}
		                	document.getElementById("formnewproductsubmit").reset();
		                	$('#formnewproductsubmit').trigger("reset");
		                	$('#ModalProduct').modal('hide');



			                 // /


			             }
			         });
		        
		    });

});  

// get product show form modal product

function onclickupdate(r,id){
	let rowproduct = r.parentNode.parentNode.rowIndex;
	$('#titleProduct').html('Update product');
	$('#showImage').empty();
	$('#shownewImage').empty();

	$('#getsize').empty();

	$('#getsizeup').empty();
				// console.log(firebase.auth());
				
				$.ajax({
					url:"get-ajax-product",
					method:"get",
					data:{id:id},
					success:function(data){

						$('#name_product').attr("value",data.product.name);
						$('#source').attr("value",data.product.source);
						$('#date').attr("value",data.product.time_expired);
						$('#rowid').attr('value',rowproduct);
						$('#product_id').append('<input type="hidden" name="id" value="'+data.product.id+'">');
						let listup='';
						for (const x of data.productColors) {
							listup +=`<div class="row">
							<div class="col-md-2">
							<label>size</label>
							<select class="form-control select2" style="width: 100%;" name="color_id[]" class="validatesize" id="validateSize">
							<option value="">-- chọn --</option>`;
							for (const color of data.colors) {
								if (color.id==x.color_id) {
									listup +='<option value="'+color.id+'" selected> '+color.name+'</option>';
								}else{
									listup +='<option value="'+color.id+'"> '+color.name+'</option>';
								}
								
							}
							listup+='</select></div>';
						// }
						// for (const x of data.productSizes) {
							listup +=`<div class="col-md-2">
							<label>size</label>
							<select class="form-control select2" style="width: 100%;" name="size_id[]" class="validatesize" id="validateSize">
							<option value="">-- chọn --</option>`;
							for (const size of data.sizes) {
								if (size.id==x.size_id) {
									listup +='<option value="'+size.id+'" selected> '+size.size+'</option>';
								}else{
									listup +='<option value="'+size.id+'"> '+size.size+'</option>';
								}
								
							}
							listup+=`</select>
							</div>
							<div class="col-md-3">
							<label>giá</label>
							<input type="number" name="price[]" class="form-control" value="`+x.price+`">
							</div>
							<div class="col-md-2">
							<label>số lượng</label>
							<input type="number" name="stock[]" class="form-control" value="`+x.stock+`">
							<input type="hidden" name="middle_id[]" value="`+x.middle_id+`">
							</div><a style="width:75px; margin-top:31px" onclick="xoa(event,`+x.middle_id+`)" class="form-control addSizePriceStock btn-danger">delete</a>
							</div></div>`;
						}
						for (const image of data.images) {
							$('#showImage').append(`<div class="col-md-2 position-relative" id="showImagediv">
								<img src="`+image.image+`" class="img-rounded img-thumbnail" alt="Cinque Terre" width="100%" height="236">
								<div class="form-group"><label>vị trí</label>
								<input type="number" name="sort[]" class="form-control" value="`+image.sort+`">
								<input type="hidden" name="image_id[]" value="`+image.id+`"></div>
								<button type="button" onclick="deleteImage(event,`+image.id+`)" class="btn btn-danger text-white position-absolute " style="left:70%;top:0" >x</button>
								</div>`);
							// console.log(image.image);
						}
						$('#getsizeup').append(listup);
						let listColor=`<option selected="selected" value="">-- chọn --</option>`;
				for(const x of data.colors){
					listColor +='<option value="'+x.id+'" > '+x.name+'</option>';
					// console.log(x.name)
				}
				let listSize=`<option selected="selected" value="">-- chọn --</option>`;
				for(const x of data.sizes){
					listSize +='<option value="'+x.id+'" > '+x.size+'</option>'
				}

				
				$('#color_id').html(listColor);
				$('#size_id').html(listSize);
						// console.log(data.product);
						// console.log(data.images);
					}
				})
			// console.log(rowproduct);
			// console.log(id);
		}
		

 // delete image
 function deleteImage(event,id=null){
 	let alertdelete = confirm("Are you sure you want to delete!");
 	if (alertdelete == true) {
 		if (id==null) {
 			event.target.parentElement.remove();
 		} else {
 			$.ajax({
 				url:"delete-image",
 				method:"post",
 				data:{_token:CSRF_TOKEN, id:id},
 				success:function(data){	
 					event.target.parentElement.remove();
 				}
 			})
 		}


 	}

 }    
// delete size price stock
function xoa(event,id){
	let alertdelete = confirm("Are you sure you want to delete!");
	if (alertdelete == true) {
		$.ajax({
			url:"delete-size-price-stock",
			method:"post",
			data:{_token:CSRF_TOKEN, id:id},
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



// table delete row size tabledeleteSize
function tabledeleteSize(r,id) {
	// console.log(r);
	let tableRow = r.parentNode.parentNode.rowIndex;
	let alertSize = confirm("Are you sure you want to delete!");
	$.ajax({
		url:"delete-size-table-row",
		method:"post",
		data:{_token:CSRF_TOKEN,id:id},
		success:function(data){
			document.getElementById("TableSize").deleteRow(tableRow);
		}
	})
	// console.log(tableRow);
	

}

function tableGetSize(r,id){
	let row_i = r.parentNode.parentNode.rowIndex;

	$('.title-size').html('Update size');
	$('#row_id_size').attr('value',row_i);
	$.ajax({
		url:"get-size",
		method:"get",
		data:{id:id},
		success:function(data){

			$('.newSize').attr("value",data.size.size);
			$('.id_size_hidden').append('<input class="Size_id" type="hidden" name="id" value="'+data.size.id+'">');

		}
	})
	// console.log(row_i);
	// console.log(id);
}


// save size and update size
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

			url: 'save-size',
			method:"post",
			data: new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function (data) { 
                	// console.log(data.addsize);
                	if (row_id_size=="") {
                	  // $('#size_id').append('<option value="'+data.size.id+'" > '+data.size.size+'</option>');
                   //    console.log('<option value="'+data.size.id+'" > '+data.size.size+'</option>');

                   let row = table.insertRow(1);
                   let cell1 = row.insertCell(0);
                   let cell2 = row.insertCell(1);
                   let cell3 = row.insertCell(2);
                   let cell4 = row.insertCell(3);
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
// firebase.auth().onAuthStateChanged(function(user) {
//     let user = firebase.auth().currentUser;
//   if (user) {
//     // User is signed in.
//     // console.log(user)
//     user.providerData.forEach(function (profile) {
//        $('#Logout').html(profile.phoneNumber)
//         console.log("  phoneNumber: " + profile.phoneNumber);
//       });
//   } else {
//     console.log('no auth')
//     // No user is signed in.
//   }
// });