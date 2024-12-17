<?php
// Enlazamos las dependencias necesarias, conexión a la base de datos
require_once('../../model/conexion.php');
require_once('../../model/consultasOperador.php');
session_start();

// Capturamos los valores enviados por el formulario
$ticket = $_POST['ticket'];
$asuntoCorreo = $_POST['asuntoCorreo'];
$descripcion = $_POST['descripcion'];
$cargoIng = $_POST['cargoIng'];
$empresaCli = $_POST['empresaCli'];
$estadoTicket = $_POST['estadoTicket'];
$prioridad = $_POST['prioridad'];

// Validación de los datos recibidos
if (empty($ticket)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor ingrese un número de ticket válido.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
} else if (empty($asuntoCorreo)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor ingrese un asunto de correo válido.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
} else if (empty($descripcion)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor ingrese una descripción válida.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
} else if (empty($cargoIng) || !is_numeric($cargoIng)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor seleccione un ingeniero a cargo.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
} else if (empty($empresaCli) || !is_numeric($empresaCli)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor seleccione una empresa cliente.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
} else if (empty($estadoTicket) || !is_numeric($estadoTicket)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor seleccione un estado para el ticket.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
} else if (empty($prioridad) || !is_numeric($prioridad)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor seleccione una prioridad para el ticket.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
} else {
    // Si los datos son válidos, llamamos al modelo para comprobar duplicados y registrar el ticket
    $objetoConsultas = new consultasOperador();
    $ticketDuplicado = $objetoConsultas->verificarTicketDuplicado($ticket);
    
    if ($ticketDuplicado) {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "El ticket ingresado ya existe, por favor ingrese un ticket único.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else {
        // Si el ticket no es duplicado, procedemos a registrar el ticket
        $resultado = $objetoConsultas->registrarTicket($ticket, $asuntoCorreo, $descripcion, $cargoIng, $empresaCli, $estadoTicket, $prioridad);
        
        // Comprobamos el resultado de la operación
        if ($resultado) {
            $_SESSION['titulo'] = "Registro exitoso!";
            $_SESSION['msj'] = "El ticket ha sido registrado exitosamente.";
            $_SESSION['icono'] = "success";
            echo "<script> location.href='../../view/operaciones/registrarTicket.php'; </script>";
        } else {
            $_SESSION['titulo'] = "Error!";
            $_SESSION['msj'] = "Hubo un error al registrar el ticket.";
            $_SESSION['icono'] = "error";
            echo "<script> window.history.back(); </script>";
        }
    }
}
?>
