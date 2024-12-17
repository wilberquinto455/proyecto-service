<?php
require_once('../../model/conexion.php');
require_once('../../model/consultasA.php');
session_start();

try {
    // Validamos que el parámetro `id_ticket` esté presente
    if (!isset($_GET['id_ticket']) || !is_numeric($_GET['id_ticket'])) {
        throw new Exception("ID del ticket no válido o no proporcionado.");
    }

    $id_ticket = intval($_GET['id_ticket']); // Convertimos a entero por seguridad

    // Instanciamos el objeto de consultas
    $objetoConsultas = new consultasA();

    // Llamamos al método para eliminar el ticket
    $result = $objetoConsultas->eliminarTicketA($id_ticket);

    if ($result) {
        $_SESSION['titulo'] = "Éxito!";
        $_SESSION['msj'] = "El ticket fue eliminado correctamente.";
        $_SESSION['icono'] = "success";
    } else {
        throw new Exception("No se pudo eliminar el ticket. Verifica que exista.");
    }

    // Redirigimos al listado de tickets
    echo "<script>window.location.href = '../../view/Administrador/verTickets.php';</script>";
} catch (Exception $e) {
    // Manejo de errores
    $_SESSION['titulo'] = "Error!";
    $_SESSION['msj'] = $e->getMessage();
    $_SESSION['icono'] = "error";
    echo "<script>window.history.back();</script>";
}
