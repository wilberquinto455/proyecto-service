<?php 
    require_once("../../model/validarSesion.php");
?>

<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html>

<head>
    <meta charset="utf-8">
    <title>Timeout | Acerca De</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome/css/all.css">
    <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">


    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" href="images/FAVICON_TIMEOUT.png" type="image/x-icon">
    <link rel="icon" href="images/FAVICON_TIMEOUT.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


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
                <a class="navbar-brand" href="../../index.php" class="logo">
                    <img src="images/LOGO_TIMEOUT.png" alt="">
                </a>
                <!-- end of navbar-brand -->

                <div class="navbar navbar-dark my-4 p-0 font-primary">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item">
                            <a class="nav-link text-white px-0 pt-0" href="../../index.php">Inicio</a>
                        </li>
                        <li class="nav-item active accordion">
                            <a class="nav-link text-white" href="#!" role="button" data-toggle="collapse"
                                data-target="#drop-menu" aria-expanded="false" aria-controls="drop-menu">Acerca De</a>
                            <div id="drop-menu" class="drop-menu collapse">
                                <a class="d-block " href="about.php">¿Quiénes Somos?</a>
                                <a class="d-block " href="privacy.php">Términos Y Condiciones</a>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white px-0" href="contact.php">Contacto</a>
                        </li>
                        <?php 
                            session_start();
                            if (!isset($_SESSION['id'])){
                                echo '
                                    <li class="nav-item mt-3">
                                        <a href="login.php" class="btn btn-primary" style="width: 80%">Iniciar Sesion <img
                                        src="images/arrow-right.png" alt="Imagen de una flecha"></a>
                                    </li>';
                            } else {
                                if ($_SESSION['rol'] == "Administrador") {
                                    echo '
                                    <li class="nav-item mt-3">
                                        <a href="../administrador/homeAdmin.php" class="btn btn-primary" style="width: 80%">Ingresar<img
                                        src="images/arrow-right.png" alt="Imagen de una flecha"></a>
                                    </li>';
                                } else if ($_SESSION['rol'] == "Vendedor") {
                                    echo '
                                    <li class="nav-item mt-3">
                                        <a href="../vendedor/homeVendedor.php" class="btn btn-primary" style="width: 80%">Ingresar<img
                                        src="images/arrow-right.png" alt="Imagen de una flecha"></a>
                                    </li>';
                                } else if ($_SESSION['rol'] == "Cliente") {
                                    echo '
                                    <li class="nav-item mt-3">
                                        <a href="../cliente/homeCliente.php" class="btn btn-primary" style="width: 80%">Ingresar<img
                                        src="images/arrow-right.png" alt="Imagen de una flecha"></a>
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
                            <a href="../../index.html">
                                <img src="images/logo-dos.png" alt="">
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
            <div class="container py-4 my-5">
                <div class="row">
                    <div class="col-lg-5 col-md-8">
                    </div>
                </div>
                <div class="row" style="justify-content: center;">
                    <div class="col-md-9">
                        <h1 class="text-white add-letter-space my-4">Acerca De</h1>
                        <h3 class="text-white add-letter-space my-3">Proyecto Timeout</h3>
                            <p>Lorem ipsum dolor sit.</p>
                            <p>Lorem ipsum dolor sit.</p>
                        <h3 class="text-white add-letter-space my-3">Página Web</h3>
                        <p>Lorem ipsum dolor sit.</p>
                        <h3 class="text-white mb-3 add-letter-space  my-3">Nosotros</h3>
                            <p>Lorem ipsum dolor sit.</p>
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
    <script src="plugins/jQuery/jquery.min.js"></script>
    <script src="plugins/bootstrap/bootstrap.min.js"></script>

    <!-- Main Script -->
    <script src="js/script.js"></script>
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