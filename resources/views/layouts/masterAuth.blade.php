<!DOCTYPE html>
<html lang="en">
<head>
  <title>MERANTI - @yield('title')</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="/login-assets/images/logo.png"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="/login-assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="/login-assets/css/main.css">
  <!--===============================================================================================-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @yield('links')

  <style media="screen">
  .login100-form {
    padding: 75px 55px 55px 55px;
  }
  
  .login100-form-btn {
      background: #1e3054;
  }
  
  .login100-form-btn:hover {
    background: #1e3054;
  }
  
  .t-p {
      color: #1e3054;
  }
  
  .btn-p {
      background: #1e3054;
      color: white;
  }
  
  .btn-p:hover {
    background: #1e3054;
  }
  </style>

  @yield('style')
</head>
<body style="background-color: #1e3054;">

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">

        <div class="login100-form">
          <span class="login100-form-title p-b-43">
      			<img src="/login-assets/images/logo.png" class="mb-3" style="height: 156px"> <br>
      			<h5>
      				@yield('form-title')
      			</h5>
      		</span>

          @yield('content')
        </div>

        <div class="login100-more" style="background: #1e3054; position: relative;">
        </div>
      </div>
    </div>
  </div>

  <!--===============================================================================================-->
  <script src="/login-assets/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="/login-assets/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="/login-assets/vendor/bootstrap/js/popper.js"></script>
  <script src="/login-assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="/login-assets/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="/login-assets/vendor/daterangepicker/moment.min.js"></script>
  <script src="/login-assets/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="/login-assets/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <script src="/login-assets/js/main.js"></script>

  @if(session('OK'))
    <script>
      Swal.fire("Berhasil!", "{{ session("OK") }}", "success");
    </script>
  @endif

  @if(session('ERR'))
    <script>
    Swal.fire("Error!", "{{ session("ERR") }}", "error");
    </script>
  @endif

  @yield('script')

</body>
</html>
