function newform(){
	document.getElementById("SubmitFormCategory").reset();
	document.getElementsByClassName('title-cate').innerHTML="New category product";
	document.getElementById('row_id_cate').value='';
	document.getElementById('id').value='';
	$.ajax({
		url:'../../api/category-product/list',
		type:'get',
		success:function(data){
			console.log(data)
			let list = '<option value="">- chon -</option>';
			for(const x of data){
				list+='<option value="'+x.id+'" > '+x.name+'</option>'
				// console.log(x.id)
				// return false;
			}
			document.getElementById('allsize').innerHTML=list;
		}
	})
}
function update(r,id){
	let rowid = r.parentNode.parentNode.rowIndex;
	$.ajax({
		url:'../../api/category-product/'+id,
		type:'get',
		success:function(data){
			console.log(data)
			document.getElementsByClassName('title-cate').innerHTML="Update category product";
			document.getElementById('row_id_cate').value=rowid;
			document.getElementById('id').value=id;
			document.getElementById('name').value=data.data.name;
			let parent_id = data.data.parent  == null ? 'null':data.data.parent.id ;
			console.log(parent_id);
			$.ajax({
				url:'./get-cate-null-parent',
				type:'get',
				success:function(data){
					// console.log(data)
					let list = '<option value="">- chon -</option>';
					for(const x of data.data){
						const id = x.parent !=null ? x.parent.id :'';
						if (x.id == parent_id) {
							list+='<option value="'+x.id+'" selected> '+x.name+'</option>'
						}else{
							list+='<option value="'+x.id+'"> '+x.name+'</option>'
						}
						
				// console.log(x.id)
				// return false;
			}
			document.getElementById('allsize').innerHTML=list;
		}

	})
		}
	})
}
$(document).ready(function () {
	// body...
	let submit = document.getElementById('SubmitFormCategory');
	let tableCategoryProduct = document.getElementById('tableCategoryProduct');
	submit.addEventListener('submit', function(e) {
		let name = document.getElementById('name').value;
		let rowid = document.getElementById('row_id_cate').value;
		
		if (name=='') {
			console.log('sadasd')
			document.getElementById('error').innerHTML="error name";
			return false;
		}else{
			document.getElementById('error').style.display='none';
		}
		console.log(name)
		// return false;
		$.ajax({
			url:'../../api/category-product/save',
			type:'post',
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success:function(data){
				console.log(data)
				// return false;
				if (rowid =="") {
					const row = tableCategoryProduct.insertRow(1);
					const cell1 = row.insertCell(0);
					const cell2 = row.insertCell(1);
					const cell3 = row.insertCell(2);
					const cell4 = row.insertCell(3);
					cell1.innerHTML = data.data.id;
					cell2.innerHTML = data.data.name;
					cell3.innerHTML = data.data.parent == null ? 'null': data.data.parent.name;
					cell4.innerHTML =`<a class="btn btn-primary" data-toggle="modal" data-target="#modalcategory" onclick="update(this,`+data.data.id+`)">update</a>
					<a class="btn btn-danger" onclick="DeleteCategory(this,`+data.data.id+`)">delete</a>`;
					
				} else {
					const cells = tableCategoryProduct.rows[rowid].cells;
					cells[0].innerHTML = data.data.id;
					cells[1].innerHTML = data.data.name;
					cells[2].innerHTML = data.data.parent == null ? 'null':data.data.parent.name;
					cells[3].innerHTML = `<a class="btn btn-primary" data-toggle="modal" data-target="#modalcategory" onclick="update(this,`+data.data.id+`)">update</a>
					<a class="btn btn-danger" onclick="DeleteCategory(this,`+data.data.id+`)">delete</a>`;				
				}
				$('#modalcategory').modal('hide');
			}
		})
	});
})
function DeleteCategory(r,id){
	let rowid = r.parentNode.parentNode.rowIndex;
	$.ajax({
		url:'../../api/category-product/'+id,
		type:'delete',
		success:function(data){
			document.getElementById("tableCategoryProduct").deleteRow(rowid);
		}

	})
}