<?php
  require_once("../../model/conexion.php");
  require_once("../../model/validarSesion.php");
  require_once("../../controller/seguridadE.php");
  require_once("../../controller/mostrarPqr.php");
  // perfil
  require_once("../../controller/perfilA.php");
  require_once("../../model/consultasA.php");
  // pqr
  require_once("../../controller/mostrarPqr.php");
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador | Uruz</title>

  <!-- favicon -->
  <link href="../client-side/images/favicon.png" rel="shortcut icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <!-- estilos para las alertas de sweetalert2 -->
  <link rel="stylesheet" href="../dashboard/dist/css/sweetalert2.min.css">
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
        <a href="homeAdmin.php" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
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
      </li> -->

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <?php 
        PreguntasQuejasReclamos();
        ?>
      </li>

      <!-- Notifications Dropdown Menu -->

      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->

      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      <li class="nav-item">
        <a href="../../controller/seguridadE.php?cierre=si" class="cierre">Cerrar sesión</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1a191e">
    <!-- Brand Logo -->
    <a href="homeAdmin.php" class="brand-link">
      <img src="../client-side/images/favicon.png" alt="Logo de Uruz" class="brand-image">
      <span class="brand-text font-weight-light">Uruz</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- funcion para mostrar el nombre del usuario -->
        <?php usuario() ?>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline" style="background-color: #3a3a3a">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search" style="background-color: #3a3a3a">
          <div class="input-group-append">
            <button class="btn btn-sidebar" style="background-color: #3a3a3a">
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
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-users-cog"></i>
              <p>
                Empleados
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="registrarEmpleado.php" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Registar empleado</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verEmpleados.php" class="nav-link">
                <i class="fas fa-eye"></i>
                  <p>Ver empleados</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- clientes -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-users-cog"></i>
              <p>
                Clientes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="registrarCliente.php" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Registar cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="VerCliente.php" class="nav-link">
                <i class="fas fa-eye"></i>
                  <p>Ver clientes</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Proveedores -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-industry"></i>
              <p>
                Proveedores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="registrarProveedor.php" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Registar proveedor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verProveedores.php" class="nav-link">
                <i class="fas fa-eye"></i>
                  <p>Ver proveedores</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- ventas -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-dollar-sign"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="registrarVenta.php" class="nav-link">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p>Generar venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verVentas.php" class="nav-link">
                <i class="fas fa-eye"></i>
                  <p>Ver las ventas</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- productos -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-barcode"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="registrarProductoA.php" class="nav-link">
                  <i class="fas fa-plus-circle"></i>
                  <p>Registrar productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verProductosA.php" class="nav-link">
                  <i class="fas fa-eye"></i>
                  <p>Ver productos</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Inventario -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-box-open"></i>
              <p>
                Inventario
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="registrarInventarioProductos.php" class="nav-link">
                  <i class="fas fa-plus-circle"></i>
                  <p>Registrar inventario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verInventarioProductos.php" class="nav-link">
                  <i class="fas fa-eye"></i>
                  <p>Ver inventario</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="../../index.php" class="nav-link">
              <i class="fas fa-home"></i>
              <p> Página principal</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Notificaciones</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">
              <a href="../../controller/marcarVisto.php?id=todo" class="btn btn-danger" style="margin-bottom: 25px">Marcar todo como leído</a>
            </div>
              <?php
                PreguntasQuejas()
              ?>
            </div>
        </div>
    </div>
    <!-- <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0"> <strong>Motivo</strong> - Fecha</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title"><strong>Nombre*</strong> - Correo*</h6>
                <br>
                <p class="card-text">Texto de ejemplo..</p>
              </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
              <h5 class="m-0"> <strong>Motivo</strong> - Fecha</h5>
              </div>
              <div class="card-body">
              <h6 class="card-title"><strong>Nombre*</strong> - Correo*</h6>
                <br>
                <p class="card-text">Texto de ejemplo..</p>
              </div>
            </div>
          </div>
    </div> -->

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
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->
  <button class="btn-scroll-up" id="btn-scroll-up"><i class="fas fa-chevron-up"></i></button>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dashboard/dist/js/adminlte.min.js"></script>
<!-- conexion con el js de sweetalert2 -->
<script src="../dashboard/dist/js/sweetalert2.all.min.js"></script>
<!-- Alerta -->
<?php 
  if (isset($_SESSION['titulo'])) {
    $titulo = $_SESSION['titulo'];
    $msj = $_SESSION['msj'];
    $icono = $_SESSION['icono'];
    ?>
    <script>
      Swal.fire({
        title: '<?php echo $titulo?>',
        text: '<?php echo $msj?>',
        icon: '<?php echo $icono?>',
        confirmButtonColor: '#e4112f'
      })
    </script>
    <?php
    unset($_SESSION['titulo']);
    unset($_SESSION['msj']);
    unset($_SESSION['icono']);
  }
?>
<?php 
// alerta de notificaciones leidas
  if (isset($_SESSION['otra'])) {
    $otraAlerta = $_SESSION['otra'];
    echo $otraAlerta;
    unset($_SESSION['otra']);
  }
  // si no exite la autenticacion o el rol, mostrara una alerta de seguridad
  if (isset($_SESSION['seguridad'])) {
    $alerta = $_SESSION['seguridad'];
    echo $alerta;
    unset($_SESSION['seguridad']);
}
?>
</body>
</html>