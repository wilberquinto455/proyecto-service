<?php
require_once('../../model/conexion.php');
require_once('../../model/consultasOperador.php');
session_start();

try {
    // Capturamos en variables los valores enviados por el formulario
    $ticket = $_POST['idTicket'];
    $asunto = $_POST['asunto'];
    $descripcion = $_POST['descripcion'];
    $prioridad = $_POST['prioridad'];
    $estado = $_POST['estado'];
    $usuario = $_POST['usuario'];

    // Validaciones básicas
    if (empty($ticket) || !is_string($ticket)) {
        throw new Exception("El Ticket no puede estar vacío y debe ser un texto válido.");
    }

    if (empty($asunto) || !is_string($asunto)) {
        throw new Exception("El Asunto no puede estar vacío y debe ser un texto válido.");
    }

    if (empty($descripcion) || !is_string($descripcion) || strlen($descripcion) > 200) {
        throw new Exception("La Descripción no puede estar vacía, debe ser texto válido y tener máximo 200 caracteres.");
    }

    if (!is_numeric($prioridad) || !is_numeric($estado) || !is_numeric($usuario)) {
        throw new Exception("Prioridad, Estado o Usuario deben ser valores numéricos válidos.");
    }

    // Si todas las validaciones son correctas, procedemos a actualizar
    $objetoConsultas = new consultasOperador();
    $result = $objetoConsultas->updateTicket($ticket, $asunto, $descripcion, $prioridad, $estado, $usuario);

    if ($result) {
        $_SESSION['titulo'] = "Éxito!";
        $_SESSION['msj'] = "El ticket se actualizó correctamente.";
        $_SESSION['icono'] = "success";
        echo "<script> window.history.back(); </script>";
    } else {
        throw new Exception("Ocurrió un problema al intentar actualizar el ticket.");
    }
} catch (Exception $e) {
    // Manejo de errores
    $_SESSION['titulo'] = "Error!";
    $_SESSION['msj'] = $e->getMessage();
    $_SESSION['icono'] = "error";
    echo "<script> window.history.back(); </script>";
}
?>
