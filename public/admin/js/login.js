


$(document).ready(function () {
  // body...
  $('#postLogin').on('submit',function(event){
    event.preventDefault();
    var email_regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  
    let email = $("#email").val();
    let pass = $("#pass").val();
  
  
    
    if( email == "" ) {
        $('#error_email').html('vui lòng nhập email!');
        return false;
    }else if(email_regex.test(email) ==false){
        $('#error_email').html('vui lòng nhập email dung dinh dang!');
        return false;
    }else {
        $('#error_email').css('display','none');
    }
    if( pass == "" ) {
        $('#error_pass').html('vui lòng nhập pass !');
        return false;
    }else{
        $('#error_pass').css('display','none');
    }
    
     $.ajax({
        url:"post-login",
        method:"post",
        data: new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
     
        success:function(data)
        {
          // console.log(data.error);
          if (data.error =='') {
            // $('#error').css('display','none');
            confirm("login success !");
            window.location ='../login-firebase';
            
          } else {
          $('#error').css('display','block');
          $('#error').html(data.error);
          }
          
          // location.reload();
        }
    });
            
  });
})