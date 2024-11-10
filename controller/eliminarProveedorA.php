<?php
    //Se enlaza a la base de datos
    require_once("../model/conexion.php");
    require_once("../model/consultasA.php");

    if (isset($_GET['nit_proveedor'])) {
        $nit_proveedor = $_GET['nit_proveedor'];
        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->eliminarProveedor($nit_proveedor);

    }

?>