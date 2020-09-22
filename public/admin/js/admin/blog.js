
// change load image input

$(document).ready(function(){
    let img = document.querySelector('input[type="file"]');

    img.onchange = function(){
            // console.log('đasads');
            // $('#showImage').empty();
            let file = this.files[0];
            $('.img').css('display','none');
            let image = img.files[0];
           let maxSize = 1024 * 1024*2;
            
            let test = new FileReader();
            test.readAsDataURL(image);
            test.onload = function () { 
                if (image.size>maxSize || /\.(jpe?g|png|gif|bmp)$/i.test(image.name)==false) {
                    $('.error_image').html('file filesUpload không được lớn hơn 2 mb và đúng định dạng ảnh!');
                    $('.error_image').css('display','block');
                    return false;
                }else{
                    const showimage = `<div class="form-group"><img src="`+test.result+`" width="200px"></div>`; 
                    $('#showImage').html(showimage);
                }

            }

            

            
        }
    });

// save

$(document).ready(function(){
    $('#formblogsubmit').on('submit', function(event){
        event.preventDefault();

      
       
        if( $("#title").val() == "" ) {
            $('.error_title').html('vui long nhập!');
            return false;
        }else{
            $('.error_title').css('display','none');
        }

        if( $("#author").val() == "" ) {
            $('.error_author').html('Vui lòng nhập Tác giả!');
            return false;
        }else{
            $('.error_author').css('display','none');
        }

        if( $('#editor1').val() == "" ) {
            $('.error_content').html('vui lòng Nôi dung!');
            // console.log('adasd')
            return false;
        }else{
            $('.error_content').css('display','none');
        }
        // return false;
        

                let rowid = $('#rowid').val();
                $.ajax({
                    url:"./add-and-update",
                    type:"POST",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data)
                    {
                            console.log(data)
                            // return false;
                            // console.log(data.product);
                            // return false;
                            // return false;
                            // confirm("success!");
                            // console.log("success");
                            // let tableProduct = document.getElementById("example1");
                            // if (rowid =="") {
                            //     const row = tableProduct.insertRow(1);
                            //     const cell1 = row.insertCell(0);
                            //     const cell2 = row.insertCell(1);
                            //     const cell3 = row.insertCell(2);
                            //     const cell4 = row.insertCell(3);
                            //     const cell5 = row.insertCell(4);
                            //     const cell6 = row.insertCell(5);
                            //     cell1.innerHTML = data.product.id;
                            //     cell2.innerHTML = data.product.name;
                            //     cell3.innerHTML = data.product.source;
                            //     cell4.innerHTML = data.product.time_expired;
                            //     cell5.innerHTML ='<a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" id="updateProduct" onclick="onclickupdate(this,'+data.product.id+')"><i class="fa fa-edit text-primary"></i>Edit</a>';
                            //     cell6.innerHTML ='<a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,'+data.product.id+')"><i class="fas fa-trash-alt text-danger"></i>delete</a>';

                            // } else {
                            //     const cells = tableProduct.rows[rowid].cells;
                            //     cells[0].innerHTML = data.product.id;
                            //     cells[1].innerHTML = data.product.name;
                            //     cells[2].innerHTML = data.product.source;
                            //     cells[3].innerHTML = data.product.time_expired;
                            //     cells[4].innerHTML ='<a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" id="updateProduct" onclick="onclickupdate(this,'+data.product.id+')"><i class="fa fa-edit text-primary"></i>Edit</a>';
                            //     cells[5].innerHTML ='<a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,'+data.product.id+')"><i class="fas fa-trash-alt text-danger"></i>delete</a>';

                            //     $('#ModalProduct').modal('hide');
                            // }
                            // document.getElementById("formnewproductsubmit").reset();
                            // $('#formnewproductsubmit').trigger("reset");
                            // $('#ModalProduct').modal('hide');



                             // /


                         }
                     });
                
            });

});  