
	function DeleteShopingCart(r,id){
		const rowId = r.parentNode.parentNode.rowIndex;
		const table = document.getElementById('table');
		// console.log(rowId)
		// table.deleteRow(rowId)
		$.ajax({
			url:'../cart/delete',
			type:'post',
			data:{_token:CSRF_TOKEN,id:id},
			success:function(data){
				table.deleteRow(rowId)
				const subtotla = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.subtotla);
				$('.subtotla').html(subtotla);
			}
		})
	}
	function clickpre(r,id,max){
		const i = r.parentNode.parentNode.parentNode.rowIndex;
    	const table = document.getElementById('table');
    	console.log(max)
    	let number = document.getElementsByClassName('num-product')[i-1].value;
    	let qty=parseInt(number);
    	if (number>1) {
    		qty -= 1;
    	}
    	$.ajax({
    		url:'../cart/update',
    		type:'post',
    		data:{_token:CSRF_TOKEN,id:id,qty:qty},
    		success:function(data){
    			console.log(data.subtotla)
    			const qtyNumber = data.cart.price*data.cart.quantity;
    			// console.log(qtyNumber,data.cart.price,data.cart.quantity)
    			const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(qtyNumber);
    			const cells = table.rows[i].cells;
    			const subtotla = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.subtotla);
    			cells[6].innerHTML = price;
    			document.getElementsByClassName('num-product')[i-1].value = qty;
    			$('.subtotla').html(subtotla)
    		}
    	})
	}
    function clicknext(r,id,max){
    	let i = r.parentNode.parentNode.parentNode.rowIndex;
    	// const max = $(this).attr('id');
    	const table = document.getElementById('table');
    	let number = document.getElementsByClassName('num-product')[i-1].value;
    	let qty=parseInt(number);
    	if (number<max) {
    		qty += 1;
    	}
    	$.ajax({
    		url:'../cart/update',
    		type:'post',
    		data:{_token:CSRF_TOKEN,id:id,qty:qty},
    		success:function(data){
    			// console.log(data.subtotla)
    			const qtyNumber = data.cart.price*data.cart.quantity;
    			// console.log(qtyNumber,data.cart.price,data.cart.quantity)
    			const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(qtyNumber);
    			const subtotla = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.subtotla);
    			const cells = table.rows[i].cells;
    			cells[6].innerHTML = price;
    			document.getElementsByClassName('num-product')[i-1].value = qty;
    			$('.subtotla').html(subtotla)
    		}
    	})
    	
    	console.log(i)
    }
    $('.continue').click(function(event) {
    	window.location = '../cart/checkout';
    });