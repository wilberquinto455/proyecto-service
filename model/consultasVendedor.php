<?php

    class consultasVendedor{

        //Clientes
        public function registrarCliente($documento, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $estado, $passmd){
            //Conexión a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            //Query de verificación
            $sql = "SELECT * FROM clientes WHERE Correo_cliente = :emailCli OR ID_cliente = :documento";
            $result = $conexion->prepare($sql);

            $result->bindParam(':emailCli',$email);
            $result->bindParam(':documento',$documento);
            $result->execute();

            //almacena el arreglo en $f
            $f = $result->fetch();

            //Query de ingreso y validación de registro existente
            if ($f){
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "Este cliente ya se encuentra registrado, revise que el número de documento y correo estén bien escritos, e intente nuevamente.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back(); </script>";
            } else {
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
                    $_SESSION['msj'] = "El cliente no se ha podido registrar en el sistema.";
                    $_SESSION['icono'] = "error";
                    echo "<script> location.href='../view/vendedor/registrarClienteVendedor.php' </script>";
                } else {
                    $statement->execute();
                    
                    $_SESSION['titulo'] = "Registro exitoso!";
                    $_SESSION['msj'] = "El cliente ha sido registrado exitosamente en el sistema.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../view/vendedor/registrarClienteVendedor.php' </script>";
                }
            }
        }
        public function mostrarClientesVendedor(){
            $f = null;
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $consultar = "SELECT c.*, e.* FROM clientes c, estados e WHERE c.ID_estado = e.ID_estado";
            
            $result = $conexion->prepare($consultar);
            $result->execute();

            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarCliente($id_cliente){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la todas las tablas necesarias para poder mostrar el nombre en lugar del id
            $consultar = "SELECT c.*, e.* FROM clientes c, estados e 
            WHERE c.ID_cliente = :id_cliente AND c.ID_estado = e.ID_estado";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':id_cliente', $id_cliente);
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
        public function updateClienteVendedor($documento, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $estado){
            //conexion con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM clientes WHERE ID_cliente = :documento";
            $result1 = $conexion->prepare($sql);
            $result1->bindParam(':documento',$documento);
            $result1->execute();

            //para almacenar la informacion de result1 en la variable $f
            $f = $result1->fetch();

            // si existe f quiere decir que ya hay un cliente con ese correo
            if ($f['Correo_cliente'] == $email){
                // query para la actualizacion de los datos
                $actualizar = "UPDATE clientes SET ID_cliente = :id_cliente, Nombres_cliente = :nombres, Apellidos_cliente = :apellidos, Direccion_cliente = :direccion, Correo_cliente = :email, Celular_cliente = :celular, Telefono_fijo_cliente = :telefono, ID_estado = :estado 
                WHERE ID_cliente=:id_cliente";

                $result = $conexion->prepare($actualizar);
                //Parametros
                $result->bindParam(':id_cliente',$documento);
                $result->bindParam(':nombres',$nombres);
                $result->bindParam(':apellidos',$apellidos);
                $result->bindParam(':direccion',$direccion);
                $result->bindParam(':email',$email);
                $result->bindParam(':celular',$celular);
                $result->bindParam(':telefono',$telefono);
                $result->bindParam(':estado',$estado);

                $result->execute();
                
                $_SESSION['titulo'] = "Actualización exitosa!";
                $_SESSION['msj'] = "La información del cliente ha sido actualizada.";
                $_SESSION['icono'] = "success";
                echo "<script> location.href='../view/vendedor/verClientesVendedor.php'</script>";
            } else {
                $contador1 = "SELECT COUNT(Correo_cliente) FROM clientes WHERE Correo_cliente = :email";
                $resultCont = $conexion->prepare($contador1);
                $resultCont->bindParam(':email', $email);
                $resultCont->execute();
                $fCont = $resultCont->fetch();

                if ($fCont['COUNT(Correo_cliente)'] == 0) {
                    $actualizar = "UPDATE clientes SET Nombres_cliente = :nombres, Apellidos_cliente = :apellidos, Direccion_cliente = :direccion, Correo_cliente = :email, Celular_cliente = :celular, Telefono_fijo_cliente = :telefono, ID_estado = :estado 
                    WHERE ID_cliente=:id_cliente";

                    $result = $conexion->prepare($actualizar);
                    //Parametros
                    $result->bindParam(':id_cliente',$documento);
                    $result->bindParam(':nombres',$nombres);
                    $result->bindParam(':apellidos',$apellidos);
                    $result->bindParam(':direccion',$direccion);
                    $result->bindParam(':email',$email);
                    $result->bindParam(':celular',$celular);
                    $result->bindParam(':telefono',$telefono);
                    $result->bindParam(':estado',$estado);

                    $result->execute();
                    
                    $_SESSION['titulo'] = "Actualización exitosa!";
                    $_SESSION['msj'] = "La información del cliente ha sido actualizada.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../view/vendedor/verClientesVendedor.php'</script>";
                } else {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "Este email ya le pertenecen a un cliente, revise ese campo e intente nuevamente.";
                    $_SESSION['icono'] = "error";
                    echo "<script> window.history.back(); </script>";
                }
            }
        }

        //Ventas
        public function registrarVentaVendedor($ID_empleado, $ID_cliente, $Cod_producto, $Cantidad_producto, $id_forma_pago, $garantia){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql7 = "SELECT ID_empleado FROM empleados WHERE ID_empleado = :ID_empleado";
            $statement7 = $conexion -> prepare($sql7);
            $statement7->bindParam(':ID_empleado',$ID_empleado);
            $statement7->execute();
            $f7 = $statement7->fetch();

            if (!$f7) {
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "No se ha encontrado ese Id de empleado, por favor verifique que este bien escrito.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back() </script>";
            } else {
                $sql8 = "SELECT Cod_producto FROM productos WHERE Cod_producto = :Cod_producto;";
                $statement8 = $conexion -> prepare($sql8);
                $statement8->bindParam(':Cod_producto',$Cod_producto);
                $statement8->execute();
                $f8 = $statement8->fetch();

                if (!$f8) {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "No se ha encontrado ese codigo de producto, por favor verifique que este bien escrito.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back() </script>";
                } else {
                    //consulta para saber el precio del producto
                    $sql2 = "SELECT Precio_producto FROM productos WHERE Cod_producto = :Cod_producto;";

                    $statement2 = $conexion -> prepare($sql2);
                    $statement2->bindParam(':Cod_producto',$Cod_producto);

                    $statement2->execute();

                    // Transformo la cosulta en arreglo para poder manejar el valor numerico
                    $f = $statement2->fetch();
                    
                    // VARIABLES PARA LA CONTABILIDAD DE LA VENTA: valor total de los productos, el iva y el subtotal
                    // Multiplico la cantidad por el valor
                    $totalProductos = $Cantidad_producto * $f['Precio_producto'];
                    $iva = $totalProductos * 0.19;
                    $subtotal = $totalProductos - $iva;

                    // seleccionamos las existencias actuales del producto
                    $sql4 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :Cod_producto";
                    $result4 = $conexion->prepare($sql4);
                    $result4->bindParam(':Cod_producto',$Cod_producto);
                    $result4->execute();

                    $f = $result4->fetch();
                    
                    // restamos las existencias actuales menos las ingresadas
                    $new_existencias = $f["Existencias_producto"] - $Cantidad_producto;

                    // Si las existencias actuales son de cero o no hay sufientes existencias disponibles
                    // no se podra realizar la venta
                    if ($f["Existencias_producto"] == 0 || $new_existencias < 0) {
                        $_SESSION['titulo'] = "Lo sentimos!";
                        $_SESSION['msj'] = "No hay suficientes productos para realizar la venta. Productos disponibles: ".$f['Existencias_producto']."";
                        $_SESSION['icono'] = "info";
                        echo "<script> window.history.back() </script>";
                    } else {
                        // actualizar las existencias del producto
                        $sql5 = "UPDATE productos SET Existencias_producto = :new_existencias WHERE Cod_producto = :Cod_producto";
                        $statement5 = $conexion->prepare($sql5);
                        $statement5->bindParam(':new_existencias',$new_existencias);
                        $statement5->bindParam(':Cod_producto',$Cod_producto);

                        // consulta para saber si el documento esta registrado en el sistema
                        $sql6 = "SELECT * FROM clientes WHERE ID_cliente = :ID_cliente";
                        $result6 = $conexion->prepare($sql6);
                        $result6->bindParam(':ID_cliente',$ID_cliente);
                        $result6->execute();

                        $f6 = $result6->fetch();

                        // si no existe f6 quiere decir que el documento no esta registrado
                        if (!$f6) {
                            // el id del cliente sera 1 es decir cliente ocasional
                            $sql = "INSERT INTO facturas (Fecha_compra, ID_empleado, Nombres_empleado, ID_cliente, Nombres_cliente, ID_forma_pago, Nombre_forma_pago, Subtotal, Iva, Total_venta, Garantia)
                            VALUES (:fecha, :ID_empleado, (SELECT Nombres_empleado FROM empleados WHERE ID_empleado = :ID_empleado), 1, (SELECT Nombres_cliente FROM clientes WHERE ID_cliente = 1), :id_forma_pago, (SELECT Nombre_forma_pago FROM formas_pago WHERE ID_forma_pago = :id_forma_pago), :subtotal, :iva, :totalProductos, :garantia);";
                        } else {
                            // si no se registra el documento con sus nombres
                            $sql = "INSERT INTO facturas (Fecha_compra, ID_empleado, Nombres_empleado, ID_cliente, Nombres_cliente, ID_forma_pago, Nombre_forma_pago, Subtotal, Iva, Total_venta, Garantia)
                            VALUES (:fecha, :ID_empleado, (SELECT Nombres_empleado FROM empleados WHERE ID_empleado = :ID_empleado), :ID_cliente, (SELECT Nombres_cliente FROM clientes WHERE ID_cliente = :ID_cliente), :id_forma_pago, (SELECT Nombre_forma_pago FROM formas_pago WHERE ID_forma_pago = :id_forma_pago), :subtotal, :iva, :totalProductos, :garantia);";
                        }

                        //variable para almacenar la fecha
                        $fecha = date("Y/m/d H:i:s");
                    
                        $statement = $conexion-> prepare($sql);

                        $statement->bindParam(':fecha',$fecha);
                        $statement->bindParam(':ID_empleado',$ID_empleado);
                        $statement->bindParam(':ID_cliente',$ID_cliente);
                        $statement->bindParam(':id_forma_pago',$id_forma_pago);
                        $statement->bindParam(':subtotal',$subtotal);
                        $statement->bindParam(':iva',$iva);
                        $statement->bindParam(':totalProductos',$totalProductos);
                        $statement->bindParam(':garantia',$garantia);
                        
                        if(!$statement){
                            $_SESSION['titulo'] = "Error en el sistema!";
                            $_SESSION['msj'] = "La venta no se ha podido registrar en el sistema";
                            $_SESSION['icono'] = "error";
                            echo "<script> location.href='../view/vendedor/registrarVentaVendedor.php' </script>";
                        } else {
                            $sql3 = "INSERT INTO detalles_factura (ID_factura, Cod_producto, Nombre_producto, Valor_producto, Cantidad_producto, Total_productos) 
                            VALUES ((SELECT MAX(ID_factura) FROM facturas) ,:Cod_producto, (SELECT Nombre_producto FROM productos WHERE Cod_producto = :Cod_producto), (SELECT Precio_producto FROM productos WHERE Cod_producto = :Cod_producto), :Cantidad_producto, :totalProductos);";

                            $statement3 = $conexion-> prepare($sql3);

                            $statement3->bindParam(':Cod_producto',$Cod_producto);
                            $statement3->bindParam(':Cantidad_producto',$Cantidad_producto);
                            $statement3->bindParam(':totalProductos',$totalProductos);

                            if (!$statement3) {
                                $_SESSION['titulo'] = "Error en el sistema!";
                                $_SESSION['msj'] = "El detalle de venta no se ha podido registrar en el sistema";
                                $_SESSION['icono'] = "error";
                                echo "<script> location.href='../view/vendedor/registrarVentaVendedor.php' </script>";
                            } else {
                                // insert en factura
                                $statement->execute();
                                // insert en detalle de factura
                                $statement3->execute();
                                // update en productos
                                $statement5->execute();
                                $alerta = "
                                    <script>
                                    (async () => {
                                    const { value: dinero } = await Swal.fire({
                                        title: 'El valor total a cobrar es: $".$totalProductos."',
                                        input: 'number',
                                        inputLabel: 'Ingrese el valor del dinero recibido:',
                                        inputPlaceholder: 'Dinero recibido',
                                        confirmButtonText: 'Siguiente',
                                        confirmButtonColor: '#e4112f'
                                    })
                                    if (dinero) {
                                        var total = ".$totalProductos.";
                                        var cambio = dinero - total;
                                        Swal.fire({
                                            title: 'El cambio a dar es de $' + cambio,
                                            confirmButtonColor: '#e4112f'
                                        })
                                    }
                                    })()
                                </script>";
                                $_SESSION['alerta'] = $alerta;
                                echo "<script> location.href='../view/vendedor/registrarVentaVendedor.php' </script>";
                            }
                        }
                    }
                }
            }   
        }
        public function mostrarVentasVendedor(){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $sql = "SELECT * FROM facturas WHERE ID_empleado = :id";
            $result = $conexion->prepare($sql);
            $result->bindParam(':id',$_SESSION['id']);
            $result->execute();
    
            //creamos un ciclo para convertir la variable result en arreglo $f
            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarVentaVendedor($ID_factura){
            
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
        public function UpdateVentaVendedor($ID_factura, $ID_empleado, $ID_cliente, $Cod_producto, $Cantidad_producto, $id_forma_pago, $garantia){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $sql7 = "SELECT ID_empleado FROM empleados WHERE ID_empleado = :ID_empleado";
            $statement7 = $conexion -> prepare($sql7);
            $statement7->bindParam(':ID_empleado',$ID_empleado);
            $statement7->execute();
            $f7 = $statement7->fetch();

            if (!$f7) {
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "No se ha encontrado ese Id de empleado, por favor verifique que este bien escrito.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back() </script>";
            } else {
                $sql4 = "SELECT * FROM detalles_factura WHERE ID_factura = :ID_factura";
                $result4 = $conexion-> prepare($sql4);
                $result4->bindParam(':ID_factura',$ID_factura);
                $result4->execute();
                $f4 = $result4->fetch();

                // exixtencias del producto ingresado
                $sql5 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :Cod_producto";
                $result5 = $conexion->prepare($sql5);
                $result5->bindParam(':Cod_producto',$Cod_producto);
                $result5->execute();
                $f5 = $result5->fetch();

                // existencias del producto registrado en detalles facturas
                $sql6 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :Cod_producto";
                $result6 = $conexion->prepare($sql6);
                $result6->bindParam(':Cod_producto',$f4['Cod_producto']);
                $result6->execute();
                $f6 = $result6->fetch();
                if (!$f5) {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "No se ha encontrado ese código de producto, por favor verifique que este bien escrito.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back() </script>";
                } else {
                    // si el producto registrado es igual al ingresado y la cantidad registrada es igual al ingresada
                    if ($f4['Cod_producto'] == $Cod_producto && $f4['Cantidad_producto'] == $Cantidad_producto) {
                        $existencias_ant = $f6['Existencias_producto'];
                        $new_existencias = $f6['Existencias_producto'];

                    // si el producto registrado es igual al ingresado y la cantidad registrada es diferente al ingresada
                    } else if ($f4['Cod_producto'] == $Cod_producto && $f4['Cantidad_producto'] != $Cantidad_producto){
                        $existencias_ant = $f6['Existencias_producto'] + $f4['Cantidad_producto'];
                        $new_existencias = $existencias_ant - $Cantidad_producto;

                    // si el producto registrado es diferente al ingresado y la cantidad registrada es igual al ingresada
                    } else if ($f4['Cod_producto'] != $Cod_producto && $f4['Cantidad_producto'] == $Cantidad_producto){
                        $existencias_ant = $f6['Existencias_producto'] + $f4['Cantidad_producto'];
                        $new_existencias = $f5['Existencias_producto'] - $Cantidad_producto;

                    // si el producto registrado es diferente al ingresado y la cantidad registrada es diferente al ingresada
                    } else if ($f4['Cod_producto'] != $Cod_producto && $f4['Cantidad_producto'] != $Cantidad_producto) {
                        $existencias_ant = $f6['Existencias_producto'] + $f4['Cantidad_producto'];
                        $new_existencias = $f5['Existencias_producto'] - $Cantidad_producto;
                    }

                    // update para el producto registrado, es decir devolverle las existencias que habia
                    $sql7 = "UPDATE productos SET Existencias_producto = :existencias_ant WHERE Cod_producto = :Cod_producto";
                    $statement7 = $conexion->prepare($sql7);
                    $statement7->bindParam(':existencias_ant',$existencias_ant);
                    $statement7->bindParam(':Cod_producto',$f4['Cod_producto']);
                    

                    // modificar las existencias al producto ingresado
                    $sql8 = "UPDATE productos SET Existencias_producto = :new_existencias WHERE Cod_producto = :Cod_producto";
                    $statement8 = $conexion->prepare($sql8);
                    $statement8->bindParam(':new_existencias',$new_existencias);
                    $statement8->bindParam(':Cod_producto',$Cod_producto);

                    $sqlCli = "SELECT * FROM clientes WHERE ID_cliente = :ID_cliente";
                    $resultCli = $conexion->prepare($sqlCli);
                    $resultCli->bindParam(':ID_cliente',$ID_cliente);
                    $resultCli->execute();

                    $fCli = $resultCli->fetch();

                    if (!$fCli) {
                        $sql = "UPDATE facturas SET ID_empleado = :ID_empleado, Nombres_empleado = (SELECT Nombres_empleado FROM empleados WHERE ID_empleado = :ID_empleado), 
                        ID_cliente = 1, Nombres_cliente = (SELECT Nombres_cliente FROM clientes WHERE ID_cliente = 1), 
                        ID_forma_pago = :id_forma_pago, Nombre_forma_pago = (SELECT Nombre_forma_pago FROM formas_pago WHERE ID_forma_pago = :id_forma_pago), Subtotal = :subtotal, Iva = :iva, Total_venta = :totalProductos, Garantia = :garantia 
                        WHERE ID_factura = :ID_factura;";
                    } else {
                        $sql = "UPDATE facturas SET ID_empleado = :ID_empleado, Nombres_empleado = (SELECT Nombres_empleado FROM empleados WHERE ID_empleado = :ID_empleado), 
                        ID_cliente = :ID_cliente, Nombres_cliente = (SELECT Nombres_cliente FROM clientes WHERE ID_cliente = :ID_cliente), 
                        ID_forma_pago = :id_forma_pago, Nombre_forma_pago = (SELECT Nombre_forma_pago FROM formas_pago WHERE ID_forma_pago = :id_forma_pago), Subtotal = :subtotal, Iva = :iva, Total_venta = :totalProductos, Garantia = :garantia 
                        WHERE ID_factura = :ID_factura;";
                    }
                    $statement = $conexion-> prepare($sql);

                    $statement->bindParam(':ID_factura',$ID_factura);
                    $statement->bindParam(':ID_empleado',$ID_empleado);
                    $statement->bindParam(':ID_cliente',$ID_cliente);
                    $statement->bindParam(':id_forma_pago',$id_forma_pago);
                    $statement->bindParam(':subtotal',$subtotal);
                    $statement->bindParam(':iva',$iva);
                    $statement->bindParam(':totalProductos',$totalProductos);
                    $statement->bindParam(':garantia',$garantia);
                    
                    if(!$statement){
                        $_SESSION['titulo'] = "Error en el sistema!";
                        $_SESSION['msj'] = "La venta no se ha podido actualizar.";
                        $_SESSION['icono'] = "error";
                        echo "<script> location.href='../view/vendedor/verVentasVendedor.php' </script>";
                    } else {
                        //consulta para saber el precio del producto
                        $sql2 = "SELECT Precio_producto FROM productos WHERE Cod_producto = :Cod_producto;";

                        $statement2 = $conexion -> prepare($sql2);
                        $statement2->bindParam(':Cod_producto',$Cod_producto);

                        $statement2->execute();

                        // Transformo la cosulta en arreglo para poder manejar el valor numerico
                        $f = $statement2->fetch();
                        
                        // VARIABLES PARA LA CONTABILIDAD DE LA VENTA: valor total de los productos, el iva y el subtotal
                        // Multiplico la cantidad por el valor
                        $totalProductos = $Cantidad_producto * $f['Precio_producto'];
                        $iva = $totalProductos * 0.19;
                        $subtotal = $totalProductos - $iva;

                        $sql3 = "UPDATE detalles_factura SET Cod_producto = :Cod_producto, Nombre_producto = (SELECT Nombre_producto FROM productos WHERE Cod_producto = :Cod_producto) , Valor_producto = (SELECT Precio_producto FROM productos WHERE Cod_producto = :Cod_producto), Cantidad_producto = :Cantidad_producto, Total_productos = :totalProductos 
                        WHERE ID_factura = :ID_factura;";

                        $statement3 = $conexion-> prepare($sql3);

                        $statement3->bindParam(':ID_factura',$ID_factura);
                        $statement3->bindParam(':Cod_producto',$Cod_producto);
                        $statement3->bindParam(':Cantidad_producto',$Cantidad_producto);
                        $statement3->bindParam(':totalProductos',$totalProductos);

                        if (!$statement3) {
                            $_SESSION['titulo'] = "Error en el sistema!";
                            $_SESSION['msj'] = "El detalle de la venta no se ha podido actualizar.";
                            $_SESSION['icono'] = "error";
                            echo "<script> location.href='../view/vendedor/verVentasVendedor.php' </script>";
                        } else {
                            if ($f5['Existencias_producto'] == 0 || $new_existencias < 0) {
                                $_SESSION['titulo'] = "Lo sentimos!";
                                $_SESSION['msj'] = "No hay suficientes productos para actualizar la venta. Productos disponibles: ".$f5['Existencias_producto']." (sin contar el que vendio).";
                                $_SESSION['icono'] = "info";
                                echo "<script> window.history.back() </script>";
                            } else {
                                // ejecucion de insertar en tabla facturas y luego insertar en tabla detalle de facturas
                                $statement->execute();
                                $statement3->execute();

                                // actualizar las exixtencias del producto registrado y luego las del producto ingresado
                                $statement7->execute();
                                $statement8->execute();
                                
                                $_SESSION['titulo'] = "Actualización exitosa!";
                                $_SESSION['msj'] = "La informacion de la venta ha sido actualizada.";
                                $_SESSION['icono'] = "success";
                                echo "<script> location.href='../view/vendedor/verVentasVendedor.php' </script>";
                            }
                        }
                    }
                }
            }
        }

        //Productos
        public function registrarProductoVendedor($Cod_producto, $Nombre_producto, $Descripcion_producto, $Marca, $Nit_proveedor, $Precio_producto, $imgProd){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "SELECT Cod_producto FROM productos WHERE Cod_producto = :Cod_producto";
            $result = $conexion->prepare($sql);
            $result->bindParam(':Cod_producto', $Cod_producto);
            $result->execute();
            
            $f1 = $result->fetch();
            if ($f1) {
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "Este producto ya se encuentra registrado, intente con uno nuevo.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back(); </script>";
            } else {
                // seleccionamos el nit del proveedor donde el nit sea igual al ingresado el el formulario
                $sql = "SELECT Nit_proveedor FROM proveedores WHERE Nit_proveedor = :nitProveedor";
                $result = $conexion->prepare($sql);

                $result->bindParam(':nitProveedor',$Nit_proveedor);
                $result->execute();
            
                //Almacenamos la información de result en la variable $f
                $f = $result->fetch();

                // si existe $f realiza el registro del producto
                if ($f) {

                    $fecha = date('Y/m/d');
                    
                    $sql = "INSERT INTO productos (Cod_producto, Nombre_Producto, Descripcion_producto, Marca , Nit_proveedor, Nombre_proveedor, Precio_producto, Foto_producto, Fecha_producto)
                    VALUES (:Cod_producto, :Nombre_producto, :Descripcion_producto, :Marca, :Nit_proveedor, (SELECT Nombre_proveedor FROM proveedores WHERE Nit_proveedor = :Nit_proveedor), :Precio_producto, :Foto_producto, :fecha)";

                    $statement = $conexion-> prepare($sql);

                    $statement->bindParam(':Cod_producto',$Cod_producto);
                    $statement->bindParam(':Nombre_producto',$Nombre_producto);
                    $statement->bindParam(':Descripcion_producto',$Descripcion_producto);
                    $statement->bindParam(':Marca',$Marca);
                    $statement->bindParam(':Nit_proveedor',$Nit_proveedor);
                    $statement->bindParam(':Precio_producto',$Precio_producto);
                    $statement->bindParam(':fecha',$fecha);
                    $statement->bindParam(':Foto_producto',$imgProd);

                    if(!$statement){
                        $_SESSION['titulo'] = "Error en el sistema!";
                        $_SESSION['msj'] = "El producto no se ha podido registrar en el sistema.";
                        $_SESSION['icono'] = "error";
                        echo "<script> location.href='../view/vendedor/registrarProductoVendedor.php' </script>";
                    } else {
                        $statement->execute();
                        
                        $_SESSION['titulo'] = "Registro exitoso!";
                        $_SESSION['msj'] = "El producto ha sido registrado exitosamente en el sistema.";
                        $_SESSION['icono'] = "success";
                        echo "<script> location.href='../view/vendedor/registrarProductoVendedor.php' </script>";
                    }
                //Si no existe $f, no se realiza el registro y se notificara al usuario.
                } else {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "Ese proveedor no esta registrado en el sistema. Registre primero ese proveedor y luego el producto.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back(); </script>";
                }
            }
        } 
        public function mostrarProductosVendedor(){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
    
            $consultar = "SELECT * FROM productos";
            $result = $conexion->prepare($consultar);
            $result->execute();
    
            //creamos un ciclo para convertir la variable result en arreglo $f
            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarProductoVendedor($Cod_producto){
            $f = null;

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $sql = "SELECT * FROM productos WHERE Cod_producto = :Cod_producto";

            $result = $conexion->prepare($sql);
            $result->bindParam(':Cod_producto',$Cod_producto);
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
        public function updateProductoVendedor($Cod_producto, $Nombre_producto, $Descripcion_producto, $Marca, $Nit_proveedor, $Precio_producto, $imgProd){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "SELECT * FROM productos WHERE Cod_producto = :Cod_producto";
            $result = $conexion->prepare($sql);
            $result->bindParam(':Cod_producto', $Cod_producto);
            $result->execute();
            $f = $result->fetch();
            
            $sqlProv = "SELECT Nit_proveedor FROM productos WHERE Nit_proveedor = :nitProveedor";
            $result2 = $conexion->prepare($sqlProv);
            $result2->bindParam(':nitProveedor', $Nit_proveedor);
            $result2->execute();

            $f2 = $result2->fetch();
            if (!$f2) {
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "Ese proveedor no esta registrado en el sistema. Registre primero ese proveedor y luego actualice el producto.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back(); </script>";
            } else {
                if ($f['Cod_producto'] == $Cod_producto) {
                    // si la longitud de la variable imgProd es igual a 4, la imagen no se debe actualizar
                    // porque la variable ya contiene almacenado "img/" 
                    // si no quiere decir que tiene el "img/" mas el nombre del archivo, entonces si se actualiza
                    if (strlen($imgProd) == 4) {
                        $sql = "UPDATE productos SET Nombre_producto = :Nombre_producto, Descripcion_producto = :Descripcion_producto, Marca = :Marca, Nit_proveedor = :Nit_proveedor, Nombre_proveedor = (SELECT Nombre_proveedor FROM Proveedores WHERE Nit_proveedor = :Nit_proveedor), Precio_producto = :Precio_producto
                        WHERE Cod_producto = :Cod_producto";

                        $statement = $conexion->prepare($sql);

                        $statement->bindParam(':Cod_producto',$Cod_producto);
                        $statement->bindParam(':Nombre_producto',$Nombre_producto);
                        $statement->bindParam(':Descripcion_producto',$Descripcion_producto);
                        $statement->bindParam(':Marca',$Marca);
                        $statement->bindParam(':Nit_proveedor',$Nit_proveedor);
                        $statement->bindParam(':Precio_producto',$Precio_producto);

                        if (!$statement) {
                            $_SESSION['titulo'] = "Error en el sistema!";
                            $_SESSION['msj'] = "La informacion del producto no se ha podido actualizar.";
                            $_SESSION['icono'] = "error";
                            echo "<script> location.href='../view/vendedor/verProductosVendedor.php' </script>";
                        } else {
                            $statement->execute();
                            
                            $_SESSION['titulo'] = "Actualización exitoso!";
                            $_SESSION['msj'] = "La informacion del producto ha sido actualizada.";
                            $_SESSION['icono'] = "success";
                            echo "<script> location.href='../view/vendedor/verProductosVendedor.php' </script>";
                        }
                    } else {
                        $sql = "UPDATE productos SET Nombre_producto = :Nombre_producto, Descripcion_producto = :Descripcion_producto, Marca = :Marca, Nit_proveedor = :Nit_proveedor, Nombre_proveedor = (SELECT Nombre_proveedor FROM Proveedores WHERE Nit_proveedor = :Nit_proveedor), Precio_producto = :Precio_producto, Foto_producto = :imgProd
                        WHERE Cod_producto = :Cod_producto";

                        $statement = $conexion->prepare($sql);

                        $statement->bindParam(':Cod_producto',$Cod_producto);
                        $statement->bindParam(':Nombre_producto',$Nombre_producto);
                        $statement->bindParam(':Descripcion_producto',$Descripcion_producto);
                        $statement->bindParam(':Marca',$Marca);
                        $statement->bindParam(':Nit_proveedor',$Nit_proveedor);
                        $statement->bindParam(':Precio_producto',$Precio_producto);
                        $statement->bindParam(':imgProd',$imgProd);

                        if (!$statement) {
                            $_SESSION['titulo'] = "Error en el sistema!";
                            $_SESSION['msj'] = "La informacion del producto no se ha podido actualizar.";
                            $_SESSION['icono'] = "error";
                            echo "<script> location.href='../view/vendedor/verProductosVendedor.php' </script>";
                        } else {
                            $statement->execute();
                            
                            $_SESSION['titulo'] = "Actualización exitoso!";
                            $_SESSION['msj'] = "La informacion del producto ha sido actualizada.";
                            $_SESSION['icono'] = "success";
                            echo "<script> location.href='../view/vendedor/verProductosVendedor.php' </script>";
                        }
                    }
                } else {
                    $sql2 = "SELECT COUNT(Cod_producto) FROM productos WHERE Cod_producto = :Cod_producto";
                    $result2 = $conexion->prepare($sql2);
                    $result2->bindParam(':Cod_producto', $Cod_producto);
                    $result2->execute();

                    $f2 = $result2->fetch();
                    if ($f2['COUNT(Cod_producto)'] == 0) {
                        if (strlen($imgProd) == 4) {
                            $sql = "UPDATE productos SET Nombre_producto = :Nombre_producto, Descripcion_producto = :Descripcion_producto, Marca = :Marca, Nit_proveedor = :Nit_proveedor, Nombre_proveedor = (SELECT Nombre_proveedor FROM Proveedores WHERE Nit_proveedor = :Nit_proveedor), Precio_producto = :Precio_producto
                            WHERE Cod_producto = :Cod_producto";
        
                            $statement = $conexion->prepare($sql);
        
                            $statement->bindParam(':Cod_producto',$Cod_producto);
                            $statement->bindParam(':Nombre_producto',$Nombre_producto);
                            $statement->bindParam(':Descripcion_producto',$Descripcion_producto);
                            $statement->bindParam(':Marca',$Marca);
                            $statement->bindParam(':Nit_proveedor',$Nit_proveedor);
                            $statement->bindParam(':Precio_producto',$Precio_producto);
                            
                            if (!$statement) {
                                $_SESSION['titulo'] = "Error en el sistema!";
                                $_SESSION['msj'] = "La informacion del producto no se ha podido actualizar.";
                                $_SESSION['icono'] = "error";
                                echo "<script> location.href='../view/vendedor/verProductosVendedor.php' </script>";
                            } else {
                                $statement->execute();
                                
                                $_SESSION['titulo'] = "Actualización exitoso!";
                                $_SESSION['msj'] = "La informacion del producto ha sido actualizada.";
                                $_SESSION['icono'] = "success";
                                echo "<script> location.href='../view/vendedor/verProductosVendedor.php' </script>";
                            }
                        } else {
                            $sql = "UPDATE productos SET Nombre_producto = :Nombre_producto, Descripcion_producto = :Descripcion_producto, Marca = :Marca, Nit_proveedor = :Nit_proveedor, Nombre_proveedor = (SELECT Nombre_proveedor FROM Proveedores WHERE Nit_proveedor = :Nit_proveedor), Precio_producto = :Precio_producto, Foto_producto = :imgProd
                            WHERE Cod_producto = :Cod_producto";
        
                            $statement = $conexion->prepare($sql);
        
                            $statement->bindParam(':Cod_producto',$Cod_producto);
                            $statement->bindParam(':Nombre_producto',$Nombre_producto);
                            $statement->bindParam(':Descripcion_producto',$Descripcion_producto);
                            $statement->bindParam(':Marca',$Marca);
                            $statement->bindParam(':Nit_proveedor',$Nit_proveedor);
                            $statement->bindParam(':Precio_producto',$Precio_producto);
                            $statement->bindParam(':imgProd',$imgProd);
        
                            if (!$statement) {
                                $_SESSION['titulo'] = "Error en el sistema!";
                                $_SESSION['msj'] = "La informacion del producto no se ha podido actualizar.";
                                $_SESSION['icono'] = "error";
                                echo "<script> location.href='../view/vendedor/verProductosVendedor.php' </script>";
                            } else {
                                $statement->execute();
                                
                                $_SESSION['titulo'] = "Actualización exitoso!";
                                $_SESSION['msj'] = "La informacion del producto ha sido actualizada.";
                                $_SESSION['icono'] = "success";
                                echo "<script> location.href='../view/vendedor/verProductosVendedor.php' </script>";
                            }
                        }  
                    } else {
                        $_SESSION['titulo'] = "Oops!";
                        $_SESSION['msj'] = "Este codigo de producto ya le pertenece a un producto, revise ese campo e intente nuevamente.";
                        $_SESSION['icono'] = "error";
                        echo "<script> window.history.back(); </script>";
                    }
                }
            }
        }

        //Inventarios
        public function registrarInventarioProductosVendedor($nitproveedor, $codproducto, $cantidad, $precio, $causa, $observacion){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // seleccionamos el nit del proveedor donde el nit sea igual al ingresado el el formulario
            $sql1 = "SELECT Nit_proveedor FROM proveedores WHERE Nit_proveedor = :nitproveedor";
            $result = $conexion->prepare($sql1);
            $result->bindParam(':nitproveedor',$nitproveedor);
            $result->execute();

            // convertimos la variable result en arreglo
            $f = $result->fetch();

            // si no existe f, no se realiza el registro y se redirecciona
            if (!$f){
                echo '<script> alert("El proveedor no esta registrado en el sistema. \nIntente registrar primero este proveedor.") </script>';
                echo "<script> window.history.back(); </script>";
            } else {
                // seleccionamos el codigo de producto donde el codigo sea igual al ingresado el el formulario
                $sql2 = "SELECT Cod_producto FROM productos WHERE Cod_producto = :codproducto";
                $result1 = $conexion->prepare($sql2);
                $result1->bindParam(':codproducto',$codproducto);
                $result1->execute();

                // convertimos la variable result1 en arreglo
                $f1 = $result1->fetch();

                // si no existe f1, no se realiza el registro y se redirecciona
                if (!$f1) {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "Ese producto no esta registrado en el sistema. Registre ese producto y luego el inventario.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back(); </script>";
                } else {
                    $fecha = date("Y/m/d H:i:s");

                    $sql = "INSERT INTO inventario_productos (Nit_proveedor, Nombre_proveedor, Cod_producto, Nombre_producto, Fecha_inventario, Cantidad_inventario, Precio_inventario, Causa, Observaciones)
                    VALUES (:nitproveedor, (SELECT Nombre_proveedor FROM proveedores WHERE Nit_proveedor = :nitproveedor), :codproducto, (SELECT Nombre_producto FROM productos WHERE Cod_producto = :codproducto), :fecha, :cantidad, :precio, :causa, :observacion)";

                    $statement = $conexion-> prepare($sql);

                    // $statement->bindParam(':idinventario',$idinventario);
                    $statement->bindParam(':nitproveedor',$nitproveedor);
                    $statement->bindParam(':codproducto',$codproducto);
                    $statement->bindParam(':fecha',$fecha);
                    $statement->bindParam(':cantidad',$cantidad);
                    $statement->bindParam(':precio',$precio);
                    $statement->bindParam(':causa',$causa);
                    $statement->bindParam(':observacion',$observacion);

                    // seleccionamos las existencias acuales del producto
                    $sql3 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codproducto";
                    $result3 = $conexion->prepare($sql3);
                    $result3->bindParam(':codproducto',$codproducto);
                    $result3->execute();

                    $f = $result3->fetch();

                    if ($causa == "Ingreso"){
                        // sumamos las existencias actuales mas las ingresadas en el formulario
                        $new_existencias = $cantidad + $f["Existencias_producto"];
                    } else {
                        // restamos las existencias actuales menos las ingresadas en el formulario
                        $new_existencias =  $f["Existencias_producto"] - $cantidad ;
                    }
                    // actualizamos las existencias del producto
                    $sql4 = "UPDATE productos SET Existencias_producto = :new_existencias WHERE Cod_producto = :codproducto";
                    $statement4 = $conexion->prepare($sql4);
                    $statement4->bindParam(':new_existencias',$new_existencias);
                    $statement4->bindParam(':codproducto',$codproducto);

                    if(!$statement){
                        $_SESSION['titulo'] = "Error en el sistema!";
                        $_SESSION['msj'] = "El inventario no se ha podido registrar en el sistema.";
                        $_SESSION['icono'] = "error";
                        echo "<script> location.href='../view/vendedor/registrarInventarioProductosVendedor.php' </script>";
                    } else {
                        // si la causa es salida y las nuevas existencias son menores a cero o que la cantidad sea mayor
                        // a las existencias actuales no se podra registrar el movimiento de inventario
                        if ($causa == "Salida" && ($new_existencias < 0 || $f["Existencias_producto"] < $cantidad)) {
                            $_SESSION['titulo'] = "Lo sentimos";
                            $_SESSION['msj'] = "No hay suficientes productos para sacarlos del inventario. Productos disponibles: ".$f['Existencias_producto']."";
                            $_SESSION['icono'] = "info";
                            echo "<script> window.history.back() </script>";
                        } else {
                            // insert en inventario
                            $statement->execute();
                            // update en productos
                            $statement4->execute();
                            
                            $_SESSION['titulo'] = "Registro exitoso!";
                            $_SESSION['msj'] = "El inventario ha sido registrado exitosamente en el sistema.";
                            $_SESSION['icono'] = "success";
                            echo "<script> location.href='../view/vendedor/registrarInventarioProductosVendedor.php' </script>";
                        }
                    }
                }
            }
        } 
        public function mostrarInventarioProductosVendedor(){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
    
            $consultar = "SELECT * FROM inventario_productos";
            $result = $conexion->prepare($consultar);
            $result->execute();
    
            //creamos un ciclo para convertir la variable result en arreglo $f
            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarInventarioVendedor($Id_inventario){
            
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $sql = "SELECT * FROM inventario_productos WHERE ID_inventario = :Id_inventario";

            $result = $conexion->prepare($sql);
            $result->bindParam(':Id_inventario',$Id_inventario);
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
        public function updateInventarioVendedor($ID_inventario, $nitproveedor, $codproducto, $cantidad, $precio, $causa, $observacion){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $sqlProv = "SELECT Nit_proveedor FROM proveedores WHERE Nit_proveedor = :nitproveedor";
            $resultProv = $conexion->prepare($sqlProv);
            $resultProv->bindParam(':nitproveedor',$nitproveedor);
            $resultProv->execute();
            $fp = $resultProv->fetch();

            if (!$fp){
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "Ese proveedor no esta registrado en el sistema. Registre ese proveedor y luego el inventario.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back(); </script>";
            } else {
                $sqlProd = "SELECT Cod_producto FROM productos WHERE Cod_producto = :codproducto";
                $resultProd = $conexion->prepare($sqlProd);
                $resultProd->bindParam(':codproducto',$codproducto);
                $resultProd->execute();
                $fr = $resultProd->fetch();
                if (!$fr) {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "Ese producto no esta registrado en el sistema. Registre ese producto y luego actualice el inventario.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back(); </script>";
                } else {
                    // seleccionamos el registro de inventario y las existencias de productos antes de actualizarlo para poder hacer unas validadciones
                    $sql2 = "SELECT i.*, p.Existencias_producto FROM inventario_productos i, productos p WHERE i.ID_inventario = :ID_inventario AND p.Cod_producto = :codproducto";
                    $result = $conexion->prepare($sql2);
                    $result->bindParam(':ID_inventario',$ID_inventario);
                    $result->bindParam(':codproducto',$codproducto);
                    $result->execute();

                    $f = $result->fetch();
                    // Las siguientes validaciones son para cada posibilidad de cambio, es decir si se cambia el codigo y la causa
                    // o no se cambian, o se cambia el codigo pero no la causa o viceversa
                    // Validamos que si el producto registrado es igual al ingresado, que la causa registrada es igual a "ingreso"
                    // y la causa ingresada en el formualrio es igual a "ingreso"
                    if ($f['Cod_producto'] == $codproducto && $f['Causa'] == "Ingreso" && $causa == "Ingreso") {
                        
                        $diferencia = $f['Existencias_producto'] - $f['Cantidad_inventario']; // regresamos a las existencias que habian antes de hacer el registro
                        $new_existencias = $diferencia + $cantidad; // como la causa en el formulario es "ingreso", sumamos la cantidad ingresada en el formulario

                    // Validamos que si el producto registrado es igual al ingresado, que la causa registrada es igual a "ingreso"
                    // y la causa ingresada en el formulario es igual a "salida"
                    } else if ($f['Cod_producto'] == $codproducto && $f['Causa'] == "Ingreso" && $causa == "Salida"){
                        
                        $diferencia = $f['Existencias_producto'] - $f['Cantidad_inventario']; // regresamos a las existencias que habian antes de hacer el registro
                        $new_existencias = $diferencia - $cantidad; // como la causa en el formulario es "salida", restamos la cantidad ingresada en el formulario

                    // Validamos que si el producto registrado es igual al ingresado, que la causa registrada es igual a "salida"
                    // y la causa ingresada en el formulario es igual a "ingreso"
                    } else if ($f['Cod_producto'] == $codproducto && $f['Causa'] == "Salida" && $causa == "Ingreso"){
                        
                        $diferencia = $f['Existencias_producto'] + $f['Cantidad_inventario']; // regresamos a las existencias que habian antes de hacer el registro
                        $new_existencias = $diferencia + $cantidad; // como la causa en el formulario es "ingreso", sumamos la cantidad ingresada en el formulario
                    
                    // Validamos que si el producto registrado es igual al ingresado, que la causa registrada es igual a "salida"
                    // y la causa ingresada en el formulario es igual a "Salida"
                    } else if ($f['Cod_producto'] == $codproducto && $f['Causa'] == "Salida" && $causa == "Salida"){
                        
                        $diferencia = $f['Existencias_producto'] + $f['Cantidad_inventario']; // regresamos a las existencias que habian antes de hacer el registro
                        $new_existencias = $diferencia - $cantidad; // como la causa en el formulario es "Salida", restamos la cantidad ingresada en el formulario
                    
                    // Validamos que si el producto registrado es diferente al ingresado, que la causa registrada es igual a "ingreso"
                    // y la causa ingresada en el formulario es igual a "ingreso"
                    } else if ($f['Cod_producto'] != $codproducto && $f['Causa'] == "Ingreso" && $causa == "Ingreso"){
                        
                        // creamos una nueva consulta de las existenias puesto que el codigo de producto es diferente entre el registrado y el ingresado
                        $sql4 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codigo";
                        $result4 = $conexion->prepare($sql4);
                        $result4->bindParam(':codigo',$f['Cod_producto']);
                        $result4->execute();

                        $f1 = $result4->fetch();

                        $diferencia = $f1['Existencias_producto'] - $f['Cantidad_inventario']; // regresamos a las existencias que habian antes de hacer el registro

                        // actualizamos las existencias del producto registrado, es decir a como estaban antes del registro
                        $sql5 = "UPDATE productos SET Existencias_producto = :diferencia WHERE Cod_producto = :codigo";
                        $statement5 = $conexion->prepare($sql5);
                        $statement5->bindParam(':codigo',$f['Cod_producto']);
                        $statement5->bindParam(':diferencia',$diferencia);
                        $statement5->execute();

                        // seleccionamos las existencias del producto ingresado en el formulario
                        $sql6 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codigo";
                        $result6 = $conexion->prepare($sql6);
                        $result6->bindParam(':codigo',$codproducto);
                        $result6->execute();

                        $f2 = $result6->fetch();

                        $new_existencias = $f2["Existencias_producto"] + $cantidad; // como la causa en el formulario es "ingreso", Sumamos la cantidad ingresada en el formulario

                    // Validamos que si el producto registrado es diferente al ingresado, que la causa registrada es igual a "ingreso"
                    // y la causa ingresada en el formulario es igual a "salida"
                    } else if ($f['Cod_producto'] != $codproducto && $f['Causa'] == "Ingreso" && $causa == "Salida"){
                        
                        // creamos una nueva consulta de las existenias puesto que el codigo de producto es diferente entre el registrado y el ingresado
                        $sql4 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codigo";
                        $result4 = $conexion->prepare($sql4);
                        $result4->bindParam(':codigo',$f['Cod_producto']);
                        $result4->execute();

                        $f1 = $result4->fetch();

                        $diferencia = $f1['Existencias_producto'] - $f['Cantidad_inventario']; // regresamos a las existencias que habian antes de hacer el registro

                        // actualizamos las existencias del producto registrado, es decir a como estaban antes del registro
                        $sql5 = "UPDATE productos SET Existencias_producto = :diferencia WHERE Cod_producto = :codigo";
                        $statement5 = $conexion->prepare($sql5);
                        $statement5->bindParam(':codigo',$f['Cod_producto']);
                        $statement5->bindParam(':diferencia',$diferencia);
                        $statement5->execute();

                        // seleccionamos las existencias del producto ingresado en el formulario
                        $sql6 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codigo";
                        $result6 = $conexion->prepare($sql6);
                        $result6->bindParam(':codigo',$codproducto);
                        $result6->execute();

                        $f2 = $result6->fetch();

                        $new_existencias = $f2["Existencias_producto"] - $cantidad; // como la causa en el formulario es "salida", restamos la cantidad ingresada en el formulario

                    // Validamos que si el producto registrado es diferente al ingresado, que la causa registrada es igual a "Salida"
                    // y la causa ingresada en el formulario es igual a "ingreso"
                    } else if ($f['Cod_producto'] != $codproducto && $f['Causa'] == "Salida" && $causa == "Ingreso"){
                        
                        // creamos una nueva consulta de las existenias puesto que el codigo de producto es diferente entre el registrado y el ingresado
                        $sql4 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codigo";
                        $result4 = $conexion->prepare($sql4);
                        $result4->bindParam(':codigo',$f['Cod_producto']);
                        $result4->execute();

                        $f1 = $result4->fetch();

                        $diferencia = $f1['Existencias_producto'] + $f['Cantidad_inventario']; // regresamos a las existencias que habian antes de hacer el registro

                        // actualizamos las existencias del producto registrado, es decir a como estaban antes del registro
                        $sql5 = "UPDATE productos SET Existencias_producto = :diferencia WHERE Cod_producto = :codigo";
                        $statement5 = $conexion->prepare($sql5);
                        $statement5->bindParam(':codigo',$f['Cod_producto']);
                        $statement5->bindParam(':diferencia',$diferencia);
                        $statement5->execute();

                        // seleccionamos las existencias del producto ingresado en el formulario
                        $sql6 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codigo";
                        $result6 = $conexion->prepare($sql6);
                        $result6->bindParam(':codigo',$codproducto);
                        $result6->execute();

                        $f2 = $result6->fetch();

                        $new_existencias = $f2["Existencias_producto"] + $cantidad; // como la causa en el formulario es "Ingreso", sumamos la cantidad ingresada en el formulario

                    // Validamos que si el producto registrado es diferente al ingresado, que la causa registrada es igual a "Salida"
                    // y la causa ingresada en el formulario es igual a "Salida"
                    } else if ($f['Cod_producto'] != $codproducto && $f['Causa'] == "Salida" && $causa == "Salida"){
                        
                        // creamos una nueva consulta de las existenias puesto que el codigo de producto es diferente entre el registrado y el ingresado
                        $sql4 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codigo";
                        $result4 = $conexion->prepare($sql4);
                        $result4->bindParam(':codigo',$f['Cod_producto']);
                        $result4->execute();

                        $f1 = $result4->fetch();

                        $diferencia = $f1['Existencias_producto'] + $f['Cantidad_inventario']; // regresamos a las existencias que habian antes de hacer el registro

                        // actualizamos las existencias del producto registrado, es decir a como estaban antes del registro
                        $sql5 = "UPDATE productos SET Existencias_producto = :diferencia WHERE Cod_producto = :codigo";
                        $statement5 = $conexion->prepare($sql5);
                        $statement5->bindParam(':codigo',$f['Cod_producto']);
                        $statement5->bindParam(':diferencia',$diferencia);
                        $statement5->execute();

                        // seleccionamos las existencias del producto ingresado en el formulario
                        $sql6 = "SELECT Existencias_producto FROM productos WHERE Cod_producto = :codigo";
                        $result6 = $conexion->prepare($sql6);
                        $result6->bindParam(':codigo',$codproducto);
                        $result6->execute();

                        $f2 = $result6->fetch();

                        $new_existencias = $f2["Existencias_producto"] - $cantidad; // como la causa en el formulario es "Salida", restamos la cantidad ingresada en el formulario
                    }
                    // actualizamos las existencias en productos
                    $sql3 = "UPDATE productos SET Existencias_producto = :new_existencias WHERE Cod_producto = :codproducto";
                    $statement3 = $conexion->prepare($sql3);
                    $statement3->bindParam(':new_existencias',$new_existencias);
                    $statement3->bindParam(':codproducto',$codproducto);

                    // actualizamos el inventario
                    $sql = "UPDATE inventario_productos SET Nit_proveedor = :nitproveedor, Nombre_proveedor = (SELECT Nombre_proveedor FROM proveedores WHERE Nit_proveedor = :nitproveedor), Cod_producto = :codproducto, Nombre_producto = (SELECT Nombre_producto FROM productos WHERE Cod_producto = :codproducto), Cantidad_inventario = :cantidad , Precio_inventario = :precio, Causa = :causa, Observaciones = :observacion
                    WHERE ID_inventario = :ID_inventario";

                    $statement = $conexion->prepare($sql);

                    $statement->bindParam(':ID_inventario',$ID_inventario);
                    $statement->bindParam(':nitproveedor',$nitproveedor);
                    $statement->bindParam(':codproducto',$codproducto);
                    $statement->bindParam(':cantidad',$cantidad);
                    $statement->bindParam(':precio',$precio);
                    $statement->bindParam(':causa',$causa);
                    $statement->bindParam(':observacion',$observacion);

                    if (!$statement) {
                        $_SESSION['titulo'] = "Error en el sistema!";
                        $_SESSION['msj'] = "La información del inventario no se ha podido actualizar.";
                        $_SESSION['icono'] = "error";
                        echo "<script> location.href='../view/vendedor/verInventarioProductosVendedor.php' </script>";
                    } else {
                        if ($causa == "Salida" && ($new_existencias < 0 || $f["Existencias_producto"] < $cantidad)) {
                            $_SESSION['titulo'] = "Lo sentimos!";
                            $_SESSION['msj'] = "No hay suficientes productos para sacarlos del inventario. Productos disponibles: ".$f['Existencias_producto'].".";
                            $_SESSION['icono'] = "info";
                            echo "<script> window.history.back() </script>";
                        } else {
                            // update en las existencias de los productos
                            $statement3->execute();
                            // Update en inventario
                            $statement->execute();
                            
                            $_SESSION['titulo'] = "Actualización exitosa!";
                            $_SESSION['msj'] = "La información del inventario ha sido actualizada.";
                            $_SESSION['icono'] = "success";
                            echo "<script> location.href='../view/vendedor/verInventarioProductosVendedor.php' </script>";
                        }
                    }
                }
            }
        }

        //modulo de perfil
        public function perfilVendedor(){
            $f = null;
            $modelo = new conexion;
            $conexion = $modelo->get_conexion();

            $sql = "SELECT e.*, s.* FROM empleados e, estados s WHERE ID_empleado = :id AND e.ID_estado = s.ID_estado";

            $result = $conexion->prepare($sql);
            $result->bindParam(':id',$_SESSION['id']);
            $result->execute();

            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function updatePerfilVendedor($id_empleado, $tipoDoc, $numDoc, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $genero){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "SELECT * FROM empleados WHERE ID_empleado = :id_empleado";
            $result1 = $conexion->prepare($sql);
            $result1->bindParam(':id_empleado',$id_empleado);
            $result1->execute();
            //para almacenar la informacion de result1 en la variable $f
            $f = $result1->fetch();

            if ($f['Correo_empleado'] == $email) {
                // query para la actualizacion de los datos
                $actualizar = "UPDATE empleados SET Nombres_empleado = :nombres, Apellidos_empleado = :apellidos, Tipo_documento = :tipoDoc, 
                No_documento_empleado = :numDoc, Direccion_empleado = :direccion, Correo_empleado = :email, Celular_empleado = :celular, 
                Telefono_fijo_empleado = :telefono, Genero = :genero 
                WHERE ID_empleado = :id_empleado";

                $result = $conexion->prepare($actualizar);

                $result->bindParam(':id_empleado', $id_empleado);
                $result->bindParam(':tipoDoc', $tipoDoc);
                $result->bindParam(':numDoc', $numDoc);
                $result->bindParam(':nombres', $nombres);
                $result->bindParam(':apellidos', $apellidos);
                $result->bindParam(':direccion', $direccion);
                $result->bindParam(':email', $email);
                $result->bindParam(':celular', $celular);
                $result->bindParam(':telefono', $telefono);
                $result->bindParam(':genero', $genero);

                $result->execute();
                
                $_SESSION['titulo'] = "Actualización exitosa!";
                $_SESSION['msj'] = "Su información ha sido actualizada.";
                $_SESSION['icono'] = "success";
                echo "<script> location.href='../view/vendedor/perfilUsuario.php'</script>"; 
            } else {
                $contador1 = "SELECT COUNT(Correo_empleado) FROM empleados WHERE Correo_empleado = :email";
                $resultCont = $conexion->prepare($contador1);
                $resultCont->bindParam(':email', $email);
                $resultCont->execute();

                $fCont = $resultCont->fetch();

                if ($fCont['COUNT(Correo_empleado)'] == 0 ) {
                    $actualizar = "UPDATE empleados SET Nombres_empleado = :nombres, Apellidos_empleado = :apellidos, Tipo_documento = :tipoDoc, 
                    No_documento_empleado = :numDoc, Direccion_empleado = :direccion, Correo_empleado = :email, Celular_empleado = :celular, 
                    Telefono_fijo_empleado = :telefono, Genero = :genero 
                    WHERE ID_empleado = :id_empleado";

                    $result = $conexion->prepare($actualizar);

                    $result->bindParam(':id_empleado', $id_empleado);
                    $result->bindParam(':tipoDoc', $tipoDoc);
                    $result->bindParam(':numDoc', $numDoc);
                    $result->bindParam(':nombres', $nombres);
                    $result->bindParam(':apellidos', $apellidos);
                    $result->bindParam(':direccion', $direccion);
                    $result->bindParam(':email', $email);
                    $result->bindParam(':celular', $celular);
                    $result->bindParam(':telefono', $telefono);
                    $result->bindParam(':genero', $genero);

                    $result->execute();
                    
                    $_SESSION['titulo'] = "Actualización exitosa!";
                    $_SESSION['msj'] = "Su información ha sido actualizada.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../view/vendedor/perfilUsuario.php'</script>"; 
                } else {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "Este email ya le pertenece a alguien registrado, revise ese campo e intente nuevamente.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back(); </script>";
                }
            }
        }
        public function updateClaveVendedor($id, $pasmdAntigua, $passmd){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $sql = "SELECT Clave_empleado FROM empleados WHERE ID_empleado = :id";
            $result = $conexion->prepare($sql);
            $result->bindParam(':id',$id);
            $result->execute();

            $f = $result->fetch();

            // si la contraseña actual es incorrecta lo devuelve
            if ($f['Clave_empleado'] != $pasmdAntigua){
                $_SESSION['titulo'] = "Oops!";
                $_SESSION['msj'] = "Su contraseña actual es incorrecta, intente nuevamente.";
                $_SESSION['icono'] = "info";
                echo "<script> window.history.back(); </script>";
            } else {
                $sql1 = "UPDATE empleados SET Clave_empleado = :passmd WHERE ID_empleado = :id";
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
    }
?>