<?php

    require_once("../model/conexion.php");
    require_once("../model/consultasA.php");

    //para saber si se envio la llave, aunque si no se envia, el codigo no llegaria a esta parte
    if (isset($_GET['id_empleado'])) {
        // almacenamos el valor que viene por el metodo GET desde mostrarEmpleadosA
        $id_empleado = $_GET['id_empleado'];

        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->eliminarEmpleadoA($id_empleado);
    }

?>