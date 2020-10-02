window.onload = function () {
	$('.text-danger').css('display','none');

}
$(document).ready(function() {
	$('#submitaddress').on('submit',function(){
		const name = $('#name').val();
		const phone = $('#phone').val();
		 var phone_regex =/((92|86|96|97|98|32|33|34|35|36|37|38|39|89|90|93|70|79|77|76|78|88|91|94|83|84|85|81|82|56|58|99|59)+([0-9]{7})\b)/g;
		const city = $('#city').val();
		const district = $('#district').val();
		const address = $('#address').val();
		console.log(name,phone)
		if (name=="") {
			$('.error_name').css('display','block');
			return false;
		} else {
			$('.error_name').css('display','none');
		}
		if (phone=="") {
			$('.error_phone').css('display','block');
			return false;
		} else  if(phone_regex.test(phone) ==false){
        $('.error_phone').css('display','block');
       
        $('.error_phone').html('vui lòng nhập phone đúng sdt số!');
        return false;
        }else {
			$('.error_phone').css('display','none');
		}
		
		if (city=="") {
			$('.error_city').css('display','block');
			return false;
		} else {
			$('.error_city').css('display','none');
		}
		if (district=="") {
			$('.error_district').css('display','block');
			return false;
		} else {
			$('.error_district').css('display','none');
		}
		if (address=="") {
			$('.error_address').css('display','block');
			return false;
		} else {
			$('.error_address').css('display','none');
		}
		$.ajax({
			url: '../payment',
			type: 'post',
			data: {_token:CSRF_TOKEN,name:name,phone:phone,city:city,district:district,address:address},
			success:function(data){
				console.log(data.bill_code);
				window.location = '../check-out-seccess/'+data.bill_code;
			}
		})
		// .done(function() {
		// 	console.log("success");
		// })
		// .fail(function() {
		// 	console.log("error");
		// })
		// .always(function() {
		// 	console.log("complete");
		// });
		
		
	})
});