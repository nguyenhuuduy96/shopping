
<html lang="en">
<head>
  <title>Firebase Phone Number Auth</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
 



  <script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
  <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  
</head>
<body>

  
<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card">
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container">
            <p  class="brand_logo" alt="Logo" id="logo" style="line-height: 120px; size: 26px;color: white">Login</p>
          </div>
        </div>

        <div class="d-flex justify-content-center form_container">
          <form >
          {{--   @csrf --}}
             <span style="color: white" class="error"></span>
            <div class="input-group mb-3" id="phone">
              <div class="input-group-append" >
                <select class="input-group-text first_Phone" >
                  <option value="+84">+84</option>
                  <option value="+86">+86</option>
                  <option value="+1">+1</option>
                </select>
              
              </div>
              <input type="Number" id="phoneNumber" class="form-control input_user" value="" placeholder="phone register">
                          
              <div id="recaptcha-container"></div>
            </div>
        
            
            
            <div class="d-flex justify-content-center mt-3 login_container" id="verify">
            <button type="button" name="button" class="btn login_btn" id="sign-in-button" onclick="onSignInSubmit();">VERIFY</button>

           </div>
          </form>

        </div>
    <a href="{{route('user.register')}}" class="text-center text-white" >Register a new membership</a>
        
      </div>

    </div>
  </div>
<script src="{{asset('admin/loginFirebase.js')}}" ></script>
<script type="text/javascript">
 






// firebase.auth().signOut().then(function() {
//   // Sign-out successful.
//   console.log('Sign-out successful.');

// }).catch(function(error) {
//   // An error happened.
// });
// console.log(firebase.auth());




// firebase.auth().onAuthStateChanged(function(user) {
//     var user = firebase.auth().currentUser;
//   if (user) {
//     // User is signed in.
//     console.log(user)
//     user.providerData.forEach(function (profile) {
       
//         console.log("  phoneNumber: " + profile.phoneNumber);
//       });
//   } else {
//     console.log('s')
//     // No user is signed in.
//   }
// });
  </script>
</body>
</html>



