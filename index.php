<?php 
    require_once("model/validarSesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timeout</title>
    
    <!-- Bootstrap & Plugins -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/client-side/plugins/fontawesome/css/all.css">

    <!--Favicon-->
    <link rel="shortcut icon" href="view/client-side/images/FAVICON_TIMEOUT.png" type="image/x-icon">
    <link rel="icon" href="view/client-side/images/FAVICON_TIMEOUT.png" type="image/x-icon">
    <style>
        :root {
            --timeout-red: #e4112f;
            --timeout-dark: #1A191E;
        }

        body {
            background-color: var(--timeout-dark);
            color: white;
        }

        /* Preloader */
        .preloader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--timeout-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Sidebar */
        .sidenav {
            width: 250px;
            height: 100vh;
            background: var(--timeout-dark);
            padding: 2rem;
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .sidenav .navbar-brand img {
            width: 150px;
            height: auto;
        }

        .drop-menu {
            padding-left: 1rem;
        }

        .drop-menu a {
            color: #b0b0b0;
            text-decoration: none;
            padding: 0.5rem 0;
            transition: color 0.3s;
        }

        .drop-menu a:hover {
            color: white;
        }

        /* Carousel/Slider */
        .carousel {
            margin-bottom: 3rem;
        }

        .carousel-item {
            height: 500px;
        }

        .carousel-item img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .carousel-item:hover img {
            transform: scale(1.02);
            filter: brightness(1.1);
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 8px;
            bottom: 3rem;
        }

        .carousel-indicators {
            bottom: 1rem;
        }

        .carousel-indicators [data-bs-target] {
            background-color: var(--timeout-red);
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 6px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            min-height: 100vh;
        }

        .card {
            background: rgba(255, 255, 255, 0.05) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .card-img-top {
            height: 400px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .opacity-75-onHover:hover {
            opacity: 0.75;
        }

        /* Mobile Nav */
        .mobile-nav {
            display: none;
            background: var(--timeout-dark);
        }

        @media (max-width: 991px) {
            .sidenav {
                display: none;
            }
            .mobile-nav {
                display: block;
            }
            .carousel-item {
                height: 300px;
            }
        }

        /* Footer */
        footer {
            background-color: var(--timeout-dark);
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .btn-primary {
            background-color: var(--timeout-red);
            border-color: var(--timeout-red);
        }

        .btn-primary:hover {
            background-color: #cc0000;
            border-color: #cc0000;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-wrapper">
        <div class="preloader-inner">
            <div class="spinner-border text-danger"></div>
        </div>
    </div>

    <!-- Main Wrapper -->
    <section class="d-flex">
        <!-- Sidebar -->
        <aside>
            <div class="sidenav position-sticky d-flex flex-column justify-content-between">
                <a class="navbar-brand text-center" href="index.php">
                 <img src="view/client-side/images/FAVICON_TIMEOUT.png" alt="">
                 <br>
                 <span class="h4">TIMEOUT</span>
                </a>
                
                <div class="navbar navbar-dark my-4 p-0">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item active">
                            <a class="nav-link text-white px-0 pt-0" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item accordion">
                            <a class="nav-link text-white" href="#!" data-bs-toggle="collapse" data-bs-target="#drop-menu">
                                Acerca De
                            </a>
                            <div id="drop-menu" class="drop-menu collapse">
                                <a class="d-block" href="view/client-side/about.php">¿Quiénes Somos?</a>
                                <a class="d-block" href="view/client-side/privacy.php">Términos Y Condiciones</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white px-0" href="view/client-side/contact.php">Contacto</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="btn btn-danger text-white" href="view/client-side/login.php">
                                Iniciar Sesión <i class="fas fa-sign-in-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Mobile Nav -->
            <header class="mobile-nav pt-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="/api/placeholder/150/50" alt="Timeout Logo">
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Carousel/Slider -->
            <div id="timeoutCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#timeoutCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#timeoutCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#timeoutCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="view/client-side/images/03.png" class="d-block w-100" alt="Timeout Office">
                        <div class="carousel-caption">
                            <h2>Sistema de Alertamiento</h2>
                            <p>Gestiona tus documentos de manera eficiente</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="view/client-side/images/03.png" class="d-block w-100" alt="Documentation">
                        <div class="carousel-caption">
                            <h2>Documentación Inteligente</h2>
                            <p>Control total de tus procesos de calidad</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="view/client-side/images/03.png" class="d-block w-100" alt="Quality">
                        <div class="carousel-caption">
                            <h2>Mejora Continua</h2>
                            <p>Optimiza tus procesos empresariales</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#timeoutCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#timeoutCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Main Content Area -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card post-item border-0 mb-5">
                            <div class="card-body px-4 py-5">
                                <h2 class="card-title text-center mb-4">
                                    <span class="text-white opacity-75-onHover">¡Bienvenido a TIMEOUT!</span>
                                </h2>
                                <p class="card-text text-center text-white mb-4">
                                    Herramienta de alertamientos para documentación.<br>
                                    ¡Bienvenido al sistema de alertamiento para documentación de procesos para cumplimiento de calidad!<br>
                                    Nos encontramos en <a class="text-primary" href="https://www.google.com/maps" target="_blank">
                                        Ac 116 #7-15, Bogotá
                                    </a>
                                </p>
                                <div class="text-center">
                                    <a href="view/client-side/contact.php" class="btn btn-primary btn-lg">
                                        Contáctanos <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer>
                <div class="container">
                    <div class="row text-center">
                        <div class="col-12">
                            <h5 class="mb-4">TIMEOUT - Información de los desarrolladores</h5>
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <p class="text-white small">
                                        Wilder Quinto<br>
                                        wilder.quinto@ikusi.com
                                    </p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <p class="text-white small">
                                        Sebastian Rodriguez<br>
                                        mauricio.rodriguez@ikusi.com
                                    </p>
                                </div>
                            </div>
                            <p class="small">Copyright © 2024-2025 Timeout.</p>
                            <p class="small">Ac 116 #7-15, Bogotá - Colombia</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preloader
        window.addEventListener('load', () => {
            document.querySelector('.preloader-wrapper').style.display = 'none';
        });

        // Initialize carousel with custom settings
        const carousel = new bootstrap.Carousel(document.getElementById('timeoutCarousel'), {
            interval: 5000,
            touch: true,
            ride: 'carousel'
        });
    </script>
</body>
</html>