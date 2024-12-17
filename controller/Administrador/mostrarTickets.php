<?php
    function cargarTickets(){

        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->obtenerTodosLosTickets();
        
        //isset es para saber si existe algún dato en el arreglo
        if (!isset($arreglo) || empty($arreglo)) {
            echo '<h2>No hay registros de tickets en el sistema</h2>';
        } else {
            echo '
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>ID Ticket</th>
                    <th>Ingeniero a cargo</th>
                    <th>Ticket</th>
                    <th>Estado Ticket</th>
                    <th>Prioridad</th>
                    <th>Tiempo Prioridad (min)</th>
                    <th>Asunto</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
            ';
        
            // Ciclo para repetir los registros del arreglo
            foreach ($arreglo as $f) {
                echo '
                <tr>
                    <td>' . $f["ID_Ticket"] . '</td>
                    <td>' . $f["Usuario"] . '</td>
                    <td>' . $f["Ticket"] . '</td>
                    <td>' . $f["Estado_Ticket"] . '</td>
                    <td>' . $f["Prioridad"] . '</td>
                    <td>' . ($f["Tiempo_Prioridad"] / 60) . ' min</td>
                    <td>' . $f["Asunto"] . '</td>
                    <td>' . $f["Descripcion"] . '</td>
                    <td>' . $f["Empresa_Cliente"] . '</td>
                    <td style="width: 90px; min-width: 90px"> 
                    <a href="verInfoTicket.php?Id_ticket=' . $f["ID_Ticket"] . '" class="btn btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-danger" onclick="confirmarBorrar(' . $f["ID_Ticket"] . ')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </td>
                </tr>
                ';
            }
            echo '
            </tbody>
                <tfoot>
                    <tr>
                    <th>ID Ticket</th>
                    <th>Ingeniero a cargo</th>
                    <th>Ticket</th>
                    <th>Estado Ticket</th>
                    <th>Prioridad</th>
                    <th>Tiempo Prioridad (min)</th>
                    <th>Asunto</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                    </tr>
                </tfoot>
                </table>
            ';
        }
        
        echo '
        <script type="text/javascript">
        function confirmarBorrar(id) {
            Swal.fire({
            title: "¿Seguro que quieres eliminar este ticket?",
            text: "¡No podrás revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                location.href="../../controller/Administrador/eliminarTicketA.php?id_ticket=" + id;
            }
            })
        }
        </script>';
        
    }

    function cargarMisTickets(){

        // Asignar el valor del usuario que inició sesión
        $idUsuario = $_SESSION['id'];
        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->obtenerTicketsPorUsuario($idUsuario);

        //isset es para saber si existe algun dato en result
        if (!isset($arreglo) || empty($arreglo)) {
        echo '<h2>No hay registros de tickets en el sistema</h2>';
        } else {
        echo '
        <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID Ticket</th>
                    <th>Ingeniero a cargo</th>
                    <th>Ticket</th>
                    <th>Estado Ticket</th>
                    <th>Prioridad</th>
                    <th>Tiempo Prioridad (min)</th>
                    <th>Asunto</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
        ';
    
        // Ciclo para repetir los registros del arreglo
        foreach ($arreglo as $f) {
            echo '
            <tr>
                <td>' . $f["ID_Ticket"] . '</td>
                <td>' . $f["Usuario"] . '</td>
                <td>' . $f["Ticket"] . '</td>
                <td>' . $f["Estado_Ticket"] . '</td>
                <td>' . $f["Prioridad"] . '</td>
                <td>' . ($f["Tiempo_Prioridad"] / 60) . ' min</td>
                <td>' . $f["Asunto"] . '</td>
                <td>' . $f["Descripcion"] . '</td>
                <td>' . $f["Empresa_Cliente"] . '</td>
                <td style="width: 90px; min-width: 90px"> 
                    <a href="verInfoTicket.php?Id_ticket=' . $f["ID_Ticket"] . '" class="btn btn-success">
                    <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
            ';
        }
        echo '
        </tbody>
                <tfoot>
                <tr>
                    <th>ID Ticket</th>
                    <th>Ingeniero a cargo</th>
                    <th>Ticket</th>
                    <th>Estado Ticket</th>
                    <th>Prioridad</th>
                    <th>Tiempo Prioridad (min)</th>
                    <th>Asunto</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                </tr>
                </tfoot>
            </table>
        ';
    
    }
    }
    
    function cargarInfoTicket() {
        $objetoConsultas = new consultasA();
        $id_ticket = $_GET['Id_ticket'];
        $result = $objetoConsultas->buscarTicket($id_ticket);

        // Conexión y consulta de los estados, prioridades y usuarios
        $modelo = new conexion;
        $conexion = $modelo->get_conexion();

        // Consultas para obtener los estados
        $consultaEstados = "SELECT * FROM estado_tickets";
        $stmtEstados = $conexion->query($consultaEstados);
        $estados = $stmtEstados->fetchAll(PDO::FETCH_ASSOC);

        // Consultas para obtener las prioridades
        $consultaPrioridades = "SELECT * FROM prioridades";
        $stmtPrioridades = $conexion->query($consultaPrioridades);
        $prioridades = $stmtPrioridades->fetchAll(PDO::FETCH_ASSOC);

        // Consultas para obtener la lista de usuarios
        $consultaUsuarios = "SELECT ID_User, CONCAT(Nombre, ' ', Apellido) AS Usuario FROM usuarios";
        $stmtUsuarios = $conexion->query($consultaUsuarios);
        $usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);

        // Iteramos sobre los resultados del ticket
        foreach ($result as $f) {
            echo '
            <form action="../../controller/Administrador/updateTicketA.php" method="POST">
                <div class="card-body">
                    <div class="row">
                        <!-- ID Ticket (solo lectura) -->
                        <div class="form-group col-md-6">
                            <label for="idTicket">ID Ticket</label>
                            <input type="text" name="idTicket" value="' . $f["Ticket"] . '" class="form-control" id="idTicket" placeholder="Ticket" readonly="readonly" required>
                        </div>

                        <!-- Asunto del Ticket -->
                        <div class="form-group col-md-6">
                            <label for="asuntoInput">Asunto</label>
                            <input type="text" name="asunto" value="' . $f["Asunto"] . '" class="form-control" id="asuntoInput" placeholder="Asunto del Ticket" required>
                        </div>

                        <!-- Descripción del Ticket -->
                        <div class="form-group col-md-12">
                            <label for="descripcionInput">Descripción</label>
                            <textarea 
                                name="descripcion" 
                                class="form-control" 
                                id="descripcionInput" 
                                rows="4" 
                                maxlength="200" 
                                placeholder="Descripción del ticket" 
                                required 
                                oninput="actualizarContador()">' . $f["Descripcion"] . '</textarea>
                            <p id="contador" style="text-align: right;">0/200</p>
                        </div>

                        <!-- Selección de Usuario -->
                        <div class="form-group col-md-6">
                            <label for="usuarioInput">Usuario asignado</label>
                            <select class="form-control" name="usuario" id="usuarioInput" required>
                                <option value="' . $f["ID_User"] . '">' . $f["Usuario"] . '</option>';
                                foreach ($usuarios as $usuario) {
                                    $selected = ($f["ID_User"] == $usuario["ID_User"]) ? 'selected' : '';
                                    echo '<option value="' . $usuario["ID_User"] . '" ' . $selected . '>' . $usuario["Usuario"] . '</option>';
                                }
                            echo '</select>
                        </div>

                        <!-- Selección de Estado -->
                        <div class="form-group col-md-6">
                            <label for="estadoInput">Estado</label>
                            <select class="form-control" name="estado" id="estadoInput" required>
                                <option value="' . $f["Estado_Ticket"] . '">' . $f["Estado_Ticket"] . '</option>';
                                foreach ($estados as $estado) {
                                    $selected = ($f["Estado_Ticket"] == $estado["Estado"]) ? 'selected' : '';
                                    echo '<option value="' . $estado["ID_Estado_Ticket"] . '" ' . $selected . '>' . $estado["Estado"] . '</option>';
                                }
                            echo '</select>
                        </div>

                        <!-- Selección de Prioridad -->
                        <div class="form-group col-md-6">
                            <label for="prioridadInput">Prioridad</label>
                            <select class="form-control" name="prioridad" id="prioridadInput" required>
                                <option value="' . $f["Prioridad"] . '">' . $f["Prioridad"] . '</option>';
                                foreach ($prioridades as $prioridad) {
                                    $selected = ($f["Prioridad"] == $prioridad["Prioridad"]) ? 'selected' : '';
                                    echo '<option value="' . $prioridad["ID_Prioridad"] . '" ' . $selected . '>' . $prioridad["Prioridad"] . ' - ' . $prioridad["Descripcion"] . '</option>';
                                }
                            echo '</select>
                        </div>

                        <!-- Cliente relacionado con el Ticket -->
                        <div class="form-group col-md-6">
                            <label for="clienteInput">Cliente</label>
                            <input type="text" name="cliente" value="' . $f["Empresa_Cliente"] . '" class="form-control" id="clienteInput" placeholder="Cliente relacionado" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger">Actualizar Ticket</button>
                </div>
            </form>';
        }
    }


    function mostrarTickets() {
        if (!isset($_SESSION['id'])) {
            echo '<div class="alert alert-danger">Sesión no iniciada</div>';
            return;
        }
    
        $idUsuario = $_SESSION['id'];
        $objetoConsultas = new consultasA();
        $tickets = $objetoConsultas->obtenerCronometrosPorUsuario($idUsuario);
        $sonidoActivo = $objetoConsultas->obtenerEstadoSonidoUsuario($idUsuario);
        $rutaSonido = $objetoConsultas->obtenerRutaSonido();
    
        if (empty($tickets)) {
            echo '<div class="alert alert-info">No hay tickets asignados actualmente.</div>';
            return;
        }
    
        $prioridades = [
            'alta' => ['tiempo' => 900, 'icono' => 'exclamation-circle', 'color' => 'danger'],
            'media 1' => ['tiempo' => 1800, 'icono' => 'exclamation-triangle', 'color' => 'warning'],
            'media 2' => ['tiempo' => 3600, 'icono' => 'exclamation-triangle', 'color' => 'warning'],
            'baja' => ['tiempo' => 2700, 'icono' => 'info-circle', 'color' => 'success'],
            'baja 2' => ['tiempo' => 5400, 'icono' => 'info-circle', 'color' => 'success']
        ];
    
        echo '<div class="tickets-container">';
        
        foreach ($tickets as $ticket) {
            $prioridad = strtolower($ticket['Prioridad_Nombre']);
            $tiempoObjetivo = $ticket['Tiempo_Objetivo'] ?? $prioridades[$prioridad]['tiempo'];
            $tiempoTranscurrido = $ticket['Tiempo_Transcurrido'] ?? 0;
            $progreso = min(100, ($tiempoTranscurrido / $tiempoObjetivo) * 100);
            
            echo '<div class="timer-card" 
                       data-cronometro-id="' . $ticket['ID_Cronometro'] . '"
                       data-tiempo-transcurrido="' . $tiempoTranscurrido . '"
                       data-tiempo-objetivo="' . $tiempoObjetivo . '"
                       data-ruta-sonido="' . htmlspecialchars($rutaSonido) . '">';
            
            echo '<div class="progress">
                    <div id="progress_' . $ticket['ID_Cronometro'] . '"
                         class="progress-bar ' . ($progreso >= 100 ? 'bg-danger' : 'bg-success') . '"
                         style="width: ' . $progreso . '%">
                    </div>
                  </div>';
    
            echo '<div class="ticket-header">
                    <div class="ticket-title">
                        <h5>Ticket #' . $ticket['ID_Ticket'] . '</h5>
                        <span class="priority-badge ' . $prioridades[$prioridad]['color'] . '">
                            <i class="fas fa-' . $prioridades[$prioridad]['icono'] . '"></i>
                            ' . ucfirst($prioridad) . '
                        </span>
                    </div>
                    <div class="ticket-meta">
                        <span><i class="fas fa-building"></i> ' . htmlspecialchars($ticket['Empresa_Cliente']) . '</span>
                        <span><i class="fas fa-clock"></i> SLA: ' . ($tiempoObjetivo / 60) . ' min</span>
                    </div>
                  </div>';
    
            echo '<div class="ticket-body">
                    <p class="ticket-description">' . htmlspecialchars($ticket['Asunto']) . '</p>
                    <div class="timer-display">
                        <div class="estado-badge estado-activo" id="estado_' . $ticket['ID_Cronometro'] . '">
                            Activo
                        </div>
                        <div class="tiempo-transcurrido" id="timer_' . $ticket['ID_Cronometro'] . '">' 
                            . gmdate("H:i:s", $tiempoTranscurrido) . 
                        '</div>
                        <div class="tiempo-restante" id="restante_' . $ticket['ID_Cronometro'] . '">
                            Tiempo restante: ' . gmdate("H:i:s", max(0, $tiempoObjetivo - $tiempoTranscurrido)) . '
                        </div>
                    </div>
                    <div class="timer-controls">
                        <button id="iniciar-' . $ticket['ID_Cronometro'] . '"
                                class="btn btn-success btn-sm">
                            <i class="fas fa-play"></i>
                        </button>
                        <button id="pausar-' . $ticket['ID_Cronometro'] . '"
                                class="btn btn-warning btn-sm" style="display:none;">
                            <i class="fas fa-pause"></i>
                        </button>
                        <button id="reiniciar-' . $ticket['ID_Cronometro'] . '"
                                class="btn btn-danger btn-sm">
                            <i class="fas fa-redo"></i>
                        </button>
                        <a href="verInfoTicket.php?Id_ticket=' . $ticket['ID_Ticket'] . '"
                           class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button id="sonido-' . $ticket['ID_Cronometro'] . '"
                                class="btn btn-info btn-sm toggle-sound">
                            <i class="fas fa-' . ($sonidoActivo ? 'volume-up' : 'volume-mute') . '"></i>
                        </button>
                    </div>
                  </div>';
            
            echo '</div>'; // Cierre de timer-card
        }
        
        echo '</div>'; // Cierre de tickets-container
    }

?>