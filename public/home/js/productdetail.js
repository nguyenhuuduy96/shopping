$(document).ready(function(){
    $('#cart_add').click(function(){
        let color = $('#color_p').val();
        let size_and_middle_id = $('#id_size_detail').val();
        let cartColor = color.split(" ")[1];
        let size = size_and_middle_id.split(" ")[0];
        let middle_id = size_and_middle_id.split(" ")[1];
        let cartImage = $('#cartImage').val();
        let product_name = $('#product_detail_name').val();
        let price = $('#priceCart').val();
        console.log(size,cartColor,middle_id,cartImage,product_name,price)
        // return false;
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
            url:'../cart/add',
            type:'post',
            data:{_token:CSRF_TOKEN,middle_id:middle_id,
                image:cartImage,size:size,
                name:product_name,
                color:cartColor,price:price},
            success:function(data){
                
                
                let showcart = '';
                console.log(data.carts['1']);
                for(const cart in data.carts){
                    // console.log(cart)
                    // console.log(data.carts[cart].price)
                    // return false;
                const price =new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data.carts[cart].price);
                showcart +=`<li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="`+data.carts[cart].attributes.image+`" alt="IMG">
                        </div>
                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                `+data.carts[cart].name+`<p>`+data.carts[cart].attributes.color+` - `+data.carts[cart].attributes.size+`</p>
                            </a>
                            <span class="header-cart-item-info">
                                `+data.carts[cart].quantity+` x `+price+`
                            </span>
                        </div>
                        <button class="text-danger" onclick="deleteCart(this,`+data.carts[cart].id+`)">
                            <i class="fas fa-trash-alt"></i>
                        </button>      
                        
                    </li>`;

                }
                
                $('#cartshow').html(showcart);
                 $('.js-modal1').removeClass('show-modal1');
                 $('.js-panel-cart').addClass('show-header-cart');
                console.log(data)
            }


        })
    })
})