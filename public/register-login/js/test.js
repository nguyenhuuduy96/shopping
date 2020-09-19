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
    function verify(){
            let phone = $('#phone').val();
            var phone_regex =/((92|86|96|97|98|32|33|34|35|36|37|38|39|89|90|93|70|79|77|76|78|88|91|94|83|84|85|81|82|56|58|99|59)+([0-9]{7})\b)/g;
            var phoneNumber ='+84' + phone;
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
                url:"check-phone",
                method:"post",
                data:{_token:CSRF_TOKEN,phone:phone},
                success:function(data){
                  // console.log(data.user)
                  if (data.phone =='') {
                     
                      // console.log(phoneNumber);
                      // console.log(appVerifier);
                      // 
                      firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                          .then(function (confirmationResult) {
                            
                            window.confirmationResult = confirmationResult;
                             $('#emptyForm').empty();
                             $('.title').html(phone);
                             $('#emptyForm').append(`<label for="your_code"><i class="zmdi zmdi-code material-icons-name"></i></label>
                                <input type="hidden" name='phone' id="phone" value="`+phone+`"/>
                                <input type="text" name="code" id="code" placeholder="code"/>
                                <span class="error"></span>`);
                            $('#verify').html(`<button onclick="login()" class="btn btn-primary" id="sign-in-button">log in</button>`)
                          }).catch(function (error) {
                           
                      });
                     
                  }else{
                    // console.log(data.phone);
                    $('.error').css('display','block');
                    $('.error').html(data.phone);
                    console.log(data.phone);
                    return false;
                   
                  }
                }

              });
            console.log('gj,hjk')
            // return false;
        
    }
    function login(){
          var code = $('#code').val();
            var phoneNumber = $('#phone').val();
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
                url:'post-login',
                method:'post',
                data:{_token:CSRF_TOKEN,phone:phoneNumber},
                success:function(data){
                  // confirm('login success!');
                   firebase.auth().signOut().then(function() {
                  // Sign-out successful.
                    console.log('Sign-out successful.');
                    
                  }).catch(function(error) {
                    // An error happened.
                    alert(error)
                  });
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