<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="{{route('admin.dashboard')}}" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Home</a>
    </li>
  {{--   <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li> --}}
  </ul>

  <!-- SEARCH FORM -->
 {{--  <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar"  type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form> --}}

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto" >
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown user user-menu " style="line-height: 45px">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
        <span class="hidden-xs">Alexander Pierce</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header bg-primary">
          <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

          <p>
            {{Auth::user()->name}}
            
          </p>
        </li>
    
        <li class="user-footer">

          <a href="#" class="btn btn-default btn-flat">Profile</a>


          <a href="{{route('logout')}}" class="btn btn-default btn-flat float-right">Sign out</a>

        </li>
      </ul>
    </li>


      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>