<?php include ("../../Controller/Administrador/Funciones/requiresOnce.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrar Ticket | Timeout</title>

  <!-- favicon -->
  <link href="../client-side/images/FAVICON_TIMEOUT.png" rel="shortcut icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
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
      <img src="../client-side/images/FAVICON_TIMEOUT.png" alt="Logo Timeout" class="brand-image">
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
      <?php include ("../Modulos/Menu.php"); ?>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registrar Ticket</h1>
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
                <h5 class="m-0">Formulario para el registro de tickets</h5>
              </div>
              <form action="../../controller/Administrador/insertTicketA.php" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="numTicket">Ticket</label>
                      <input type="text" name="ticket" class="form-control" id="numTicketR" placeholder="Número de ticket" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="AsuntoTicket">Asunto</label>
                      <input type="text" name="asuntoCorreo" class="form-control" id="AsuntoTicketR" placeholder="Asunto correo" required>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group mb-5">
                        <label for="message">Descripción</label>
                        <textarea name="descripcion" maxlength="200" id="mensaje" class="form-control bg-transparent rounded-0 border-bottom shadow-none pb-15 px-10" placeholder="Ingrese la descripción del ticket." required></textarea>
                        <p id="contador" style="display: flex; justify-content: end;">0/200</p>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cargoInput">Ingeniero a cargo</label>
                      <select class="form-control" name="cargoIng" id="cargoUser" required>
                        <option value="" selected>Seleccione una opción</option>
                        <?php 
                          $conexion = (new conexion)->get_conexion();
                          $consulta = "SELECT * FROM Usuarios";
                          $stmt = $conexion->query($consulta);
                          $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($resultados as $fila) {
                            echo '<option value="' . $fila['ID_User'] . '">' . $fila['Nombre'] . " " . $fila['Apellido'] . '</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="empresaInput">Empresa cliente</label>
                      <select class="form-control" name="empresaCli" id="empresaInputR" required>
                        <option value="" selected>Seleccione una opción</option>
                        <?php 
                          $consulta = "SELECT * FROM empresas_cliente";
                          $stmt = $conexion->query($consulta);
                          $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($resultados as $fila) {
                            echo '<option value="' . $fila['ID_Empresa'] . '">' . $fila['Nombre'] . '</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="estadoTicketInput">Estado ticket</label>
                      <select class="form-control" name="estadoTicket" id="estadoTicketR" required>
                        <option value="" selected>Seleccione una opción</option>
                        <?php 
                          $consulta = "SELECT * FROM estado_tickets";
                          $stmt = $conexion->query($consulta);
                          $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($resultados as $fila) {
                            echo '<option value="' . $fila['ID_Estado_Ticket'] . '">' . $fila['Estado'] . '</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="prioridadInput">Prioridad</label>
                      <select class="form-control" name="prioridad" id="prioridadR" required>
                        <option value="" selected>Seleccione una opción</option>
                        <?php 
                          $consulta = "SELECT * FROM prioridades";
                          $stmt = $conexion->query($consulta);
                          $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($resultados as $fila) {
                            $descripcion = strpos($fila['Descripcion'], 'plataforma') !== false ? substr($fila['Descripcion'], strpos($fila['Descripcion'], 'plataforma')) : $fila['Descripcion'];
                            echo '<option value="' . $fila['ID_Prioridad'] . '">' . $fila['Prioridad'] . " para " . $descripcion . '</option>';
                          }
                        ?>
                      </select>
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

  <script src="../dashboard/plugins/jquery/jquery.min.js"></script>
  <script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dashboard/dist/js/adminlte.min.js"></script>
  <script src="../dashboard/dist/js/sweetalert2.all.min.js"></script>

  <script>
    var mensaje = document.getElementById('mensaje');
    var contador = document.getElementById('contador');
    mensaje.addEventListener('input', function(a) {
      var longitudMax = a.target.getAttribute('maxlength');
      var longitudAct = a.target.value.length;
      contador.innerHTML = `${longitudAct}/${longitudMax}`;
    });
  </script>

  <?php 
    if (isset($_SESSION['titulo'])) {
      $titulo = $_SESSION['titulo'];
      $msj = $_SESSION['msj'];
      $icono = $_SESSION['icono'];
      echo "<script>Swal.fire({title: '$titulo', text: '$msj', icon: '$icono', confirmButtonColor: '#e4112f'});</script>";
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
