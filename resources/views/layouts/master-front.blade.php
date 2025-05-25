<!DOCTYPE html>
@if(session('error'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Toast.fire({
      icon: 'error',
      title: '{{ session('error') }}'
    });
  });
</script>
@endif
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.custom_name') }}</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/chart.js') }}"></script>
<style type="text/css">
 .topnavs {
  background-color: #faf0a8; 
  border-bottom: 6px solid #04b656;
}
.footline {
  background-color: #faf0a8; 
  border-top: 6px solid #04b656;
}
.tops {
  display: flex;
  align-items: center; /* Vertically aligns logo and text */
  justify-content: flex-start; /* Aligns to the left */
  padding: 10px;
  text-align: left;
}
.content-wrapper {
  background: url('{{ asset('dist/img/bgc.jpg') }}') no-repeat center center fixed;
    background-size: cover;
    height:50px;
  }
  .transpa {
   /* background-color: rgba(255, 255, 255, 0.7);  white with 50% opacity */
   background-color: transparent;
 }
 .page-heading {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size: 2rem;
  font-weight: 700;
  color: white;
  margin-bottom: 1rem;
  border-bottom: 2px solid #007bff;
  padding-bottom: 0.5rem;
  /* Simulated black outline using shadows */
  text-shadow:
  -1px -1px 0 #000,
  1px -1px 0 #000,
  -1px  1px 0 #000,
  1px  1px 0 #000;
}
</style>
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white topnavs tops">
      <div class="container">
        <a href="../../index3.html" class="navbar-brand">
          <img src="../../dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Crescent Birthing clinic</span>
        </a>
        @php
        $showDeveloperMode = $modules->whereIn('id', [1, 2, 3, 4, 5,10,11,12])->isNotEmpty();
        $showAdminMode = $modules->whereIn('id', [5,6,7,8,9])->isNotEmpty();
        @endphp
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{ route(config('role_dashboard.' . (auth()->user()->role->role_name ?? 'default'))) }}" class="nav-link {{ Str::contains(request()->path(), 'dashboard') ? 'active' : '' }}">Dashboard</a>
            </li>
            @if($showDeveloperMode || $showAdminMode)
            <li class="nav-item">
              @foreach($modules as $module)
              @if(in_array($module->id, [5]))
              <a href="{{ route($module->url) ?? '#' }}" class="nav-link {{ request()->routeIs($module->url) ? 'active' : '' }}">{{ $module->name }}</a>
              @endif
              @endforeach
            </li>
            @endif
            @if($showDeveloperMode || $showAdminMode)
            <li class="nav-item">
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle {{ Str::contains(request()->path(), 'family') ? 'active' : '' }}">Families</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
               @foreach($modules as $module)
               @if(in_array($module->id, [10,11,12]))
               <li><a href="{{ route($module->url) ?? '#' }}" class="dropdown-item {{ request()->routeIs($module->url) ? 'active' : '' }}">{{ $module->name }} </a></li>
               @endif
               @endforeach
             </ul>
           </li>
           @endif
         </ul>
       </div>
       <!-- Right navbar links -->
       <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
               <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fa fa-cogs"></i>
          </a>
        </li>

<li class="nav-item">
  <a class="nav-link" href="{{ route('logout') }}" 
     onclick="event.preventDefault(); this.onclick=null; document.getElementById('logout-form').submit();">
    <i class="fa fa-power-off"></i>
  </a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form>









      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid ">
        <div class="card transpa" >
          <div class="card-header">
           <h1 class="m-0 page-heading"> @yield('header')</h1>
         </div> <!-- /.card-body -->
         <div class="card-body">
          @yield('content')
        </div><!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer footline">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
   {{ config('app.custom_name') }}
 </div>
 <!-- Default to the left -->
 <strong>Copyright &copy; 2025 <a href="https://www.facebook.com/profile.php?id=61572728822378">MGX TECH</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@yield('scripts')
</body>
</html>