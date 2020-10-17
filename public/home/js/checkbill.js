$(document).ready(function() {

    $('#submit_phone').click(function() {
        console.log('sadasd')
        let search_phone = document.getElementById('search_phone').value;
        let tablecheckbill = document.getElementById('tablecheckbill');
        $.ajax({
            url: '../api/check-bill',
            type: 'POST',
            data: { phone: search_phone },
            success: function(data) {
                console.log(data)
                let list = '';
                // for(const bill of data.data.bills){
                //   console.log(bill);
                // }
                if (data == "") {
                    $('.error_check').html('không tìm thấy dữ liệu!');
                } else {

                    for (const bill of data.data.bills) {

                        const price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(bill.total);
                        const status = bill.status.name == null ? 'null' : bill.status.name;
                        list += `<tr>
                      <td><a href="check-out-seccess/` + bill.bill_code + `" title="">` + bill.bill_code + `</a></td>
                      <td>` + bill.created_at + `</td>
                      <td>` + status + `</td>
                      <td>` + price + `</td>
                    </tr>`;
                    }
                    // console.log(list)
                    $('#search_show_bill').html(list);
                }
            }
        })


    })
});