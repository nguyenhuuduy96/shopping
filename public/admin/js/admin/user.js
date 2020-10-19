var tableUser = document.getElementById('example1');

function save(event, id) {
    let rowId = event.parentNode.parentNode.rowIndex;

    const cells = tableUser.rows[rowId].cells;
    let is_active = cells[4].children[0].value;
    // console.log(is_active)
    if (is_active !== '') {
        $.ajax({
            type: "post",
            url: "decentralization",
            data: { id: id, is_active: is_active, _token: CSRF_TOKEN },
            success: function(data) {
                // console.log(data)
                if (data.error !== '') {
                    alert(data.error);
                    return false;
                }

                const decentralization = data.decentralization == '' ? null : data.decentralization.name;
                cells[5].innerHTML = `<p class="btn btn-primary">` + decentralization + `</p>`;
                alert('cấp quyền thành công!')
            }
        });
    }
}