<?php include("../../Controller/Soporte/Funciones/requiresOnce.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi Perfil | Timeout</title>

  <!-- Favicon -->
  <link href="../client-side/images/FAVICON_TIMEOUT.png" rel="shortcut icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <!-- Estilos para las alertas de sweetalert2 -->
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
        <a href="homeOperador.php" class="nav-link">Inicio</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="../../controller/Soporte/seguridadOperador.php?cierre=si" class="cierre">Cerrar sesión</a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1a191e">
    <a href="homeOperador.php" class="brand-link">
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
      <?php include("../Modulos/MenuOperador.php"); ?>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mi Perfil</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <?php CargarPerfil(); ?>
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

<!-- Scripts -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/dist/js/adminlte.min.js"></script>
<script src="../dashboard/dist/js/sweetalert2.all.min.js"></script>

<?php 
// Mostrar mensaje de alerta si hay datos en sesión
if (isset($_SESSION['titulo'])) {
  $titulo = $_SESSION['titulo'];
  $msj = $_SESSION['msj'];
  $icono = $_SESSION['icono'];
  echo "<script>
    Swal.fire({
      title: '$titulo',
      text: '$msj',
      icon: '$icono',
      confirmButtonColor: '#e4112f'
    });
  </script>";
  unset($_SESSION['titulo'], $_SESSION['msj'], $_SESSION['icono']);
}

// Alerta de notificaciones leídas
if (isset($_SESSION['otra'])) {
  echo $_SESSION['otra'];
  unset($_SESSION['otra']);
}

// Alerta de seguridad
if (isset($_SESSION['seguridad'])) {
  echo $_SESSION['seguridad'];
  unset($_SESSION['seguridad']);
}
?>
</body>
</html>
