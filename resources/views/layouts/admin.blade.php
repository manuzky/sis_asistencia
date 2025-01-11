<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CONTROL DE SISTENCIA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  {{-- Iconos de Bootstrap --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  {{-- jQuery --}}
  <script src="{{asset('/plugins/jquery/jquery.js')}}"></script>
  {{-- DataTables --}}
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  {{-- Sweet Alert 2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- CKEDITOR PARA EL TEXTAREA --}}
  <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <img src="{{url('images/encabezado.png')}}" alt="encabezado" width="42%">
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-image: linear-gradient(to bottom, #5fc3fd, #cae9ff, #a8f8fd);">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      {{-- <img src="{{url('/dist/img/logo_uptjaa.png')}}" alt="UPTJAA logo" class="brand-image elevation-9"> --}}
      {{-- <span class="brand-text font-weight-light">CONTROL DE ASISTENCIAS</span> --}}
      <div class="image">
        <center>
          <img src="{{url('/images/uptjaalogofullderecha.png')}}" alt="logo uptjaa" width="70%">
        </center>
      </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info ">
          <a class="d-block" style="color: #333333;"> <b>USUARIO: </b>{{ Auth::user()->name }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item" >
                <a href="{{url('/')}}" class="nav-link active" style="background-color: #18b0ec;">
                  <i class="nav-icon fas">
                    <i class="bi bi-house-fill"></i>
                  </i>
                  <p>
                    Menú de inicio
                  </p>
                </a>
              </li>

            @can('asistencias')
            <li class="nav-item {{ Request::is('asistencias/create*') || Request::is('asistencias*') ? 'menu-open' : '' }}" >
              <a href="#" class="nav-link active {{ Request::is('asistencias/create*') || Request::is('asistencias*') ? 'active' : '' }}" style="background-color: #18b0ec;">
                <i class="nav-icon fas">
                  <i class="bi bi-calendar2-week-fill"></i>
                </i>
                <p>
                  Asistencias
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('asistencias.create')
                <li class="nav-item">
                  <a href="{{url('asistencias/create')}}" class="nav-link {{ Request::is('asistencias/create*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                    <p style="color: #333333;">Nueva asistencia</p>
                  </a>
                </li>
                @endcan
                <li class="nav-item">
                  <a href="{{url('asistencias')}}" class="nav-link {{ Request::is('asistencias*') && !Request::is('asistencias/create*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                    <p style="color: #333333;">Listado de asistencias</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
              
            @can('cargos')
            <li class="nav-item {{ Request::is('cargos/create*') || Request::is('cargos*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link active {{ Request::is('cargos/create*') || Request::is('cargos*') ? 'active' : '' }}" style="background-color: #18b0ec;">
                <i class="nav-icon fas">
                  <i class="bi bi-tags-fill"></i>
                </i>
                <p>
                  Cargos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('cargos.create')
                <li class="nav-item">
                  <a href="{{url('cargos/create')}}" class="nav-link {{ Request::is('cargos/create*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                    <p style="color: #333333;">Nuevo cargo</p>
                  </a>
                </li>
                @endcan
                <li class="nav-item">
                  <a href="{{url('cargos')}}" class="nav-link {{ Request::is('cargos*') && !Request::is('cargos/create*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                    <p style="color: #333333;">Listado de cargos</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

            @can('miembros')
            <li class="nav-item {{ Request::is('miembros/create*') || Request::is('miembros*') ? 'menu-open' : '' }}" >
              <a href="#" class="nav-link active {{ Request::is('miembros/create*') || Request::is('miembros*') ? 'active' : '' }}" style="background-color: #18b0ec;" >
                <i class="nav-icon fas">
                  <i class="bi bi-person-vcard-fill"></i>
                </i>
                <p>
                  Miembros
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('miembros.create')
                <li class="nav-item ">
                  <a href="{{url('miembros/create')}}" class="nav-link {{ Request::is('miembros/create*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                    <p style="color: #333333;">Nuevo miembro</p>
                  </a>
                </li>
                @endcan
                <li class="nav-item">
                  <a href="{{url('miembros')}}" class="nav-link {{ Request::is('miembros*') && !Request::is('miembros/create*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                    <p style="color: #333333;">Listado de miembros</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan

            {{-- @can('pnfs') --}}
            <li class="nav-item {{ Request::is('pnfs/create*') || Request::is('pnfs*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link active {{ Request::is('pnfs/create*') || Request::is('pnfs*') ? 'active' : '' }}" style="background-color: #18b0ec;">
                <i class="nav-icon fas">
                  <i class="bi bi-mortarboard-fill"></i>
                </i>
                <p>
                  PNF
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                {{-- @can('pnfs.create') --}}
                <li class="nav-item">
                  <a href="{{url('pnfs/create')}}" class="nav-link {{ Request::is('pnfs/create*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                    <p style="color: #333333;">Nuevo PNF</p>
                  </a>
                </li>
                {{-- @endcan --}}
                <li class="nav-item">
                  <a href="{{url('pnfs')}}" class="nav-link {{ Request::is('pnfs*') && !Request::is('pnfs/create*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                    <p style="color: #333333;">Listado de PNFs</p>
                  </a>
                </li>
              </ul>
            </li>
            {{-- @endcan --}}

          @can('rolesypermisos')
          <li class="nav-item {{ Request::is('rolesypermisos/create*') || Request::is('rolesypermisos*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active {{ Request::is('rolesypermisos/create*') || Request::is('rolesypermisos*') ? 'active' : '' }}" style="background-color: #18b0ec;">
              <i class="nav-icon fas">
                <i class="fas fa-users-cog fa-fw"></i>
              </i>
              <p>
                Roles y Permisos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('rolesypermisos.create')
              <li class="nav-item">
                <a href="{{url('rolesypermisos/create')}}" class="nav-link {{ Request::is('rolesypermisos/create*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                  <p style="color: #333333;">Nuevo rol</p>
                </a>
              </li>
              @endcan
              <li class="nav-item">
                <a href="{{url('rolesypermisos')}}" class="nav-link {{ Request::is('rolesypermisos*') && !Request::is('rolesypermisos/create*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                  <p style="color: #333333;">Listado de roles</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan


          @can('usuarios')
          <li class="nav-item {{ Request::is('usuarios/create*') || Request::is('usuarios*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active {{ Request::is('usuarios/create*') || Request::is('usuarios*') ? 'active' : '' }}" style="background-color: #18b0ec;">
              <i class="nav-icon fas">
                <i class="fas fa-users fa-fw"></i>
              </i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('usuarios.create')
              <li class="nav-item">
                <a href="{{url('usuarios/create')}}" class="nav-link {{ Request::is('usuarios/create*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                  <p style="color: #333333;">Nuevo usuario</p>
                </a>
              </li>
              @endcan
              <li class="nav-item">
                <a href="{{url('usuarios')}}" class="nav-link {{ Request::is('usuarios*') && !Request::is('usuarios/create*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon" style="color: #333333;"></i>
                  <p style="color: #333333;">Listado de usuarios</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can('reportes')
          <li class="nav-item" >
            <a href="{{url('reportes')}}" class="nav-link active" style="background-color: #18b0ec;">
              <i class="nav-icon fas">
                <i class="bi bi-printer-fill"></i>
              </i>
              <p>
                Reportes
              </p>
            </a>
          </li>
          @endcan
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    style="background-color: #dc3545">
                <i class="nav-icon">
                    <i class="bi bi-door-open-fill"></i>
                </i>
                <p>Cerrar sesión</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <div class="content">
        @yield('content')
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    {{-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div> --}}
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="https://github.com/Zakeyo">ZKY SYSTEMS</a>.</strong> Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
{{-- SCRIPT PARA LA FECHA VISUALMENTE MEJOR (DATEPICKER) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
</body>
</html>
