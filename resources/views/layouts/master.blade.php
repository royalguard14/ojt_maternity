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
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
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
  
  .labo8 {
    opacity: 0.8;
  }

.headers {
  color: yellow;
  font-size: 2.5rem;
  font-weight: bold;
  text-align: center;
  text-shadow: 
    -1px -1px 0 black,  
     1px -1px 0 black,
    -1px  1px 0 black,
     1px  1px 0 black;
  background-color: rgba(51, 51, 51, 0.5); /* #333 with 50% opacity */
  border-radius: 8px;
}



</style>
@yield('style')


</head>
<body class="hold-transition sidebar-mini layout-footer-fixed">
  <div class="wrapper ">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('profiles.index') }}" class="nav-link {{ request()->routeIs(['profiles.index']) ? 'active' : '' }}">Profile</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a class="nav-link text-red" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      @developer
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      @enddeveloper
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.custom_name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
         <img src="{{ $profile && $profile->profile_picture && file_exists(storage_path('app/public/' . $profile->profile_picture)) 
         ? asset('storage/' . $profile->profile_picture) 
         : asset('dist/img/user2-160x160.jpg') }}"
         class="img-circle elevation-2"
         alt="User Image"
         >
       </div>
       <div class="info">
        <a href="#" class="d-block">
          @if($profile)
          {{ $profile->full_name }}
          @else
          Guest
          @endif
        </a>
      </div>
    </div>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route(config('role_dashboard.' . (auth()->user()->role->role_name ?? 'default'))) }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p> Dashboard</p>
          </a>
        </li>
        @php
        $showDeveloperMode = $modules->whereIn('id', [1, 2, 3, 4, 5])->isNotEmpty();
        $showAdminMode = $modules->whereIn('id', [5,6,7,8,9])->isNotEmpty();
        @endphp


  @if($showDeveloperMode || $showAdminMode)
        <li class="nav-header">Maternity Management</li>
            @foreach($modules as $module)
            @if(in_array($module->id, [5,6,7,8,11]))
            <li class="nav-item">
              <a href="{{ route($module->url) ?? '#' }}" 
               class="nav-link {{ request()->routeIs($module->url) ? 'active' : '' }}">
               <i class="nav-icon fas {{ $module->icon }}"></i>
               <p>{{ $module->name }}</p>
             </a>
           </li>
           @endif
           @endforeach
       @endif






        @if($showDeveloperMode)
        <li class="nav-header">Administrative Tools</li>
        <li class="nav-item {{ request()->routeIs(['roles.index', 'modules.index', 'settings.index','users.index']) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs(['roles.index', 'modules.index', 'settings.index','users.index']) ? 'active' : '' }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Developer Setting
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @foreach($modules as $module)
            @if(in_array($module->id, [1, 2, 3, 4]))
            <li class="nav-item">
              <a href="{{ route($module->url) ?? '#' }}" 
               class="nav-link {{ request()->routeIs($module->url) ? 'active' : '' }}">
               <i class="far fa-circle nav-icon"></i>
               <p>{{ $module->name }}</p>
             </a>
           </li>
           @endif
           @endforeach
         </ul>
       </li>
       @endif
     </ul>
   </nav>
   <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" 
style="background: url('{{ asset('dist/img/bgc.jpg') }}') no-repeat center center fixed; background-size: cover;"
>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 headers" >@yield('header')</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      @yield('content')
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
@developer
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Website Setting</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->
@enddeveloper
<!-- Main Footer -->
<footer class="main-footer footline labo8" >
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
</script>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
{{-- <script src="{{ asset('dist/js/widget.js') }}"></script> --}}

<script src="{{ asset('dist/js/dates_loc.js') }}"></script>







</body>
</html>