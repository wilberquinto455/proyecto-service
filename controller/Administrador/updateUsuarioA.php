<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../../model/conexion.php');
    require_once('../../model/consultasA.php');
    session_start();

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del actualización
    $ID_User = $_POST['ID_User'];
    $Nombre = $_POST['nameIng'];
    $Apellido = $_POST['apellidoIng'];
    $Celular = $_POST['celularIng'];
    $Email = $_POST['emailIng'];
    $Cargo = $_POST['cargoIng'];
    $rol = $_POST['rolIng'];
    $Estado = $_POST['estadoIng'];

    if (empty($ID_User) || !is_numeric($ID_User)) {
        $_SESSION['titulo'] = "Error en el sistema!";
        $_SESSION['msj'] = "Por favor vuelva a llenar los campos.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Nombre) || is_numeric($Nombre) || preg_match("/[0-9]/", $Nombre)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Ingrese un nombre valido, este no debe contener números.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Apellido) || is_numeric($Apellido) || preg_match("/[0-9]/", $Apellido)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Ingrese un apellido valido, este no debe contener números.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Celular) || strlen($Celular) < 10 || !is_numeric($Celular) || strlen($Celular) > 10){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un número de celular valido. Recuerde que el numero de celular debe tener 10 digitos.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Email) || !filter_var($Email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un email valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Cargo)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el cargo del usuario.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($rol)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el rol del usuario.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Estado)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el estado del usuario.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($Nombre) && !is_numeric($Nombre) && !preg_match("/[0-9]/", $Nombre) &&
        !empty($Apellido) && !is_numeric($Apellido) && !preg_match("/[0-9]/", $Apellido) &&
        !empty($Celular) && strlen($Celular) == 10 && is_numeric($Celular) && 
        !empty($Email) && filter_var($Email, FILTER_VALIDATE_EMAIL) && !empty($Cargo) && 
        !empty($rol) && !empty($Estado))
    {             
        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->updateUserA($ID_User, $Nombre, $Apellido, $Celular, $Email, $Cargo, $rol, $Estado);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>