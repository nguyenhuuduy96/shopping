 <div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full" id="cartshow">
                @foreach($carts as $cart)
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="{{$cart->attributes['image']}}" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-0">
                        <a href="#" class="header-cart-item-name m-b-2 hov-cl1 trans-04">
                            {{$cart->name}} <p>{{$cart->attributes['color']}} - {{$cart->attributes['size']}}</p>
                        </a>

                        <span class="header-cart-item-info">
                            {{$cart->quantity}} x {{ number_format($cart->price, 0, '.', '.') }}&nbsp;₫
                        </span>
                    </div>
                    <button class="text-danger" onclick="deleteCart(this,{{$cart->id}})">
                        <i class="fas fa-trash-alt"></i>
                    </button> 
                    
                    
                </li>
                @endforeach
                
            </ul>
            
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: {{ number_format($cartSubTotal, 0, '.', '.') }}&nbsp;₫
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="javascript:void(0)" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10 js-hide-cart">
                        continue buy
                    </a>

                    <a href="{{route('cart.show')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>