<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('register-login/fonts/material-icon/css/material-design-iconic-font.min.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.css" />
    <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('register-login/css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{asset('register-login/images/signin-image.jpg')}}" alt="sing up image"></figure>
                        <a href="{{route('register')}}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <p class="title" style="display: none">phone Number</p>
                        <form class="register-form" id="login-form" action="javascript:void(0)" style="display: none">
                            <div class="form-group" id="emptyForm">
                                <label for="your_name"><i class="zmdi zmdi-phone material-icons-name"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Phone register"/>
                                <span class="error"></span>
                            </div>
                            <div id="recaptcha-container"></div>
                            <div class="form-group form-button" id="verify">
                                <!-- <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/> -->
                                <button onclick="verify()" class="btn btn-primary" id="sign-in-button">sendSMS</button>
                            </div>
                        </form>
                        <form method="POST" action="javascript:void(0)" class="register-form" id="login">
                            <div class="form-group">
                                <label for="phone_login"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="phone_login" id="phone_login" placeholder="phone number"/>
                                <span class="error_phone text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>
                                <span class="error_password text-danger"></span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" value="1"/>
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                                <p class="error_login text-danger"></p>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <a href="javascript:void(0)" class="btn btn-primary login-sms-block" onclick="clickSMS()">Login SMS</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      

    </div>

    <!-- JS -->
    
    <script src="{{asset('register-login/js/main.js')}}"></script>
    <script src="{{asset('register-login/js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('register-login/js/test.js')}}"></script>
    
    
   
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>