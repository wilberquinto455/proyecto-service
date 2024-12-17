<?php
// Enlazamos las dependencias necesarias
require_once('../../model/conexion.php');
require_once('../../model/consultasA.php');
session_start();

// Capturamos las variables enviadas desde el formulario
$idCliente = $_POST['idCliente'];
$empresa = $_POST['empresa'];
$nombreContacto = strtoupper(trim($_POST['nombreContacto'])); // Convertimos a mayúsculas y eliminamos espacios adicionales
$correo = trim($_POST['correo']); // Eliminamos espacios adicionales
$celularCon = $_POST['celularCon'];

// Validamos los datos capturados

// Validar ID del cliente
if (empty($idCliente) || !is_numeric($idCliente)) {
    $_SESSION['titulo'] = "Error!";
    $_SESSION['msj'] = "ID de cliente inválido. Por favor intente de nuevo.";
    $_SESSION['icono'] = "error";
    echo "<script> window.history.back(); </script>";
    exit();
}

// Validar empresa
if (empty($empresa) || !is_numeric($empresa)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Seleccione una empresa válida.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
}

// Validar nombre del contacto
if (empty($nombreContacto) || is_numeric($nombreContacto)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Ingrese un nombre de contacto válido. Este no debe ser solo números.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
}

// Validar correo electrónico
if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Ingrese un correo electrónico válido.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
}

// Validar celular
if (empty($celularCon) || !is_numeric($celularCon) || strlen($celularCon) < 7) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Ingrese un número de celular válido con al menos 7 dígitos.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
}

// Si todas las validaciones pasan, intentamos actualizar los datos del cliente
$objetoConsultas = new consultasA();
$result = $objetoConsultas->updateCliente($idCliente, $empresa, $nombreContacto, $correo, $celularCon);

if ($result) {
    $_SESSION['titulo'] = "Actualización exitosa!";
    $_SESSION['msj'] = "La información del cliente se ha actualizado correctamente.";
    $_SESSION['icono'] = "success";
    echo "<script> location.href = '../../view/administrador/verClientes.php'; </script>";
} else {
    $_SESSION['titulo'] = "Error!";
    $_SESSION['msj'] = "Hubo un problema al actualizar los datos del cliente.";
    $_SESSION['icono'] = "error";
    echo "<script> window.history.back(); </script>";
}
?>
