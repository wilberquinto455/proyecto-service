<?php
    require_once('../model/conexion.php');
    require_once('../model/consultasVendedor.php');
    session_start();
    
    //Captura de variables por metodo post
    $ID_inventario = $_POST['ID_inventario'];
    $nitproveedor = $_POST['nitproveedor'];
    $codproducto = $_POST['codproducto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $causa = $_POST['causa'];
    $observacion = $_POST['observacion'];
    
    //Validación de campos
    if (empty($ID_inventario) || !is_numeric($ID_inventario)){
        $_SESSION['titulo'] = "Error en el sistema!";
        $_SESSION['msj'] = "Por favor vuelva a llenar los campos.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    } else if (empty($nitproveedor) || !is_numeric($nitproveedor)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un Nit de proveedor valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($codproducto) || !is_numeric($codproducto)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un código de producto valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($cantidad) || !is_numeric($cantidad) || strlen($cantidad) < 1){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba la cantidad de productos ingresados o sacados.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($precio) || !is_numeric($precio)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba el precio unitario al cual compro los productos.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($causa)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja la causa del movimiento del inventario.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($ID_inventario) && is_numeric($ID_inventario) &&
        !empty($nitproveedor) && is_numeric($nitproveedor) && 
        !empty($codproducto) && is_numeric($codproducto) && 
        !empty($cantidad) && is_numeric($cantidad) && strlen($cantidad) >= 1 &&
        !empty($precio) && is_numeric($precio) && 
        !empty($causa)){
           
        // convertimos la clase consultasa del modelo en un objeto
        $objetoConsultas = new consultasVendedor();
        $result = $objetoConsultas->UpdateInventarioVendedor($ID_inventario, $nitproveedor, $codproducto, $cantidad, $precio, $causa, $observacion);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>