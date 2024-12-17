<?php

    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../../model/conexion.php');
    require_once('../../model/consultasA.php');

    //para saber si se envio la llave, aunque si no se envia, el codigo no llegaria a esta parte
    if (isset($_GET['id_Empresa'])) {
        // almacenamos el valor que viene por el metodo GET desde mostrarClienteEmpresasA
        $ID_Empresa = $_GET['id_Empresa'];

        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->eliminarUEmpresaoA($ID_Empresa);
    }

?>