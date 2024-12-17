<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasVendedor.php');
    session_start();
    
    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    // $idinventario = $_POST['idinventario'];
    $Cod_producto = $_POST['Cod_producto'];
    $Nombre_producto = $_POST['Nombre_producto'];
    $Descripcion_producto = $_POST['Descripcion_producto'];
    $Marca = $_POST['Marca'];
    $Nit_proveedor = $_POST['Nit_proveedor'];
    $Precio_producto = $_POST['Precio_producto'];

    // Codigo para cargar imagenes en nuestro formulario

    // Capturamos los valores de la imagen, nombre, ubicacion temporal y tamaño
    $imgFile = $_FILES['Foto_producto']['name'];
    $tmp_dir = $_FILES['Foto_producto']['tmp_name'];
    $imgSize = $_FILES['Foto_producto']['size'];
    $upload_dir = '../view/img/';  //Carpeta donde estan las imagenes
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); //Capturar extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); //Validacion de extensiones

    // Renombrar el archivo (ruta que quedara en la bd)
    $imgProd = "img/".$imgFile;

    // validamos que todos los datos esten llenos, excepto la marca 
    // porque hay productos que no tienen marca, es decir son pirata
    if (empty($Cod_producto) || !is_numeric($Cod_producto)) {
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un codigo del producto valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Nombre_producto)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un nombre del producto valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Nit_proveedor) || !is_numeric($Nit_proveedor)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un Nit de proveedor valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Precio_producto) || !is_numeric($Precio_producto)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba un precio del producto valido.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (empty($Descripcion_producto)){
        $_SESSION['titulo'] = "Oops!";
        $_SESSION['msj'] = "Por favor escriba una descripción del producto valida.";
        $_SESSION['icono'] = "info";
        echo "<script> window.history.back(); </script>";
    } else if (!empty($Cod_producto) && is_numeric($Cod_producto) && 
        !empty($Nombre_producto) && !empty($Descripcion_producto) && 
        !empty($Nit_proveedor) && is_numeric($Nit_proveedor) && 
        !empty($Precio_producto) && is_numeric($Precio_producto)){
        
        // Validar extencion y comprobacion
        if(in_array($imgExt, $valid_extensions)){
            //Validar tamaño de imagen '5MB'
            if ($imgSize < 5000000) {
                move_uploaded_file($tmp_dir,$upload_dir.$_FILES['Foto_producto']['name']);
            
                // convertimos la clase consultasa del modelo en un objeto
                $objetoConsultas = new consultasVendedor();
                $result = $objetoConsultas->registrarProductoVendedor($Cod_producto, $Nombre_producto, $Descripcion_producto, $Marca, $Nit_proveedor, $Precio_producto, $imgProd);
            } else {
                $_SESSION['titulo'] = "Error!";
                $_SESSION['msj'] = "El archivo es muy grande. Recuerde que el tamaño debe ser inferior a 5MB.";
                $_SESSION['icono'] = "error";
                echo "<script> window.history.back(); </script>";
            }
        } else {
            $_SESSION['titulo'] = "Oops!";
            $_SESSION['msj'] = "Por favor escoja una foto o imagen para el producto.";
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