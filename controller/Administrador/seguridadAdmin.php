<?php
    session_start();

    if (!isset($_SESSION['autenticacion'])) {
        $alerta = "
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Debe iniciar sesión para acceder a esa interfaz.',
                icon: 'error',
                confirmButtonColor: '#e4112f'
            })()
        </script>";
        $_SESSION['seguridad'] = $alerta;
        echo "<script> location.href='../client-side/login.php'</script>";
    } 
    if ($_SESSION['rol'] != 1) {
        $alertaRol = "
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Su rol no tiene acceso a esa interfaz.',
                icon: 'error',
                confirmButtonColor: '#e4112f'
            })()
        </script>";
        $_SESSION['seguridad'] = $alertaRol;
        echo "<script> window.history.back();</script>";
    }
    if (isset($_GET['cierre']) == "si"){
        unset($_SESSION['autenticacion']);
        unset($_SESSION['rol']);
        session_destroy();
        echo "<script> location.href='../../index.php'</script>";
    }

?>