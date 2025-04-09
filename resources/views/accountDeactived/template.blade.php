<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Asset Management</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
  
  <!-- Custom Styles -->
  <style>
    /* General Styles */
    body {
        font-family: 'Source Sans Pro', sans-serif;
        background-color: #f5f7fa;
    }

    /* Sidebar Styles */
    .main-sidebar {
      background-color: #f1f1f1; 
        border-right: 1px solid #ddd;
    }

    .nav-sidebar .nav-link {
        color: #333;
    }

    .nav-sidebar .nav-link.active {
        background-color: #f8f9fa !important; /* Light grey background */
        color: #343a40 !important; /* Dark grey text color */
    }

    .nav-sidebar .nav-link:hover {
        background-color: #f0f0f0;
    }

    .nav-sidebar .nav-icon {
        color: #007bff;
    }

    .main-sidebar .brand-link {
        background-color: #fff;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    .main-sidebar .brand-text {
        color: #333;
    }

    /* Navbar Styles */
    .main-header {
        background-color: #fff;
        border-bottom: 1px solid #ddd;
    }

    .navbar-nav .nav-link {
        color: #333;
    }

    .navbar-nav .nav-link:hover {
        color: #007bff;
    }

    /* Dashboard Cards */
    .dashboard-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
    }

    .dashboard-card .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .dashboard-card .card-value {
        font-size: 24px;
        color: #007bff;
        font-weight: bold;
    }

    .dashboard-card .card-icon {
        font-size: 36px;
        color: #007bff;
    }

    /* Sidebar <p> Styles */
    .nav-sidebar .nav-link p {
        color: #000; /* Black color for <p> */
    }

    .nav-header {
        /* Dark black text color */
    }


    /* Footer Styles */
    .main-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #ddd;
        text-align: center;
        padding: 15px;
    }

    .main-footer a {
        color: #007bff;
        text-decoration: none;
    }

    .main-footer a:hover {
        text-decoration: underline;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Fullscreen Toggle -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('adminD.dashboard')}}" class="brand-link">
      <span class="brand-text font-weight-light" style="margin-left:20px;"><b>Asset Management</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="{{ route('adminD.dashboard') }}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header" style=" color: #000000;">USER MANAGEMENT</li>
          <li class="nav-item">
            <a href="{{ route('userApproval.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>User Approval</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('accountActive.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Active Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('accountDeactived.index') }}" class="nav-link active">
              <i class="nav-icon fas fa-user-slash"></i>
              <p>Deactivated Users</p>
            </a>
          </li>
          <li class="nav-header " style=" color: #000000;">ADMIN MANAGEMENT</li>
          <li class="nav-item">
            <a href="{{ route('adminView.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Admin List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('adminProfile.show') }}" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>Admin Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- Optional Header Content -->
          </div><!-- /.col -->
          <div class="container">
            @yield('content')
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Dashboard Cards (Example) -->
   
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
</body>
</html>
