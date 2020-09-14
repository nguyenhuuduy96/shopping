var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 $(document).ready(function () {
        $('.Quick_View').click(function(){
            let id = $(this).attr('id');
            $.ajax({
                url:'getQuickView',
                method:'get',
                data:{id:id},
                success:function(data){
                    console.log(data.cartImage);
                    // console.log(data.id)
                    const imageCart= data.cartImage == '' ? '/img/default.jpg' :data.cartImage[0].image;
                    // console.log(imageCart)
                    // return false;
                    const name = `<input type="hidden" name="product_id" class="product_id" value="`+data.product.id+`">
                    <input type="hidden" name="product_name" id="product_name" value="`+data.product.name+`">
                    <input type="hidden" name="cartImage" id="cartImage" value="`+imageCart+`">`+data.product.name+``;
                    $('.js-name-detail').html(name);
                    const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.price);
                    $('#price').html(price);
                    let color_list='<option value="">Choose an option</option>';
                    for(const x of data.colors){

                        color_list +='<option value="'+x.color_id+" "+x.color+'">'+x.color+'</option>'
                    }
                    // console.log(color_list);
                    $('#color').html(color_list);
                    $('#size_id').html('<option value="">Choose an option</option>')
                    let show_image_view='';
                    if (data.image=='') {
                                const imagenull= '/img/default.jpg';
                                // console.log(imagenull)
                                // return false;
                                show_image_view+= 
                               `<div class="item-slick3" data-thumb="`+imagenull+`">
                                                <div class="wrap-pic-w pos-relative">
                                                    <img src="`+imagenull+`" alt="IMG-PRODUCT">

                                                    <a class="flex-c-m size-108 fs-16 cl10 bg0 hov-btn3 trans-04" href="`+imagenull+`">
                                                       
                                                    </a>
                                                </div>
                                </div>`;
                              
                            }else{
                                for(const x of data.image){

                                   show_image_view+= 
                                   `<div class="item-slick3" data-thumb="`+x.image+`">
                                                    <div class="wrap-pic-w pos-relative">
                                                        <img src="`+x.image+`" alt="IMG-PRODUCT">
                                            
                                                        <a class="flex-c-m size-108 fs-16 cl10 bg0 hov-btn3 trans-04" href="`+x.image+`">
                                                           
                                                        </a>
                                                    </div>
                                    </div>`;
                                }
                     }
                  
                    $('.images_quick_view').html(`
                            <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                   `+show_image_view+`
                                </div>
                        `);
                       


                        $('.wrap-slick3').each(function(){
                            $(this).find('.slick3').slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                fade: true,
                                infinite: true,
                                autoplay: false,
                                autoplaySpeed: 6000,

                                arrows: true,
                                appendArrows: $(this).find('.wrap-slick3-arrows'),
                                prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                                nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                                dots: true,
                                appendDots: $(this).find('.wrap-slick3-dots'),
                                dotsClass:'slick3-dots',
                                customPaging: function(slick, index) {
                                    var portrait = $(slick.$slides[index]).data('thumb');
                                    return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                                },  
                            });
                        });

                         $('.js-show-modal1').on('click',function(e){
                                e.preventDefault();
                                $('.js-modal1').addClass('show-modal1');
                            });

                            $('.js-hide-modal1').on('click',function(){
                                $('.js-modal1').removeClass('show-modal1');
                            });



                }
            })
        })
        $('#color').change(function(){
            let product_id = $('.product_id').val();
            let color_id = $('#color').val();
            let array = color_id.split(' ');
            // console.log(product_id,array[0],CSRF_TOKEN);
            $.ajax({
                url:'get-size-quick-view',
                type:'post',
                data:{_token:CSRF_TOKEN,product_id:product_id,color_id:array[0]},
                success:function(data){
                    // console.log(data.data)
                    let list_sizes =`<option value="">Choose an option</option>`;
                    for(const x of data.data){
                        if (x.stock<1) {
                            list_sizes+=`<option value="`+x.size.size+" "+x.middle_id+`" disabled>`+" hết size "+x.size.size+`</option>`
                        }else{
                            list_sizes+=`<option value="`+x.size.size+" "+x.middle_id+`">`+x.size.size+`</option>`
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
        $('#size_id').change(function(){
           let size= $('#size_id').val();
           let id_size=size.split(' ')[1];
           // console.log(id_size)
            $.ajax({
                url:'get-quick-view-price-size',
                method:'get',
                data:{id:id_size},
                success:function(data){
                    // console.log(data)
                    const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.price.price);
                    // console.log(data.price);
                    const showprice= '<input type="hidden" name="price" id="priceCart" value="'+data.price.price+'">'+price;
                    $('#price').html(showprice);
                    // console.log(data.id);
                }
            })
        })

})
// cart
$(document).ready(function(){
    $('#cart_add_quick_view').click(function(){
        let color = $('#color').val();
        let size_and_middle_id = $('#size_id').val();
        let cartColor = color.split(" ")[1];
        let size = size_and_middle_id.split(" ")[0];
        let middle_id = size_and_middle_id.split(" ")[1];
        let cartImage = $('#cartImage').val();
        let product_name = $('#product_name').val();
        let price = $('#priceCart').val();
        if (color=='') {
            $('.error_color_qv').html('vui long chon!');
            $('.error_color_qv').css('display','block');
            return false;
        }else{
          $('.error_color_qv').css('display','none');  
        }
        if (size_and_middle_id=='') {
            $('.error_size_qv').html('vui long chon!');
            $('.error_size_qv').css('display','block');
            return false;
        }else{
          $('.error_size_qv').css('display','none');  
        }
        // console.log(price,cartImage,size,middle_id,cartColor,product_name)
        // return false;
        $.ajax({
            url:'cart/add',
            type:'post',
            data:{_token:CSRF_TOKEN,middle_id:middle_id,
                image:cartImage,size:size,
                name:product_name,
                color:cartColor,price:price},
            success:function(data){
                const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.cart.price);
                const cart = `<li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="`+data.cart.attributes.image+`" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                `+data.cart.name+`
                            </a>

                            <span class="header-cart-item-info">
                                `+data.cart.quantity+` x `+price+`
                            </span>
                        </div>
                        <button class="text-danger" onclick="deleteCart(this,`+data.cart.id+`)">
                            <i class="fas fa-trash-alt"></i>
                        </button> 
                            
                        
                    </li>`;
                $('#cartshow').append(cart)
                console.log(data)
            }


        })
    })
})
//onchange detail price product
$(document).ready(function(){
    $('#color_p').change(function(){
        let color= $('#color_p').val();
        let color_id = color.split(' ')[0];
        let product_id = $('#product_detail_id').val();
        $.ajax({
                url:'../get-size-quick-view',
                type:'post',
                data:{_token:CSRF_TOKEN,product_id:product_id,color_id:color_id},
                success:function(data){
                    console.log(data.data)
                    let list_sizes =`<option value="">Choose an option</option>`;
                    for(const x of data.data){
                        if (x.stock<1) {
                            list_sizes+=`<option value="`+x.size.size+" "+x.middle_id+`" disabled>`+" hết size "+x.size.size+`</option>`
                        }else{
                            list_sizes+=`<option value="`+x.size.size+" "+x.middle_id+`">`+x.size.size+`</option>`
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
    $('#id_size_detail').change(function(){
        let id_size_detail= $('#id_size_detail').val();
        let middle_id = id_size_detail.split(" ")[1];
        $.ajax({
                url:'../get-quick-view-price-size',
                method:'get',
                data:{id:middle_id},
                success:function(data){
                    console.log(data)
                    const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.price.price);
                    // console.log(data.price);
                    $('#price_detail').html(price);
                    // console.log(data.id);
                }
        })
    })
})
//search product
$(document).ready(function(){
    $('#search-product').on('keyup',function(){
    var search = $(this).val();
    console.log(search);
    $.ajax({
        url:"search-product-home",
        method:"get",
        data:{search:search},
        success:function(data){
                console.log(data.products);
                                // let listsearch ="";
                let showsearch = ``;
                for (const x of data.products) {
                    const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(x.price);
        showsearch+=`<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="`+x.image+`" alt="IMG-PRODUCT">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 Quick_View" id="`+x.id+`">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    `+x.name+`
                                </a>

                                <span class="stext-105 cl3">
                                    `+price+`
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04" src="home/images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="home/images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`
                }
                $('.isotope-grid').html(showsearch);
                  $('.js-show-modal1').on('click',function(e){
                                e.preventDefault();
                                $('.js-modal1').addClass('show-modal1');
                            });

                            $('.js-hide-modal1').on('click',function(){
                                $('.js-modal1').removeClass('show-modal1');
                            });
                $('.Quick_View').click(function(){
            let id = $(this).attr('id');
            $.ajax({
                url:'getQuickView',
                method:'get',
                data:{id:id},
                success:function(data){
                    console.log(data.colors);
                    // console.log(data.id)
                    const name = `<input type="hidden" name="product_id" class="product_id" value="`+data.product.id+`">
                    <input type="hidden" name="product_name" id="product_name" value="`+data.product.name+`">`+data.product.name+``;
                    $('.js-name-detail').html(name);
                    const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.price);
                    $('#price').html(price);
                    let color_list='<option value="">Choose an option</option>';
                    for(const x of data.colors){

                        color_list +='<option value="'+x.color_id+" "+x.color+'">'+x.color+'</option>'
                    }
                    // console.log(color_list);
                    $('#color').html(color_list);
                    let show_image_view='';
                    if (data.image=='') {
                                const imagenull= '/img/default.jpg';
                                // console.log(imagenull)
                                // return false;
                                show_image_view+= 
                               `<div class="item-slick3" data-thumb="`+imagenull+`">
                                                <div class="wrap-pic-w pos-relative">
                                                    <img src="`+imagenull+`" alt="IMG-PRODUCT">

                                                    <a class="flex-c-m size-108 fs-16 cl10 bg0 hov-btn3 trans-04" href="`+imagenull+`">
                                                       
                                                    </a>
                                                </div>
                                </div>`;
                              
                            }else{
                                for(const x of data.image){

                                   show_image_view+= 
                                   `<div class="item-slick3" data-thumb="`+x.image+`">
                                                    <div class="wrap-pic-w pos-relative">
                                                        <img src="`+x.image+`" alt="IMG-PRODUCT">

                                                        <a class="flex-c-m size-108 fs-16 cl10 bg0 hov-btn3 trans-04" href="`+x.image+`">
                                                           
                                                        </a>
                                                    </div>
                                    </div>`;
                                }
                     }
                  
                    $('.images_quick_view').html(`
                            <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                   `+show_image_view+`
                                </div>
                        `);
                       


                        $('.wrap-slick3').each(function(){
                            $(this).find('.slick3').slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                fade: true,
                                infinite: true,
                                autoplay: false,
                                autoplaySpeed: 6000,

                                arrows: true,
                                appendArrows: $(this).find('.wrap-slick3-arrows'),
                                prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                                nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                                dots: true,
                                appendDots: $(this).find('.wrap-slick3-dots'),
                                dotsClass:'slick3-dots',
                                customPaging: function(slick, index) {
                                    var portrait = $(slick.$slides[index]).data('thumb');
                                    return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                                },  
                            });
                        });

                       



                        }
                    })
                })
                        
            }
        })
    })
})
function deleteCart(link,id){
    console.log(event)
    $.ajax({
        url:'cart/delete',
        type:'post',
        data:{_token:CSRF_TOKEN,id:id},
        success:function(data){
            // console.log(data)
            console.log('success')
            link.parentNode.parentNode.removeChild(link.parentNode);
        }
    })
    // return false;
    
}

