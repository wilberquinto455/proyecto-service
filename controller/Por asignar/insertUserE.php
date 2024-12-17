<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasE.php');
    session_start();
    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    if (isset($_POST['terminos'])){
        $terminos = $_POST['terminos'];
    } else {
        $terminos = "off";
    }
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $clave = $_POST['clave'];
    $clave2 = $_POST['clave2'];
    $estado = 1;
    
    // validamos que todos los datos esten llenos, a excepcion del teléfono porque es opcional

    if (empty($documento) || !is_numeric($documento)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un numero de documento valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($nombres) || is_numeric($nombres) || preg_match("/[0-9]/", $nombres)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un nombre valido. Recuerde que los nombres no deben contener numeros.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/", $apellidos)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba unos apellidos validos. Recuerde que los apellidos no deben contener numeros.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($celular) || !is_numeric($celular)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un numero de celular valido. Recuerde que el numero de celular debe tener 10 digitos.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un email valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($direccion)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba una dirección de residencia valida.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($clave) || strlen($clave) < 8 || empty($clave2) || strlen($clave2) < 8){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba una contraseña valida. Recuerde que la contraseña debe tener minimo 8 caracteres y puede combinar mayusculas, minusculas, numeros y caracteres especiales";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if ($terminos != "on" ){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Para poder registrarse, primero debe aceptar los términos y condiciones";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($documento) && is_numeric($documento) &&
        !empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres) && 
        !empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) && 
        !empty($celular) && is_numeric($celular) && 
        !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL) && 
        !empty($direccion) && 
        !empty($clave) && strlen($clave) >= 8 &&
        !empty($clave2) && strlen($clave2) >= 8 &&
        $terminos == "on"){
        
        // validamos que las claves conduerden
        if ($clave == $clave2){
            // encriptacion de clave
            $passmd = md5($clave);
            // convertimos la clase consultas  del modelo en un objeto
            $objetoConsultas = new consultasE();
            // enviamos los datos a la funcion registrar user perteneciente a la clase consultas e
            $result = $objetoConsultas->registarUser($documento, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $estado, $passmd);

        }else{
            //en caso de que la confirmacion de la clave no concuerde
            $_SESSION['titulo'] = "Oops!";
            $_SESSION['msj'] = "Sus claves no concuerdan, por favor vuelva a escribirlas.";
            $_SESSION['icono'] = "info";
            echo "<script> window.history.back(); </script>";
        }
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>