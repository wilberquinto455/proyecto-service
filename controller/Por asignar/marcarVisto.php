<?php
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');
    session_start();

    $marca = $_GET['id'];

    if (!isset($marca)) {
      $_SESSION['titulo'] = "Error en el sistema!";
      $_SESSION['msj'] = "No se ha podido modificar la notificación.";
      $_SESSION['icono'] = "error";
      echo "<script> window.history.back(); </script>";
    } else {
      $objetoConsultas = new consultasA();
      $result = $objetoConsultas->marcarPqr($marca);
    }
?>