<?php include ("../../Controller/Administrador/Funciones/requiresOnce.php")?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrar Usuario | Timeout</title>

  <!-- favicon -->
  <link href="../client-side/images/FAVICON_TIMEOUT.png" rel="shortcut icon">
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
      <li class="nav-item">
        <a href="../../controller/administrador/seguridadAdmin.php?cierre=si" class="cierre">Cerrar sesión</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1a191e">
    <!-- Brand Logo -->
    <a href="homeAdmin.php" class="brand-link">
      <img src="../client-side/images/FAVICON_TIMEOUT.png" alt="Logo de Timeout" class="brand-image">
      <span class="brand-text font-weight-light">Timeout</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- funcion para mostrar el nombre del usuario -->
        
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
      <?php include ("../Modulos/Menu.php") ?>
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
            <h1 class="m-0">Registrar Usuario</h1>
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
                <h5 class="m-0">Formulario para el registro de un Usuario</h5>
              </div>
              <form action="../../controller/Administrador/insertUsuarios.php" method="POST">
                <div class="card-body">
                  <div class="row">
                    <!-- a la opcion de "selciones una opcion" se le pone un valor vacio para que haga 
                    la comparacion en insertarUserA y no de error -->
                    <div class="form-group col-md-6">
                      <label for="nombreInput">Nombre del ingeniero</label>
                      <input type="text" name="nameIng" class="form-control" id="nameUser" placeholder="EJ: Eduardo" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="apellidoInput">Apellido del ingeniero</label>
                      <input type="text" name="apellidoIng" class="form-control" id="apellidoUser" placeholder="EJ: Rodríguez" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="celularInput">Celular Corporativo</label>
                      <input type="number" name="celularIng" class="form-control" id="celularUser" placeholder="No. de celular" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="emailInput">Correo Corporativo</label>
                      <input type="email" class="form-control" name="emailIng" id="emailUser" placeholder="Email" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="cargoInput">Cargo</label>
                      <select class="form-control" name="cargoIng" id="cargoUser" required>
                        <option value="" selected>Seleccione una opción</option>
                        <?php 
                          $modelo = new conexion;
                          $conexion = $modelo -> get_conexion();
                          // Consulta para obtener datos de la base de datos
                          $consulta = "SELECT * FROM  cargos";
                          $stmt = $conexion -> query($consulta);
                          // Obtener los resultados como un array
                          $resultados = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                          foreach ($resultados as $fila) {
                            echo '<option value="'. $fila['ID_Cargo'] .'">'.$fila['Cargo'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    
                    <div class="form-group col-md-4">
                      <label for="rolInput">Rol</label>
                      <select class="form-control" name="rolIng" id="rolUser" required>
                      <option value="" selected>Seleccione una opción</option>
                        <?php 
                          $modelo = new conexion;
                          $conexion = $modelo -> get_conexion();
                          // Consulta para obtener datos de la base de datos
                          $consulta = "SELECT * FROM  roles";
                          $stmt = $conexion -> query($consulta);
                          // Obtener los resultados como un array
                          $resultados = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                          foreach ($resultados as $fila) {
                            echo '<option value="'. $fila['ID_Rol'] .'">'.$fila['Rol'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    
                    <div class="form-group col-md-4">
                      <label for="estadoInput">Estado</label>
                      <select class="form-control" name="estadoIng" id="estadoUser" required>
                        <option value="" selected>Seleccione una opción</option>
                          <?php 
                            $modelo = new conexion;
                            $conexion = $modelo -> get_conexion();
                            // Consulta para obtener datos de la base de datos
                            $consulta = "SELECT * FROM  estados_users";
                            $stmt = $conexion -> query($consulta);
                            // Obtener los resultados como un array
                            $resultados = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            foreach ($resultados as $fila) {
                               echo '<option value="'. $fila['ID_Estado_Usuario'] .'">'.$fila['Estado_User'].'</option>';
                            }
                          ?>
                      </select>
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
