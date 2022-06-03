@if(Auth::user()->activo==1)
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HandiQuip GSE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../backend/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../backend/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right " style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header">Opciones de Sesión</span>
          <div class="dropdown-divider"></div>
          <a href="{{ route('changepassword') }}" class="dropdown-item">
            <i class="fas fa-lock mr-2"></i> Cambiar contraseña
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-door-open "></i> Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

          </a>
          <div class="dropdown-divider"></div>

      </li>




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
    <a href="../../index3.html" class="brand-link">
      <img src="/images/logohq-removebg-preview.png" style="height:70px" alt="AdminLTE Logo" class=" " style="opacity: .8">
      <span class="brand-text font-weight-light">HandiQuip GSE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">

          <img src="/images/logohq-removebg-preview.png"  alt="User Image">
        </div>
        <div class="info">
          <h5><a href="#" class="d-block">{{Auth::user()->name}}</a></h5>
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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-header">INICIO</li>
          <li class="nav-item menu-open">


              <li class="nav-item">
                <a href="../layout/boxed.html" class="nav-link @yield('TableroActive') ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Tablero</p>
                </a>
              </li>

          </li>
               <li class="nav-header">CATALOGO</li>
          <li class="nav-item {{-- menu-open--}} @yield('CatalogoMenuActive')">
            <a href="#" class="nav-link @yield('CatalogoActive')">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Catalogo
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="../layout/fixed-sidebar.html" class="nav-link @yield('PortadaCatalogoActive')">
                      <i class="fas fa-copy nav-icon"></i>
                      <p>Portada</p>
                    </a>
                  </li>
              <li class="nav-item">
                <a href="../layout/top-nav.html" class="nav-link @yield('SeccionesCatalogoActive')">
                  <i class="fas fa-copy nav-icon"></i>
                  <p>Secciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/top-nav-sidebar.html" class="nav-link @yield('CategoriasCatalogoActive')">
                  <i class="fas fa-copy nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/productos/indexview" class="nav-link @yield('ProductosCatalogoActive')">
                  <i class="nav-icon far fa-image"></i>
                  <p>Productos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">SLIDER</li>
          <li class="nav-item menu-open">


              <li class="nav-item">
                <a href="../layout/boxed.html" class="nav-link @yield('SliderActive')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Elementos</p>
                </a>
              </li>

          </li>




          <li class="nav-header">ADMINISTRACIÓN</li>
          <li class="nav-item">
            <a href="/usuarios" class="nav-link @yield('UsuariosActive')">
              <i class="nav-icon far fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../calendar.html" class="nav-link @yield('ProductosActive')">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Productos
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

@yield('contenidoPrincipal')

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../backend/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../backend/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
</body>
</html>
@else
<center><h1>Usuario no autorizado<h1></center>
@endif
