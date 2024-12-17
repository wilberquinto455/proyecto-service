<?php 
    require_once("../../model/validarSesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - TimeOut</title>
    <!-- Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome/css/all.css">
    <!--Favicon-->
    <link rel="shortcut icon" href="images/FAVICON_TIMEOUT.png" type="image/x-icon">
    <link rel="icon" href="images/FAVICON_TIMEOUT.png" type="image/x-icon">
    <!-- estilos para las alertas de sweetalert2 -->
    <link rel="stylesheet" href="../dashboard/dist/css/sweetalert2.min.css">
    <style>
        body {
            background-color: #343a40;
            min-height: 100vh;
        }
        .login-container {
            min-height: calc(100vh - 76px);
        }
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .input-group-text {
            background-color: transparent;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .input-group:hover .input-group-text,
        .input-group:hover .form-control {
            border-color: #dc3545;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .navbar-brand svg {
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center font-weight-bold" href="../../index.php">
            <img src="images/FAVICON_TIMEOUT.png" width="50" height="50" alt=""> 
              &nbsp;  TimeOut
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" 
                       id="navbarDropdown" role="button" 
                       data-toggle="dropdown" aria-expanded="false">
                        Acerca De
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="about.php">¿Quiénes Somos?</a>
                        <a class="dropdown-item" href="privacy.php">Términos Y Condiciones</a>
                    </div>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contacto</a>
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
        </div>
    </nav>

    <!-- Login Container -->
    <div class="container login-container">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 rounded-lg mt-5">
                    <div class="card-body p-5">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <svg class="text-danger" style="width: 64px; height: 64px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                            <h4 class="text-dark font-weight-bold mt-3">Recuperar Contraseña</h4>
                        </div>

                        <!-- Login Form -->
                        <form form action="../../controller/getPassword.php" method="POST" id="login-1">
                            <div class="login">
                                <div class="form-box">
                                    <input class="form-control mb-3" name="correo" type="email" placeholder="Correo" required>
                                    <input class="form-control mb-3" name="Telefono" type="number" placeholder="Celular" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block py-2 mt-4">
                                Enviar datos
                            </button>

                            <div class="text-center mt-3">
                                <a href="recuperarContraseña.php" class="small text-danger">¿Olvidaste tu Contraseña?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
  
     <!-- All JS Files -->
     <script src="plugins/jQuery/jquery.min.js"></script>
     <script src="js/script.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <!-- conexion con el js de sweetalert2 -->
    <script src="../dashboard/dist/js/sweetalert2.all.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('showPassword').addEventListener('change', function() {
            const password = document.getElementById('password');
            password.type = this.checked ? 'text' : 'password';
        });
    </script>
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