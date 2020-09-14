
$(document).ready(function () {
  // body...
  $('#register-form').on('submit',function(event){
    event.preventDefault();
    // console.log('adsakjldka')
    // return false;
    var email_regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var phone_regex =/((92|86|96|97|98|32|33|34|35|36|37|38|39|89|90|93|70|79|77|76|78|88|91|94|83|84|85|81|82|56|58|99|59)+([0-9]{7})\b)/g;
    let name = $("#name").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    let pass = $("#pass").val();
    let RetypePass = $('#re_pass').val();
 
    if( name == "" ) {
      $('.error_name').css('display','block');
      $('.error_name').html('vui long nhập!');
      return false;
    }else{
      $('.error_name').css('display','none');
    }
    if( email == "" ) {
        $('.error_email').css('display','block');
        $('.error_email').html('vui lòng nhập email!');
        return false;
    }else if(email_regex.test(email) ==false){
        $('.error_email').css('display','block');
        $('.error_email').html('vui lòng nhập email dung dinh dang!');
        return false;
    }else {
        $('.error_email').css('display','none');
    }
    if( phone == "" ) {
        $('.error_phone').css('display','block');
        $('.error_phone').html('vui lòng nhập phone!');
        return false;
    }else if(phone_regex.test(phone) ==false){
        $('.error_phone').css('display','block');
        console.log('errors')
        $('.error_phone').html('vui lòng nhập phone đúng sdt số!');
        return false;
    }else {
        $('.error_phone').css('display','none');
    }
    if( pass == "" ) {
        $('.error_pass').css('display','block');
        $('.error_pass').html('vui lòng nhập pass !');
        return false;
    }else{
        $('.error_pass').css('display','none');
    }
  
    if(RetypePass ==""){
      $('.error_repass').css('display','block');
      $('.error_repass').html('vui lòng nhập pass word!');
       return false;
    }else if(RetypePass!==pass){
      $('.error_repass').css('display','block');
      $('.error_repass').html('error_RetypePass nhap ko khop!');
       return false;
    }else{
      $('.error_repass').css('display','none');
    }
 
     $.ajax({
        url:"save-register",
        method:"post",
        data: new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
       
        success:function(data)
        {
          if (data.email !=='') {
            console.log(data.email);
            $('.error_email').css('display','block');
            $('.error_email').html(data.email);     
          } else if(data.phone !=='') {
            $('.error_email').css('display','none');
            $('.error_phone').css('display','block');
            $('.error_phone').html(data.phone);
          }else {
            $('.error_email').css('display','none');
            $('.error_email').css('display','none');
            // console.log(data.email)
            // return false;
            confirm("register success !");
            window.location ='login';
          }
          
          // location.reload();
        }
    });
            
  });
})