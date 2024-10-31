<?php
    class consultasE{
        // registro de clientes
        public function registarUser($documento, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $estado, $passmd){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // selccionamos todo de la tabla clientes de la base de datos
            $sql = "SELECT * FROM clientes WHERE Correo_cliente = :email OR ID_cliente = :documento";
            $result = $conexion->prepare($sql);

            $result->bindParam(':email', $email);
            $result->bindParam(':documento', $documento);

            $result->execute();

            $f = $result->fetch();
            // si existe f quiere decir que ya hay un usuario con ese correo
            if ($f) {
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "Este usuario ya esta registrado en el sistema, revise que el número de documento y correo esten bien escritos, e intente nuevamente.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back() </script>";
            } else {
                // Si no, insertamos los datos en la base de datos
                $sql = "INSERT INTO clientes (ID_cliente, Nombres_cliente, Apellidos_cliente, Direccion_cliente, Correo_cliente, Celular_cliente, Telefono_fijo_cliente, ID_estado, Clave_cliente)
                VALUES (:documento, :nombres, :apellidos, :direccion, :email, :celular, :telefono, :estado, :passmd)";

                $statement = $conexion-> prepare($sql);

                $statement->bindParam(':documento',$documento);
                $statement->bindParam(':nombres',$nombres);
                $statement->bindParam(':apellidos',$apellidos);
                $statement->bindParam(':direccion',$direccion);
                $statement->bindParam(':email',$email);
                $statement->bindParam(':celular',$celular);
                $statement->bindParam(':telefono',$telefono);
                $statement->bindParam(':estado',$estado);
                $statement->bindParam(':passmd',$passmd);
                
                if(!$statement){
                    $_SESSION['titulo'] = "Error en el sistema!";
                    $_SESSION['msj'] = "El usuario no se ha podido registrar, intente nuevamente.";
                    $_SESSION['icono'] = "error";
                    echo "<script> location.href='../view/client-side/register.php' </script>";
                } else {
                    $statement->execute();
                    
                    $_SESSION['titulo'] = "Registro exitoso!";
                    $_SESSION['msj'] = "Su usuario ha sido registrado exitosamente en el sistema.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../view/client-side/login.php' </script>";
                }
            }
        }
        // catalogo
        public function mostrarProductosC(){
            $f = null;

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
    
            $consultar = "SELECT * FROM productos";
            $result = $conexion->prepare($consultar);
            $result->execute();

            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarProducto($Cod_producto){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la todas las tablas necesarias para poder mostrar el nombre en lugar del id
            $consultar = "SELECT * FROM productos
            WHERE Cod_producto = :Cod_producto";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':Cod_producto', $Cod_producto);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
        }
        // pqr 
        public function RegistrarPqr($Nombres_pqr, $Apellidos_pqr, $Email_pqr, $Motivo_pqr, $Mensaje_pqr){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $fecha = date("Y/m/d H:i:s");

            $sql = "INSERT INTO pqr VALUES (NULL, :fecha, :Nombres_pqr, :Apellidos_pqr, :Email_pqr, :Motivo_pqr, :Mensaje_pqr, 'No')";
            $statement = $conexion->prepare($sql); 
            $statement -> bindParam(':fecha',$fecha);
            $statement -> bindParam(':Nombres_pqr',$Nombres_pqr);
            $statement -> bindParam(':Apellidos_pqr',$Apellidos_pqr);
            $statement -> bindParam(':Email_pqr',$Email_pqr);
            $statement -> bindParam(':Motivo_pqr',$Motivo_pqr);
            $statement -> bindParam(':Mensaje_pqr',$Mensaje_pqr);

            if (!$statement){
                $_SESSION['titulo'] = "Error en el sistema!";
                $_SESSION['msj'] = "La PQR no se ha podido enviar.";
                $_SESSION['icono'] = "error";
                echo "<script> window.history.back(); </script>";
            } else {
                $statement->execute();
                
                $_SESSION['titulo'] = "Envio exitoso!";
                $_SESSION['msj'] = "El mensaje ha sido enviado.";
                $_SESSION['icono'] = "success";
                echo "<script> location.href='../view/client-side/contact.php' </script>";
            }
        }
        //Perfil Cliente
        public function perfilC(){
            $f = null;
            $modelo = new conexion;
            $conexion = $modelo->get_conexion();

            $sql = "SELECT c.*, s.* FROM clientes c, estados s WHERE ID_cliente = :id AND c.ID_estado = s.ID_estado";

            $result = $conexion->prepare($sql);
            $result->bindParam(':id',$_SESSION['id']);
            $result->execute();

            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function updatePerfilC($documento, $nombres, $apellidos, $direccion, $email, $celular, $telefono){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "SELECT * FROM clientes WHERE ID_cliente = :documento";
            $result1 = $conexion->prepare($sql);
            $result1->bindParam(':documento',$documento);
            $result1->execute();
            $f = $result1->fetch();

            if ($f['Correo_cliente'] == $email){
                // query para la actualizacion de los datos
                $actualizar = "UPDATE clientes SET Nombres_cliente = :nombres, Apellidos_cliente = :apellidos,  Direccion_cliente = :direccion,
                Correo_cliente = :email, Celular_cliente = :celular, Telefono_fijo_cliente = :telefono WHERE ID_cliente = :documento";

                $result = $conexion->prepare($actualizar);

                $result->bindParam(':documento', $documento);
                $result->bindParam(':nombres', $nombres);
                $result->bindParam(':apellidos', $apellidos);
                $result->bindParam(':direccion', $direccion);
                $result->bindParam(':email', $email);
                $result->bindParam(':celular', $celular);
                $result->bindParam(':telefono', $telefono);

                $result->execute();
                
                $_SESSION['titulo'] = "Actualización exitosa!";
                $_SESSION['msj'] = "Su información ha sido actualizada.";
                $_SESSION['icono'] = "success";
                echo "<script> location.href='../view/cliente/perfilCliente.php'</script>"; 
            } else {
                $contador1 = "SELECT COUNT(Correo_cliente) FROM clientes WHERE Correo_cliente = :email";
                $resultCont = $conexion->prepare($contador1);
                $resultCont->bindParam(':email', $email);
                $resultCont->execute();
                $fCont = $resultCont->fetch();

                if ($fCont['COUNT(Correo_cliente)'] == 0) {
                    $actualizar = "UPDATE clientes SET Nombres_cliente = :nombres, Apellidos_cliente = :apellidos,  Direccion_cliente = :direccion,
                    Correo_cliente = :email, Celular_cliente = :celular, Telefono_fijo_cliente = :telefono WHERE ID_cliente = :documento";

                    $result = $conexion->prepare($actualizar);

                    $result->bindParam(':documento', $documento);
                    $result->bindParam(':nombres', $nombres);
                    $result->bindParam(':apellidos', $apellidos);
                    $result->bindParam(':direccion', $direccion);
                    $result->bindParam(':email', $email);
                    $result->bindParam(':celular', $celular);
                    $result->bindParam(':telefono', $telefono);

                    $result->execute();
                    
                    $_SESSION['titulo'] = "Actualización exitosa!";
                    $_SESSION['msj'] = "Su información ha sido actualizada.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../view/cliente/perfilCliente.php'</script>"; 
                } else {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "Este email ya le pertenece a alguien registrado, revise ese campo e intente nuevamente.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back(); </script>"; 
                }
            }
            
        }
        public function updateClaveC($id, $pasmdAntigua, $passmd){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $sql = "SELECT Clave_cliente FROM clientes WHERE ID_cliente = :id";
            $result = $conexion->prepare($sql);
            $result->bindParam(':id',$id);
            $result->execute();

            $f = $result->fetch();

            // si la contraseña actual es incorrecta lo devuelve
            if ($f['Clave_cliente'] != $pasmdAntigua){
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "Su contraseña actual es incorrecta, intente nuevamente.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back(); </script>";
            } else {
                $sql1 = "UPDATE clientes SET Clave_cliente = :passmd WHERE ID_cliente = :id";
                $statement = $conexion->prepare($sql1);
                $statement->bindParam(':id',$id);
                $statement->bindParam(':passmd',$passmd);

                if (!$statement){
                    $_SESSION['titulo'] = "Error en el sistema!";
                    $_SESSION['msj'] = "La contraseña no se ha podido actualizar.";
                    $_SESSION['icono'] = "error";
                    echo "<script> window.history.back(); </script>";
                } else {
                    $statement->execute();
                    
                    $_SESSION['titulo'] = "Cambio exitoso!";
                    $_SESSION['msj'] = "Su contraseña ha sido actuailizada.";
                    $_SESSION['icono'] = "success";
                    echo "<script> window.history.back(); </script>";
                }
            }
        }

        // facturas
        public function mostrarVentasC(){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
    
            $consultar = "SELECT * FROM facturas WHERE ID_cliente = :id";
            $result = $conexion->prepare($consultar);
            $result -> bindParam(':id', $_SESSION['id']);
            $result->execute();
    
            //creamos un ciclo para convertir la variable result en arreglo $f
            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarVentaC($ID_factura){
            
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $sql = "SELECT f.*, d.* FROM facturas f, detalles_factura d WHERE f.ID_factura = :ID_factura AND d.ID_factura = :ID_factura";

            $result = $conexion->prepare($sql);
            $result->bindParam(':ID_factura',$ID_factura);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
            
        }
        // recuperar clave
        public function recuperarContraseña($correo, $numDocumento, $passMd){
            //El arreglo $f es para clientes y el arreglo $f2 para empleados
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            //Consulta en Empleados
            $sqlEmple = "SELECT * FROM empleados WHERE No_documento_empleado = :numDocumento AND Correo_empleado = :correo";
            $result2 = $conexion->prepare($sqlEmple);
            $result2->bindParam(':correo',$correo);
            $result2->bindParam(':numDocumento',$numDocumento);
            $result2->execute();
            $f2 = $result2->fetch();
            
            if ($f2) {
                if ($f2['Correo_empleado'] == $correo && $f2['No_documento_empleado'] == $numDocumento) {
                    $actualizar = "UPDATE empleados SET Clave_empleado = :nuevaClave WHERE No_documento_empleado = :numDocumento";
                    $result3 = $conexion->prepare($actualizar);
                    $result3->bindParam(':nuevaClave',$passMd);
                    $result3->bindParam(':numDocumento',$numDocumento);
                    
                    $result3->execute();

                    $_SESSION['titulo'] = "Actualización exitosa!";
                    $_SESSION['msj'] = "Su contraseña fue restaurada a su número de documento, inicie sesión y cambiela a una mas segura.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../view/client-side/login.php' </script>";
                }
            } else {
                // Consulta en clientes
                $sqlClie = "SELECT * FROM clientes WHERE ID_cliente = :numDocumento AND Correo_cliente = :correo";
                $result1 = $conexion->prepare($sqlClie);
                $result1->bindParam(':correo',$correo);
                $result1->bindParam(':numDocumento',$numDocumento);
                $result1->execute();
                $f = $result1->fetch();

                if ($f) {
                    if ($f['ID_cliente'] == $numDocumento && $f['Correo_cliente'] == $correo) {
                        $actualizar = "UPDATE clientes SET Clave_cliente = :newClave WHERE ID_cliente = :numDocumento";
                        $result4 = $conexion->prepare($actualizar);
                        $result4->bindParam(':newClave',$passMd);
                        $result4->bindParam(':numDocumento',$numDocumento);
                        $result4->execute();

                        $_SESSION['titulo'] = "Actualización exitosa!";
                        $_SESSION['msj'] = "Su contraseña fue restaurada a su número de documento, inicie sesión y cambiela a una mas segura.";
                        $_SESSION['icono'] = "success";
                        echo "<script> location.href='../view/client-side/login.php' </script>";
                    }
                } else {
                    $_SESSION['titulo'] = "Error";
                    $_SESSION['msj'] = "No se encontro un usuario con ese email y número de documento. Intente nuevamente.";
                    $_SESSION['icono'] = "error";
                    echo "<script> window.history.back(); </script>";
                }
            }
        }
    }
?>