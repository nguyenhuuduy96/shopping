 // window.addEventListener('load', function(e) {
        
 //        $.ajax({
 //            url:'get-ajax-home',
 //            type:'get',
 //            success:function(data){
 //                console.log(data)
 //                let showhome='';
 //                for(const product of data.data){
 //                    const de = product.price[0]==null?'0':product.price[0].price;
 //                    const imagenull= '/img/default.jpg';
 //                    const image = product.image[0]==null?imagenull:product.image[0].image;
 //                    const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(de);
 //                    // console.log(imagenull,price)
 //                    // return false;
 //                    // const priceProduct = product.price[0].price;
                    
 //                    showhome+=`<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
 //                    <!-- Block2 -->
 //                    <div class="block2">
 //                        <div class="block2-pic hov-img0">
 //                            <img src="`+image+`" alt="IMG-PRODUCT">

 //                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 Quick_View" id="`+product.id+`">
 //                                Quick View
 //                            </a>
 //                        </div>

 //                        <div class="block2-txt flex-w flex-t p-t-14">
 //                            <div class="block2-txt-child1 flex-col-l ">
 //                                <a href="detail-product/`+product.id+`" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
 //                                    `+product.name+`
 //                                </a>

 //                                <span class="stext-105 cl3">
 //                                    `+price+`
 //                                </span>
 //                            </div>

                            
 //                        </div>
 //                    </div>
 //                </div>`;
 //                }
 //                $('#showhome').html(showhome);
 //                var $topeContainer = $('.isotope-grid');
 //                var $filter = $('.filter-tope-group');

 //                // filter items on button click
 //                $filter.each(function () {
 //                    $filter.on('click', 'button', function () {
 //                        var filterValue = $(this).attr('data-filter');
 //                        $topeContainer.isotope({filter: filterValue});
 //                    });
                    
 //                });

 //                // init Isotope
 //                $(window).on('load', function () {
 //                    var $grid = $topeContainer.each(function () {
 //                        $(this).isotope({
 //                            itemSelector: '.isotope-item',
 //                            layoutMode: 'fitRows',
 //                            percentPosition: true,
 //                            animationEngine : 'best-available',
 //                            masonry: {
 //                                columnWidth: '.isotope-item'
 //                            }
 //                        });
 //                    });
 //                });
 //                 $('.js-show-modal1').on('click',function(e){
 //                    e.preventDefault();
 //                    $('.js-modal1').addClass('show-modal1');
 //                });

 //                $('.js-hide-modal1').on('click',function(){
 //                    $('.js-modal1').removeClass('show-modal1');
 //                });
 //                $('.Quick_View').click(function(){
 //                    let id = $(this).attr('id');
 //                    $.ajax({
 //                        url:'getQuickView',
 //                        method:'get',
 //                        data:{id:id},
 //                        success:function(data){
 //                            console.log(data.colors);
 //                            // console.log(data.id)
 //                            const name = `<input type="hidden" name="product_id" class="product_id" value="`+data.product.id+`">
 //                            <input type="hidden" name="product_name" id="product_name" value="`+data.product.name+`">`+data.product.name+``;
 //                            $('.js-name-detail').html(name);
 //                            const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.price);
 //                            $('#price').html(price);
 //                            let color_list='<option value="">Choose an option</option>';
 //                            for(const x of data.colors){

 //                                color_list +='<option value="'+x.color_id+" "+x.color+'">'+x.color+'</option>'
 //                            }
 //                            // console.log(color_list);
 //                            $('#color').html(color_list);
 //                            let show_image_view='';
 //                            if (data.image=='') {
 //                                const imagenull= '/img/default.jpg';
 //                                show_image_view+= 
 //                               `<div class="item-slick3" data-thumb="`+imagenull+`">
 //                                                <div class="wrap-pic-w pos-relative">
 //                                                    <img src="`+imagenull+`" alt="IMG-PRODUCT">

 //                                                    <a class="flex-c-m size-108 fs-16 cl10 bg0 hov-btn3 trans-04" href="`+imagenull+`">
                                                       
 //                                                    </a>
 //                                                </div>
 //                                </div>`;
                              
 //                            }else{
 //                                for(const x of data.image){

 //                                   show_image_view+= 
 //                                   `<div class="item-slick3" data-thumb="`+x.image+`">
 //                                                    <div class="wrap-pic-w pos-relative">
 //                                                        <img src="`+x.image+`" alt="IMG-PRODUCT">

 //                                                        <a class="flex-c-m size-108 fs-16 cl10 bg0 hov-btn3 trans-04" href="`+x.image+`">
                                                           
 //                                                        </a>
 //                                                    </div>
 //                                    </div>`;
 //                                }
 //                            }
                          
 //                            $('.images_quick_view').html(`
 //                                    <div class="wrap-slick3-dots"></div>
 //                                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

 //                                        <div class="slick3 gallery-lb">
 //                                           `+show_image_view+`
 //                                        </div>
 //                                `);
                               


 //                                $('.wrap-slick3').each(function(){
 //                                    $(this).find('.slick3').slick({
 //                                        slidesToShow: 1,
 //                                        slidesToScroll: 1,
 //                                        fade: true,
 //                                        infinite: true,
 //                                        autoplay: false,
 //                                        autoplaySpeed: 6000,

 //                                        arrows: true,
 //                                        appendArrows: $(this).find('.wrap-slick3-arrows'),
 //                                        prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
 //                                        nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

 //                                        dots: true,
 //                                        appendDots: $(this).find('.wrap-slick3-dots'),
 //                                        dotsClass:'slick3-dots',
 //                                        customPaging: function(slick, index) {
 //                                            var portrait = $(slick.$slides[index]).data('thumb');
 //                                            return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
 //                                        },  
 //                                    });
 //                                });

 //                                 $('.js-show-modal1').on('click',function(e){
 //                                        e.preventDefault();
 //                                        $('.js-modal1').addClass('show-modal1');
 //                                    });

 //                                    $('.js-hide-modal1').on('click',function(){
 //                                        $('.js-modal1').removeClass('show-modal1');
 //                                    });



 //                            }
 //                        })
 //                })
 //            }
 //        })
 //    });