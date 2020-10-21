$(document).ready(function() {
    $('#cart_add').click(function() {
        let color = $('#color_p').val();
        let size_and_middle_id = $('#id_size_detail').val();
        let cartColor = color.split(" ")[1];
        let size = size_and_middle_id.split(" ")[0];
        let middle_id = size_and_middle_id.split(" ")[1];
        let cartImage = $('#cartImage').val();
        let product_name = $('#product_detail_name').val();
        let price = $('#priceCart').val();
        let product_id = $('#product_detail_id').val();
        let slug = $('#product_detail_slug').val();
        console.log(size, cartColor, middle_id, cartImage, product_name, price)
            // return false;
        if (color == '') {
            $('.error_color_qv').html('vui long chon!');
            $('.error_color_qv').css('display', 'block');
            return false;
        } else {
            $('.error_color_qv').css('display', 'none');
        }
        if (size_and_middle_id == '') {
            $('.error_size_qv').html('vui long chon!');
            $('.error_size_qv').css('display', 'block');
            return false;
        } else {
            $('.error_size_qv').css('display', 'none');
        }
        // console.log(price,cartImage,size,middle_id,cartColor,product_name)
        // return false;
        $.ajax({
            url: '../cart/add',
            type: 'post',
            data: {
                _token: CSRF_TOKEN,
                middle_id: middle_id,
                image: cartImage,
                size: size,
                name: product_name,
                color: cartColor,
                price: price,
                product_id: product_id,
                slug: slug
            },
            success: function(data) {


                let showcart = '';
                console.log(data.carts['1']);
                for (const cart in data.carts) {
                    // console.log(cart)
                    // console.log(data.carts[cart].price)
                    // return false;
                    const price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.carts[cart].price);
                    showcart += `<li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="` + data.carts[cart].attributes.image + `" alt="IMG">
                        </div>
                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                ` + data.carts[cart].name + `<p>` + data.carts[cart].attributes.color + ` - ` + data.carts[cart].attributes.size + `</p>
                            </a>
                            <span class="header-cart-item-info">
                                ` + data.carts[cart].quantity + ` x ` + price + `
                            </span>
                        </div>
                        <button class="text-danger" onclick="deleteCart(this,` + data.carts[cart].id + `)">
                            <i class="fas fa-trash-alt"></i>
                        </button>      
                        
                    </li>`;

                }

                const subtotal = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.subtotla);
                $('#cartshow').html(showcart);
                $('.header-cart-total').html('Total: ' + subtotal + '');
                $('.js-modal1').removeClass('show-modal1');
                $('.js-panel-cart').addClass('show-header-cart');
                console.log(data)
            }


        })
    })
})
$(document).ready(function() {
    $('#color_p').change(function() {
        let color = $('#color_p').val();
        let color_id = color.split(' ')[0];
        let product_id = $('#product_detail_id').val();
        $.ajax({
            url: '../get-size-quick-view',
            type: 'post',
            data: { _token: CSRF_TOKEN, product_id: product_id, color_id: color_id },
            success: function(data) {
                console.log(data.data)
                let list_sizes = `<option value="">Choose an option</option>`;
                for (const x of data.data) {
                    if (x.stock < 1) {
                        list_sizes += `<option value="` + x.size.size + " " + x.middle_id + `" disabled>` + " hết size " + x.size.size + `</option>`
                    } else {
                        list_sizes += `<option value="` + x.size.size + " " + x.middle_id + `">` + x.size.size + `</option>`
                    }
                }
                $('#id_size_detail').html(list_sizes)
                    // let color_list='<option value="">Choose an option</option>';
                    // for(const x of data.colors){
                    //     color_list +='<option value="'+x.color_id+" "+x.color+'">'+x.color+'</option>'
                    // }
            }
        })
    })
    $('#id_size_detail').change(function() {
        let id_size_detail = $('#id_size_detail').val();
        let middle_id = id_size_detail.split(" ")[1];
        $.ajax({
            url: '../get-quick-view-price-size',
            method: 'get',
            data: { id: middle_id },
            success: function(data) {
                console.log(data)
                const price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.price.price);
                // console.log(data.price);
                const showprice = `<input type="hidden" id="priceCart" name="priceCart" value="` + data.price.price + `">price`;
                $('#price_detail').html(showprice);
                // console.log(data.id);
            }
        })
    })
})

function deleteCart(link, id) {
    $.ajax({
            url: '../cart/delete',
            type: 'post',
            data: { _token: CSRF_TOKEN, id: id },
            success: function(data) {
                // console.log(data)
                console.log('success')
                link.parentNode.parentNode.removeChild(link.parentNode);
            }
        })
        // return false;

}