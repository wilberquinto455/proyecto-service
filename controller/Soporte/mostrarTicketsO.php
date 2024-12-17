<?php

    function cargarMisTickets(){

        // Asignar el valor del usuario que inició sesión
        $idUsuario = $_SESSION['id'];
        $objetoConsultas = new consultasOperador();
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
        $objetoConsultas = new consultasOperador();
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

        echo '<script>
            function actualizarContador() {
                var descripcion = document.getElementById("descripcionInput");
                var contador = document.getElementById("contador");
                var longitudMax = descripcion.getAttribute("maxlength");
                var longitudAct = descripcion.value.length;
                contador.innerHTML = `${longitudAct}/${longitudMax}`;
            }
            document.addEventListener("DOMContentLoaded", function () {
                actualizarContador();
            });
        </script>';

    function cargarMisCronometros() {
        // Asignar el valor del usuario que inició sesión
        $idUsuario = $_SESSION['id'];
        $objetoConsultas = new consultasOperador();
        $arreglo = $objetoConsultas->obtenerCronometrosPorUsuario($idUsuario);
    
        // Definir el arreglo de tiempos iniciales según la prioridad
        $tiemposIniciales = [
            "alta" => 900,    // 15 minutos
            "media" => 1800,  // 30 minutos
            "baja" => 2700,   // 45 minutos
            "media" => 1800,  // 30 minutos (duplicado, pero ya lo tenemos en el arreglo)
            "baja" => 5400    // 1 hora y 30 minutos
        ];
    
        // Arreglo para los iconos de prioridad
        $iconos = [
            "alta" => "exclamation-circle",   // Alta
            "media" => "exclamation-triangle",// Media
            "baja" => "info-circle"           // Baja
        ];
    
        if (empty($arreglo)) {
            echo '<h2>No hay cronómetros registrados para tus tickets.</h2>';
        } else {
            echo '<div class="timer-container">';
    
            foreach ($arreglo as $f) {
                // Obtener el nombre de la prioridad
                $prioridadNombre = $f["Prioridad_Nombre"]; // Prioridad obtenida de la consulta
    
                // Obtener el tiempo inicial de acuerdo a la prioridad
                $tiempoInicial = isset($tiemposIniciales[strtolower($prioridadNombre)]) 
                                 ? $tiemposIniciales[strtolower($prioridadNombre)] 
                                 : 0;  // Valor por defecto 0 si no se encuentra la prioridad
    
                // Obtener el icono de acuerdo a la prioridad
                $prioridadIcon = isset($iconos[strtolower($prioridadNombre)]) ? $iconos[strtolower($prioridadNombre)] : 'question-circle';
    
                // Calcular el tiempo restante y el progreso
                $tiempoTotal = $f["Tiempo_Objetivo"]; // en segundos
                $tiempoRestante = max($tiempoTotal - $f["Tiempo_Transcurrido"], 0); // calcular el tiempo restante real
                $progreso = ($f["Tiempo_Transcurrido"] / $tiempoTotal) * 100;
    
                // Mostrar la tarjeta del cronómetro
                echo '
                <div class="timer-card" data-cronometro-id="' . $f["ID_Cronometro"] . '" data-tiempo-inicial="' . $tiempoInicial . '">
                    <div class="progress timer-progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: ' . $progreso . '%"></div>
                    </div>
                    <div class="timer-header">
                        <div class="ticket-info">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bold mr-2">Ticket #' . $f["Ticket"] . '</span>
                                <span class="priority-badge">
                                    <i class="fas fa-' . $prioridadIcon . '"></i>
                                    ' . $prioridadNombre . '
                                </span>
                            </div>
                            <div class="meta-info">
                                <span class="meta-tag">
                                    <i class="fas fa-clock"></i>
                                    SLA: ' . ($f["Tiempo_Objetivo"] / 60) . ' min
                                </span>
                                <span class="meta-tag">
                                    <i class="fas fa-building"></i>
                                    ' . $f["Empresa_Cliente"] . '
                                </span>
                            </div>
                        </div>
                        <span class="badge badge-soft-primary badge-status">' . $f["Estado_Ticket"] . '</span>
                    </div>
                    <div class="timer-body">
                        <div class="timer-section">
                            <div class="ticket-info">
                                <small class="text-muted">' . $f["Asunto"] . '</small>
                            </div>
                            <div class="time-info">
                                <div class="timer-display" id="timer_' . $f["ID_Cronometro"] . '">
                                    ' . gmdate("H:i:s", $tiempoRestante) . '
                                </div>
                                <span class="time-remaining text-success">
                                    <i class="fas fa-clock"></i>
                                    Tiempo restante
                                </span>
                            </div>
                            <div class="timer-controls">
                                <button class="btn btn-sm btn-outline-success" onclick="iniciarCronometro(' . $f["ID_Cronometro"] . ')">
                                    <i class="fas fa-play"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="pausarCronometro(' . $f["ID_Cronometro"] . ')">
                                    <i class="fas fa-pause"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="reiniciarCronometro(' . $f["ID_Cronometro"] . ')">
                                    <i class="fas fa-redo"></i>
                                </button>
                                <a href="verInfoTicket.php?Id_ticket=' . $f["ID_Ticket"] . '" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger" onclick="confirmarBorrar(' . $f["ID_Cronometro"] . ')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
    
            echo '</div>';
        }
    
        // Script para la confirmación de eliminación
        echo '
        <script type="text/javascript">
        function confirmarBorrar(id) {
            Swal.fire({
                title: "¿Seguro que quieres eliminar este cronómetro?",
                text: "¡No podrás revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href="eliminarTicketA.php?id_ticket=" + id;
                }
            });
        }
    
        // Objeto para almacenar los intervalos de los cronómetros
        const cronometros = {};
    
        function iniciarCronometro(id) {
            if (!cronometros[id]) {
                cronometros[id] = setInterval(() => {
                    const timerDisplay = document.querySelector(`#timer_${id}`);
                    let [horas, minutos, segundos] = timerDisplay.textContent.split(":").map(Number);
                    
                    if (segundos > 0) {
                        segundos--;
                    } else if (minutos > 0) {
                        minutos--;
                        segundos = 59;
                    } else if (horas > 0) {
                        horas--;
                        minutos = 59;
                        segundos = 59;
                    }
                    
                    timerDisplay.textContent = 
                        `${String(horas).padStart(2, "0")}:${String(minutos).padStart(2, "0")}:${String(segundos).padStart(2, "0")}`;
                    
                    if (horas === 0 && minutos === 0 && segundos === 0) {
                        clearInterval(cronometros[id]);
                        delete cronometros[id];
                    }
    
                }, 1000);
            }
        }
    
        function pausarCronometro(id) {
            if (cronometros[id]) {
                clearInterval(cronometros[id]);
                delete cronometros[id];
            }
        }
    
        function reiniciarCronometro(id) {
            pausarCronometro(id); // Llama a la función de pausa
            const timerElement = document.querySelector(`#timer_${id}`); // Obtén el elemento del cronómetro
            // Obtener el tiempo inicial desde el atributo data-tiempo-inicial
            const tiempoInicial = document.querySelector(`[data-cronometro-id="${id}"]`).getAttribute("data-tiempo-inicial");
            timerElement.textContent = new Date(tiempoInicial * 1000).toISOString().substr(11, 8); // Formatear el tiempo en HH:MM:SS
        }
        </script>';
    }
    

?>