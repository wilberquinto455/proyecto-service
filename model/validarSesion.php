<?php
    class validarSesion{
        public function iniciarSesion($email, $clave){
            //Conexión DB
            $modelo = new conexion();
            $conexion = $modelo -> get_conexion();
            session_start();

            //Se valida correo
            $sql = "SELECT * FROM usuarios WHERE Email_Usuario = :email";
            $result = $conexion->prepare($sql);
            $result->bindParam(":email", $email);
            $result->execute();

            $f = $result->fetch();
            // La variable F toma los datos consultados y se convierta en arreglo para almacenarlos
            if ($f) {
                // Se valida password
                if ($clave == $f['Contraseña']) {
                    // Se comprueba estado
                    if ($f['ID_Estado_Usuario'] == 1) {

                        //variables de inicio de sesion
                        $_SESSION['id'] = $f['ID_User'];
                        $_SESSION['rol'] = $f['ID_Rol'];
                        $_SESSION['autenticacion'] = "SI";
                        $_SESSION['nombre'] = $f['Name'];
                        
                        if ($f['ID_Rol'] == 1) {
                            echo "<script> location.href='../view/administrador/homeAdmin.php' </script>"; 
                        }
                        if ($f['ID_Rol'] == 2) {
                            echo "<script> location.href='../view/operaciones/homeOperador.php' </script>";
                        }

                    } else if ($f['ID_Estado_Usuario'] == 2){
                        $_SESSION['titulo'] = "Oops!";
                        $_SESSION['msj'] = "Su cuenta está inactiva, contacte con un administrador para reactivarla.";
                        $_SESSION['icono'] = "error";
                        echo "<script> window.history.back(); </script>"; 
                    } else if ($f['ID_Estado_Usuario'] == 3){
                        $_SESSION['titulo'] = "Oops!";
                        $_SESSION['msj'] = "Su cuenta está bloqueada, contacte con un administrador para desbloquearla.";
                        $_SESSION['icono'] = "error";
                        echo "<script> window.history.back(); </script>"; 
                    } else if ($f['ID_Estado_Usuario'] == 4){
                        $_SESSION['titulo'] = "Oops!";
                        $_SESSION['msj'] = "Contacte con un administrador.";
                        $_SESSION['icono'] = "error";
                        echo "<script> window.history.back(); </script>"; 
                    } 

                }
                 else {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "La contraseña es incorrecta, por favor verifíquela.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back(); </script>";
                }
            } 
        }
    }
?>