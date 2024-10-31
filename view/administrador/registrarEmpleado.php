<?php
  require_once("../../model/conexion.php");
  require_once("../../model/validarSesion.php");
  require_once("../../controller/seguridadE.php");
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
  <title>Registrar Empleado | Uruz</title>

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
      <li class="nav-item dropdown">
        <?php PreguntasQuejasReclamos() ?>
      </li>
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
      <img src="../client-side/images/favicon.png" alt="Logo de uruz" class="brand-image">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registrar Empleado</h1>
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
                <h5 class="m-0">Formulario para el registro de un empleado</h5>
              </div>
              <form action="../../controller/insertEmpleadosA.php" method="POST">
                <div class="card-body">
                  <div class="row">
                    <!-- a la opcion de "selciones una opcion" se le pone un valor vacio para que haga 
                    la comparacion en insertarUserA y no de error -->
                    <div class="form-group col-md-6">
                      <label for="tipoDocImput">Tipo de documento</label>
                      <select class="form-control" name="tipoDoc" id="tipoDocImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="CC">CC</option>
                        <option value="CE">CE</option>
                        <option value="Pasaporte">Pasaporte</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="documentoimput">No. de Documento</label>
                      <input type="number" name="numDoc" class="form-control" id="documentoimput" placeholder="No. de docuemento" required>
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
                      <label for="celularImput">Celular</label>
                      <input type="number" name="celular" class="form-control" id="celularImput" placeholder="No. de celular" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="telefonoImput">Teléfono</label> 
                      <input type="number" name="telefono" class="form-control" id="telefonoImput" placeholder="No. teléfono fijo (opcional)">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="direccionImput">Dirección</label>
                      <input type="text" name="direccion" class="form-control" id="direccionImput" placeholder="Dirección de residencia" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="emailImput">Email</label>
                      <input type="email" class="form-control" name="email" id="emailImput" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="epsImput">Eps</label>
                      <select class="form-control" name="eps" id="epsImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="Alian salud">Alian salud</option>
                        <option value="Cafam">Cafam</option>
                        <option value="Compensar">Compensar</option>
                        <option value="Confandi">Confandi</option>
                        <option value="Famisanar">Famisanar</option>
                        <option value="Nueva Eps">Nueva Eps</option>
                        <option value="Salud total">Salud total</option>
                        <option value="Sanitas">Sanitas</option>
                        <option value="Servicio ocidental">Servicio ocidental</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cajaCompensacionImput">Caja de compensación</label>
                      <select class="form-control" name="cajaCompensacion" id="cajaCompensacionImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="Cafam">Cafam</option>
                        <option value="Cajasan">Cajasan</option>
                        <option value="Colsubsidio">Colsubsidio</option>
                        <option value="Concaja">Concaja</option>
                        <option value="Confacundi">Confacundi</option>
                        <option value="Compensar">Compensar</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="arlImput">ARL</label>
                      <select class="form-control" name="arl" id="arlImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="Aurora">Aurora</option>
                        <option value="Axa colpatria">Axa colpatria</option>
                        <option value="Colmena">Colmena</option>
                        <option value="La equidad">La equidad</option>
                        <option value="Liberty seguros">Liberty seguros</option>
                        <option value="Mapfre">Mapfre</option>
                        <option value="Positiva">Positiva</option>
                        <option value="Seguros alfa">Seguros alfa</option>
                        <option value="Seguros bolivar">Seguros bolivar</option>
                        <option value="Sura">Sura</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="fondoImput">Fondo de pensiones</label>
                      <select class="form-control" name="fondoPension" id="fondoImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="Colfondos">Colfondos</option>
                        <option value="Colpensiones">Colpensiones</option>
                        <option value="Old mutual">Old mutual</option>
                        <option value="Porvenir">Porvenir</option>
                        <option value="Protección">Protección</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="generoImput">Genero</label>
                      <select class="form-control" name="genero" id="generoImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="rolImput">Rol</label>
                      <select class="form-control" name="rol" id="rolImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Vendedor">Vendedor</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cargoImput">Estado</label>
                      <select class="form-control" name="estado" id="cargoImput" required>
                        <option value="" selected>Seleccione una opción</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                        <option value="3">Bloqueado</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="sueldoImput">Sueldo</label>
                      <input type="number" class="form-control" name="sueldo" id="sueldoImput" placeholder="Sueldo mesual" required>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Registar</button>
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
