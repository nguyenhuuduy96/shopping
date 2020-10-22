$(document).ready(function() {
    let choose = document.getElementById("choose");
    let pages = choose.getElementsByClassName("page");
    let id = document.getElementById('id').value;
    for (let i = 0; i < pages.length; i++) {
        pages[i].addEventListener("click", function() {
            $("li").removeClass("active");
            $('li').attr('name', '');
            this.className += " active";
            $('.active').attr('name', 'active');
            const choose_logo = $(this).val();
            console.log(choose_logo);
            $('#choose_logo').val(choose_logo);
            // return false;
            if (id !== null) {
                $.ajax({
                    url: "./choose_logo",
                    method: "post",
                    data: {
                        _token: CSRF_TOKEN,
                        choose_logo: choose_logo,
                        id: id
                    },
                    success: function(data) {

                    },
                });
            }

        });
    }
});
$(document).ready(function() {
    $('#formsubmit').on('submit', function(event) {
        event.preventDefault();
        let image = $('#image').val();
        let anh = $('#anh').val();
        let logo_text = document.getElementById('logo_text').value;
        let email_contact = document.getElementById('email_contact').value;
        let url_banner1 = document.getElementById('url_banner1').value;
        let url_banner2 = document.getElementById('url_banner2').value;
        let url_banner3 = document.getElementById('url_banner3').value;
        let address = document.getElementById('address').value;
        let choose_logo = $('.active').val();

        // console.log(logo_text)

        if (logo_text == "") {
            $('.error_name').html('vui long nhập!');
            $('.error_name').css('display', 'block');
            return false;
        } else {
            $('.error_name').css('display', 'none');
        }

        if (email_contact == "") {
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
            url: "./save-setting",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {


                $('#id').val(data.setting.id);
                alert('cập nhật thành công!')

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