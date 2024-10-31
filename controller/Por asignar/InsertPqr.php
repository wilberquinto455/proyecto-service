<?php
    require_once('../model/conexion.php');
    require_once('../model/consultasE.php');
    session_start();
    
    $Nombres_pqr = $_POST['Nombres_pqr'];
    $Apellidos_pqr = $_POST['Apellidos_pqr'];
    $Email_pqr = $_POST['Email_pqr'];
    $Motivo_pqr = $_POST['Motivo_pqr'];
    $Mensaje_pqr = $_POST['Mensaje_pqr'];

    if (empty($Nombres_pqr) || is_numeric($Nombres_pqr) || preg_match("/[0-9]/", $Nombres_pqr)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un nombre valido. Recuerde que los nombres no deben contener numeros.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Apellidos_pqr) || is_numeric($Apellidos_pqr) || preg_match("/[0-9]/", $Apellidos_pqr)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba unos apellidos validos. Recuerde que los apellidos no deben contener numeros.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Email_pqr) || !filter_var($Email_pqr,FILTER_VALIDATE_EMAIL)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un email valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Motivo_pqr)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el motivo por el cual se esta comunicando.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Mensaje_pqr) || strlen($Mensaje_pqr) > 300 ){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un mensaje valido. Recuerde que el mensaje debe tener maximo 300 caracteres.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($Nombres_pqr) && !is_numeric($Nombres_pqr) && !preg_match("/[0-9]/", $Nombres_pqr) && 
    !empty($Apellidos_pqr) && !is_numeric($Apellidos_pqr) && !preg_match("/[0-9]/", $Apellidos_pqr) && 
    !empty($Email_pqr) && filter_var($Email_pqr,FILTER_VALIDATE_EMAIL) && 
    !empty($Motivo_pqr) && 
    !empty($Mensaje_pqr) && strlen($Mensaje_pqr) <= 300){

        // convertimos la clase consultasa del modelo en un objeto
        $objetoConsultas = new consultasE();
        $result = $objetoConsultas->RegistrarPqr($Nombres_pqr, $Apellidos_pqr, $Email_pqr, $Motivo_pqr, $Mensaje_pqr);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }

?>