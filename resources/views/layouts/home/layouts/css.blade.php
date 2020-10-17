
<link rel="stylesheet" type="text/css" href="{{asset('home/vendor/bootstrap-4/css/bootstrap.min.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/bootstrap/css/bootstrap.min.css')}}"> --}}
<!--===============================================================================================-->
<link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free-5.13.1/css/all.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('home/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/main.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
       .dropdown:hover>.dropdown-menu {
        display: block;
        }
        .child{
            top: 50px;
        
        }
        .dropdown-menu .dropdown-toggle:after{
			border-top: .3em solid transparent;
		    border-right: 0;
		    border-bottom: .3em solid transparent;
		    border-left: .3em solid;
		}

		.dropdown-menu .dropdown-menu{
			margin-left:0; margin-right: 0;
		}

		.dropdown-menu li{
			position: relative;
		}
		.nav-item .submenu{ 
			display: none;
			position: absolute;
			left:100%; top:-7px;
		}
		.nav-item .submenu-left{ 
			right:100%; left:auto;
		}
        .dropdown-menu-right {
            right: auto;
            left: 0;
        }

		.dropdown-menu > li:hover{ background-color: #f1f1f1 }
		.dropdown-menu > li:hover > .submenu{
			display: block;
		}
        /* 
} */
    </style>
