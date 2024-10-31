<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');
    session_start();

    $id = $_POST['id_empleado'];
    $claveAntigua = $_POST['clave'];
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];

    if (empty($id) || !is_numeric($id)) {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor vuelva a llenar los campos.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else if (empty($claveAntigua)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba su contraseña actual.";
        $_SESSION['icono'] = "Info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($clave1) || strlen($clave1) < 8 || empty($clave2) || strlen($clave2) < 8) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba una contraseña valida. Recuerde que la contraseña debe tener minimo 8 caracteres y puede combinar mayusculas, minusculas, numeros y caracteres especiales";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($id) && is_numeric($id) && !empty($claveAntigua) && !empty($clave1) && strlen($clave1) >= 8 && !empty($clave2) && strlen($clave2) >= 8){
        // validamos que las claves conduerden
        if ($clave1 == $clave2){
            // encriptacion de clave nueva y la antigua
            $passmd = md5($clave1);
            $pasmdAntigua = md5($claveAntigua);
            // convertimos la clase consultas  del modelo en un objeto
            $objetoConsultas = new consultasA();
            // enviamos los datos a la funcion registrar user perteneciente a la clase consultas e
            $result = $objetoConsultas->updateClaveA($id, $pasmdAntigua, $passmd);
        }else{
            //en caso de que la confirmacion de la clave no concuerde
            $_SESSION['titulo'] = "Oops!";
            $_SESSION['msj'] = "Sus nuevas contraseñas no concuerdan, por favor vuelva a llenar el formulario.";
            $_SESSION['icono'] = "info";
            echo "<script> window.history.back(); </script>";
        }
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>