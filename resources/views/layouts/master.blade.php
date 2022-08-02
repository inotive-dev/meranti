<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
  content=".">
  <meta name="keywords"
  content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="/login-assets/images/logo.png" type="image/x-icon">
  <link rel="shortcut icon" href="/login-assets/images/logo.png" type="image/x-icon">
  <title>MERANTI - {{ $title }}</title>
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&display=swap"
  rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&display=swap"
  rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/feather-icon.css">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/chartist.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/date-picker.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
  <link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">


  <style>
  body, .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links li a span {
    font-family: 'Poppins', sans-serif !important;
  }
  @media only screen and (max-width: 575.98px){
    .page-wrapper .page-header .header-wrapper {
      padding: 20px 15px !important;
    }
  }
  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper{
    background: #1e3054;
  }
  .logo-wrapper, .page-wrapper, .footer, .page-header{
    -webkit-box-shadow: none !important;
    -moz-box-shadow: none !important;
    box-shadow: none !important;
  }
  .simplebar-offset {
    top: 29px !important;
  }
  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper{
    -webkit-box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    -moz-box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  }
  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.active {
    background-color: #FFFFFF !important;
  }
  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.active span {
    color: #1e3054;
    font-weight: 400 !important;
    font-size: 16px !important;
  }
  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.active svg {
    color: #1e3054;
    margin-right: 29px;
  }

  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link:not(.active) span {
    color: #FFFFFF;
    font-weight: 400 !important;
    font-size: 16px !important;
  }
  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link:not(.active) svg {
    color: #FFFFFF;
    margin-right: 29px;
  }

  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li.sidebar-list:hover>a:hover {
    background-color: #ffffff59;
    color: #1e3054;
  }

  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li:hover .sidebar-link:not(.active):hover span {
    color: #1e3054;
  }

  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li:hover .sidebar-link:not(.active):hover svg {
    stroke: #1e3054 !important;
  }

  .page-title h3{
    font-weight: 400 !important;
  }

  .btn-blue {
    background-color: #0d6efd !important;
    color: white;
  }

  .btn-blue:hover {
    color: white;
  }

  .btn-primary{
    background: #1e3054 !important;
    border-color: #1e3054 !important;
  }

  .btn-outline-primary {
    border-color: #1BA0E1;
    color: #1BA0E1;
  }

  .btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active, .btn-outline-primary.active {
    background-color: #1BA0E1 !important;
    border-color: #1BA0E1 !important;
  }
  a:hover{
    color: #1e3054 !important;
  }

  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content > li .sidebar-link.active span{
    color: #1e3054;
  }

  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content > li .sidebar-link.active svg {
    color: #1e3054;
  }

  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content > li:hover .sidebar-link:not(.active):hover span {
    color: white;
  }

  .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content > li:hover .sidebar-link:not(.active):hover svg {
    stroke: white !important;
  }

    .form-control-file {
        background: #E3E1E1;
        box-shadow: 0px 4px 0px #E3E1E1;
        border-radius: 7px;
        border: 0px;
        height: 46px;
        text-align: center;
        padding: 10px 10px 0px 10px;
        cursor: pointer;
        font-size: 18px;
        color: #9B9B9B;
        font-weight: 300;
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
        color: white;
    }

    .select2-container .select2-selection--single {
        border-color: #ced4da !important;
    }
</style>
@yield('style')
</head>

<body>
@php
    $userPermissions = [];
    if(Auth::user()->user_role != null)
    {
      $userPermissions = Auth::user()->user_role->role->permissions->pluck('permission_name')->toArray();
    }
@endphp
  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <div class="page-header">
      <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
          <div class="logo-wrapper">
            <a href="{{ route('dashboard.index') }}">
              <img class="img-fluid" src="/login-assets/images/logo-balikpapan.png" height="24px" alt="">
            </a>
          </div>
        </div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        <div class="left-header col horizontal-wrapper ps-0">
          <ul class="horizontal-menu">
          </ul>
        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
          <ul class="nav-menus">
            <li class="profile-nav onhover-dropdown p-0 me-0">
              <div class="media profile-media">
                <img class="rounded-circle" src="/assets/images/dashboard/profile.jpg" alt="">
                <div class="media-body"><span>{{ Auth::user()->name }}</span>
                  <p class="mb-0 font-roboto">{{ Auth::user()->email }} <i class="middle fa fa-angle-down"></i></p>
                </div>
              </div>
              <ul class="profile-dropdown onhover-show-div">
                <!--<li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>-->
                <li><a href="{{ route('logout') }}"><i data-feather="log-out"> </i><span>Log out</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <!-- Page Sidebar Start-->
      <div class="sidebar-wrapper" style="background: #1e3054">
        <div>
          <div class="logo-wrapper"  style="background: white;">
            <a href="{{ route('dashboard.index') }}" data-bs-original-title="" title="">
              <!--<img class="img-fluid for-light" src="/login-assets/images/logo-balikpapan.png" alt="" width="38">-->
              <!--<img class="img-fluid for-dark" src="/login-assets/images/logo-balikpapan.png" alt="" width="38">-->
              <span class="text-dark fw-bold fs-4 text">MERANTI</span>
            </a>
          </div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn">
                  {{-- <a href="{{ route('dashboard.index') }}">
                    <img class="img-fluid" src="/login-assets/images/logo-balikpapan.png" height="64px" alt="">
                  </a>
                  <div class="mobile-back text-end">
                    <span>Kembali</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                  </div> --}}
                </li>
                <li class="sidebar-list mb-3">
                  <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard.index') }}">
                    <i data-feather="home"> </i><span>Beranda</span>
                  </a>
                </li>
                
                <li class="sidebar-list mb-3">
                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard.user.index') }}">
                        <i data-feather="user"> </i><span>Pengguna</span>
                    </a>
                </li>
                
                
                <li class="sidebar-list mb-3">
                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard.client.index') }}">
                        <i data-feather="user-check"> </i><span>Client</span>
                    </a>
                </li>
                
                @if(in_array('read_project', $userPermissions))
                <li class="sidebar-list mb-3">
                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard.project.index') }}">
                        <i data-feather="database"> </i><span>Project</span>
                    </a>
                </li>
                @endif

                <li class="sidebar-list mb-3">
                  <a class="sidebar-link sidebar-title" href="#">
                    <i data-feather="archive"></i><span>
                      <span>Settings</span>
                    </a>
                    <ul class="sidebar-submenu" style="">
                      <li><a class="text-light" href="{{ route('dashboard.setting.job-request.index') }}">Job Request</a></li>

                      <!--<li><a class="text-light" href="{{ route('dashboard.setting.quotation.index') }}">Quotation</a></li>-->

                      <li><a class="text-light" href="{{ route('dashboard.setting.work-order.index') }}">Work Order</a></li>

                      <li><a class="text-light" href="{{ route('dashboard.setting.opname-report.index') }}">Opname Report</a></li>

                      <li><a class="text-light" href="{{ route('dashboard.setting.s-note.index') }}">S-Note</a></li>

                      <li><a class="text-light" href="{{ route('dashboard.setting.lapdoc.index') }}">Lapdoc</a></li>
                    </ul>
                  </li>

              </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
          </nav>
        </div>
      </div>
      <!-- Page Sidebar Ends-->
      <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              @yield('breadcrumb')
            </div>
          </div>
        <!-- Container-fluid starts-->
        <div class="">
          @yield('content')
        </div>
        <!-- Container-fluid Ends-->
      </div>
      <!-- footer start-->
      @if ($title != 'Peta')
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2021 © Inotive Technology </p>
              </div>
            </div>
          </div>
        </footer>
      @endif
    </div>
  </div>
  <!-- latest jquery-->
  <script src="/assets/js/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap js-->
  <script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <!-- feather icon js-->
  <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
  <!-- scrollbar js-->
  <script src="/assets/js/scrollbar/simplebar.js"></script>
  <script src="/assets/js/scrollbar/custom.js"></script>
  <!-- Sidebar jquery-->
  <script src="/assets/js/config.js"></script>
  <!-- Plugins JS start-->
  <script src="/assets/js/sidebar-menu.js"></script>
  <script src="/assets/js/chart/apex-chart/apex-chart.js"></script>
  <script src="/assets/js/notify/bootstrap-notify.min.js"></script>
  <script src="/assets/js/datepicker/date-picker/datepicker.js"></script>
  <script src="/assets/js/datepicker/date-picker/datepicker.en.js"></script>
  <script src="/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
  <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
  <script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="/assets/js/script.js"></script>
  {{-- <script src="/assets/js/theme-customizer/customizer.js"></script> --}}
  <script>
    $(".datatable").DataTable({
      "ordering": false
    });
    $(document).ready(function()
    {
      var token = $("meta[name=_token]").attr("content");
      var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + token,
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token= + token'
      };

      var current = window.location.href;
      if ($('a[href="' + current + '"]')[0]) {
        $('a[href="' + current + '"]').parents().children('a').addClass('active');
        $('a[href="' + current + '"]').parents().parents().children('ul').css('display', 'block');
        $('a[href="' + current + '"]').addClass('active');
        $('a[href="' + current + '"]').parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
        $('a[href="' + current + '"]').parent().parent().parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
      }
    });
  </script>
  @yield('script')
  @if (session('ERR'))
    <script>
      Swal.fire({
        title: "ERROR!",
        text: "{{ session('ERR') }}",
        icon: "error",
        confirmButtonClass: "btn btn-primary",
      });
    </script>
  @endif
  @if (session('OK'))
    <script>
      Swal.fire({
        title: "OK!",
        text: "{{ session('OK') }}",
        icon: "success",
        confirmButtonClass: "btn btn-primary",
      });
    </script>
  @endif
  <!-- login js-->
  <!-- Plugin used-->
</body>

</html>
