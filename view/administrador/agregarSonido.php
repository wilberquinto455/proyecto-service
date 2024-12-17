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
  <title>Agregar sonido | Timeout</title>

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

  <style>
    .upload-container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background: #f8f9fa;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .drag-area {
      border: 2px dashed #dc3545;
      height: 200px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      margin: 20px 0;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .drag-area.active {
      border-color: #28a745;
      background: #f8f9fa;
    }

    .drag-area .icon {
      font-size: 50px;
      color: #dc3545;
    }

    .drag-area h3 {
      font-size: 20px;
      font-weight: 500;
      color: #34495e;
    }

    .drag-area span {
      font-size: 14px;
      font-weight: 500;
      color: #999;
      margin: 10px 0 15px 0;
    }

    .audio-preview {
      width: 100%;
      margin-top: 20px;
      display: none;
    }

    .file-details {
      margin-top: 20px;
      padding: 10px;
      background: #fff;
      border-radius: 5px;
      display: none;
    }

    .progress-area {
      height: 30px;
      border-radius: 30px;
      background: #f0f0f0;
      margin: 20px 0;
      display: none;
      overflow: hidden;
    }

    .progress-bar {
      height: 100%;
      width: 0%;
      background: #dc3545;
      transition: width 0.3s ease;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-control {
      width: 100%;
      padding: 0.375rem 0.75rem;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
    }

    .btn-submit {
      background: #dc3545;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }

    .btn-submit:hover {
      background: #c82333;
    }
  </style>
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
            <h1 class="m-0">Agregar Sonido</h1>
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
                <h5 class="m-0">Formulario para agregar sonido</h5>
              </div>
              <form action="../../controller/Administrador/insertSonido.php" method="POST" enctype="multipart/form-data" id="uploadForm">
    <div class="upload-container">
      <div class="form-group">
        <label for="nombreInput">Nombre de la canción</label>
        <input type="text" name="nombreMusica" class="form-control" id="nombreMusica" placeholder="Ej: Canción de verano" required>
      </div>

      <div class="form-group">
        <label for="tipoInput">Tipo de música</label>
        <select class="form-control" name="tipoMusica" id="tipoMusica" placeholder="Ej: Rock, Pop, Jazz" required>
             <option value="" selected>Seleccione una opción</option>
               <?php 
                $modelo = new conexion;
                $conexion = $modelo -> get_conexion();
                // Consulta para obtener datos de la base de datos
                $consulta = "SELECT * FROM  tipo_sonido";
                $stmt = $conexion -> query($consulta);
                // Obtener los resultados como un array
                $resultados = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                  foreach ($resultados as $fila) {
                    echo '<option value="'. $fila['idtipo_sonido'] .'">'.$fila['tipo_nombre'].'</option>';
                   }
                ?>
         </select>
      </div>

      <div class="drag-area">
        <div class="icon">🎵</div>
        <h3>Arrastra y suelta el archivo de audio</h3>
        <span>O</span>
        <button type="button" class="browse">Seleccionar archivo</button>
        <input type="file" name="rutaArchivo" id="fileInput" accept="audio/*" hidden required>
      </div>

      <div class="file-details">
        <p>Nombre del archivo: <span id="fileName"></span></p>
        <p>Tamaño: <span id="fileSize"></span></p>
        <p>Tipo: <span id="fileType"></span></p>
      </div>

      <div class="progress-area">
        <div class="progress-bar"></div>
      </div>

      <audio controls class="audio-preview" id="audioPreview">
        Tu navegador no soporta el elemento de audio.
      </audio>

      <input type="hidden" name="duracion" id="duracion">
      <input type="hidden" name="fechaSubida" id="fechaSubida">

      <button type="submit" class="btn-submit">Subir música</button>
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

<script>
    const dragArea = document.querySelector(".drag-area");
    const dragText = document.querySelector(".drag-area h3");
    const button = document.querySelector(".browse");
    const input = document.querySelector("#fileInput");
    const preview = document.querySelector("#audioPreview");
    const fileDetails = document.querySelector(".file-details");
    const progressArea = document.querySelector(".progress-area");
    const progressBar = document.querySelector(".progress-bar");

    button.onclick = () => {
      input.click();
    }

    input.addEventListener("change", function() {
      const file = this.files[0];
      displayFile(file);
    });

    dragArea.addEventListener("dragover", (event) => {
      event.preventDefault();
      dragArea.classList.add("active");
      dragText.textContent = "Suelta para subir el archivo";
    });

    dragArea.addEventListener("dragleave", () => {
      dragArea.classList.remove("active");
      dragText.textContent = "Arrastra y suelta el archivo de audio";
    });

    dragArea.addEventListener("drop", (event) => {
      event.preventDefault();
      const file = event.dataTransfer.files[0];
      displayFile(file);
    });

    function displayFile(file) {
      if (file && file.type.startsWith('audio/')) {
        const reader = new FileReader();
        
        reader.onload = () => {
          preview.src = reader.result;
          preview.style.display = "block";
          
          // Mostrar detalles del archivo
          document.getElementById("fileName").textContent = file.name;
          document.getElementById("fileSize").textContent = formatSize(file.size);
          document.getElementById("fileType").textContent = file.type;
          fileDetails.style.display = "block";

          // Obtener duración cuando se carga el audio
          preview.onloadedmetadata = () => {
            document.getElementById("duracion").value = formatTime(preview.duration);
          };
        }

        reader.readAsDataURL(file);

        // Simular progreso de carga
        progressArea.style.display = "block";
        simulateUploadProgress();
      }
    }

    function formatSize(bytes) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB', 'GB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function formatTime(seconds) {
      const date = new Date(null);
      date.setSeconds(seconds);
      return date.toISOString().substr(11, 8);
    }

    function simulateUploadProgress() {
      let width = 0;
      const interval = setInterval(() => {
        if (width >= 100) {
          clearInterval(interval);
        } else {
          width++;
          progressBar.style.width = width + "%";
        }
      }, 20);
    }

    // Establecer fecha actual
    document.getElementById("fechaSubida").value = new Date().toISOString().slice(0, 19).replace('T', ' ');
  </script>
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
