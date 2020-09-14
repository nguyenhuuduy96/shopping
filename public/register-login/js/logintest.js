$(document).ready(function(){
    $('#login-form').on('submit', function(event){
		        event.preventDefault();
		       let phone = document.getElementById('phone').value;
		       let password = document.getElementById('password').value;
		       let Regex_phone=/((92|86|96|97|98|32|33|34|35|36|37|38|39|89|90|93|70|79|77|76|78|88|91|94|83|84|85|81|82|56|58|99|59)+([0-9]{7})\b)/g;
		       if (phone =="") {
		       	$('.error_phone').html('vui long nhập phone!')
		       	return false;
		       }
		       if (Regex_phone.test(phone) ==false) {
		       	$('.error_phone').html('vui long nhập phone là số!')
		       	return false;
		       }
		       if (password == "") {
		       	$('.error_password').html('vui long nhập password!')
		       	return false;
		       }
		     
		            $.ajax({
		                url:"api/login",
		                method:"POST",
		                data: new FormData(this),
		                contentType:false,
		                cache:false,
		                processData:false,
		                success:function(data)
		                {
		                	
		                	console.log(data)
		                	if (data.error!=='') {
		                		return false;
		                	}
		                	
	                    	window.location ='../admin/dashboard';
	                    	
		                  
		                   
		                }
		            });
		        
		    });
		 
});   
