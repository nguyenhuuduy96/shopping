var phone_regex = /(03|07|08|09|01[2|6|8|9])+([0-9]{8})\b/;

// block login-sms-block
function clickSMS() {
    $('#login-form').css('display', 'block');
    $('.title').css('display', 'block');
    $('#login').css('display', 'none');
    const login = `<a href="javascript:void(0)" class="btn btn-primary login-sms-block" onclick="clickPhone()">Login phone</a>`;
    $('.socials').html(login);
}

function clickPhone() {
    $('#login-form').css('display', 'none');
    $('.title').css('display', 'none');
    $('#login').css('display', 'Block');
    const login = `<a href="javascript:void(0)" class="btn btn-primary login-sms-block" onclick="clickSMS()">Login SMS</a>`;
    $('.socials').html(login);
}
// login
$(document).ready(function() {
    let login = document.getElementById('login');
    login.addEventListener('submit', function() {
        let phone = document.getElementById('phone_login').value;
        let password = document.getElementById('your_pass').value;
        let remember = document.getElementById('remember-me').value;
        // console.log(phone, password)
        if (phone == "") {
            $('.error_phone').html('vui lòng nhập');
            return false;
        } else if (phone_regex.test(phone) == false) {
            $('.error_phone').css('display', 'block');
            $('.error_phone').html('vui lòng nhập phone đúng sdt số!');

            return false;
        } else {
            $('.error_phone').css('display', 'none');
        }
        if (password == '') {
            $('.error_password').html('vui lòng nhập');
            $('.error_password').css('display', 'block');
            return false;
        } else {
            $('.error_password').css('display', 'none');

        }
        $.ajax({
            type: "post",
            url: "../login",
            data: { _token: CSRF_TOKEN, phone: phone, password: password, remember: remember },
            success: function(response) {
                console.log(response.error)
                if (response.error !== '') {
                    $('.error_login').html(response.error)
                    return false;
                }
                window.location = '/';
            }
        });
    })
});


// sms login
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

function verify() {
    let phone = $('#phone').val();

    var phoneNumber = '+84' + phone;
    if (phone == "") {
        $('.error').html('vui lòng nhập');
        return false;
    } else if (phone_regex.test(phone) == false) {
        $('.error').css('display', 'block');
        $('.error').html('vui lòng nhập phone đúng sdt số!');
        // console.log('loi');
        return false;
    } else {
        $('.error').css('display', 'none');
    }
    $.ajax({
        url: "check-phone",
        method: "post",
        data: { _token: CSRF_TOKEN, phone: phone },
        success: function(data) {
            // console.log(data.user)
            if (data.phone == '') {

                // console.log(phoneNumber);
                // console.log(appVerifier);
                // 
                firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                    .then(function(confirmationResult) {

                        window.confirmationResult = confirmationResult;
                        $('#emptyForm').empty();
                        $('.title').html(phone);
                        $('#emptyForm').append(`<label for="your_code"><i class="zmdi zmdi-code material-icons-name"></i></label>
                                <input type="hidden" name='phone' id="phone" value="` + phone + `"/>
                                <input type="text" name="code" id="code" placeholder="code"/>
                                <span class="error"></span>`);
                        $('#verify').html(`<button onclick="login()" class="btn btn-primary" id="sign-in-button">log in</button>`)
                    }).catch(function(error) {

                    });

            } else {
                // console.log(data.phone);
                $('.error').css('display', 'block');
                $('.error').html(data.phone);
                console.log(data.phone);
                return false;

            }
        }

    });
    console.log('gj,hjk')
        // return false;

}

function login() {
    var code = $('#code').val();
    var phoneNumber = $('#phone').val();
    if (code == "") {
        $('.error').html('vui lòng nhập');
        return false;
    } else {
        $('.error').css('display', 'none');
    }
    confirmationResult.confirm(code).then(function(result) {
        // User signed in successfully.
        var user = result.user;
        let phonefirst = user.phoneNumber;

        // console.log(user.phoneNumber);
        // let lastphone = phonefirst.replace('+84','');
        $.ajax({
            url: 'post-login',
            method: 'post',
            data: { _token: CSRF_TOKEN, phone: phoneNumber },
            success: function(data) {
                // confirm('login success!');
                firebase.auth().signOut().then(function() {
                    // Sign-out successful.
                    console.log('Sign-out successful.');

                }).catch(function(error) {
                    // An error happened.
                    alert(error)
                });
                window.location = '/';
            }
        })

        // window.location ='/admin-product/list';


        // console.log('successfully');
        // ...
    }).catch(function(error) {
        // User couldn't sign in (bad verification code?)
        // ...
        alert(error)
    });
}