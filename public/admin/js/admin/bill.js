window.onload = function() {
    $("#example1_filter").html(
        '<label>Search:<input type="search" id="searh_product" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>'
    );
    let search = $("#searh_phone").val();
    let show = $("#show").val();
    getAjaxPageAndBill(search, show);
};
var phone_regex = /(03|07|08|09|01[2|6|8|9])+([0-9]{8})\b/;
// search keyup product seclect 2
$(document).ready(function() {
    $("#searh_phone").on("keyup", function() {
        let search = $("#searh_phone").val();
        let show = $("#show").val();
        // if (phone_regex.test(search) == false) {
        //     $('.error_phone').html('vui lòng nhập đúng phone!');
        //     $('.error_phone').css('display', 'block');
        // } else if (phone_regex.test(search) == true) {
        //     $('.error_phone').css('display', 'none');
        //     getAjaxPageAndBill(search, show);
        //     return false;
        // }
        // window.onload = function() {
        //     getAjaxPageAndBill(search, show);
        // }
        getAjaxPageAndBill(search, show);
        console.log(search, show);

    });
});
//get ajax page and product
function getAjaxPageAndBill(search, show) {
    $.ajax({
        url: "../../api/bill/get-ajax-bill-page",
        method: "get",
        data: { search: search, show: show },
        success: function(data) {
            console.log(data);
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
            showHtmlBill(data.bills);
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
                        url: "../../api/bill/get-ajax-bill-page",
                        method: "get",
                        data: { search: search, show: show, paga: page },
                        success: function(data) {
                            console.log(data.skip);
                            console.log(data.bills);
                            showHtmlBill(data.bills);
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
                    url: "../../api/bill/get-ajax-bill-page",
                    method: "get",
                    data: { search: search, show: show, paga: page },
                    success: function(data) {
                        console.log(data.skip);
                        console.log(data.bills);
                        showHtmlBill(data.bills);
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
                        url: "../../api/bill/get-ajax-bill-page",
                        method: "get",
                        data: { search: search, show: show, paga: page },
                        success: function(data) {
                            console.log(data.skip);
                            console.log(data.bills);
                            showHtmlBill(data.bills);
                        },
                    });
                }
            });
        },
    });
}

// show html product
function showHtmlBill(bills) {
    let showsearch = ``;
    for (const x of bills) {
        const price = new Intl.NumberFormat("de-DE", {
            style: "currency",
            currency: "VND",
        }).format(x.total);
        showsearch +=
            `<tr>
                <th>
                <a href="./detail/` +
            x.bill_code +
            `">
                ` +
            x.bill_code +
            `</a>
                </th>
                <th>` +
            x.created_at +
            `</th>
                <th>` +
            price +
            `</th>
                <th>` +
            x.status.name +
            `</th>
        <th>
            <a class="btn btn-primary"
                onclick="confirmBill(this,` +
            x.id +
            `,` +
            x.status.name +
            `)">
                Xác nhận đơn</a>
            <a class="btn btn-danger"
                onclick="cancelBill(this,` +
            x.id +
            `,` +
            x.status.name +
            `)">Hủy
                đơn</a>
        </th>
    </tr>`;
        // `<tr><td>` +
        // x.id +
        //     `</td>
        // 			<td>` +
        //     x.name +
        //     `</td>
        // 			<td>` +
        //     x.source +
        //     `</td>
        // 			<td>` +
        //     x.time_expired +
        //     `</td>
        // 			<td><a class="btn btn-app" class="btn btn-success" data-toggle="modal" data-target="#ModalProduct"
        // 			id="updateProduct" onclick="onclickupdate(this,` +
        //     x.id +
        //     `)">
        // 			<i class="fa fa-edit text-primary"></i>Edit</a></td>
        // 			<td><a class="btn btn-app" class="btn btn-success" id="deleteRow" onclick="tabledeleteProduct(this,` +
        //     x.id +
        //     `)">
        // 			<i class="fas fa-trash-alt text-danger"></i>delete</a>
        // 			</td>
        // 			</tr>`;
    }
    // console.log(showsearch)
    $("#search_Show").html(showsearch);
}

function confirmBill(r, id, status_id) {
    let rowid = r.parentNode.parentNode.rowIndex;
    let tableBill = document.getElementById("tablebill");
    console.log(CSRF_TOKEN);
    if (status_id > 2) {
        alert(
            "đơn hàng đã hoàn thành hoặc bị hủy không thể xác nhận đơn được!"
        );
        return false;
    }
    $.ajax({
        url: "./confirm",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            id: id,
        },
        success: function(data) {
            console.log(data.bill);
            console.log(data.status);
            const cells = tableBill.rows[rowid].cells;

            cells[3].innerHTML = data.status.name;
            cells[4].innerHTML =
                `
      <a class="btn btn-danger" onclick="cancelBill(this,` +
                data.bill.id +
                `)">Cancel</a>`;
        },
    });
}

function cancelBill(r, id, status_id) {
    let rowid = r.parentNode.parentNode.rowIndex;
    let tableBill = document.getElementById("tablebill");
    console.log(CSRF_TOKEN);
    if (status_id > 3) {
        alert("đơn hàng đã hoàn thành không thể hủy đơn được!");
        return false;
    }
    $.ajax({
        url: "./cancel",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            id: id,
        },
        success: function(data) {
            console.log(data.bill);
            console.log(data.status);
            const cells = tableBill.rows[rowid].cells;

            cells[3].innerHTML = data.status.name;
            cells[4].innerHTML = `
      `;
        },
    });
}