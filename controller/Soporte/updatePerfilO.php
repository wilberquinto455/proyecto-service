<?php
// Enlace a las dependencias necesarias
require_once('../../model/conexion.php');
require_once('../../model/consultasOperador.php');
session_start();

// Capturamos los valores enviados por el formulario
$id_user = $_POST['id_user'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$celular = $_POST['celular'];
$email = $_POST['email'];

// Validaciones
if (empty($id_user) || !is_numeric($id_user)) {
    $_SESSION['titulo'] = "Error en el sistema";
    $_SESSION['msj'] = "El ID del usuario es inválido.";
    $_SESSION['icono'] = "error";
    echo "<script> window.history.back(); </script>";
    exit();
} elseif (empty($nombres) || is_numeric($nombres) || preg_match('/[0-9]/', $nombres)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor, ingrese un nombre válido sin números.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
} elseif (empty($apellidos) || is_numeric($apellidos) || preg_match('/[0-9]/', $apellidos)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor, ingrese un apellido válido sin números.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
} elseif (empty($celular) || strlen($celular) != 10 || !is_numeric($celular)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor, ingrese un número de celular válido de 10 dígitos.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
} elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor, ingrese un correo electrónico válido.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
} else {
    // Si todas las validaciones son correctas, actualizamos el perfil
    $objetoConsultas = new consultasOperador();
    $resultado = $objetoConsultas->updatePerfilA($id_user, $nombres, $apellidos, $celular, $email);

    if ($resultado) {
        $_SESSION['titulo'] = "Éxito!";
        $_SESSION['msj'] = "El perfil se actualizó correctamente.";
        $_SESSION['icono'] = "success";
        echo "<script> window.history.back(); </script>";
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Hubo un problema al actualizar el perfil. Por favor, intente nuevamente.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
}
?>
