<?php include("../../Controller/Administrador/Funciones/requiresOnce.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrar Cliente | Timeout</title>

  <!-- Favicon -->
  <link href="../client-side/images/FAVICON_TIMEOUT.png" rel="shortcut icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <!-- SweetAlert2 styles -->
  <link rel="stylesheet" href="../dashboard/dist/css/sweetalert2.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="homeAdmin.php" class="nav-link">Inicio</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="../../controller/administrador/seguridadAdmin.php?cierre=si" class="cierre">Cerrar sesión</a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1a191e">
    <a href="homeAdmin.php" class="brand-link">
      <img src="../client-side/images/FAVICON_TIMEOUT.png" alt="Logo de Timeout" class="brand-image">
      <span class="brand-text font-weight-light">Timeout</span>
    </a>
    <div class="sidebar">
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
      <?php include("../Modulos/Menu.php"); ?>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registrar Cliente</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">Formulario para el registro de un cliente</h5>
              </div>
              <form action="../../controller/Administrador/insertClienteA.php" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="empresaInput">Nombre de la empresa</label>
                      <select class="form-control" name="empresaCli" id="empresaInputR" required>
                        <option value="" selected>Seleccione una opción</option>
                        <?php 
                          $modelo = new conexion;
                          $conexion = $modelo->get_conexion();
                          $consulta = "SELECT * FROM empresas_cliente";
                          $stmt = $conexion->query($consulta);
                          $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($resultados as $fila) {
                            echo '<option value="'. $fila['ID_Empresa'] .'">'.$fila['Nombre'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="contactoInput">Nombre del contacto</label>
                      <input type="text" name="nombreCli" class="form-control" id="contactoInputR" placeholder="EJ: Eduardo Rodríguez" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="correoInput">Email</label>
                      <input type="email" name="emailCli" class="form-control" id="correoInputR" placeholder="Correo@Example.com" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="celularInput">Celular contacto</label>
                      <input type="number" name="celularCli" class="form-control" id="celularInputR" placeholder="No. de celular" required pattern="[0-9]{10}" title="Ingrese un número de 10 dígitos">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Registrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

</div>

<!-- REQUIRED SCRIPTS -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/dist/js/adminlte.min.js"></script>
<script src="../dashboard/dist/js/sweetalert2.all.min.js"></script>

<!-- Alerts -->
<?php 
  if (isset($_SESSION['titulo'])) {
    echo "<script>
      Swal.fire({
        title: '{$_SESSION['titulo']}',
        text: '{$_SESSION['msj']}',
        icon: '{$_SESSION['icono']}',
        confirmButtonColor: '#e4112f'
      });
    </script>";
    unset($_SESSION['titulo'], $_SESSION['msj'], $_SESSION['icono']);
  }

  if (isset($_SESSION['otra'])) {
    echo $_SESSION['otra'];
    unset($_SESSION['otra']);
  }

  if (isset($_SESSION['seguridad'])) {
    echo $_SESSION['seguridad'];
    unset($_SESSION['seguridad']);
  }
?>
</body>
</html>
