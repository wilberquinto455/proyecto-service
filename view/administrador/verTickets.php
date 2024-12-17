<?php include ("../../Controller/Administrador/Funciones/requiresOnce.php")?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tickets Registrados | Timeout</title>

  <!-- favicon -->
  <link href="../client-side/images/FAVICON_TIMEOUT.png" rel="shortcut icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <!-- estilos para las alertas de sweetalert2 -->
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

  <!-- Main Sidebar Container -->
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
      <?php include ("../Modulos/Menu.php") ?>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tickets registrados</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">Tickets registrados en el sistema</h5>
              </div>
              <div class="card-body">
                  <?php
                    cargarTickets();
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- SCRIPTS NECESARIOS -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../dashboard/plugins/jszip/jszip.min.js"></script>
<script src="../dashboard/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../dashboard/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../dashboard/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../dashboard/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../dashboard/dist/js/adminlte.min.js"></script>
<script src="../dashboard/dist/js/sweetalert2.all.min.js"></script>

<script>
  $(function () {
    // Inicializar DataTables con buscador y exportación
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<!-- la alerta de confirmacion para borarr esta en el cotrolador -->
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
