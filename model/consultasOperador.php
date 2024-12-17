<?php

    class consultasOperador{

        // modulo de Empresas
        public function registrarEmpresa($Empresa) {
            try {
                // Creamos el objeto de conexión
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
        
                // Verificamos si la empresa ya está registrada
                $sql = "SELECT * FROM empresas_cliente WHERE Nombre = :Empresa";
                $statement = $conexion->prepare($sql);
                $statement->bindParam(':Empresa', $Empresa);
                $statement->execute();
        
                // Validamos si ya existe
                if ($statement->fetch()) {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "Esta empresa ya se encuentra registrada. Por favor revise el nombre ingresado.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back(); </script>";
                    return;
                }
        
                // Si no existe, registramos la empresa
                $sql = "INSERT INTO empresas_cliente (Nombre) VALUES (:Empresa)";
                $statement = $conexion->prepare($sql);
                $statement->bindParam(':Empresa', $Empresa);
        
                if ($statement->execute()) {
                    $_SESSION['titulo'] = "Registro exitoso!";
                    $_SESSION['msj'] = "La empresa ha sido registrada exitosamente.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../../view/operaciones/registrarEmpresa.php'; </script>";
                } else {
                    $_SESSION['titulo'] = "Error!";
                    $_SESSION['msj'] = "No se pudo registrar la empresa.";
                    $_SESSION['icono'] = "error";
                    echo "<script> window.history.back(); </script>";
                }
            } catch (PDOException $e) {
                // Manejo de errores
                $_SESSION['titulo'] = "Error en el sistema!";
                $_SESSION['msj'] = "Ocurrió un error: " . $e->getMessage();
                $_SESSION['icono'] = "error";
                echo "<script> window.history.back(); </script>";
            }
        }

        public function mostrarEmpresas() {
            $empresas = null;
        
            // Creamos el objeto de la clase conexión para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            // Consulta para obtener todas las empresas
            $consultar = "SELECT ID_Empresa, Nombre FROM empresas_cliente";
        
            // Preparamos y ejecutamos la consulta
            $result = $conexion->prepare($consultar);
            $result->execute();
        
            // Recorremos los resultados y los almacenamos en un arreglo
            while ($arreglo = $result->fetch()) {
                $empresas[] = $arreglo;
            }
        
            // Retornamos el arreglo con los datos de las empresas
            return $empresas;
        }

        public function buscarEmpresa($ID_Empresa){
            $f = []; // Inicializar como array vacío
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            $consultar = "SELECT * FROM empresas_cliente WHERE ID_Empresa = :Id_Empresa";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':Id_Empresa', $ID_Empresa, PDO::PARAM_INT);
        
            if ($result->execute()) {
                // Mientras existan resultados, agrégalo al array
                while ($arreglo = $result->fetch(PDO::FETCH_ASSOC)) {
                    $f[] = $arreglo;
                }
            }
            return $f; // Devolverá un array (vacío si no hay resultados)
        }

        public function updateEmpresa($IDEmpresa, $NombreEmpresa) {
            // Conexión con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            // Verificar si la empresa ya existe con el mismo ID
            $sql = "SELECT * FROM empresas_cliente WHERE ID_Empresa = :IDEmpresa";
            $result1 = $conexion->prepare($sql);
            $result1->bindParam(':IDEmpresa', $IDEmpresa);
            $result1->execute();
            $f = $result1->fetch();
        
            // Validar si el nombre de la empresa es el mismo
            if ($f['Nombre'] == $NombreEmpresa) {
                // Actualizar si el nombre no cambió
                $actualizar = "UPDATE empresas_cliente SET Nombre = :NombreEmpresa WHERE ID_Empresa = :IDEmpresa";
                $result = $conexion->prepare($actualizar);
                $result->bindParam(':IDEmpresa', $IDEmpresa);
                $result->bindParam(':NombreEmpresa', $NombreEmpresa);
                return $result->execute();
            } else {
                // Verificar si el nuevo nombre ya existe en la base de datos
                $contador1 = "SELECT COUNT(Nombre) AS empresa_count FROM empresas_cliente WHERE Nombre = :NombreEmpresa";
                $resultCont = $conexion->prepare($contador1);
                $resultCont->bindParam(':NombreEmpresa', $NombreEmpresa);
                $resultCont->execute();
                $fCont = $resultCont->fetch();
        
                if ($fCont['empresa_count'] == 0) {
                    // Actualizar si el nuevo nombre es único
                    $actualizar = "UPDATE empresas_cliente SET Nombre = :NombreEmpresa WHERE ID_Empresa = :IDEmpresa";
                    $result = $conexion->prepare($actualizar);
                    $result->bindParam(':IDEmpresa', $IDEmpresa);
                    $result->bindParam(':NombreEmpresa', $NombreEmpresa);
                    return $result->execute();
                } else {
                    // Si el nuevo nombre ya existe, retornar falso
                    return false;
                }
            }
        }
        

        // Modulo de clientes
        public function registrarCliente($ID_Empresa, $Nombre_Contacto, $Email, $Celular_Contacto) {
            // Crear el objeto de la clase conexión
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            try {
                // Verificar si el cliente ya existe en la base de datos
                $sqlVerificar = "SELECT * FROM clientes WHERE Email = :Email OR Celular_Contacto = :Celular_Contacto";
                $stmtVerificar = $conexion->prepare($sqlVerificar);
        
                // Enlazar parámetros para evitar inyecciones SQL
                $stmtVerificar->bindParam(':Email', $Email);
                $stmtVerificar->bindParam(':Celular_Contacto', $Celular_Contacto);
                $stmtVerificar->execute();
        
                // Verificar si se encontró un resultado
                $resultado = $stmtVerificar->fetch();
                if ($resultado) {
                    $_SESSION['titulo'] = "Oops!";
                    $_SESSION['msj'] = "El cliente ya está registrado. Verifique los datos e intente nuevamente.";
                    $_SESSION['icono'] = "info";
                    echo "<script> window.history.back(); </script>";
                    return false;
                }
        
                // Si no existe el cliente, realizar el registro
                $sqlInsertar = "INSERT INTO clientes (ID_Empresa, Nombre_Contacto, Email, Celular_Contacto) 
                                VALUES (:ID_Empresa, :Nombre_Contacto, :Email, :Celular_Contacto)";
                $stmtInsertar = $conexion->prepare($sqlInsertar);
        
                // Enlazar los parámetros
                $stmtInsertar->bindParam(':ID_Empresa', $ID_Empresa);
                $stmtInsertar->bindParam(':Nombre_Contacto', $Nombre_Contacto);
                $stmtInsertar->bindParam(':Email', $Email);
                $stmtInsertar->bindParam(':Celular_Contacto', $Celular_Contacto);
        
                // Ejecutar la consulta
                if ($stmtInsertar->execute()) {
                    $_SESSION['titulo'] = "Registro exitoso!";
                    $_SESSION['msj'] = "El cliente ha sido registrado exitosamente.";
                    $_SESSION['icono'] = "success";
                    echo "<script> location.href='../../view/operaciones/registrarCliente.php'; </script>";
                    return true;
                } else {
                    throw new Exception("Error al ejecutar la consulta.");
                }
            } catch (PDOException $e) {
                $_SESSION['titulo'] = "Error en el sistema!";
                $_SESSION['msj'] = "Ocurrió un error al registrar el cliente: " . $e->getMessage();
                $_SESSION['icono'] = "error";
                echo "<script> window.history.back(); </script>";
                return false;
            }
        }
        
        public function mostrarClientes(){
            $f = null;
            // Creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            // Consulta SQL que obtiene los datos de la tabla clientes junto con la información relacionada
            $consultar = "SELECT c.ID_Cliente, c.Nombre_Contacto, c.Email, c.Celular_Contacto, 
                          e.Nombre AS Nombre_Empresa
                          FROM clientes c 
                          INNER JOIN empresas_cliente e ON c.ID_Empresa = e.ID_Empresa";
            $result = $conexion->prepare($consultar);
            $result->execute();
        
            // Creamos un ciclo para convertir la variable result en arreglo
            // Esto se ejecuta las veces que haya registros
            while ($arreglo = $result->fetch()) {
                // La variable arreglo que contiene el arreglo, lo almacenamos en la variable f
                $f[] = $arreglo;
            }
        
            // Retornamos f para poder mostrar los resultados más adelante
            return $f;
        }
        
        public function buscarCliente($id_cliente) {
            $f = null;
        
            // Crear objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            // Consulta SQL con alias claros para evitar colisiones y errores
            $consultar = "SELECT 
                              c.ID_Cliente, 
                              c.Nombre_Contacto, 
                              c.Email, 
                              c.Celular_Contacto, 
                              c.ID_Empresa, 
                              e.Nombre AS empNombre,
                              e.ID_Empresa AS empID
                          FROM clientes c
                          INNER JOIN empresas_cliente e 
                              ON c.ID_Empresa = e.ID_Empresa
                          WHERE c.ID_Cliente = :id_cliente";
        
            // Preparar la consulta
            $result = $conexion->prepare($consultar);
            $result->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $result->execute();
        
            // Convertir el resultado a un arreglo
            while ($arreglo = $result->fetch(PDO::FETCH_ASSOC)) {
                $f[] = $arreglo;
            }
        
            return $f; // Retornar resultados
        }
        
        public function updateCliente($idCliente, $empresa, $nombreContacto, $correo, $celularCon) {
            // Conexión con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            // Verificar si el cliente existe con el ID proporcionado
            $sql = "SELECT * FROM clientes WHERE ID_cliente = :idCliente";
            $result1 = $conexion->prepare($sql);
            $result1->bindParam(':idCliente', $idCliente);
            $result1->execute();
        
            $f = $result1->fetch(PDO::FETCH_ASSOC);
        
            if ($f) {
                // Si el correo no ha cambiado o no está repetido, se procede a la actualización
                if ($f['Email'] == $correo) {
                    // Actualización directa si el correo no ha cambiado
                    $actualizar = "UPDATE clientes 
                                   SET ID_Empresa = :empresa, 
                                       Nombre_Contacto = :nombreContacto, 
                                       Email = :correo, 
                                       Celular_Contacto = :celularCon 
                                   WHERE ID_cliente = :idCliente";
                    $result = $conexion->prepare($actualizar);
        
                    $result->bindParam(':empresa', $empresa);
                    $result->bindParam(':nombreContacto', $nombreContacto);
                    $result->bindParam(':correo', $correo);
                    $result->bindParam(':celularCon', $celularCon);
                    $result->bindParam(':idCliente', $idCliente);
        
                    $result->execute();
        
                    return true;
                } else {
                    // Verificar si el correo ya está siendo utilizado por otro cliente
                    $sqlCorreo = "SELECT COUNT(*) AS total FROM clientes WHERE Email = :correo";
                    $resultCorreo = $conexion->prepare($sqlCorreo);
                    $resultCorreo->bindParam(':correo', $correo);
                    $resultCorreo->execute();
        
                    $correoCount = $resultCorreo->fetch(PDO::FETCH_ASSOC);
        
                    if ($correoCount['total'] == 0) {
                        // Actualización si el correo no está repetido
                        $actualizar = "UPDATE clientes 
                                       SET ID_Empresa = :empresa, 
                                           Nombre_Contacto = :nombreContacto, 
                                           Email = :correo, 
                                           Celular_Contacto = :celularCon 
                                       WHERE ID_cliente = :idCliente";
                        $result = $conexion->prepare($actualizar);
        
                        $result->bindParam(':empresa', $empresa);
                        $result->bindParam(':nombreContacto', $nombreContacto);
                        $result->bindParam(':correo', $correo);
                        $result->bindParam(':celularCon', $celularCon);
                        $result->bindParam(':idCliente', $idCliente);
        
                        $result->execute();
        
                        return true;
                    } else {
                        // Si el correo está repetido
                        return false;
                    }
                }
            } else {
                // Si no se encuentra el cliente
                return false;
            }
        }
    

        // Modulo de Tickets
        public function verificarTicketDuplicado($ticket) {
            // Conectamos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // Consulta para verificar si el ticket ya existe
            $consulta = "SELECT COUNT(*) FROM tickets WHERE Ticket = :ticket";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':ticket', $ticket);
            $stmt->execute();
            
            // Verificamos si el ticket existe
            $count = $stmt->fetchColumn();
            
            // Si el conteo es mayor a 0, significa que el ticket ya existe
            return $count > 0;
        }
    
        public function registrarTicket($ticket, $asuntoCorreo, $descripcion, $cargoIng, $empresaCli, $estadoTicket, $prioridad) {
            // Conectamos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // Primero, verificamos si el ticket ya existe
            $ticketDuplicado = $this->verificarTicketDuplicado($ticket);
            if ($ticketDuplicado) {
                // Si el ticket ya existe, devolvemos un error o un mensaje de fallo
                return false;
            }
            
            // Consultamos el tiempo de la prioridad seleccionada
            $consultaTiempo = "SELECT Tiempo FROM prioridades WHERE ID_Prioridad = :prioridad";
            $stmtTiempo = $conexion->prepare($consultaTiempo);
            $stmtTiempo->bindParam(':prioridad', $prioridad);
            $stmtTiempo->execute();
            $resultadoTiempo = $stmtTiempo->fetch(PDO::FETCH_ASSOC);
            $tiempo = $resultadoTiempo['Tiempo'];
            
            // Consulta para insertar el nuevo ticket
            $consultaInsertar = "INSERT INTO tickets (Ticket, Asunto, Descripcion, ID_User, Cliente, ID_Estado_Ticket, ID_Prioridad, Tiempo) 
                                 VALUES (:ticket, :asuntoCorreo, :descripcion, :cargoIng, :empresaCli, :estadoTicket, :prioridad, :tiempo)";
            
            // Preparamos la consulta para insertar en la tabla tickets
            $stmt = $conexion->prepare($consultaInsertar);
            
            // Bind de los parámetros
            $stmt->bindParam(':ticket', $ticket);
            $stmt->bindParam(':asuntoCorreo', $asuntoCorreo);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':cargoIng', $cargoIng);
            $stmt->bindParam(':empresaCli', $empresaCli);
            $stmt->bindParam(':estadoTicket', $estadoTicket);
            $stmt->bindParam(':prioridad', $prioridad);
            $stmt->bindParam(':tiempo', $tiempo);
            
            // Ejecutamos la consulta para insertar el ticket
            $stmt->execute();
            
            // Recuperar el ID del ticket recién insertado
            $idTicket = $conexion->lastInsertId();
            
            // Ahora, obtenemos la información adicional para el registro en la tabla cronometros
            // Obtener el nombre de la empresa del cliente
            $consultaCliente = "SELECT Nombre FROM empresas_cliente WHERE ID_Empresa = :empresaCli";
            $stmtCliente = $conexion->prepare($consultaCliente);
            $stmtCliente->bindParam(':empresaCli', $empresaCli);
            $stmtCliente->execute();
            $resultadoCliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);
            $nombreCliente = $resultadoCliente['Nombre'];
            
            // Obtener el nombre y apellido del usuario
            $consultaUsuario = "SELECT Nombre, Apellido FROM usuarios WHERE ID_User = :cargoIng";
            $stmtUsuario = $conexion->prepare($consultaUsuario);
            $stmtUsuario->bindParam(':cargoIng', $cargoIng);
            $stmtUsuario->execute();
            $resultadoUsuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);
            $nombreUsuario = $resultadoUsuario['Nombre'] . ' ' . $resultadoUsuario['Apellido'];
            
            // Obtener el estado del ticket
            $consultaEstado = "SELECT Estado FROM estado_tickets WHERE ID_Estado_Ticket = :estadoTicket";
            $stmtEstado = $conexion->prepare($consultaEstado);
            $stmtEstado->bindParam(':estadoTicket', $estadoTicket);
            $stmtEstado->execute();
            $resultadoEstado = $stmtEstado->fetch(PDO::FETCH_ASSOC);
            $estado = $resultadoEstado['Estado'];
            
            // Obtener el ID de la música
            $consultaMusica = "SELECT ID_Musica FROM sonidos LIMIT 1"; // Suponiendo que solo hay un sonido predeterminado
            $stmtMusica = $conexion->prepare($consultaMusica);
            $stmtMusica->execute();
            $resultadoMusica = $stmtMusica->fetch(PDO::FETCH_ASSOC);
            $idMusica = $resultadoMusica['ID_Musica'];
            
            // Insertar el cronómetro
            $consultaCronometro = "INSERT INTO cronometros (ID_Cliente, ID_User, ID_Ticket, Titulo, Descripcion, Estado, Prioridad, ID_Musica, Tiempo_Objetivo, Tiempo_Transcurrido, Ultima_Actualizacion) 
                                   VALUES (:empresaCli, :cargoIng, :idTicket, :asuntoCorreo, :descripcion, :estado, :prioridad, :idMusica, :tiempoObjetivo, 0, current_timestamp())";
            
            $stmtCronometro = $conexion->prepare($consultaCronometro);
            
            // Bind de los parámetros para insertar en cronometros
            $stmtCronometro->bindParam(':empresaCli', $empresaCli);
            $stmtCronometro->bindParam(':cargoIng', $cargoIng);
            $stmtCronometro->bindParam(':idTicket', $idTicket); // Usamos el ID del ticket insertado
            $stmtCronometro->bindParam(':asuntoCorreo', $asuntoCorreo);
            $stmtCronometro->bindParam(':descripcion', $descripcion);
            $stmtCronometro->bindParam(':estado', $estado);
            $stmtCronometro->bindParam(':prioridad', $prioridad); // Insertamos la prioridad
            $stmtCronometro->bindParam(':idMusica', $idMusica);
            $stmtCronometro->bindParam(':tiempoObjetivo', $tiempo);
            
            // Ejecutar la consulta para insertar en la tabla cronometros
            return $stmtCronometro->execute();
        }
        
        public function obtenerTicketsPorUsuario($idUsuario) {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            $consulta = "SELECT 
                            t.ID_Ticket, t.Ticket, t.Asunto, t.Descripcion, t.Tiempo, 
                            CONCAT(u.Nombre, ' ', u.Apellido) AS Usuario, 
                            et.Estado AS Estado_Ticket, 
                            p.Prioridad, 
                            p.Tiempo AS Tiempo_Prioridad, 
                            ec.Nombre AS Empresa_Cliente
                        FROM 
                            tickets t
                        INNER JOIN 
                            usuarios u ON t.ID_User = u.ID_User
                        INNER JOIN 
                            estado_tickets et ON t.ID_Estado_Ticket = et.ID_Estado_Ticket
                        INNER JOIN 
                            prioridades p ON t.ID_Prioridad = p.ID_Prioridad
                        INNER JOIN 
                            empresas_cliente ec ON t.Cliente = ec.ID_Empresa
                        WHERE 
                            t.ID_User = :idUsuario";
        
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function buscarTicket($id_ticket) {
            $f = null;
        
            // Crear objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            // Consulta SQL con alias claros para evitar colisiones y errores
            $consultar = "SELECT 
                              t.ID_Ticket, t.Ticket, t.Asunto, t.Descripcion, t.Tiempo, 
                              u.ID_User, -- Incluye el ID del usuario
                              CONCAT(u.Nombre, ' ', u.Apellido) AS Usuario,
                              et.Estado AS Estado_Ticket,
                              p.Prioridad, 
                              ec.Nombre AS Empresa_Cliente
                          FROM tickets t
                          INNER JOIN usuarios u ON t.ID_User = u.ID_User
                          INNER JOIN estado_tickets et ON t.ID_Estado_Ticket = et.ID_Estado_Ticket
                          INNER JOIN prioridades p ON t.ID_Prioridad = p.ID_Prioridad
                          INNER JOIN empresas_cliente ec ON t.Cliente = ec.ID_Empresa
                          WHERE t.ID_Ticket = :id_ticket";
        
            // Preparar la consulta
            $result = $conexion->prepare($consultar);
            $result->bindParam(':id_ticket', $id_ticket, PDO::PARAM_INT);
            $result->execute();
        
            // Convertir el resultado a un arreglo
            while ($arreglo = $result->fetch(PDO::FETCH_ASSOC)) {
                $f[] = $arreglo;
            }
        
            return $f; // Retornar resultados
        }

        public function updateTicket($ticket, $asunto, $descripcion, $prioridad, $estado, $usuario) {
            try {
                // Crear objeto de la clase conexion para conectarnos a la base de datos
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
        
                // Iniciamos una transacción para asegurar consistencia entre las tablas
                $conexion->beginTransaction();
        
                // Actualizar información del ticket
                $consultaTicket = "UPDATE tickets 
                                   SET 
                                       Asunto = :asunto, 
                                       Descripcion = :descripcion, 
                                       ID_Prioridad = :prioridad, 
                                       ID_Estado_Ticket = :estado, 
                                       ID_User = :usuario
                                   WHERE Ticket = :ticket";
        
                $stmtTicket = $conexion->prepare($consultaTicket);
                $stmtTicket->bindParam(':ticket', $ticket, PDO::PARAM_STR);
                $stmtTicket->bindParam(':asunto', $asunto, PDO::PARAM_STR);
                $stmtTicket->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $stmtTicket->bindParam(':prioridad', $prioridad, PDO::PARAM_INT);
                $stmtTicket->bindParam(':estado', $estado, PDO::PARAM_INT);
                $stmtTicket->bindParam(':usuario', $usuario, PDO::PARAM_INT);
        
                // Ejecutar la consulta de actualización del ticket
                if (!$stmtTicket->execute()) {
                    throw new Exception("Error al actualizar el ticket.");
                }
        
                // Obtener el tiempo de la prioridad seleccionada
                $consultaTiempo = "SELECT Tiempo FROM prioridades WHERE ID_Prioridad = :prioridad";
                $stmtTiempo = $conexion->prepare($consultaTiempo);
                $stmtTiempo->bindParam(':prioridad', $prioridad, PDO::PARAM_INT);
                $stmtTiempo->execute();
                $resultadoTiempo = $stmtTiempo->fetch(PDO::FETCH_ASSOC);
        
                if (!$resultadoTiempo) {
                    throw new Exception("No se encontró información sobre la prioridad seleccionada.");
                }
        
                $tiempoObjetivo = $resultadoTiempo['Tiempo'];
        
                // Actualizar información del cronómetro asociado
                $consultaCronometro = "UPDATE cronometros 
                                       SET 
                                           Titulo = :asunto, 
                                           Descripcion = :descripcion, 
                                           Estado = (SELECT Estado FROM estado_tickets WHERE ID_Estado_Ticket = :estado), 
                                           Prioridad = :prioridad, 
                                           ID_User = :usuario, 
                                           Tiempo_Objetivo = :tiempoObjetivo, 
                                           Ultima_Actualizacion = current_timestamp()
                                       WHERE ID_Ticket = (SELECT ID_Ticket FROM tickets WHERE Ticket = :ticket)";
        
                $stmtCronometro = $conexion->prepare($consultaCronometro);
                $stmtCronometro->bindParam(':ticket', $ticket, PDO::PARAM_STR);
                $stmtCronometro->bindParam(':asunto', $asunto, PDO::PARAM_STR);
                $stmtCronometro->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $stmtCronometro->bindParam(':estado', $estado, PDO::PARAM_INT);
                $stmtCronometro->bindParam(':prioridad', $prioridad, PDO::PARAM_INT);
                $stmtCronometro->bindParam(':usuario', $usuario, PDO::PARAM_INT);
                $stmtCronometro->bindParam(':tiempoObjetivo', $tiempoObjetivo, PDO::PARAM_INT);
        
                // Ejecutar la consulta de actualización del cronómetro
                if (!$stmtCronometro->execute()) {
                    throw new Exception("Error al actualizar el cronómetro.");
                }
        
                // Si todo fue bien, confirmamos la transacción
                $conexion->commit();
                return true;
        
            } catch (Exception $e) {
                // Si ocurre un error, revertimos los cambios
                $conexion->rollBack();
                echo "Error al actualizar el ticket y cronómetro: " . $e->getMessage();
                return false;
            }
        }
        

        //Modulo cronometros
        // Función para obtener cronómetros por usuario
        public function obtenerCronometrosPorUsuario($idUsuario) {

            try{
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            // Consulta SQL para obtener los cronómetros del usuario
            $consulta = "
                SELECT c.ID_Cronometro, c.ID_Ticket, c.Titulo, c.Descripcion, c.Estado, c.Tiempo_Objetivo, c.Tiempo_Transcurrido, c.Ultima_Actualizacion, 
                    t.Ticket, t.Asunto, ts.Estado AS Estado_Ticket, t.ID_Prioridad, t.created_at , p.Prioridad AS Prioridad_Nombre, t.Cliente, e.Nombre AS Empresa_Cliente, 
                    u.Nombre AS Usuario_Nombre, u.Apellido AS Usuario_Apellido
                FROM cronometros c
                INNER JOIN tickets t ON c.ID_Ticket = t.ID_Ticket
                INNER JOIN usuarios u ON c.ID_User = u.ID_User
                INNER JOIN empresas_cliente e ON t.Cliente = e.ID_Empresa  -- Asumiendo que t.Cliente es ID_Empresa
                INNER JOIN estado_tickets ts ON t.ID_Estado_Ticket = ts.ID_Estado_Ticket  -- Relación con estado_tickets
                INNER JOIN prioridades p ON t.ID_Prioridad = p.ID_Prioridad  -- Relación con la tabla prioridades
                WHERE c.ID_User = :idUsuario AND t.ID_Estado_Ticket = 1 or t.ID_Estado_Ticket = 2;
                ORDER BY c.Ultima_Actualizacion DESC";

            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los cronómetros del usuario

             // Ajustar el formato de tiempo en el resultado
            foreach ($resultados as &$cronometro) {
                $cronometro['Tiempo_Transcurrido_Format'] = gmdate("H:i:s", $cronometro['Tiempo_Transcurrido']);
                $cronometro['Tiempo_Objetivo_Format'] = gmdate("H:i:s", $cronometro['Tiempo_Objetivo']);
            }

                    return $resultados;
                } catch (PDOException $e) {
                    error_log("Error al obtener cronómetros: " . $e->getMessage());
                    return [];
                }
            
        }

        public function tiempoDesdeCreacion($idTicket) {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $consulta = "SELECT TIMESTAMPDIFF(SECOND, created_at, NOW()) AS tiempo_transcurrido
                         FROM tickets WHERE id_ticket = :idTicket";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':idTicket', $idTicket);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['tiempo_transcurrido']; // Devuelve el tiempo en segundos
        }

        public function actualizarTiempoCronometro($idCronometro, $tiempoTranscurrido) {
            try {
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $sql = "UPDATE cronometros SET Tiempo_Transcurrido = :tiempoTranscurrido WHERE ID_Cronometro = :idCronometro";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':tiempoTranscurrido', $tiempoTranscurrido, PDO::PARAM_INT);
                $stmt->bindParam(':idCronometro', $idCronometro, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Error en la base de datos: " . $e->getMessage());
                return false;
            }
        }
        
        public function pausarCronometro($idCronometro, $tiempoTranscurrido) {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            try {
                $query = "UPDATE cronometros SET Tiempo_Transcurrido = :tiempoTranscurrido WHERE ID_Cronometro = :idCronometro";
                $stmt = $conexion->prepare($query);
                $stmt->bindParam(':tiempoTranscurrido', $tiempoTranscurrido, PDO::PARAM_INT);
                $stmt->bindParam(':idCronometro', $idCronometro, PDO::PARAM_INT);

                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Error al pausar el cronómetro: " . $e->getMessage());
                return false;
            }
        }

        public function reiniciarCronometro($idCronometro)   {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            try {
                $query = "UPDATE cronometros SET Tiempo_Transcurrido = 0 WHERE ID_Cronometro = :idCronometro";
                $stmt = $conexion->prepare($query);
                $stmt->bindParam(':idCronometro', $idCronometro, PDO::PARAM_INT);

                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Error al reiniciar el cronómetro: " . $e->getMessage());
                return false;
            }
        }


        // SONIDO
        public function obtenerEstadoSonidoUsuario($idUsuario) {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT sonido_activo FROM usuarios WHERE ID_User = :idUsuario";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? (bool)$resultado["sonido_activo"] : true; // Devuelve true si no hay valor configurado
        }
                
        public function obtenerRutaSonido() {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT s.Ruta_Archivo AS ruta, u.sonido_activo AS sonido_activo FROM sonidos s INNER JOIN usuarios u ON u.ID_User = s.ID_Musica WHERE u.ID_User = 1 AND u.sonido_activo = 1";
            $stmt = $conexion->query($sql);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado["ruta"] : null; // Devuelve null si no hay sonido activo
        }

        
        //modulo de perfil
        public function perfil() {
            $f = null;
            $modelo = new conexion;
            $conexion = $modelo->get_conexion();
        
            $sql = "SELECT 
                        u.ID_User,
                        u.Nombre,
                        u.Apellido,
                        u.Celular_Corp,
                        u.Email_Usuario,
                        u.ID_Cargo,
                        u.ID_Rol,
                        u.ID_Estado_Usuario,
                        c.Cargo,
                        r.Rol,
                        s.Estado_User
                    FROM 
                        usuarios u
                    INNER JOIN 
                        cargos c ON u.ID_Cargo = c.ID_Cargo
                    INNER JOIN 
                        roles r ON u.ID_Rol = r.ID_Rol
                    INNER JOIN 
                        estados_users s ON u.ID_Estado_Usuario = s.ID_Estado_Usuario
                    WHERE 
                        u.ID_User = :id";
        
            $result = $conexion->prepare($sql);
            $result->bindParam(':id', $_SESSION['id']);
            $result->execute();
        
            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        
        public function updatePerfilA($id_user, $nombres, $apellidos, $celular, $email) {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            try {
                // Comprobamos si el correo ya está registrado por otro usuario
                $sqlCorreo = "SELECT COUNT(*) FROM usuarios WHERE Email_Usuario = :email AND ID_User != :id_user";
                $stmtCorreo = $conexion->prepare($sqlCorreo);
                $stmtCorreo->bindParam(':email', $email);
                $stmtCorreo->bindParam(':id_user', $id_user);
                $stmtCorreo->execute();
        
                if ($stmtCorreo->fetchColumn() > 0) {
                    return false; // El correo ya está registrado
                }
        
                // Actualizamos los datos del usuario
                $sqlUpdate = "UPDATE usuarios SET 
                                Nombre = :nombres, 
                                Apellido = :apellidos, 
                                Celular_Corp = :celular, 
                                Email_Usuario = :email 
                              WHERE ID_User = :id_user";
        
                $stmtUpdate = $conexion->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':id_user', $id_user);
                $stmtUpdate->bindParam(':nombres', $nombres);
                $stmtUpdate->bindParam(':apellidos', $apellidos);
                $stmtUpdate->bindParam(':celular', $celular);
                $stmtUpdate->bindParam(':email', $email);
        
                return $stmtUpdate->execute();
            } catch (PDOException $e) {
                return false; // Manejo de errores
            }
        }
        
        public function updateClaveA($id_user, $claveAntigua, $claveNueva) {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            try {
                // Verificar la contraseña actual
                $sql = "SELECT Contraseña FROM usuarios WHERE ID_User = :id_user";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':id_user', $id_user);
                $stmt->execute();
                $usuario = $stmt->fetch();
        
                // Comparar la contraseña actual con la ingresada
                if (!$usuario || md5($claveAntigua) !== $usuario['Contraseña']) {
                    return false; // Contraseña actual incorrecta
                }
        
                // Actualizar la contraseña
                $claveHash = md5($claveNueva); // Encriptar la nueva contraseña con MD5
                $sqlUpdate = "UPDATE usuarios SET Contraseña = :claveNueva WHERE ID_User = :id_user";
                $stmtUpdate = $conexion->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':id_user', $id_user);
                $stmtUpdate->bindParam(':claveNueva', $claveHash);
        
                return $stmtUpdate->execute();
            } catch (PDOException $e) {
                return false; // Error durante la ejecución
            }
        }
        
    }
?>