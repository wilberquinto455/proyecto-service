<?php
    class consultasE{

        // recuperar clave
        public function recuperarContraseña($correo, $Telefono, $passMd){
            //El arreglo $f es para clientes y el arreglo $f2 para usuarios
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            //Consulta en usuarios
            $sqlEmple = "SELECT * FROM usuarios WHERE Celular_Corp = :telefono AND Email_Usuario = :correo";
            $result2 = $conexion->prepare($sqlEmple);
            $result2->bindParam(':correo',$correo);
            $result2->bindParam(':telefono',$Telefono);
            $result2->execute();
            $f2 = $result2->fetch();
            
            if ($f2) {
                if ($f2['Email_Usuario'] == $correo && $f2['Celular_Corp'] == $Telefono) {
                    $actualizar = "UPDATE usuarios SET Contraseña = :nuevaClave WHERE Celular_Corp = :telefono";
                    $result3 = $conexion->prepare($actualizar);
                    $result3->bindParam(':nuevaClave',$passMd);
                    $result3->bindParam(':telefono',$Telefono);
                    
                    $result3->execute();

                    $_SESSION['titulo'] = "Actualización exitosa!";
                    $_SESSION['msj'] = "Su contraseña fue restaurada en caso de no conocerla contacte con el administrador.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../view/client-side/login.php' </script>";
                }
            } else {
                    $_SESSION['titulo'] = "Error";
                    $_SESSION['msj'] = "Contacte con el administrador.";
                    $_SESSION['icono'] = "error";
                    echo "<script> window.history.back(); </script>";
            }
        }
    }
?>