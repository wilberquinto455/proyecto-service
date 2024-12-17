<?php

    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../../model/conexion.php');
    require_once('../../model/consultasA.php');

    //para saber si se envio la llave, aunque si no se envia, el codigo no llegaria a esta parte
    if (isset($_GET['Id_User'])) {
        // almacenamos el valor que viene por el metodo GET desde mostrarUsuariosA
        $ID_User = $_GET['Id_User'];

        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->eliminarUsuarioA($ID_User);
    }

?>