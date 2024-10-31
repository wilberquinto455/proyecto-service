<?php
    require_once("../model/conexion.php");
    require_once("../model/consultasA.php");
    session_start();

    $idnotiView = $_POST['ID_pqr'];

    if (!empty($idnotiView) && is_numeric($idnotiView)) {
        $cambioLecturaVista = "Si";
        $objetoConsultas = new consultasA();
        $result = $objetoConsultas -> modificarVistaPqr($idnotiView, $cambioLecturaVista);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "No se ha podido hacer la confirmacion de lectura.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>