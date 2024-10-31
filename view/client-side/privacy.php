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
    <title>Timeout | Terminos Y Condiciones</title>

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
                    <div class="col-md-9">
                        <h1 class="text-white add-letter-space mb-3">Política de Términos Y Condiciones</h1>
                        <p class="mb-5">Bienvenido a COMUNICATE SG. Estos términos y condiciones describen las reglas y regulaciones para el uso del sitio web de COMUNICATE SG.</p>
                        <ul class="list-unstyled">
                            <li class="bullet-list-item mb-5">
                                <h3 class="text-white mb-3 add-letter-space">COMUNICATE SG se encuentra en la drirección Cr 72 #63 A 37 Sur (Barrio El Perdomo)</h3>
                                <p>Al acceder a este sitio web, asumimos que aceptas estos términos y condiciones en su totalidad. 
                                    No continúes usando el sitio web, si no aceptas todos los términos y condiciones 
                                    establecidos en esta página.</p>
                                <p class="mt-4">La siguiente terminología se aplica a estos Términos y Condiciones, 
                                    Declaración de Privacidad y Aviso legal y cualquiera o todos los Acuerdos: el Cliente, 
                                    Usted y Su se refieren a usted, la persona que accede a este sitio web y acepta los términos y 
                                    condiciones de la Compañía. La Compañía, Nosotros mismos, Nosotros y Nuestro, se refiere a nuestra 
                                    Compañía. Parte, Partes o Nosotros, se refiere en conjunto al Cliente y a nosotros mismos, 
                                    o al Cliente o a nosotros mismos.
                                </p>
                                <p class="mt-4">Todos los términos se refieren a la oferta, aceptación y consideración del tratamiento de datos personales necesario 
                                    para efectuar el proceso de nuestra asistencia al Cliente de la manera más adecuada, 
                                    ya sea mediante reuniones formales de una duración fija, o por cualquier otro medio, con el propósito 
                                    expreso de conocer las necesidades del Cliente con respecto a la provisión de los servicios/productos 
                                    declarados de la Compañía, de acuerdo con y sujeto a la ley de protección de datos personales o Ley 1581 de 2012. <br>
                                    Cualquier uso de la terminología anterior u otras palabras en singular, plural, mayúsculas y/o, él/ella o ellos, 
                                    se consideran intercambiables y, por lo tanto, se refieren a lo mismo.</p>
                            </li>
                            <li class="bullet-list-item mb-5">
                                <h3 class="text-white mb-3 add-letter-space">Cookies</h3>
                                <p>Empleamos el uso de cookies. Al utilizar el sitio web de COMUNICATE SG, usted acepta el uso de cookies de 
                                    acuerdo con la política de privacidad de COMUNICATE SG. La mayoría de los modernos sitios web interactivos de 
                                    hoy en día usan cookies para permitirnos recuperar los detalles del usuario para cada visita. Las cookies se utilizan en 
                                    algunas áreas de nuestro sitio para habilitar la funcionalidad de esta área y la facilidad de uso para las personas que lo visitan. 
                                    Algunos de nuestros socios afiliados/publicitarios también pueden usar cookies.</p>
                            </li>
                            <li class="bullet-list-item mb-5">
                                <h3 class="text-white mb-3 add-letter-space">Licencia</h3>
                                <p>A menos que se indique lo contrario, COMUNICATE SG y/o sus licenciatarios les pertenecen los 
                                    derechos de propiedad intelectual de todo el material en COMUNICATE SG.</p>
                                <p class="mt-4">Todos los derechos de propiedad intelectual están reservados. Puedes ver y/o imprimir páginas desde nuestra 
                                    <a class="termino" href="../../index.php">página oficial</a> para tu uso personal sujeto a las restricciones establecidas en estos 
                                    términos y condiciones.</p>
                                    <p class="my-4">No debes:</p>
                                    <ol>
                                        <li class="mb-2">Volver a publicar material de <a class="termino" href="../../index.php">COMUNICATE SG</a>.</li>
                                        <li class="mb-2">Vender, alquilar u otorgar una sub-licencia de material de <a class="termino" href="../../index.php">COMUNICATE SG</a>.</li>
                                        <li class="mb-2">Reproducir, duplicar o copiar material de <a class="termino" href="../../index.php">COMUNICATE SG</a>.</li>
                                        <li>Redistribuir contenido de <a class="termino" href="../../index.php">COMUNICATE SG</a>, a menos de que el contenido se haga específicamente para la redistribución.</li>
                                    </ol>
                            </li>
                            <li class="bullet-list-item">
                                <h3 class="text-white mb-3 add-letter-space">Aviso legal</h3>
                                <p class="mt-4">En la medida máxima permitida por la ley aplicable, excluimos todas las representaciones, 
                                    garantías y condiciones relacionadas con nuestro sitio web y el uso de este sitio web (incluyendo, sin limitación, 
                                    cualquier garantía implícita por la ley con respecto a la calidad satisfactoria, idoneidad para el propósito y/o el uso de cuidado 
                                    y habilidad razonables).</p>
                                    <p class="my-4">Nada en este aviso legal:</p>
                                <ol>
                                    <li class="mb-2">Limita o excluye nuestra o su responsabilidad por fraude o tergiversación fraudulenta.</li>
                                    <li class="mb-2">Limita cualquiera de nuestras o sus responsabilidades de cualquier manera que no esté permitida por la ley aplicable.</li>
                                    <li class="mb-2">Excluye cualquiera de nuestras o sus responsabilidades que no pueden ser excluidas bajo la ley aplicable.</li>
                                </ol>
                                <p class="mt-4">Las limitaciones y exclusiones de responsabilidad establecidas en esta Sección y en otras partes de este aviso legal 
                                    están sujetas al párrafo anterior y rigen todas las responsabilidades que surjan bajo la exención de responsabilidad o 
                                    en relación con el objeto de esta exención de responsabilidad, incluidas las responsabilidades que surjan en contrato, 
                                    agravio (incluyendo negligencia) y por incumplimiento del deber legal.</p>
                                    <p class="mt-4">En la medida en que el sitio web y la información y los servicios en el sitio web se proporcionen de forma gratuita, 
                                        no seremos responsables de ninguna pérdida o daño de ningún tipo.</p>
                            </li>
                        </ul>
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