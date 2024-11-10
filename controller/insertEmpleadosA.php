<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');
    session_start();
    
    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    
    $tipoDoc = $_POST['tipoDoc'];
    $numDoc = $_POST['numDoc'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $eps = $_POST['eps'];
    $cajaCompensacion = $_POST['cajaCompensacion'];
    $arl = $_POST['arl'];
    $fondoPension = $_POST['fondoPension'];
    $genero = $_POST['genero'];
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];
    $sueldo = $_POST['sueldo'];
    $clave = $_POST['numDoc'];
    
    // validamos que todos los datos esten llenos a excepcion de telefono porque es opcional
    // con !empty validamos que no este vacia, con !is_numeric que no sea un numero 
    // y con !preg_match que no tenga un patron de numeros del 0 al 9

    // en caso de no llenar los campos o hacerlo mal se muestra un mensaje avisando que tiene mal y redireccionando al formulario

    if (empty($tipoDoc)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el tipo de documento.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($numDoc) || !is_numeric($numDoc)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor dijite un numero de documento valido.";
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
    } else if (empty($celular) || strlen($celular) < 10 || !is_numeric($celular) || strlen($celular) > 10){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un numero de celular valido. Recuerde que el numero de celular debe tener 10 digitos.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($direccion)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba una dirección de residencia valida.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un email valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($eps)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja la Eps del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($cajaCompensacion)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja la caja de compensación del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($arl)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja la Arl del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($fondoPension)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el fondo de pension del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($genero)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el genero del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($rol)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el rol del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($estado)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el estado del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($sueldo) || !is_numeric($sueldo)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba el sueldo del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($tipoDoc) && 
        !empty($numDoc) && is_numeric($numDoc) && 
        !empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres) &&
        !empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) &&
        !empty($celular) && strlen($celular) == 10 && is_numeric($celular) && 
        !empty($direccion) && 
        !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && 
        !empty($eps) && !empty($cajaCompensacion) && !empty($arl) && !empty($fondoPension) && 
        !empty($genero) && !empty($rol) && !empty($estado) &&
        !empty($sueldo) && is_numeric($sueldo)){ 
            
        // encriptacion de clave
        $passmd = md5($clave);
        // convertimos la clase consultasA del modelo en un objeto
        $objetoConsultas = new consultasA();
        // enviamos los datos a la funcion registrarEmpleadosA perteneciente a la clase consultasA 
        $result = $objetoConsultas->registarEmpleadoA($tipoDoc, $numDoc, $nombres, $apellidos, $celular, $telefono, $direccion, $email, $eps, $cajaCompensacion, $arl, $fondoPension, $genero, $rol, $estado, $passmd, $sueldo);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>