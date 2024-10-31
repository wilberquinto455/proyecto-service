<?php

    // Se validan dependencias y las consulta usuario.
    require_once('../model/conexion.php');
    require_once('../model/validarSesion.php');

    $email = $_POST['Correo'];
    $clave = md5($_POST['Password']);

    if (empty($email) || empty($clave)) {

        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor ingrese sus datos para iniciar sesión.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";

    } else {

        $Consultar = new validarSesion();
        //iniciar sesión de usuario
        $result = $Consultar -> iniciarSesion($email, $clave);

}
    


?>