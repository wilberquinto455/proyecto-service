<?php
// Enlazamos las dependencias necesarias
require_once('../../model/conexion.php');
require_once('../../model/consultasA.php');
session_start();

// Capturamos las variables enviadas desde el formulario
$IDEmpresa = $_POST['idEmpresa'];
$Empresa = strtoupper(trim($_POST['nombreEmp'])); // Convertimos a mayúsculas y eliminamos espacios adicionales

// Validamos los datos capturados
if (empty($IDEmpresa) || !is_numeric($IDEmpresa)) {
    $_SESSION['titulo'] = "Error en el sistema!";
    $_SESSION['msj'] = "ID de empresa inválido. Por favor intente de nuevo.";
    $_SESSION['icono'] = "error";
    echo "<script> window.history.back(); </script>";
} else if (empty($Empresa) || is_numeric($Empresa)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Ingrese un nombre de empresa válido. Este no debe ser solo números.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
} else {
    // Si las validaciones pasan, intentamos actualizar la empresa
    $objetoConsultas = new consultasA();
    $result = $objetoConsultas->updateEmpresa($IDEmpresa, $Empresa);

    if ($result) {
        $_SESSION['titulo'] = "Actualización exitosa!";
        $_SESSION['msj'] = "La información de la empresa se ha actualizado correctamente.";
        $_SESSION['icono'] = "success";
        echo "<script> location.href = '../../view/administrador/VerEmpresas.php'; </script>";
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "El nombre de la empresa ya existe o hubo un problema al actualizar.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
}
?>
