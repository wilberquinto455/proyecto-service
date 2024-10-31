<?php

    require_once("../model/conexion.php");
    require_once("../model/consultasA.php");

    //para saber si se envio la llave
    if (isset($_GET['id_inventario'])) {
        $id_inventario = $_GET['id_inventario'];

        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->eliminarInventarioA($id_inventario);
    }

?>