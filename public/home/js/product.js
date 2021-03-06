window.addEventListener('load', function() {
        let show = document.getElementById('count-show-product').value;
        let slug = document.getElementById('slug_cate').value;
        let search = document.getElementById('search-product').value;
        // console.log(slug)
        getAjaxPageAndProduct(slug, show, search)
    })
    //get functin products
function getAjaxProduct(page, slug, show, search) {
    $.ajax({
        url: '../get-page-product',
        type: 'GET',
        data: { page: page, slug: slug, show: show, search: search },
        success: function(data) {
            // console.log(data)
            showHtmlProduct(data.showProductPage)
        }

    })
}
// show html product
function showHtmlProduct(products) {
    // console.log(products)
    let show = ``;
    for (const product of products) {
        // console.log(product)
        // return false;
        const image = product.image.length > 0 ? product.image[0].image : '../../../img/default.jpg';
        const price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(product.price[0].price);
        show += `<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                    <div class="block2-pic hov-img0">
                    
                    <img src="` + image + `" alt="IMG-PRODUCT">

                    <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 Quick_View" id="` + product.id + `" onclick="modalQV(` + product.id + `)">
                    Quick View
                    </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                    <a href="../detail-product/` + product.slug + `" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                    ` + product.name + `
                    </a>

                    <span class="stext-105 cl3" id="home_price">
                    ` + price + `
                    </span>
                    </div>

                    <div class="block2-txt-child2 flex-r p-t-3">
                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                    <img class="icon-heart1 dis-block trans-04" src="../../home/images/icons/icon-heart-01.png" alt="ICON">
                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="../../home/images/icons/icon-heart-02.png" alt="ICON">
                    </a>
                    </div>
                    </div>
                    </div>
                    </div>`
        $('.isotope-grid').html(show);
        $('.js-show-modal1').on('click', function(e) {
            e.preventDefault();
            $('.js-modal1').addClass('show-modal1');
        });
    }
}
//search keyup
$(document).ready(function() {
    $('#search-product').keyup(function(e) {
        let show = $('#count-show-product').val();
        let slug = document.getElementById('slug_cate').value;
        let search = $('#search-product').val();

        // console.log(search);
        getAjaxPageAndProduct(slug, show, search);
    });
});
// số lượng sản phẩm hiển thị trên 1 page
$(document).ready(function() {
        let showProduct = document.getElementById('count-show-product');
        showProduct.addEventListener('change', function() {
            let show = showProduct.value;
            let slug = document.getElementById('slug_cate').value;
            let search = $('#search-product').val();
            let page = null;
            // console.log(show);
            getAjaxPageAndProduct(slug, show, search);
        })
    })
    // get ajax count page and product
function getAjaxPageAndProduct(slug, show, search) {
    // console.log(show, slug, search);
    $.ajax({
        url: '../get-page-product',
        type: 'GET',
        data: { slug: slug, show: show, search: search },
        success: function(data) {
            // console.log(show, slug, search);
            // console.log(data.cate)
            // console.log(data.showProductPage)
            let showPagaLink = `<nav >
        <ul class="pagination" id="product_page">
        <li class="page-item disabled pre" aria-disabled="true" aria-label="« Previous">
        <span class="page-link" aria-hidden="true">‹</span>
        </li>
        <li class="page-item page active" value="1"  aria-current="page"><span class="page-link">1</span></li> `;
            if (data.totalPage >= 2) {
                for (var i = 2; i <= data.totalPage; i++) {
                    showPagaLink += `<li class="page-item page" value="` + i + `"  aria-current="page"><span class="page-link">` + i + `</span></li> `;
                }
            }
            showPagaLink += ` <li class="page-item next">
        <a class="page-link" rel="next" aria-label="Next »">›</a>
        </li>
        </ul>
        </nav>`;
            showHtmlProduct(data.showProductPage)
            $('.total-page').html(showPagaLink)
            let product_page = document.getElementById('product_page');
            let pages = product_page.getElementsByClassName('page');
            for (let i = 0; i < pages.length; i++) {
                pages[i].addEventListener("click", function() {

                    $('li').removeClass("active");
                    this.className += " active";
                    const id = $(this).val();
                    // console.log(id)
                    let page = id;
                    getAjaxProduct(page, slug, show, search)


                });
            }
            $('.pre').click(function() {
                const id = $('.active').val();
                const i = id - 2 < 0 ? 0 : id - 2;
                $('li').removeClass("active");

                pages[i].className += " active";

                // console.log(id)
                let page = id - 1;
                getAjaxProduct(page, slug, show, search)
            });


            $('.next').click(function() {

                const id = $('.active').val();
                const i = id;
                $('li').removeClass("active");

                pages[i].className += " active";
                let page = id + 1;
                console.log(i)
                getAjaxProduct(page, slug, show, search)
            });

        }

    })
}





function modalQV(id) {

    $.ajax({
        url: '../getQuickView',
        method: 'get',
        data: { id: id },
        success: function(data) {
            // console.log(data.cartImage);
            // console.log(data.id)
            const imageCart = data.cartImage == '' ? '/img/default.jpg' : data.cartImage[0].image;
            // console.log(imageCart)
            // return false;
            const name = `<input type="hidden" name="product_id" class="product_id" value="` + data.product.id + `">
                <input type="hidden" name="slug" class="slug" value="` + data.product.slug + `">
                <input type="hidden" name="product_name" id="product_name" value="` + data.product.name + `">
                <input type="hidden" name="cartImage" id="cartImage" value="` + imageCart + `">` + data.product.name + ``;
            $('.js-name-detail').html(name);
            const price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.price);
            $('#price').html(price);
            let color_list = '<option value="">Choose an option</option>';
            for (const x of data.colors) {

                color_list += '<option value="' + x.color_id + " " + x.color + '">' + x.color + '</option>'
            }
            // console.log(color_list);
            $('#color').html(color_list);
            $('#size_id').html('<option value="">Choose an option</option>')
            let show_image_view = '';
            if (data.image == '') {
                const imagenull = '/img/default.jpg';
                // console.log(imagenull)
                // return false;
                show_image_view +=
                    `<div class="item-slick3" data-thumb="` + imagenull + `">
                            <div class="wrap-pic-w pos-relative">
                            <img src="` + imagenull + `" alt="IMG-PRODUCT">

                            <a class="flex-c-m size-108 fs-16 cl10 bg0 hov-btn3 trans-04" href="` + imagenull + `">

                            </a>
                            </div>
                            </div>`;

            } else {
                for (const x of data.image) {
                    show_image_view += `<div class="item-slick3" data-thumb="` + x.image + `">
                                <div class="wrap-pic-w pos-relative">
                                <img src="` + x.image + `" alt="IMG-PRODUCT">

                                <a class="flex-c-m size-108 fs-16 cl10 bg0 hov-btn3 trans-04" href="` + x.image + `">

                                </a>
                                </div>
                                </div>`;
                }
            }

            $('.images_quick_view').html(`<div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                            ` + show_image_view + `
                            </div>
                            `);

            $('.wrap-slick3').each(function() {
                $(this).find('.slick3').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 6000,

                    arrows: true,
                    appendArrows: $(this).find('.wrap-slick3-arrows'),
                    prevArrow: '<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                    nextArrow: '<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                    dots: true,
                    appendDots: $(this).find('.wrap-slick3-dots'),
                    dotsClass: 'slick3-dots',
                    customPaging: function(slick, index) {
                        var portrait = $(slick.$slides[index]).data('thumb');
                        return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                    },
                });
            });

            $('.js-show-modal1').on('click', function(e) {
                e.preventDefault();
                $('.js-modal1').addClass('show-modal1');
            });

            $('.js-hide-modal1').on('click', function() {
                $('.js-modal1').removeClass('show-modal1');
            });



        }
    })
}


$('#color').change(function() {
    let product_id = $('.product_id').val();
    let color_id = $('#color').val();
    let array = color_id.split(' ');
    // console.log(product_id,array[0],CSRF_TOKEN);
    $.ajax({
        url: '../get-size-quick-view',
        type: 'post',
        data: { _token: CSRF_TOKEN, product_id: product_id, color_id: array[0] },
        success: function(data) {
            // console.log(data.data)
            let list_sizes = `<option value="">Choose an option</option>`;
            for (const x of data.data) {
                if (x.stock < 1) {
                    list_sizes += `<option value="` + x.size.size + " " + x.middle_id + `" disabled>` + " hết size " + x.size.size + `</option>`
                } else {
                    list_sizes += `<option value="` + x.size.size + " " + x.middle_id + `">` + x.size.size + `</option>`
                }
            }
            $('#size_id').html(list_sizes)
                // let color_list='<option value="">Choose an option</option>';
                // for(const x of data.colors){
                //     color_list +='<option value="'+x.color_id+" "+x.color+'">'+x.color+'</option>'
                // }
        }
    })
})
$('#size_id').change(function() {
    let size = $('#size_id').val();
    let id_size = size.split(' ')[1];
    // console.log(id_size)
    $.ajax({
        url: '../get-quick-view-price-size',
        method: 'get',
        data: { id: id_size },
        success: function(data) {
            // console.log(data)
            const price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.price.price);
            // console.log(data.price);
            const showprice = '<input type="hidden" name="price" id="priceCart" value="' + data.price.price + '">' + price;
            $('#price').html(showprice);
            // console.log(data.id);
        }
    })
})


// cart
$(document).ready(function() {
    $('#cart_add_quick_view').click(function() {
        let color = $('#color').val();
        let size_and_middle_id = $('#size_id').val();
        let cartColor = color.split(" ")[1];
        let size = size_and_middle_id.split(" ")[0];
        let middle_id = size_and_middle_id.split(" ")[1];
        let cartImage = $('#cartImage').val();
        let product_name = $('#product_name').val();
        let price = $('#priceCart').val();
        let product_id = $('.product_id').val();
        let slug = $('.slug').val();
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

                $('.js-show-cart').attr('data-notify', data.countCart)
                let showcart = '';
                // console.log(data.carts['1']);
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

function deleteCart(link, id) {
    console.log(event)
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