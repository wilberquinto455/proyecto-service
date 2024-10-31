<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');
    session_start();

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    $id_empleado = $_POST['id_empleado'];
    $tipoDoc = $_POST['tipoDoc'];
    $numDoc = $_POST['numDoc'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $eps = $_POST['eps'];
    $cajaCompensacion = $_POST['cajaCompensacion'];
    $arl = $_POST['arl'];
    $fondoPension = $_POST['fondoPension'];
    $genero = $_POST['genero'];
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];
    $sueldo = $_POST['sueldo'];

    if (empty($id_empleado) || !is_numeric($id_empleado)) {
        $_SESSION['titulo'] = "Error en el sistema!";
        $_SESSION['msj'] = "Por favor vuelva a llenar los campos.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else if (empty($tipoDoc)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el tipo de documento.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($numDoc) || !is_numeric($numDoc)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor dijite un numero de documento valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($nombres) || is_numeric($nombres) || preg_match("/[0-9]/", $nombres)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un nombre valido. Recuerde que los nombres no deben contener numeros.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/", $apellidos)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba unos apellidos validos. Recuerde que los apellidos no deben contener numeros.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($celular) || strlen($celular) < 10 || !is_numeric($celular) || strlen($celular) > 10){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un numero de celular valido. Recuerde que el numero de celular debe tener 10 digitos.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($direccion)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba una dirección de residencia valida.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un email valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($eps)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja la eps del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($cajaCompensacion)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja la caja de compensación del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($arl)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja la Arl del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($fondoPension)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el fondo de pension del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($genero)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el genero del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($rol)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el rol del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($estado)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el estado del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($sueldo) || !is_numeric($sueldo)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba el sueldo del empleado.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($id_empleado) && is_numeric($id_empleado) &&
        !empty($tipoDoc) && 
        !empty($numDoc) && is_numeric($numDoc) && 
        !empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres) &&
        !empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) &&
        !empty($celular) && strlen($celular) == 10 && is_numeric($celular) && 
        !empty($direccion) && 
        !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && 
        !empty($eps) && !empty($cajaCompensacion) && !empty($arl) && !empty($fondoPension) && 
        !empty($genero) && !empty($rol) && !empty($estado) &&
        !empty($sueldo) && is_numeric($sueldo)){ 
            
        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->updateEmpleadosA($id_empleado, $tipoDoc, $numDoc, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $eps, $cajaCompensacion, $arl, $fondoPension, $genero, $rol, $estado, $sueldo);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>