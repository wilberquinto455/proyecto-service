<?php
    require_once("../model/conexion.php");
    require_once("../model/consultasA.php");

    //para saber si se envio la llave
    if (isset($_GET['Cod_producto'])) {
        
        $Cod_producto = $_GET['Cod_producto'];
        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->eliminarProductosA($Cod_producto);
    }
?>