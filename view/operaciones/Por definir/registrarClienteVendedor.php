<?php
  //Conexion a la base de datos
  require_once("../../model/conexion.php");
  //Validación de inicio de sesión
  require_once("../../model/validarSesion.php");
  //Protege que cualquiera que no sea vendedor ingrese
  require_once("../../controller/seguridadVendedor.php");
  // Visualización de datos de perfil
  require_once("../../controller/perfilVendedor.php");
  //Consultas realizadas a la base de datos.
  require_once("../../model/consultasVendedor.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrar Cliente | Timeout</title>

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
        <a href="homeVendedor.php" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="../../controller/seguridadVendedor.php?cierre=si" class="cierre">Cerrar sesión</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1a191e">
    <!-- Brand Logo -->
    <a href="homeVendedor.php" class="brand-link">
      <img src="../client-side/images/favicon.png" alt="Logo de Timeout" class="brand-image">
      <span class="brand-text font-weight-light">Timeout</span>
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
                <a href="registrarClienteVendedor.php" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Registar cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="VerClientesVendedor.php" class="nav-link">
                <i class="fas fa-eye"></i>
                  <p>Ver clientes</p>
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
                <a href="registrarVentaVendedor.php" class="nav-link">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p>Generar venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verVentasVendedor.php" class="nav-link">
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
                <a href="registrarProductoVendedor.php" class="nav-link">
                  <i class="fas fa-plus-circle"></i>
                  <p>Registrar productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verProductosVendedor.php" class="nav-link">
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
                <a href="registrarInventarioProductosVendedor.php" class="nav-link">
                  <i class="fas fa-plus-circle"></i>
                  <p>Registrar inventario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verInventarioProductosVendedor.php" class="nav-link">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registrar Cliente</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">Formulario para el registro de un cliente</h5>
              </div>
              <form action="../../controller/insertClienteVendedor.php" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="docImput">No. de documento</label>
                      <input type="number" name="documento" class="form-control" id="docImput" placeholder="No. de documento" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nombresImput">Nombres</label>
                      <input type="text" name="nombres" class="form-control" id="nombresImput" placeholder="Nombres completos" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="apellidosImput">Apellidos</label>
                      <input type="text" name="apellidos" class="form-control" id="apellidosImput" placeholder="Apellidos completos" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="direccionImput">Dirección</label>
                      <input type="text" name="direccion" class="form-control" id="direccionImput" placeholder="Dirección de residencia" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="emailImput">Email</label>
                      <input type="email" name="email" class="form-control" id="emailImput" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="telefonoImput">Celular</label>
                      <input type="number" name="celular" class="form-control" id="celularImput" placeholder="No. de celular" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="telefonoImput">Teléfono</label>
                      <input type="number" name="telefono" class="form-control" id="telefonoImput" placeholder="No. de teléfono fijo (opcional)">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="estadoImput">Estado</label>
                      <select class="form-control" name="estado" id="estadoImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                        <option value="3">Bloqueado</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Registrar</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
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
  // si no exite la autenticacion o el rol, mostrara una alerta de seguridad
  if (isset($_SESSION['seguridad'])) {
    $alerta = $_SESSION['seguridad'];
    echo $alerta;
    unset($_SESSION['seguridad']);
}
?>
</body>
</html>