var config = {
              apiKey: "AIzaSyC4RLKOGJ0CN0TsGna6te_8F3kNYRbeWb8",
              authDomain: "quanlysanpham-4b951.firebaseapp.com",
              databaseURL: "https://quanlysanpham-4b951.firebaseio.com",
              projectId: "quanlysanpham-4b951",
              storageBucket: "quanlysanpham-4b951.appspot.com",
              messagingSenderId: "312643055627",
              appId: "1:312643055627:web:73cde60cd3b50c2b98570e",
              measurementId: "G-6H5G8V9L5K"
            };
  firebase.initializeApp(config);
var ui = new firebaseui.auth.AuthUI(firebase.auth());

    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sign-in-button', {
      'size': 'invisible',
      'callback': function(response) {
        // reCAPTCHA solved, allow signInWithPhoneNumber.
        // onSignInSubmit();
      }
    });

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

var appVerifier = window.recaptchaVerifier;
// window.onload = function(){
//   appVerifier;
// }

function onSignInSubmit(){
      var phone = $('#phoneNumber').val();
      var phone_regex =/((92|86|96|97|98|32|33|34|35|36|37|38|39|89|90|93|70|79|77|76|78|88|91|94|83|84|85|81|82|56|58|99|59)+([0-9]{7})\b)/g;
      var phoneNumber =$('.first_Phone').val() + phone;
      if ( phone == "") {
        $('.error').html('vui lòng nhập');
        return false;
      }else if(phone_regex.test(phone) ==false){
         $('.error').css('display','block');
         $('.error').html('vui lòng nhập phone đúng sdt số!');
         // console.log('loi');
         return false;
      } else {
        $('.error').css('display','none');
      }
      $.ajax({
        url:"user-auth/check-phone",
        method:"post",
        data:{_token:CSRF_TOKEN,phone:phoneNumber},
        success:function(data){
          if (data.phone =='') {
             
              console.log(phoneNumber);
              console.log(appVerifier);
              // 
              firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                  .then(function (confirmationResult) {
                    
                    window.confirmationResult = confirmationResult;
                    $('#phone').empty();
                    $('#phone').html(`<span style="color: red" class="error"></span>
                      <div class="input-group-append"><span class="input-group-text">
                      <i class="fas fa-user"></i></span>
                      </div>
                      <input type="Number" id="code" class="form-control input_user" value="" placeholder="code">
                      <input type="hidden" id="phoneNumber" class="form-control input_user" value="`+phoneNumber+`" placeholder="code">`);
                    $('#verify').empty();
                    $('#logo').html('Login');
                    $('#verify').html('<button type="button" name="button" class="btn login_btn" onclick="Submit()" >Login</button>')
                  }).catch(function (error) {
                   
              });
             console.log('ko')
          }else{
            // console.log(data.phone);
            $('.error').css('display','block');
            $('.error').html(data.phone);
            console.log(data.phone);
            return false;
           
          }
        }

      });

      
      
}
    
function Submit(){
            var code = $('#code').val();
            var phoneNumber = $('#phoneNumber').val();
           if (code =="") {
            $('.error').html('vui lòng nhập');
                    return false;
            } else {
                    $('.error').css('display','none');
            }
            confirmationResult.confirm(code).then(function (result) {
              // User signed in successfully.
              var user = result.user;
              let phonefirst= user.phoneNumber;

              // console.log(user.phoneNumber);
              // let lastphone = phonefirst.replace('+84','');
              $.ajax({
                url:'user-auth/active-login',
                method:'post',
                data:{_token:CSRF_TOKEN,phone:phoneNumber},
                success:function(data){
                  confirm('login success!');
                  // console.log(data.user);
                  window.location ='/';
                }
              })
             
              // window.location ='/admin-product/list';

     
              // console.log('successfully');
              // ...
            }).catch(function (error) {
              // User couldn't sign in (bad verification code?)
              // ...
              alert(error)
            });
            
}   



 firebase.auth().onAuthStateChanged(function(user) {
                  var user = firebase.auth().currentUser;
                if (user) {
                  // User is signed in.
                 
                  user.providerData.forEach(function (profile) {
                     // AuthPhone+=profile.phoneNumber;
                     $('#Logout').html('<li class="nav-item"><a class="nav-link">'+profile.phoneNumber+'</a></li><li class="nav-item"><a class="nav-link btn btn-primary text-white"  onclick="singOut()" >Logout</a></li>');
                      console.log("  phoneNumber: " + profile.phoneNumber);
                    });
                } else {
                  console.log('no Login')
                  // No user is signed in.
                }
});


function singOut(){
  firebase.auth().signOut().then(function() {
  // Sign-out successful.
    console.log('Sign-out successful.');
    window.location ='/login-firebase';
  }).catch(function(error) {
    // An error happened.
    alert(error)
  });
}

            