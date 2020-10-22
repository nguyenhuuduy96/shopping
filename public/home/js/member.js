let MenuRight = document.getElementById('menu-right');
let pages = MenuRight.getElementsByClassName('menu-r');
for (let i = 0; i < pages.length; i++) {
    pages[i].addEventListener("click", function() {

        $('li').removeClass("font-weight-bold");
        this.className += " font-weight-bold";
        $('.title-member').html($('.font-weight-bold')[0].innerText);
        // if (i = 0) {
        //     $('.title-member').html('Thông tin tài khoản')
        // } else if (i = 1) {
        //     $('.title-member').html('Đơn mua')
        // } else {

        // }



    });
}
$(document).ready(function() {
    $('#formsubmit').on('submit', function(event) {
        event.preventDefault();
        let image = $('#image').val();
        let anh = $('#anh').val();
        let name = document.getElementById('user_name').value;
        // console.log(name)

        if (name == "") {
            $('.error_name').html('vui long nhập!');
            $('.error_name').css('display', 'block');
            return false;
        } else {
            $('.error_name').css('display', 'none');
        }

        if ($("#email").val() == "") {
            $('.error_email').html('Vui lòng nhập!');
            $('.error_email').css('display', 'block');
            return false;
        } else {
            $('.error_email').css('display', 'none');
        }

        if (image == '' && anh == '') {
            $('.error_image').html('vui lòng chọn ảnh!');
            $('.error_image').css('display', 'block');
            return false;
        } else {
            $('.error_image').css('display', 'none');
        }

        $.ajax({
            url: "member/save",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                // console.log(data)
                if (data.error !== "") {
                    $('.error_email').html(data.error);
                    $('.error_email').css('display', 'block');
                    return false;

                }
                $('.error_email').css('display', 'none');
                document.getElementById("email").disabled = true;
                $('.success').html('cập nhật thành công!');
            }
        });

    });

});
$(document).ready(function() {
    let img = document.querySelector('input[type="file"]');

    img.onchange = function() {
        $('.img').css('display', 'none');
        let image = img.files[0];
        let maxSize = 1024 * 1024 * 2;

        let test = new FileReader();
        test.readAsDataURL(image);
        test.onload = function() {
            if (image.size > maxSize || /\.(jpe?g|png|gif|bmp)$/i.test(image.name) == false) {
                $('.error_image').html(
                    'file filesUpload không được lớn hơn 2 mb và đúng định dạng ảnh!');
                $('.error_image').css('display', 'block');
                return false;
            } else {

                $('.showimage').attr('src', test.result);
                $('.error_image').css('display', 'none');
            }

        }




    }
});
$('#submitChangePass').submit(function(e) {
    let pass = $('#password').val();
    let NewPass = $('#newpasswors').val();
    let CfPass = $('#Cfpasswors').val();
    if (pass == "") {
        $('.error_pass').html('vui long nhập!');
        $('.error_pass').css('display', 'block');
        return false;
    } else {
        $('.error_pass').css('display', 'none');
    }
    if (NewPass == "") {
        $('.error_new_pass').html('vui long nhập!');
        $('.error_new_pass').css('display', 'block');
        return false;
    } else {
        $('.error_new_pass').css('display', 'none');
    }
    if (CfPass == "") {
        $('.error_cf_pass').html('vui long nhập!');
        $('.error_cf_pass').css('display', 'block');
        return false;
    } else if (CfPass !== NewPass) {
        $('.error_cf_pass').html('Mật khẩu nhập lại không khớp!');
        $('.error_cf_pass').css('display', 'block');
        return false;
    } else {
        $('.error_cf_pass').css('display', 'none');
    }
    $.ajax({
        type: "post",
        url: "member/save-change-password",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            // console.log(response.error)
            if (response.error !== "") {
                $('.error_pass').html(response.error);
                $('.error_pass').css('display', 'block');
                return false;
            }
            $('.error_pass').css('display', 'none');
            $('#FormChangePass').modal('hide');
            alert('thay đổi mật khẩu thành công')
        }
    });
});