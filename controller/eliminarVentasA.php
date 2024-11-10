<?php

    require_once("../model/conexion.php");
    require_once("../model/consultasA.php");

    //para saber si se envio la llave
    if (isset($_GET['id_factura'])) {
        $id_factura = $_GET['id_factura'];

        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->eliminarVentasA($id_factura);
    }

?>