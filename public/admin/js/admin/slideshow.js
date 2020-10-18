$(document).ready(function() {
    let img = document.querySelector('input[type="file"]');

    img.onchange = function() {
        let image = img.files[0];
        let maxSize = 1024 * 1024 * 2;

        let test = new FileReader();
        test.readAsDataURL(image);
        test.onload = function() {
            if (
                image.size > maxSize ||
                /\.(jpe?g|png|gif|bmp)$/i.test(image.name) == false
            ) {
                $(".error_image").html(
                    "file filesUpload không được lớn hơn 2 mb và đúng định dạng ảnh!"
                );
                $(".error_image").css("display", "block");
                return false;
            } else {
                const showimage =
                    `<img src="` + test.result + `" width="100%">`;
                $(".image").html(showimage);
            }
        };
    };
});
var tableSlide = document.getElementById("example1");
// save

$(document).ready(function() {
    $("#formsubmit").on("submit", function(event) {
        event.preventDefault();
        let image = $("#image").val();
        let anh = $("#anh").val();

        if ($("#title").val() == "") {
            $(".error_title").html("vui long nhập!");
            return false;
        } else {
            $(".error_title").css("display", "none");
        }

        if ($("#description").val() == "") {
            $(".error_description").html("Vui lòng nhập!");
            return false;
        } else {
            $(".error_description").css("display", "none");
        }

        if (image == "" && anh == "") {
            $(".error_image").html("vui lòng chọn ảnh!");
            $(".error_image").css("display", "block");
            return false;
        } else {
            $(".error_image").css("display", "none");
        }
        // return false;
        // return false;

        let rowid = $("#rowid").val();
        $.ajax({
            url: "./save",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                // return false;

                let tableSlide = document.getElementById("example1");
                if (rowid == "") {
                    const row = tableSlide.insertRow(1);
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);
                    const cell5 = row.insertCell(4);
                    const cell6 = row.insertCell(5);

                    cell1.innerHTML = data.slide.id;
                    cell2.innerHTML = data.slide.title;
                    cell3.innerHTML =
                        `<img src="` +
                        data.slide.image +
                        `" width="50px;" alt="">`;
                    cell4.innerHTML =
                        data.slide.desciption.substring(0, 30) +
                        (data.slide.desciption.length > 30 ? "..." : "");

                    if (data.slide.active == 0) {
                        cell5.innerHTML += `<a class="btn btn-danger text-white" onclick="active(this,` + data.slide.id + `)">Disable</a>`;
                    } else {
                        cell5.innerHTML += `<a class="btn btn-success text-white" onclick="active(this,` + data.slide.id + `)">Enable</a>`;
                    }
                    cell6.innerHTML =
                        `<a class="btn btn-app" class="btn btn-success" data-toggle="modal" 
                                data-target="#ModalSlide" id="updateblog" onclick="Getupdate(this,` +
                        data.slide.id +
                        `)">
                                <i class="fa fa-edit text-primary" ></i>Edit</a>
                                            <a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="deleteSlide(this,` +
                        data.slide.id +
                        `)">
                                            <i class="fas fa-trash-alt text-danger"></i>delete</a> `;
                } else {
                    const cells = tableSlide.rows[rowid].cells;
                    cells[0].innerHTML = data.slide.id;
                    cells[1].innerHTML = data.slide.title;
                    cells[2].innerHTML =
                        `<img src="` +
                        data.slide.image +
                        `" width="50px;" alt="">`;
                    cells[3].innerHTML =
                        data.slide.desciption.substring(0, 30) +
                        (data.slide.desciption.length > 30 ? "..." : "");
                    if (data.slide.active == 0) {
                        cells[4].innerHTML = `<a class="btn btn-danger text-white" onclick="active(this,` + data.slide.id + `)">Disable</a>`;
                    } else {
                        cells[4].innerHTML = `<a class="btn btn-success text-white" onclick="active(this,` + data.slide.id + `)">Enable</a>`;
                    }
                    cells[5].innerHTML =
                        `<a class="btn btn-app" class="btn btn-success" data-toggle="modal" 
                    data-target="#ModalSlide" id="updateblog" onclick="Getupdate(this,` +
                        data.slide.id +
                        `)">
                    <i class="fa fa-edit text-primary" ></i>Edit</a>
                                <a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="deleteSlide(this,` +
                        data.slide.id +
                        `)">
                                <i class="fas fa-trash-alt text-danger"></i>delete</a> `;
                }
                document.getElementById("formsubmit").reset();
                $("#formsubmit").trigger("reset");
                $("#ModalSlide").modal("hide");
            },
        });
    });
});
// update
function Getupdate(r, id) {
    let rowid = r.parentNode.parentNode.rowIndex;
    $(".note-editing-area").attr("id", "checkhtml");
    console.log(rowid);
    $.ajax({
        url: "list/" + id,
        type: "get",
        success: function(data) {
            console.log(data);
            $("#ModalSlide").modal("show");
            $("#rowid").val(rowid);
            $("#id").val(data.slide.id);
            $("#anh").val(data.slide.image);
            $("#title").val(data.slide.title);
            $("#description").val(data.slide.desciption);
            $("#url").html(data.slide.url);
            $(".image").html(
                `<img src="` + data.slide.image +
                `" width="100%">`
            );
        },
    });
}
//rest form
function restForm() {
    $("#formsubmit").trigger("reset");
}
//delete
function deleteSlide(r, id) {
    let rowid = r.parentNode.parentNode.rowIndex;
    let Confirm = confirm("Are you sure you want to delete!");
    if (Confirm == true) {
        $.ajax({
            url: "list/" + id,
            method: "delete",
            data: { _token: CSRF_TOKEN },
            success: function(data) {
                console.log(data);
                document.getElementById("example1").deleteRow(rowid);
            },
        });
    }
}

function active(r, id) {
    let rowid = r.parentNode.parentNode.rowIndex;

    $.ajax({
        url: "active",
        method: "post",
        data: { _token: CSRF_TOKEN, id: id },
        success: function(data) {
            console.log(data);
            // return false;
            const cells = tableSlide.rows[rowid].cells;
            if (data.slide.active == "0") {
                cells[4].innerHTML =
                    `<a class="text-white btn btn-danger" onclick="active(this,` +
                    data.slide.id +
                    `)">Disable</a>`;
            } else {
                cells[4].innerHTML =
                    `<a class="btn btn-success text-white" onclick="active(this,` +
                    data.slide.id +
                    `)">Enable</a>`;
            }
        },
    });
}