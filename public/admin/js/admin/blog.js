
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
        let image = $('#image').val();
        let anh =$('#anh').val();
      
       
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

         if (image=='' && anh=='') {
            $('.error_image').html('vui lòng chọn ảnh!');
            $('.error_image').css('display','block');
            return false;
        }else{
            $('.error_image').css('display','none');
        }

    
        let content = document.getElementById('checkhtml').children[2].innerHTML;
        // console.log(content)
        if( content =='' ) {
            $('.error_content').html('vui lòng Nôi dung!');
            console.log('adasd')
            return false;
        }else{
            $('.error_content').css('display','none');
        }
        // return false;
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
                            
                            let tableProduct = document.getElementById("example1");
                            if (rowid =="") {
                                const row = tableProduct.insertRow(1);
                                const cell1 = row.insertCell(0);
                                const cell2 = row.insertCell(1);
                                const cell3 = row.insertCell(2);
                                const cell4 = row.insertCell(3);
                                const cell5 = row.insertCell(4);
                              
                                cell1.innerHTML = data.blog.id;
                                cell2.innerHTML = data.blog.title;
                                cell3.innerHTML = data.blog.author;
                                cell4.innerHTML = `<img src="`+data.blog.image_title+`" width="50px;" alt="">`;
                                cell5.innerHTML =`<a class="btn btn-app" class="btn btn-success" data-toggle="modal" 
                                data-target="#Modalblog" id="updateblog" onclick="Getupdate(this,`+data.blog.id+`)">
                                <i class="fa fa-edit text-primary" ></i>Edit</a>
                                            <a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="deleteBlog(this,`+data.blog.id+`)">
                                            <i class="fas fa-trash-alt text-danger"></i>delete</a> `;

                            } else {
                                const cells = tableProduct.rows[rowid].cells;
                                cells[0].innerHTML = data.blog.id;
                                cells[1].innerHTML = data.blog.title;
                                cells[2].innerHTML = data.blog.author;
                                cells[3].innerHTML =`<img src="`+data.blog.image_title+`" width="50px;" alt="">`;
                                cells[4].innerHTML =`<a class="btn btn-app" class="btn btn-success" data-toggle="modal" 
                                data-target="#Modalblog" id="updateblog" onclick="Getupdate(this,`+data.blog.id+`)">
                                <i class="fa fa-edit text-primary" ></i>Edit</a>
                                            <a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="deleteBlog(this,`+data.blog.id+`)">
                                            <i class="fas fa-trash-alt text-danger"></i>delete</a> `;

                                
                            }
                            document.getElementById("formblogsubmit").reset();
                            $('#formblogsubmit').trigger("reset");
                            $('#ModalBlog').modal('hide');





                         }
                     });
                
            });

}); 
// update
function Getupdate(r,id){
    let rowid = r.parentNode.parentNode.rowIndex;
    $(".note-editing-area").attr('id', 'checkhtml'); 
    console.log(rowid)
    $.ajax({
        url: 'list/'+id,
        type: 'get',
        success:function(data){
            console.log(data)
            $('#ModalBlog').modal('show');
            $('#rowid').val(rowid);
            $('#blog_id').val(data.blog.id);
            $('#anh').val(data.blog.image_title);
            $('#title').val(data.blog.title);
            $('#author').val(data.blog.author);
            // console.log(data.blog.content)
            $('.note-editable').html(data.blog.content);
            $('#showImage').html(`<div class="form-group"><img src="`+data.blog.image_title+`" width="200px"></div>`);
        }
    })
    
    
} 
//rest form
function restForm(){
    $('#formblogsubmit').trigger("reset");
    $('#showImage').empty();
    $('.note-editable').empty();
    $(".note-editing-area").attr('id', 'checkhtml'); 
}
//delete blog
function deleteBlog(r,id){
    let rowid =  r.parentNode.parentNode.rowIndex;
    let confirm = confirm('Are you sure you want to delete!')
    if (confirm == true) {
        $.ajax({
            url: 'list/'+id,
            method: 'delete',
            data:{_token:CSRF_TOKEN},
            success:function(data){
                console.log(data)
                document.getElementById("example1").deleteRow(rowid);
            }
        })
    }
     

}