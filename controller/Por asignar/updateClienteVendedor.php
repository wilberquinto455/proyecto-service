<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasVendedor.php');
    session_start();
    
    // capturamos en variables los valores enviados en post
    $documento = $_POST['id_cliente'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $clave = $_POST['celular'];
    $estado = $_POST['estado'];
    
    #Validación de campos con !empty se valida que no estevacia, con !is_numeric que no sea un numero 
    #y con !preg_match que no tenga un patron de numeros del 0 al 9

    // en caso de no llenar los campos o hacerlo mal se muestra un mensaje avisando que tiene mal y redireccionando al formulario

    if (empty($documento) || !is_numeric($documento)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un numero de documento valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($nombres) || is_numeric($nombres) || preg_match("/[0-9]/", $nombres)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un nombre valido. Recuerde que los nombres no deben contener numeros.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/", $apellidos)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba unos apellidos validos. Recuerde que los apellidos no deben contener numeros.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($direccion)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba una dirección de residencia valida.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un email valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($celular) || !is_numeric($celular) || strlen($celular) < 10 || strlen($celular) > 10 ){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un numero de celular valido. Recuerde que el numero de celular debe tener 10 digitos.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($estado)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el estado del cliente.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($documento) && is_numeric($documento) &&
        !empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres) && 
        !empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) && 
        !empty($direccion) && 
        !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL) && 
        !empty($celular) && is_numeric($celular) && strlen($celular) == 10 &&
        !empty($estado)){
        
        $objetoConsultas = new consultasVendedor();
        $result = $objetoConsultas->updateClienteVendedor($documento ,$nombres, $apellidos, $direccion, $email, $celular, $telefono, $estado);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>