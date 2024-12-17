<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../../model/conexion.php');
    require_once('../../model/consultasA.php');
    session_start();

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro

    $Empresa = strtoupper($_POST['empresaCli']); // Convertir a mayúsculas

    // Validar que el campo no esté vacío
    if (empty($Empresa)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba el nombre de la empresa.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
        exit;
    }
    
    // Validar que no sea solo números
    if (is_numeric($Empresa)) {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "El nombre de la empresa no puede ser solo números.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
        exit;
    }
    
    // Intentar registrar la empresa
    $objetoConsultas = new consultasA();
    if ($objetoConsultas->registrarEmpresa($Empresa)) {
        $_SESSION['titulo'] = "Éxito!";
        $_SESSION['msj'] = "La empresa se ha registrado correctamente.";
        $_SESSION['icono'] = "success";
    }     
?>
    