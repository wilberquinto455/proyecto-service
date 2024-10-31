<?php  
    require_once("../model/conexion.php");
    require_once("../model/consultasE.php");
    session_start();

    $correo = $_POST['correo'];
    $numDocumento = $_POST['documentoIng'];

    if (empty($correo) || !filter_var($correo,FILTER_VALIDATE_EMAIL)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un correo valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } elseif (empty($numDocumento) || !is_numeric($numDocumento )) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un número de documento valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } elseif (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($numDocumento) && is_numeric($numDocumento) ) {
        //encriptado del número de documento
        $passMd = md5($numDocumento); 
         //Clase a modelo en consultasE
         $objetoConsultas = new consultasE();
         // enviamos los datos a la funcion registrarEmpleadosA perteneciente a la clase consultasA 
         $result = $objetoConsultas->recuperarContraseña($correo, $numDocumento, $passMd);
     } else {
         $_SESSION['titulo'] = "Error!";
         $_SESSION['msj'] = "Por favor rellene correctamente los campos.";
         $_SESSION['icono'] = "error";
         echo "<script> window.history.back(); </script>";
     }
        
    

?>