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
    <title>Timeout | Contacto</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome/css/all.css">

    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" href="images/FAVICON_TIMEOUT.png" type="image/x-icon">
    <link rel="icon" href="images/FAVICON_TIMEOUT.png" type="image/x-icon">
    <!-- estilos para las alertas de sweetalert2 -->
    <link rel="stylesheet" href="../dashboard/dist/css/sweetalert2.min.css">
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
                        <li class="nav-item ">
                            <a class="nav-link text-white px-0 pt-0" href="../../index.php">Inicio</a>
                        </li>
                        <li class="nav-item  accordion">
                            <a class="nav-link text-white" href="#!" role="button" data-toggle="collapse"
                                data-target="#drop-menu" aria-expanded="false" aria-controls="drop-menu">Acerca De</a>
                            <div id="drop-menu" class="drop-menu collapse">
                                <a class="d-block " href="about.php">¿Quiénes Somos?</a>
                                <a class="d-block " href="privacy.php">Términos Y Condiciones</a>
                            </div>
                        </li>
                        <li class="nav-item active">
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
                                <img src="images/logo.png" alt="">
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

                <div class="row" style="justify-content: center">
                    <div class="col-md-10 my-5">
                        <div class="contact-form" style="background-color: #1A191E;">
                            <h1 class="text-white add-letter-space mb-5">Exprésanos Tus Inquietudes!</h1>
                            <form action="../../controller/CreatePQR.php" method="POST" class="formulario-contacto">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label for="firstName" class="text-black-300">Nombres</label>
                                            <input type="text" name="Nombres_pqr" id="firstName"
                                                class="form-control bg-transparent rounded-0 border-bottom shadow-none pb-15 px-0"
                                                placeholder="Robert Lee" required>
                                            <p class="invalid-feedback">¡Por favor ingrese su nombre!</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label for="lastName" class="text-black-300">Apellidos</label>
                                            <input type="text" name="Apellidos_pqr" id="lastName"
                                                class="form-control bg-transparent rounded-0 border-bottom shadow-none pb-15 px-0"
                                                placeholder="Anderson" required>
                                            <p class="invalid-feedback">¡Por favor ingrese su apellido!</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label for="email" class="text-black-300">E-Mail</label>
                                            <input type="email" name="Email_pqr" id="email"
                                                class="form-control bg-transparent rounded-0 border-bottom shadow-none pb-15 px-0"
                                                placeholder="Example@gmail.com" required>
                                            <p class="invalid-feedback">¡Por favor ingrese su correo!</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label class="text-black-300">Motivo De Tu PQR?</label>
                                            <select class="d-block w-100" name="Motivo_pqr">
                                                <option value="" selected>Seleccione una opción</option>
                                                <option value="Propuestas">Propuestas</option>
                                                <option value="Preguntas">Preguntas</option>
                                                <option value="Quejas">Quejas</option>
                                                <option value="Reclamos">Reclamos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-5">
                                            <label for="message"  class="text-black-300">Escribe Tu Mensaje Aqui:</label>
                                            <textarea name="Mensaje_pqr" maxlength="300" id="mensaje"
                                                class="form-control bg-transparent rounded-0 border-bottom shadow-none pb-15 px-0"
                                                placeholder="Hola COMUNICATE SG! Mi opinión es..."
                                                required></textarea>
                                            <p id="contador" style="display: flex; justify-content: end;">0/300</p>
                                            <p class="invalid-feedback">¡Por favor ingrese su feedback!</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm btn-primary">Enviar <img
                                                src="images/arrow-right.png" alt=""></button>
                                    </div>
                                </div>
                            </form>
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
    <script>
        var mensaje = document.getElementById('mensaje');
        var contador = document.getElementById('contador');

        mensaje.addEventListener('input', function(a) {
        var target = a.target;
        var longitudMax = target.getAttribute('maxlength');
        var longitudAct = target.value.length;
        contador.innerHTML = `${longitudAct}/${longitudMax}`;
});
    </script>
    <!-- All JS Files -->
    <script src="plugins/jQuery/jquery.min.js"></script>
    <script src="plugins/bootstrap/bootstrap.min.js"></script>

    <!-- Main Script -->
    <script src="js/script.js"></script>
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
                // tiempo que aparece la alerta '1000' es lo mismo que 1 segundo
                // timer: 10000
            })
            </script>
        <?php
            unset($_SESSION['titulo']);
            unset($_SESSION['msj']);
            unset($_SESSION['icono']);
        }
    ?>
    <!-- Alerta -->
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