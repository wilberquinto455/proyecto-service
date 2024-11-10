<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');
    session_start();

    $ID_factura = $_POST['ID_factura'];
    $ID_empleado = $_POST['ID_empleado'];
    $ID_cliente = $_POST['ID_cliente'];
    $Cod_producto = $_POST['Cod_producto'];
    $Cantidad_producto = $_POST['Cantidad_producto'];
    $id_forma_pago = $_POST['id_forma_pago'];
    $garantia = $_POST['garantia'];

    if (empty($ID_factura) || !is_numeric($ID_factura)) {
        $_SESSION['titulo'] = "error!";
        $_SESSION['msj'] = "Por favor vuelva a llenar los campos.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!is_numeric($ID_empleado) || empty($ID_empleado)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un Id del empleado valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!is_numeric($ID_cliente) || empty($ID_cliente)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un número de docuemto valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!is_numeric($Cod_producto) || empty($Cod_producto)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un código de producto valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!is_numeric($Cantidad_producto) || empty($Cantidad_producto) || strlen($Cantidad_producto) <= 0){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba una cantidad productos validos.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($id_forma_pago)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escoja el metodo de pago.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($ID_factura) && is_numeric($ID_factura) &&
        is_numeric($ID_empleado) && !empty($ID_empleado) && 
        is_numeric($ID_cliente) && !empty($ID_cliente) && 
        is_numeric($Cod_producto) && !empty($Cod_producto) && 
        is_numeric($Cantidad_producto) && !empty($Cantidad_producto) && strlen($Cantidad_producto) >= 1 &&
        !empty($id_forma_pago)){

        // convertimos la clase consultas  del modelo en un objeto
        $objetoConsultas = new consultasA();
        // enviamos los datos a la funcion updateVentaA perteneciente a la clase consultas A
        $result = $objetoConsultas->UpdateVentaA($ID_factura, $ID_empleado, $ID_cliente, $Cod_producto, $Cantidad_producto, $id_forma_pago, $garantia);
    } else {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Por favor revise que todos los campos esten bien diligenciados.";
        $_SESSION['icono'] = "error";
        echo "<script> window.history.back(); </script>";
    }
?>