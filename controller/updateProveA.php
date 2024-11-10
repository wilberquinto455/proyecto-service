<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el update en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');
    session_start();
    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro

    $nitEmpresa = $_POST['nitProveedor'];
    $nombreEmpresa = $_POST['nombreEmpreProvee'];
    $telefonoEmpre = $_POST['telefonoEmpreProvee'];
    $direccionEmpre = $_POST['direccionEmpreProvee'];
    $nombreCont = $_POST['nombreContProvee'];
    $telefonoCont = $_POST['telefonoContProvee'];
    $correoCont = $_POST['correoContProvee'];

    //Revisamos que las variables esten llenas para poder realizar la modificación
    // validamos que todos los datos esten llenos
    // Con !empty se valida que no este vacio, con !is_numeric que no sea un número
    // y con !preg_match que no tenga un patron de numeros del 0 al 9.
    if (empty($nitEmpresa) || !is_numeric($nitEmpresa)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba el Nit del proveedor valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($nombreEmpresa)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un nombre de proveedor valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($telefonoEmpre) || !is_numeric($telefonoEmpre)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un número de telefono del proveedor valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($direccionEmpre)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba la dirección del proveedor valida.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($nombreCont) || is_numeric($nombreCont) || preg_match("/[0-9]/", $nombreCont)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un nombre del contacto con el proveedor valido. Recuerde que los nombres no deben contener números";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($telefonoCont) || !is_numeric($telefonoCont)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un número de telefono del contacto con el proveedor valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($correoCont) || !filter_var($correoCont,FILTER_VALIDATE_EMAIL)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un email del contacto con el proveedor valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($nitEmpresa) && is_numeric($nitEmpresa) && 
        !empty($nombreEmpresa) && 
        !empty($telefonoEmpre) && is_numeric($telefonoEmpre) &&
        !empty($direccionEmpre) && 
        !empty($nombreCont) && !is_numeric($nombreCont) && !preg_match("/[0-9]/", $nombreCont) && 
        !empty($telefonoCont) && is_numeric($telefonoCont) && 
        !empty($correoCont) && filter_var($correoCont,FILTER_VALIDATE_EMAIL)){
        
        $objetoConsultas = new consultasA();
        $result = $objetoConsultas -> actualizarProveedor($nitEmpresa, $nombreEmpresa, $telefonoEmpre, $direccionEmpre, $nombreCont, $telefonoCont, $correoCont);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }

?>