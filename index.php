<?php 
    require_once("model/validarSesion.php");
?>
<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Timeout</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="galaxy" />

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="view/client-side/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="view/client-side/plugins/fontawesome/css/all.css">

    <!-- Main Stylesheet -->
    <link href="view/client-side/css/style.css" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" href="view/client-side/images/FAVICON_TIMEOUT.png" type="image/x-icon">
    <link rel="icon" href="view/client-side/images/FAVICON_TIMEOUT.png" type="image/x-icon">

</head>

<body>
    <!-- START preloader-wrapper -->
    <div class="preloader-wrapper">
        <div class="preloader-inner">
            <div class="spinner-border text-red"></div>
        </div>
    </div>
    <!-- END preloader-wrapper -->
    <!-- START main-wrapper -->
    <section class="d-flex">

        <!-- start of sidenav -->
        <aside>
            <div class="sidenav position-sticky d-flex flex-column justify-content-between">
                <a class="navbar-brand" href="index.php" class="logo">
                    <img src="view/client-side/images/LOGO_TIMEOUT.png" alt="">
                </a>
                <!-- end of navbar-brand -->

                <div class="navbar navbar-dark my-4 p-0 font-primary">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item active">
                            <a class="nav-link text-white px-0 pt-0" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item  accordion">
                            <a class="nav-link text-white" href="#!" role="button" data-toggle="collapse"
                                data-target="#drop-menu" aria-expanded="false" aria-controls="drop-menu">Acerca De</a>
                            <div id="drop-menu" class="drop-menu collapse">
                                <a class="d-block " href="view/client-side/about.php">¿Quiénes Somos?</a>
                                <a class="d-block " href="view/client-side/privacy.php">Términos Y Condiciones</a>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white px-0" href="view/client-side/contact.php">Contacto</a>
                        </li>
                        <?php 
                           session_start();
                           if (!isset($_SESSION['id'])){
                               echo '
                                <li class="nav-item mt-3">
                                    <a href="view/client-side/login.php" class="btn btn-primary" style="width: 80%">Iniciar Sesion <img
                                    src="view/client-side/images/arrow-right.png" alt="Imagen de una flecha"></a>
                                </li>';
                           } else {
                               if ($_SESSION['rol'] == "Administrador") {
                                   echo '
                                   <li class="nav-item mt-3">
                                       <a href="view/administrador/homeAdmin.php" class="btn btn-primary" style="width: 80%">Ingresar<img
                                       src="view/client-side/images/arrow-right.png" alt="Imagen de una flecha"></a>
                                   </li>';
                               } else if ($_SESSION['rol'] == "Vendedor") {
                                   echo '
                                   <li class="nav-item mt-3">
                                       <a href="view/vendedor/homeVendedor.php" class="btn btn-primary" style="width: 80%">Ingresar<img
                                       src="view/client-side/images/arrow-right.png" alt="Imagen de una flecha"></a>
                                   </li>';
                               } else if ($_SESSION['rol'] == "Cliente") {
                                   echo '
                                   <li class="nav-item mt-3">
                                       <a href="view/cliente/homeCliente.php" class="btn btn-primary" style="width: 80%">Ingresar<img
                                       src="view/client-side/images/arrow-right.png" alt="Imagen de una flecha"></a>
                                   </li>';
                               }
                           }
                        ?>
                    </ul>
                </div>
                <!-- end of navbar -->
            </div>
        </aside>
        <!-- end of sidenav -->
        <div class="main-content bg-dark">
            <!-- start of mobile-nav -->
            <header class="mobile-nav pt-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <a href="view/client-side/index.html">
                                <img src="view/client-side/images/LOGO_TIMEOUT.png" alt="">
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <button class="nav-toggle bg-transparent border text-white">
                                <span class="fas fa-bars"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            <div class="nav-toggle-overlay"></div>
            <!-- end of mobile-nav -->

            <div class="container pt-4 mt-5">
                <div class="row" style="justify-content: center">
                    <div class="col-lg-10">
                        <div class="card post-item bg-transparent border-0 mb-5">
                            <a href="https://www.google.com/maps/@4.69374,-74.0336923,3a,75y,232.29h,102.7t/data=!3m6!1e1!3m4!1sMzsuMW-f674rHBGQj1r4hA!2e0!7i16384!8i8192?coh=205409&entry=ttu&g_ep=EgoyMDI0MTAxNS4wIKXMDSoASAFQAw%3D%3D"
                                target="_blank">
                                <img class="card-img-top rounded-0" src="view/client-side/images/03.png"
                                    alt="">
                            </a>
                            <div class="card-body px-0">
                                <h2 class="card-title">
                                    <a class="text-white opacity-75-onHover">¡Bienvenido a TIMEOUT!</a>
                                </h2>

                                <p class="card-text my-4">Herramienta de alertamientos para documentación.<br>
                                    ¡Bienvenido al sistema de alertamiento para documentación de procesos para cumplimiento de calidad!<br>
                                    Nos encontramos en <a class=" text-primary" href="https://www.google.com/maps/@4.69374,-74.0336923,3a,75y,232.29h,102.7t/data=!3m6!1e1!3m4!1sMzsuMW-f674rHBGQj1r4hA!2e0!7i16384!8i8192?coh=205409&entry=ttu&g_ep=EgoyMDI0MTAxNS4wIKXMDSoASAFQAw%3D%3D"
                                        target="_blank">Ac 116 #7-15, Bogotá</a></p>
                                <a href="view/client-side/contact.php" class="btn btn-primary">Contactanos!<img
                                        src="view/client-side/images/arrow-right.png" alt="flecha"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- start of footer -->
            <footer class="" style="background-color: #1A191E;">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-lg-12 col-sm-6 mb-5">
                            <br>
                            <h5 class="font-primary text-white mb-4">TIOMEOUT - Información de los desarrolladores</h5>
                            <div style="display: flex; justify-content: space-evenly;">
                                <div>
                                    <p style="color: #b0b0b0; font-size: small;">Wilder Quinto<br>wilder.quinto@ikusi.com</p>
                                </div>
                                <div>
                                    <p style="color: #b0b0b0; font-size: small;">Sebastian Rodriguez<br>mauricio.rodriguez@ikus.com</p>
                                </div>
                            </div>
                            <br>
                            <p style="font-size: small;">Copyright © 2024-2025 Timeout.</p>
                            <p style="font-size: small;">Ac 116 #7-15, Bogotá - Colombia</p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end of footer -->
        </div>

    </section>
    <!-- END main-wrapper -->

    <!-- All JS Files -->
    <script src="view/client-side/plugins/jQuery/jquery.min.js"></script>
    <script src="view/client-side/plugins/bootstrap/bootstrap.min.js"></script>

    <!-- Main Script -->
    <script src="view/client-side/js/script.js"></script>
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
        if (isset($_SESSION['alertaSeguridad'])) {
            $alerta = $_SESSION['alertaSeguridad'];
            echo $alerta;
            unset($_SESSION['alertaSeguridad']);
        }
    ?>
</body>

</html>