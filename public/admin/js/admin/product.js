var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

// $('#addsize').click(function(){
// 	$('.size').append('<input type="text" class="sizename" ><button id="saveSize">Save Size</button>');
// });

window.onload = function() {
    $("#example1_filter").html(
        '<label>Search:<input type="search" id="searh_product" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>'
    );
    let search = $("#searh_product").val();
    let show = $("#show").val();
    getAjaxPageAndProduct(search, show);
};

// search keyup product seclect 2
$(document).ready(function() {
    $("#searh_product").on("keyup", function() {
        let search = $("#searh_product").val();
        let show = $("#show").val();
        console.log(search, show);
        getAjaxPageAndProduct(search, show);
    });
});
$(document).ready(function() {
        let showProduct = document.getElementById('show');
        showProduct.addEventListener('change', function() {
            let search = $("#searh_product").val();
            let show = $("#show").val();
            console.log(search, show);
            getAjaxPageAndProduct(search, show);
        })
    })
    //get ajax page and product
function getAjaxPageAndProduct(search, show) {
    $.ajax({
        url: "../../api/product/get-ajax-product-and-page",
        method: "get",
        data: { search: search, show: show },
        success: function(data) {
            let showPagaLink = `<nav >
        <ul class="pagination" id="product_page">
        <li class="page-item disabled pre" aria-disabled="true" aria-label="« Previous">
        <span class="page-link" aria-hidden="true">‹</span>
        </li>
        <li class="page-item page active" value="1"  aria-current="page"><span class="page-link">1</span></li> `;
            if (data.totalPage >= 2) {
                for (var i = 2; i <= data.totalPage; i++) {
                    showPagaLink +=
                        `<li class="page-item page" value="` +
                        i +
                        `"  aria-current="page"><span class="page-link">` +
                        i +
                        `</span></li> `;
                }
            }
            showPagaLink += ` <li class="page-item next">
        <a class="page-link" rel="next" aria-label="Next »">›</a>
        </li>
        </ul>
		</nav>`;
            showHtmlProduct(data.products);
            $("#paga-link").html(showPagaLink);
            let product_page = document.getElementById("product_page");
            let pages = product_page.getElementsByClassName("page");
            for (let i = 0; i < pages.length; i++) {
                pages[i].addEventListener("click", function() {
                    $("li").removeClass("active");
                    this.className += " active";
                    const id = $(this).val();
                    console.log(id);
                    let page = id;
                    $.ajax({
                        url: "../../api/product/get-ajax-product-and-page",
                        method: "get",
                        data: { search: search, show: show, paga: page },
                        success: function(data) {
                            console.log(data.skip);
                            console.log(data.products);
                            showHtmlProduct(data.products);
                        },
                    });
                });
            }
            $(".pre").click(function() {
                const id = $(".active").val();
                const i = id - 2 < 0 ? 0 : id - 2;
                $("li").removeClass("active");

                pages[i].className += " active";

                // console.log(id)
                let page = id - 1;
                $.ajax({
                    url: "../../api/product/get-ajax-product-and-page",
                    method: "get",
                    data: { search: search, show: show, paga: page },
                    success: function(data) {
                        console.log(data.skip);
                        console.log(data.products);
                        showHtmlProduct(data.products);
                    },
                });
            });

            $(".next").click(function() {
                const id = $(".active").val();
                const i = id;
                if (i <= pages.length - 1) {
                    $("li").removeClass("active");

                    pages[i].className += " active";
                    let page = id + 1;
                    console.log(i);
                    $.ajax({
                        url: "../../api/product/get-ajax-product-and-page",
                        method: "get",
                        data: { search: search, show: show, paga: page },
                        success: function(data) {
                            console.log(data.skip);
                            console.log(data.products);
                            showHtmlProduct(data.products);
                        },
                    });
                }
            });
        },
    });
}

// show html product
function showHtmlProduct(products) {
    let showsearch = ``;
    for (const x of products) {
        showsearch +=
            `<tr><td>` +
            x.id +
            `</td>
					<td>` +
            x.name +
            `</td>
					<td>` +
            x.source +
            `</td>
					<td>` +
            x.time_expired +
            `</td>
					<td><a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" 
					id="updateProduct" onclick="onclickupdate(this,` +
            x.id +
            `)">
					<i class="fa fa-edit text-primary"></i>Edit</a></td>
					<td><a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,` +
            x.id +
            `)">
					<i class="fas fa-trash-alt text-danger"></i>delete</a> 
					</td>
					</tr>`;
    }
    // console.log(showsearch)
    $("#search_Show").html(showsearch);
}
//rest form add new product
function productFormRest() {
    $("#titleProduct").html("New Product");
    $("#showImage").empty();
    $("#getsize").empty();
    $("#getsizeup").empty();
    $("#product_id").empty();
    $("#name_product").attr("value", "");
    $("#source").attr("value", "");
    $("#date").attr("value", "");
    $("#rowid").attr("value", "");
    $("#ModalProduct form")[0].reset();
    $.ajax({
        url: "get-size-all",
        method: "get",
        success: function(data) {
            // console.log(data.getColors);

            let listColor = `<option selected="selected" value="">-- chọn --</option>`;
            for (const x of data.getColors) {
                listColor +=
                    '<option value="' + x.id + '" > ' + x.name + "</option>";
                // console.log(x.name)
            }
            let listSize = `<option selected="selected" value="">-- chọn --</option>`;
            for (const x of data.getsize) {
                listSize +=
                    '<option value="' + x.id + '" > ' + x.size + "</option>";
            }
            let list_parent_id = '<option value="">chọn</option>';
            let list_child_id = '<option value="" class="child">chọn</option>';
            for (const cate of data.cates) {
                if (cate.parent_id == null) {
                    list_parent_id +=
                        `<option value="` +
                        cate.id +
                        `">` +
                        cate.name +
                        `</option>`;
                }
            }
            // console.log(list_child_id)
            $("#parent_id").html(list_parent_id);
            $("#child_id").html(list_child_id);

            $("#color_id").html(listColor);
            $("#size_id").html(listSize);
            // console.log(list);
        },
    });
}
//delete product
function tabledeleteProduct(r, id) {
    var i = r.parentNode.parentNode.rowIndex;
    console.log(i);
    console.log(id);
    let alertDeleteProduct = confirm("Are you sure you want to delete!");
    if (alertDeleteProduct == true) {
        $.ajax({
            url: "delete-product",
            method: "post",
            data: { _token: CSRF_TOKEN, id: id },
            success: function(data) {
                // console.log(data.product);
                document.getElementById("example1").deleteRow(i);
            },
        });
    }
}

$(".restformsize").click(function() {
    $(".id_size_hidden").empty();
    $(".title-size").html("Add new size");
    $("#row_id_size").attr("value", "");
    $("#name_size").attr("value", "");
});

//save add new product and update

// get size price stock append form
$(document).ready(function() {
    $(".addSizePriceStock").click(function() {
        $.ajax({
            url: "get-size-all",
            method: "get",
            success: function(data) {
                // console.log(data.getsize);
                let list = `<div class="row"><div class="col-md-2">
				<label>color</label>
				<select class="form-control" name="color_id[]" id="color_id" class="validatecolor"  style="width: 100%;">
				<option selected="selected" value="">-- chọn --</option>`;
                for (const x of data.getColors) {
                    list +=
                        '<option value="' +
                        x.id +
                        '" > ' +
                        x.name +
                        "</option>";
                }
                list += `</select>
				</div>
				<div class="col-md-2">
				<label>size</label>
				<select class="form-control" name="size_id[]" class="validatesize" id="size_id"  style="width: 100%;">
				<option value="">-- chọn --</option>`;
                for (const x of data.getsize) {
                    list +=
                        '<option value="' +
                        x.id +
                        '" > ' +
                        x.size +
                        "</option>";
                }

                list +=
                    '</select></div><div class="col-md-3"><label>giá</label><input type="number" name="price[]" class="form-control"></div><div class="col-md-2"><label>số lượng</label><input type="number" name="stock[]" class="form-control"></div><a style="width:75px; margin-top:31px" onclick="deletesizeMiddle(event)" class="form-control addSizePriceStock btn-danger">delete</a></div></div>';
                $("#getsize").append(list);
                // console.log(list);
            },
        });
    });
});

// change load image input

$(document).ready(function() {
    let img = document.querySelector('input[type="file"]');

    img.onchange = function() {
        // console.log('đasads');
        // $('#showImage').empty();
        let file = this.files[0];
        $(".img").css("display", "none");
        let arrayImage = document.getElementsByClassName("image");
        let listImage = arrayImage[1].files;
        let maxSize = 1024 * 1024 * 2;
        for (const x of listImage) {
            let test = new FileReader();
            test.readAsDataURL(x);
            test.onload = function() {
                if (
                    x.size > maxSize ||
                    /\.(jpe?g|png|gif|bmp)$/i.test(x.name) == false
                ) {
                    alert(
                        "có 1 file anh lớn hơn 2mb đã được loại bỏ vì file filesUpload không được lớn hơn 2 mb hoăc ko đúng định dạng!"
                    );
                } else {
                    $("#showImage").append(
                        `<div class="col-md-2" id="showImagediv">
    						<img src="` +
                        test.result +
                        `" class="img-rounded img-thumbnail" alt="Cinque Terre" width="100%" height="236"
    						>
    						<div class="form-group"><label>vị trí</label><input type="number" name="sort[]" class="form-control">
    						<input type="hidden" name="file[]" id="filesUpload" value="` +
                        test.result +
                        `">
    						</div>
    						<button type="button" onclick="deleteImage(event)" class="btn btn-danger text-white position-absolute " style="top:0;font-size:10px" >x</button>
    						</div>`
                    );
                }
            };
        }
    };
});
//save
$(document).ready(function() {
    $("#formnewproductsubmit").on("submit", function(event) {
        event.preventDefault();

        let date = $("input[type=date]").val();
        let fileimage = document.getElementsByClassName("image");
        let maxSize = 1024 * 1024 * 2;
        let regex_image = "/.(jpeg|jpg|png|gif|bmp)$/i";
        let child = document.getElementsByClassName("child");
        let countChild = child.length;
        let category = document.getElementById("parent_id").value;
        let child_id = document.getElementById("child_id").value;
        console.log(countChild);
        if ($("#name_product").val() == "") {
            $(".errorName").html("vui long nhập!");
            return false;
        } else {
            $(".errorName").css("display", "none");
        }
        if ($("#source").val() == "") {
            $(".errorsource").html("vui lòng nhập nguồn hàng!");
            return false;
        } else {
            $(".errorsource").css("display", "none");
        }
        // if (date == "") {
        //     $(".errortime_expired").html("vui lòng chọn thời gian hết hạn!");
        //     return false;
        // } else {
        //     $(".errortime_expired").css("display", "none");
        // }

        if (category == "") {
            $(".error_category").html("vui lòng chọn danh muc!");
            return false;
        } else {
            $(".error_category").css("display", "none");
        }

        if (countChild > 1 && child_id == "") {
            $(".error_Child").html("vui lòng chọn danh muc!");
            return false;
        } else {
            $(".error_Child").css("display", "none");
        }

        $(".error_image").css("display", "none");

        let rowid = $("#rowid").val();
        $.ajax({
            url: "add-and-update",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                // console.log(data.data)
                // return false;
                // console.log(data.product);
                // return false;
                // return false;
                alert("success!");
                console.log("success");
                let tableProduct = document.getElementById("example1");
                if (rowid == "") {
                    const row = tableProduct.insertRow(1);
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);
                    const cell5 = row.insertCell(4);
                    const cell6 = row.insertCell(5);
                    cell1.innerHTML = data.product.id;
                    cell2.innerHTML = data.product.name;
                    cell3.innerHTML = data.product.source;
                    const time_expireds = data.product.time_expired == null ? null : data.product.time_expired;
                    cell4.innerHTML = time_expireds;
                    cell5.innerHTML =
                        '<a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" id="updateProduct" onclick="onclickupdate(this,' +
                        data.product.id +
                        ')"><i class="fa fa-edit text-primary"></i>Edit</a>';
                    cell6.innerHTML =
                        '<a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,' +
                        data.product.id +
                        ')"><i class="fas fa-trash-alt text-danger"></i>delete</a>';
                } else {
                    const cells = tableProduct.rows[rowid].cells;
                    cells[0].innerHTML = data.product.id;
                    cells[1].innerHTML = data.product.name;
                    cells[2].innerHTML = data.product.source;
                    const time_expireds = data.product.time_expired == null ? null : data.product.time_expired;

                    cells[3].innerHTML = time_expireds;
                    cells[4].innerHTML =
                        '<a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct" id="updateProduct" onclick="onclickupdate(this,' +
                        data.product.id +
                        ')"><i class="fa fa-edit text-primary"></i>Edit</a>';
                    cells[5].innerHTML =
                        '<a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,' +
                        data.product.id +
                        ')"><i class="fas fa-trash-alt text-danger"></i>delete</a>';

                    $("#ModalProduct").modal("hide");
                }
                document.getElementById("formnewproductsubmit").reset();
                $("#formnewproductsubmit").trigger("reset");
                $("#ModalProduct").modal("hide");

                // /
            },
        });
    });
});

// get product show form modal product

function onclickupdate(r, id) {
    let rowproduct = r.parentNode.parentNode.rowIndex;
    $("#titleProduct").html("Update product");
    $("#showImage").empty();
    $("#shownewImage").empty();

    $("#getsize").empty();

    $("#getsizeup").empty();
    // console.log(firebase.auth());

    $.ajax({
        url: "get-ajax-product",
        method: "get",
        data: { id: id },
        success: function(data) {
            $("#name_product").attr("value", data.product.name);
            $("#source").attr("value", data.product.source);
            $("#date").attr("value", data.product.time_expired);
            $("#rowid").attr("value", rowproduct);
            $("#product_id").append(
                '<input type="hidden" name="id" value="' +
                data.product.id +
                '">'
            );
            let list_parent_id = '<option value="">chọn</option>';
            let list_child_id = '<option class="child" value="">chọn</option>';
            for (const cate of data.cates) {
                if (cate.parent_id == null) {
                    if (cate.id == data.product.product_category_id) {
                        list_parent_id +=
                            `<option value="` +
                            cate.id +
                            `" selected>` +
                            cate.name +
                            `</option>`;
                    } else if (cate.id == data.parent_id.id) {
                        list_parent_id +=
                            `<option value="` +
                            cate.id +
                            `" selected>` +
                            cate.name +
                            `</option>`;
                    } else {
                        list_parent_id +=
                            `<option value="` +
                            cate.id +
                            `">` +
                            cate.name +
                            `</option>`;
                    }
                }

                if (
                    cate.parent_id == data.parent_id.id &&
                    cate.parent_id !== null
                ) {
                    if (cate.id == data.product.product_category_id) {
                        list_child_id +=
                            `<option class="child" value="` +
                            cate.id +
                            `" selected>` +
                            cate.name +
                            `</option>`;
                    } else {
                        list_child_id +=
                            `<option class="child" value="` +
                            cate.id +
                            `">` +
                            cate.name +
                            `</option>`;
                    }
                }
            }
            // console.log(list_child_id)
            $("#parent_id").html(list_parent_id);
            $("#child_id").html(list_child_id);
            let listup = "";
            for (const x of data.productColors) {
                listup += `<div class="row">
							<div class="col-md-2">
							<label>size</label>
							<select class="form-control select2" style="width: 100%;" name="color_id[]" class="validatesize" id="validateSize">
							<option value="">-- chọn --</option>`;
                for (const color of data.colors) {
                    if (color.id == x.color_id) {
                        listup +=
                            '<option value="' +
                            color.id +
                            '" selected> ' +
                            color.name +
                            "</option>";
                    } else {
                        listup +=
                            '<option value="' +
                            color.id +
                            '"> ' +
                            color.name +
                            "</option>";
                    }
                }
                listup += "</select></div>";
                // }
                // for (const x of data.productSizes) {
                listup += `<div class="col-md-2">
							<label>size</label>
							<select class="form-control select2" style="width: 100%;" name="size_id[]" class="validatesize" id="validateSize">
							<option value="">-- chọn --</option>`;
                for (const size of data.sizes) {
                    if (size.id == x.size_id) {
                        listup +=
                            '<option value="' +
                            size.id +
                            '" selected> ' +
                            size.size +
                            "</option>";
                    } else {
                        listup +=
                            '<option value="' +
                            size.id +
                            '"> ' +
                            size.size +
                            "</option>";
                    }
                }
                listup +=
                    `</select>
							</div>
							<div class="col-md-3">
							<label>giá</label>
							<input type="number" name="price[]" class="form-control" value="` +
                    x.price +
                    `">
							</div>
							<div class="col-md-2">
							<label>số lượng</label>
							<input type="number" name="stock[]" class="form-control" value="` +
                    x.stock +
                    `">
							<input type="hidden" name="middle_id[]" value="` +
                    x.middle_id +
                    `">
							</div><a style="width:75px; margin-top:31px" onclick="xoa(event,` +
                    x.middle_id +
                    `)" class="form-control addSizePriceStock btn-danger">delete</a>
							</div></div>`;
            }
            for (const image of data.images) {
                $("#showImage").append(
                    `<div class="col-md-2 position-relative" id="showImagediv">
								<img src="` +
                    image.image +
                    `" class="img-rounded img-thumbnail" alt="Cinque Terre" width="100%" height="236">
								<div class="form-group"><label>vị trí</label>
								<input type="number" name="sort[]" class="form-control" value="` +
                    image.sort +
                    `">
								<input type="hidden" name="image_id[]" value="` +
                    image.id +
                    `"></div>
								<button type="button" onclick="deleteImage(event,` +
                    image.id +
                    `)" class="btn btn-danger text-white position-absolute " style="left:70%;top:0" >x</button>
								</div>`
                );
                // console.log(image.image);
            }
            $("#getsizeup").append(listup);
            let listColor = `<option selected="selected" value="">-- chọn --</option>`;
            for (const x of data.colors) {
                listColor +=
                    '<option value="' + x.id + '" > ' + x.name + "</option>";
                // console.log(x.name)
            }
            let listSize = `<option selected="selected" value="">-- chọn --</option>`;
            for (const x of data.sizes) {
                listSize +=
                    '<option value="' + x.id + '" > ' + x.size + "</option>";
            }

            $("#color_id").html(listColor);
            $("#size_id").html(listSize);
            // console.log(data.product);
            // console.log(data.images);
        },
    });
    // console.log(rowproduct);
    // console.log(id);
}

//onchage get danh muc con
$(document).ready(function() {
    // $('#parent_id').on('change',function(){
    // 	let id = $(this).val();
    // 	console.log(id)
    // })
    let event = document.getElementById("parent_id");
    event.addEventListener("change", function() {
        let id = event.value;
        $.ajax({
            url: "./get-child-cate",
            type: "POST",
            data: { _token: CSRF_TOKEN, id: id },
            success: function(data) {
                let list_child_id =
                    '<option value="" class="child">chọn</option>';
                for (const cate of data.cates) {
                    list_child_id +=
                        `<option value="` +
                        cate.id +
                        `" class="child">` +
                        cate.name +
                        `</option>`;
                }
                document.getElementById("child_id").innerHTML = list_child_id;
            },
        });
    });
});
// delete image
function deleteImage(event, id = null) {
    let alertdelete = confirm("Are you sure you want to delete!");
    if (alertdelete == true) {
        if (id == null) {
            event.target.parentElement.remove();
        } else {
            $.ajax({
                url: "delete-image",
                method: "post",
                data: { _token: CSRF_TOKEN, id: id },
                success: function(data) {
                    event.target.parentElement.remove();
                },
            });
        }
    }
}
// delete size price stock
function xoa(event, id) {
    let alertdelete = confirm("Are you sure you want to delete!");
    if (alertdelete == true) {
        $.ajax({
            url: "delete-size-price-stock",
            method: "post",
            data: { _token: CSRF_TOKEN, id: id },
            success: function(data) {
                event.target.parentElement.remove();
            },
        });
    }
}
//delete size
function deletesizeMiddle(event) {
    event.target.parentElement.remove();
}

// table delete row size tabledeleteSize
function tabledeleteSize(r, id) {
    // console.log(r);
    let tableRow = r.parentNode.parentNode.rowIndex;
    let alertSize = confirm("Are you sure you want to delete!");
    $.ajax({
        url: "size/delete-size-table-row",
        method: "post",
        data: { _token: CSRF_TOKEN, id: id },
        success: function(data) {
            document.getElementById("TableSize").deleteRow(tableRow);
        },
    });
    // console.log(tableRow);
}

function tableGetSize(r, id) {
    let row_i = r.parentNode.parentNode.rowIndex;

    $(".title-size").html("Update size");
    $("#row_id_size").attr("value", row_i);
    console.log(id);
    $.ajax({
        url: "size/get-size",
        method: "post",
        data: { id: id, _token: CSRF_TOKEN },
        success: function(data) {
            $(".newSize").attr("value", data.size.size);
            $(".id_size_hidden").append(
                '<input class="Size_id" type="hidden" name="id" value="' +
                data.size.id +
                '">'
            );
        },
    });
    // console.log(row_i);
    // console.log(id);
}

// save size and update size
$(document).ready(function() {
    //add size
    $("#submitSize").on("submit", function(event) {
        event.preventDefault();
        let row_id_size = $("#row_id_size").val();
        let name_size = $("#name_size").val();
        if (name_size == "") {
            $(".errorsSize").html("vui lòng nhập!");
        } else {
            $(".errorsSize").css("display", "none");
        }
        let table = document.getElementById("TableSize");
        $.ajax({
            url: "size/save-size",
            method: "post",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                // console.log(data.addsize);
                if (row_id_size == "") {
                    // $('#size_id').append('<option value="'+data.size.id+'" > '+data.size.size+'</option>');
                    //    console.log('<option value="'+data.size.id+'" > '+data.size.size+'</option>');

                    let row = table.insertRow(1);
                    let cell1 = row.insertCell(0);
                    let cell2 = row.insertCell(1);
                    let cell3 = row.insertCell(2);
                    let cell4 = row.insertCell(3);
                    cell1.innerHTML = data.size.id;
                    cell2.innerHTML = data.size.size;
                    cell3.innerHTML =
                        '<a class="btn btn-danger" onclick="tabledeleteSize(this,' +
                        data.size.id +
                        ')">delete</a>';
                    cell4.innerHTML =
                        '<a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary" onclick="tableGetSize(this,' +
                        data.size.id +
                        ')">Update</a>';
                } else {
                    const cells = table.rows[row_id_size].cells;
                    cells[0].innerHTML = data.size.id;
                    cells[1].innerHTML = data.size.size;
                    cells[2].innerHTML =
                        '<a class="btn btn-danger" onclick="tabledeleteSize(this,' +
                        data.size.id +
                        ')">delete</a>';
                    cells[3].innerHTML =
                        '<a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary" onclick="tableGetSize(this,' +
                        data.size.id +
                        ')">Update</a>';
                }

                $("#AddNewSize").modal("hide");
                $("#submitSize").trigger("reset");

                alert("success");
            },
        });
    });
});
//colorr
function tabledeleteColor(r, id) {
    // console.log(r);
    let tableRow = r.parentNode.parentNode.rowIndex;
    let alertSize = confirm("Are you sure you want to delete!");
    console.log(tableRow, id);
    $.ajax({
        url: "color/delete-color-table-row",
        method: "post",
        data: { _token: CSRF_TOKEN, id: id },
        success: function(data) {
            console.log(data);
            document.getElementById("TableColor").deleteRow(tableRow);
        },
    });
}

function tableGetColor(r, id) {
    let row_i = r.parentNode.parentNode.rowIndex;

    $(".title-color").html("Update color");
    $("#row_id_color").attr("value", row_i);

    $.ajax({
        url: "color/get-color",
        method: "post",
        data: { id: id, _token: CSRF_TOKEN },
        success: function(data) {
            $(".newSize").attr("value", data.color.name);
            $("#id_color").val(data.color.id);
        },
    });
}

// save color and update color
$(document).ready(function() {
    //add color
    $("#submitColor").on("submit", function(event) {
        event.preventDefault();
        let row_id_color = $("#row_id_color").val();
        let name_color = $("#name_color").val();
        if (name_color == "") {
            $(".errorsColor").html("vui lòng nhập!");
        } else {
            $(".errorsColor").css("display", "none");
        }
        let table = document.getElementById("TableColor");
        $.ajax({
            url: "color/save-color",
            method: "post",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                // console.log(data);
                // return false;
                if (row_id_color == "") {
                    let row = table.insertRow(1);
                    let cell1 = row.insertCell(0);
                    let cell2 = row.insertCell(1);
                    let cell3 = row.insertCell(2);
                    let cell4 = row.insertCell(3);
                    cell1.innerHTML = data.color.id;
                    cell2.innerHTML = data.color.name;
                    cell3.innerHTML =
                        '<a class="btn btn-danger" onclick="tabledeleteColor(this,' +
                        data.color.id +
                        ')">delete</a>';
                    cell4.innerHTML =
                        '<a data-toggle="modal" data-target="#FormColor" class="btn btn-primary" onclick="tableGetColor(this,' +
                        data.color.id +
                        ')">Update</a>';
                } else {
                    const cells = table.rows[row_id_color].cells;
                    cells[0].innerHTML = data.color.id;
                    cells[1].innerHTML = data.color.name;
                    cells[2].innerHTML =
                        '<a class="btn btn-danger" onclick="tabledeleteColor(this,' +
                        data.color.id +
                        ')">delete</a>';
                    cells[3].innerHTML =
                        '<a data-toggle="modal" data-target="#FormColor" class="btn btn-primary" onclick="tableGetColor(this,' +
                        data.color.id +
                        ')">Update</a>';
                }

                $("#FormColor").modal("hide");
                $("#submitColor").trigger("reset");
                // $('.successSize').html('thêm thành công');
                alert("success");
            },
        });
    });
});

// $(document).ready(function() {
// 	let header = document.getElementById("page_parent");
// 	let page_colors = header.getElementsByClassName("page_color");
// 	for (let i = 0; i < page_colors.length; i++) {
// 		page_colors[i].addEventListener("click", function() {
// 			let current = document.getElementsByClassName("active");
// 			$('li').removeClass("active");
// 	          this.className += " active";
// 	          const id = $(this).val();
// 	          console.log(id)

// 			console.log(id);

// 		});
// 	}
// 	$('.pre').click(function() {
// 		let header = document.getElementById("page_parent");
// 		let active = header.getElementsByClassName('active');
// 		const id = $('.active').val();
// 		console.log(id)
// 	});
// });