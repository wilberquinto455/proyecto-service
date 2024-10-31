<?php
    // ponemos las conexiones
    require_once("../model/conexion.php");
    require_once("../model/consultasA.php");

    if (isset($_GET['id_cliente'])) {
        $id_cliente = $_GET['id_cliente'];
        $objetoConsultas = new ConsultasA();
        $result = $objetoConsultas->eliminarCliente($id_cliente);
    }
?>