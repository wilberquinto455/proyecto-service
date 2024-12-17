<?php
// Enlazar dependencias necesarias
require_once('../../model/conexion.php');
require_once('../../model/consultasA.php');
session_start();

// Verificar si el parámetro necesario fue enviado
if (isset($_GET['Id_Cliente']) && is_numeric($_GET['Id_Cliente'])) {
    $id_cliente = $_GET['Id_Cliente'];

    // Crear objeto para las consultas
    $objetoConsultas = new consultasA();
    $resultado = $objetoConsultas->eliminarCliente($id_cliente);

    // Mostrar mensajes según el resultado
    if ($resultado) {
        $_SESSION['titulo'] = "Eliminación exitosa!";
        $_SESSION['msj'] = "El cliente ha sido eliminado del sistema.";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "El cliente no existe o no pudo ser eliminado.";
        $_SESSION['icono'] = "error";
    }
} else {
    $_SESSION['titulo'] = "Error!";
    $_SESSION['msj'] = "Parámetro inválido. No se puede procesar la eliminación.";
    $_SESSION['icono'] = "error";
}

// Redirigir al usuario de regreso a la página de clientes
echo "<script> location.href = '../../view/administrador/VerClientes.php'; </script>";
