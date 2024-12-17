<?php include("../../Controller/Soporte/Funciones/requiresOnce.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Soporte | Timeout</title>

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
  <style>
        .timer-card {
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.2s;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .timer-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .timer-header {
            padding: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .timer-body {
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .timer-display {
            font-family: 'Courier New', monospace;
            font-size: 1.2rem;
            font-weight: bold;
            min-width: 100px;
            text-align: center;
        }

        .timer-controls {
            display: flex;
            gap: 5px;
        }

        .timer-controls button {
            padding: 4px 8px;
            font-size: 0.8rem;
        }

        .priority-badge {
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .priority-high {
            background-color: #fde8e8;
            color: #dc3545;
        }

        .priority-medium {
            background-color: #fff8e6;
            color: #ffc107;
        }

        .priority-low {
            background-color: #e8f5e9;
            color: #28a745;
        }

        .timer-progress {
            height: 4px;
            margin: 0;
            background-color: #f0f0f0;
        }

        .timer-container {
            max-width: 700px;
            margin: 20px auto;
            padding: 15px;
        }

        .badge-status {
            font-size: 0.75rem;
            padding: 3px 8px;
        }

        .time-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .time-remaining {
            font-size: 0.75rem;
            color: #666;
        }

        .time-limit {
            font-size: 0.7rem;
            color: #999;
        }

        .ticket-info {
            flex-grow: 1;
            margin-right: 15px;
        }

        .timer-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .progress {
            position: relative;
        }

        .progress-warning .progress-bar {
            background-color: #ffc107;
        }

        .progress-danger .progress-bar {
            background-color: #dc3545;
        }

        .meta-info {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 4px;
        }

        .meta-tag {
            font-size: 0.75rem;
            color: #666;
            display: flex;
            align-items: center;
            gap: 4px;
        }
    </style>
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
            <h1 class="m-0">¡Bienvenido!</h1>
          </div>

          
        </div>
        <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">Cronometro</h5>
              </div>
              <div class="card-body">
              <?php
                    cargarMisCronometros();
              ?> 
              </div>
            </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/dist/js/adminlte.min.js"></script>
<script src="../dashboard/dist/js/sweetalert2.all.min.js"></script>

<?php 
// Mostrar mensaje de alerta con SweetAlert si existe un mensaje en la sesión
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
?>
</body>
</html>
