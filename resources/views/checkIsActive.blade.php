<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>check is active</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

 @include('layouts.layout_admins.layouts.css')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Shopping</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Bạn không có quyên truy cập vào trang quản trị</p>
      
   
    <div class="social-auth-links text-center">
     
    
      
      <a href="/" class="btn btn-primary" style="text-align: center;"></i>Về trang chu</a>
    </div>
    <!-- /.social-auth-links -->


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
@include('layouts.layout_admins.layouts.js')
</body>
</html>