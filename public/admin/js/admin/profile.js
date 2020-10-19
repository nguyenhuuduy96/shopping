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
            url: "./save",
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
                $('.title').html('thay đổi thành công!');
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
                $('.error_image').html('file filesUpload không được lớn hơn 2 mb và đúng định dạng ảnh!');
                $('.error_image').css('display', 'block');
                return false;
            } else {

                $('.showimage').attr('src', test.result);
                $('.error_image').css('display', 'none');
            }

        }




    }
});