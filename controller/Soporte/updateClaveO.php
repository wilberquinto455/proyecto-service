<?php
// Enlace a las dependencias necesarias
require_once('../../model/conexion.php');
require_once('../../model/consultasOperador.php');
session_start();

// Captura de datos desde el formulario
$id_user = $_POST['id_user'];
$claveAntigua = $_POST['clave'];
$clave1 = $_POST['clave1'];
$clave2 = $_POST['clave2'];

// Validaciones
if (empty($id_user) || !is_numeric($id_user)) {
    $_SESSION['titulo'] = "Error!";
    $_SESSION['msj'] = "Identificador de usuario inválido.";
    $_SESSION['icono'] = "error";
    echo "<script> window.history.back(); </script>";
    exit();
} elseif (empty($claveAntigua)) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Por favor, ingrese su contraseña actual.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
} elseif (empty($clave1) || strlen($clave1) < 8 || empty($clave2) || strlen($clave2) < 8) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "La nueva contraseña debe tener al menos 8 caracteres.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
} elseif ($clave1 !== $clave2) {
    $_SESSION['titulo'] = "Oops!";
    $_SESSION['msj'] = "Las nuevas contraseñas no coinciden.";
    $_SESSION['icono'] = "info";
    echo "<script> window.history.back(); </script>";
    exit();
}

// Llamada al modelo para cambiar la contraseña
$objetoConsultas = new consultasOperador();
$resultado = $objetoConsultas->updateClaveA($id_user, $claveAntigua, $clave1);

if ($resultado) {
    $_SESSION['titulo'] = "¡Cambio exitoso!";
    $_SESSION['msj'] = "Su contraseña se actualizó correctamente.";
    $_SESSION['icono'] = "success";
    echo "<script> window.history.back(); </script>";
} else {
    $_SESSION['titulo'] = "Error!";
    $_SESSION['msj'] = "La contraseña no se pudo actualizar. Verifique sus datos.";
    $_SESSION['icono'] = "error";
    echo "<script> window.history.back(); </script>";
}
?>
