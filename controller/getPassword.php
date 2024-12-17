<?php  
    require_once("../model/conexion.php");
    require_once("../model/consultasE.php");
    session_start();

    $correo = $_POST['correo'];
    $Telefono = $_POST['Telefono'];

    if (empty($correo) || !filter_var($correo,FILTER_VALIDATE_EMAIL)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un correo valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } elseif (empty($Telefono) || !is_numeric($Telefono )) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor ingrese de nuevo su número de contacto.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } elseif (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($Telefono) && is_numeric($Telefono) ) {
        //encriptado del número de documento
        $passMd = md5($Telefono); 
         //Clase a modelo en consultasE
         $objetoConsultas = new consultasE();
         // Metodo para recuperar contraseña
         
         $result = $objetoConsultas->recuperarContraseña($correo, $Telefono, $passMd);
     } else {
         $_SESSION['titulo'] = "Error!";
         $_SESSION['msj'] = "Por favor rellene correctamente los campos.";
         $_SESSION['icono'] = "error";
         echo "<script> window.history.back(); </script>";
     }
        
    

?>