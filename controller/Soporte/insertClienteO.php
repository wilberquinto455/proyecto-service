<?php
    // Enlazar las dependencias necesarias
    require_once('../../model/conexion.php');
    require_once('../../model/consultasOperador.php');
    session_start();

    // Capturar los datos enviados por el formulario
    $empresaCli = $_POST['empresaCli'];
    $nombreCli = $_POST['nombreCli'];
    $emailCli = $_POST['emailCli'];
    $celularCli = $_POST['celularCli'];

    // Validaciones de los campos
    if (empty($empresaCli)) {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Seleccione una empresa válida.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else if (empty($nombreCli) || preg_match("/[0-9]/", $nombreCli)) {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor ingrese un nombre válido para el contacto. No debe contener números.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else if (empty($emailCli) || !filter_var($emailCli, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor ingrese un correo electrónico válido.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else if (empty($celularCli) || !is_numeric($celularCli) || strlen($celularCli) != 10) {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor ingrese un número de celular válido de 10 dígitos.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else {
        // Si las validaciones son correctas, registrar el cliente en la base de datos
        $objetoConsultas = new consultasOperador();

        // Llamar a la función que registra al cliente
        $resultado = $objetoConsultas->registrarCliente($empresaCli, $nombreCli, $emailCli, $celularCli);

        if ($resultado) {
            $_SESSION['titulo'] = "Éxito!";
            $_SESSION['msj'] = "El cliente ha sido registrado correctamente.";
            $_SESSION['icono'] = "success";
            echo "<script> location.href = '../../view/operaciones/registrarCliente.php'; </script>";
        } 
    }
?>
