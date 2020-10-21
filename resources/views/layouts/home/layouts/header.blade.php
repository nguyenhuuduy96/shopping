<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>

                <div class="right-top-bar flex-w h-full">
                    @if(Auth::check() )
                        @if(Auth::user()->is_active > 1))
                        <a href="{{route('admin.dashboard')}}" class="flex-c-m trans-04 p-lr-25">
                            Admin
                        </a>
                        @endif
                    <a href="{{route('member')}}" class="flex-c-m trans-04 p-lr-25">
                        {{Auth::user()->name}}
                    </a>

                    <a href="{{route('logout')}}" class="flex-c-m trans-04 p-lr-25">
                        Logout
                    </a>
                    @else
                    <a href="{{route('login')}}" class="flex-c-m trans-04 p-lr-25">
                        Login
                    </a>

                    <a href="{{route('register')}}" class="flex-c-m trans-04 p-lr-25">
                        Register
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->       
                <a href="/" class="logo col-sm-2">
                    <h1>Shop Fashion</h1>
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="/">Trang chủ</a>
                        </li>

                       
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{route('home.product')}}"  >
                                Sản phẩm
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right child">
                                @foreach ($ProductCates as $cate)
                                <li>
                                    <a class="dropdown-item  
                                    @if (count($cate->cates)>=1) dropdown-toggle @endif
                                    " href="{{route('home.product',$cate->slug)}}"> 
                                        {{$cate->name}}  </a>
                                        @if (count($cate->cates)>0)
                                        <ul class="submenu submenu-right dropdown-menu">
                                            @foreach ($cate->cates as $item)
                                                <li><a class="dropdown-item" href="{{route('home.product',$item->slug)}}">{{$item->name}}</a></li>
                                            @endforeach 
                                            
                                        </ul> 
                                        @endif
                                        
                                        
                                </li>
                                @endforeach
                              
                            </ul>
                        </li>
                        
                        <li>
                            <a href="{{route('home.blog')}}">Tin Tức</a>
                        </li>

                        

                        <li>
                        <a href="{{route('contact')}}">Liên hệ</a>
                        </li>
                        <li>
                            <a href="{{route('check.bill.home')}}">Kiểm tra đơn</a>
                        </li>
                    </ul>
                </div>  
                <form class="input-group col-sm-3" action="{{route('home.product')}}" method="GET">
                  <input class="form-control my-0 py-1 red-border" type="text" name="SearchProduct"  placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                        aria-hidden="true"></i></button>
                    </div>
                </form>
                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                  

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            </nav>
        </div>


    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->        
        <div class="logo-mobile">
            <h1>Shopping</h1>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    @if(!empty(Auth::user()))
                    <a href="{{route('list.product')}}" class="flex-c-m trans-04 p-lr-25">
                        Admin
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        {{Auth::user()->name}}
                    </a>

                    <a href="{{route('logout')}}" class="flex-c-m trans-04 p-lr-25">
                        Logout
                    </a>
                    @else
                    <a href="{{route('login')}}" class="flex-c-m trans-04 p-lr-25">
                        Login
                    </a>

                    <a href="{{route('register')}}" class="flex-c-m trans-04 p-lr-25">
                        Register
                    </a>
                    @endif
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="/">Trang chủ</a>
            </li>

            <li>
                <a href="{{route('home.product')}}">Sản phẩm</a>
            </li>

            <li>
                <a href="#">Tin Tức</a>
            </li>

            

            <li>
                <a href="#">Liên hệ</a>
            </li>
            <li>
                <a href="{{route('check.bill.home')}}">Kiểm tra đơn</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{asset('home/images/icons/icon-close2.png')}}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>