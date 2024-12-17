<?php include ("../../Controller/Administrador/Funciones/requiresOnce.php")?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis tickets | Timeout</title>

  <!-- favicon -->
  <link href="../client-side/images/FAVICON_TIMEOUT.png" rel="shortcut icon">
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <!-- estilos para las alertas de sweetalert2 -->
  <link rel="stylesheet" href="../dashboard/dist/css/sweetalert2.min.css">
  <style>

.tickets-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
            padding: 1rem;
        }
        
        .timer-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .progress {
            height: 4px;
            margin-bottom: 0;
        }
        
        .ticket-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .ticket-body {
            padding: 1rem;
        }
        
        .timer-display {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }
        
        .timer-controls {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
        
        .priority-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }
        


        .text-danger {
        color: red;
        font-weight: bold;
        }

        /* Estilos para los Toast de SweetAlert2 */
        .swal2-toast {
            padding: 0.75rem 1.25rem;
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            font-size: 0.875rem;
            max-width: 350px;
        }

        .swal2-toast .swal2-title {
            margin: 0;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .swal2-toast .swal2-timer-progress-bar {
            background: rgba(0, 0, 0, 0.2);
        }

        /* Personalización de colores para diferentes estados */
        .swal2-toast.bg-warning {
            background: #fff3cd !important;
            color: #856404 !important;
        }

        .swal2-toast.bg-danger {
            background: #f8d7da !important;
            color: #721c24 !important;
        }

        .swal2-toast.bg-success {
            background: #d4edda !important;
            color: #155724 !important;
        }

        .modal-flotante {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            min-width: 200px;
        }

        .modal-header {
            padding: 10px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            cursor: move;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-content {
            padding: 10px;
        }

        .minimizar {
            background: none;
            border: none;
            cursor: pointer;
        }

        .modal-flotante.minimizado .modal-content {
            display: none;
        }

        .cronometro-flotante {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .tiempo-transcurrido {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .tiempo-restante {
            font-size: 1rem;
            color: #666;
        }

        .tiempo-excedido {
            color: #dc3545;
            animation: parpadeo 1s infinite;
        }

        .estado-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .estado-activo {
            background-color: #28a745;
            color: white;
        }

        .estado-pausado {
            background-color: #ffc107;
            color: #000;
        }

        .estado-excedido {
            background-color: #dc3545;
            color: white;
        }

        @keyframes parpadeo {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

    </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="homeAdmin.php" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
      
      </li>
      <li class="nav-item">
        <a href="../../controller/administrador/seguridadAdmin.php?cierre=si" class="cierre">Cerrar sesión</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1a191e">
    <!-- Brand Logo -->
    <a href="homeAdmin.php" class="brand-link">
      <img src="../client-side/images/FAVICON_TIMEOUT.png" alt="Logo de Timeout" class="brand-image">
      <span class="brand-text font-weight-light">Timeout</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- funcion para mostrar el nombre del usuario -->
        
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline" style="background-color: #3a3a3a">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search" style="background-color: #3a3a3a">
          <div class="input-group-append">
            <button class="btn btn-sidebar" style="background-color: #3a3a3a">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php include ("../Modulos/Menu.php") ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mis tickets</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">Tickets asignados a mi bandeja</h5>
              </div>
              <div class="card-body">

                  <?php
                    cargarMisTickets();
                  ?>
              </div>
              
              
            </div>
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">Cronometro</h5>
              </div>
              <div class="card-body">

              <?php
                    mostrarTickets();
              ?>
                   
              </div>
              
              
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dashboard/dist/js/adminlte.min.js"></script>
<!-- conexion con el js de sweetalert2 -->
<script src="../dashboard/dist/js/sweetalert2.all.min.js"></script>
<!-- Alerta -->

<?php 
  if (isset($_SESSION['titulo'])) {
    $titulo = $_SESSION['titulo'];
    $msj = $_SESSION['msj'];
    $icono = $_SESSION['icono'];
    ?>
    <script>
      Swal.fire({
        title: '<?php echo $titulo?>',
        text: '<?php echo $msj?>',
        icon: '<?php echo $icono?>',
        confirmButtonColor: '#e4112f'
      })
    </script>
    <?php
    unset($_SESSION['titulo']);
    unset($_SESSION['msj']);
    unset($_SESSION['icono']);
  }
?>
<?php 
// alerta de notificaciones leidas
  if (isset($_SESSION['otra'])) {
    $otraAlerta = $_SESSION['otra'];
    echo $otraAlerta;
    unset($_SESSION['otra']);
  }
  // si no exite la autenticacion o el rol, mostrara una alerta de seguridad
  if (isset($_SESSION['seguridad'])) {
    $alerta = $_SESSION['seguridad'];
    echo $alerta;
    unset($_SESSION['seguridad']);
}
?>

<script>
class Cronometro {
    constructor(id, tiempoTranscurrido, tiempoObjetivo, rutaSonido, autoIniciar = false) {
        this.id = id;
        this.tiempoTranscurrido = parseInt(tiempoTranscurrido) || 0;
        this.tiempoObjetivo = parseInt(tiempoObjetivo);
        this.rutaSonido = rutaSonido;
        this.sonidoActivado = autoIniciar;
        this.intervalo = null;
        this.alertasGeneradas = new Set();
        this.porcentajesAlerta = [50, 75, 90, 100];

        // Elementos del DOM
        this.elementoTiempo = document.getElementById(`timer_${this.id}`);
        this.elementoProgreso = document.getElementById(`progress_${this.id}`);
        this.btnIniciar = document.getElementById(`iniciar-${this.id}`);
        this.btnPausar = document.getElementById(`pausar-${this.id}`);
        this.btnReiniciar = document.getElementById(`reiniciar-${this.id}`);
        this.btnSonido = document.getElementById(`sonido-${this.id}`);

        // Modificar la inicialización del audio
        this.audio = null;
        this.audioContext = null;
        this.sonidoActivado = autoIniciar;
        this.rutaSonido = rutaSonido;
        
        // Inicializar audio solo después de la interacción del usuario
        this.initAudioContext();

        this.configurarEventListeners();
        this.recuperarEstado();

        // Agregar intervalo de sincronización
        this.sincronizacionIntervalo = null;
        this.ultimaSincronizacion = Date.now();
        
        // Iniciar sincronización
        this.iniciarSincronizacion();

        this.ultimaActualizacion = Date.now();
        this.intervaloActualizacion = null;
        
        // Iniciar actualización periódica
        this.iniciarActualizacionPeriodica();
        
        // Manejar actualización en recarga
        this.manejarRecarga();

        // Agregar intervalo para actualización del tiempo restante
        this.intervaloTiempoRestante = null;
        this.iniciarActualizacionTiempoRestante();

        // Agregar propiedades de audio
        this.audioPermiso = false;
        this.audioHabilitado = localStorage.getItem('audioHabilitado') === 'true';
        this.rutaSonido = rutaSonido;
        this.audio = new Audio(this.rutaSonido);
        
        // Inicializar audio
        this.inicializarAudio();
    }

    initAudioContext() {
        // Crear el contexto de audio solo después de una interacción del usuario
        const initAudioOnUserInteraction = () => {
            if (!this.audioContext) {
                this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
                this.audio = new Audio(this.rutaSonido);
                
                // Asegurarse de que el contexto esté en estado running
                if (this.audioContext.state === 'suspended') {
                    this.audioContext.resume();
                }
            }
        };

        // Agregar listeners para eventos de interacción del usuario
        ['click', 'touchstart', 'keydown'].forEach(eventType => {
            document.addEventListener(eventType, () => {
                initAudioOnUserInteraction();
            }, { once: true });
        });
    }

    configurarEventListeners() {
        if (this.btnIniciar) {
            this.btnIniciar.addEventListener('click', () => this.iniciar());
        }
        if (this.btnPausar) {
            this.btnPausar.addEventListener('click', () => this.pausar());
        }
        if (this.btnReiniciar) {
            this.btnReiniciar.addEventListener('click', () => this.reiniciar());
        }
        if (this.btnSonido) {
            this.btnSonido.addEventListener('click', () => this.toggleSonido());
        }
    }

    toggleSonido() {
        this.sonidoActivado = !this.sonidoActivado;
        if (this.btnSonido) {
            const icono = this.btnSonido.querySelector('i');
            if (icono) {
                icono.className = this.sonidoActivado ? 'fas fa-volume-up' : 'fas fa-volume-mute';
            }
        }

        // Inicializar el audio si aún no se ha hecho
        if (this.sonidoActivado && !this.audio) {
            this.initAudioContext();
        }

        this.mostrarToast(
            this.sonidoActivado ? 'Sonido activado' : 'Sonido desactivado',
            this.sonidoActivado ? 'success' : 'info'
        );
    }

    verificarAlertas() {
        const porcentajeCompletado = (this.tiempoTranscurrido / this.tiempoObjetivo) * 100;
        const tiempoRestante = this.tiempoObjetivo - this.tiempoTranscurrido;
        
        // Verificar alertas por porcentaje
        this.porcentajesAlerta.forEach(porcentaje => {
            if (porcentajeCompletado >= porcentaje && !this.alertasGeneradas.has(porcentaje)) {
                this.alertasGeneradas.add(porcentaje);
                this.mostrarAlertaPorcentaje(porcentaje);
            }
        });

        // Verificar alertas por tiempo restante
        if (tiempoRestante <= 0 && !this.alertasGeneradas.has('tiempoExcedido')) {
            this.alertasGeneradas.add('tiempoExcedido');
            this.mostrarToast('¡Tiempo excedido!', 'error');
            this.reproducirAlerta();
        } else if (tiempoRestante <= 300 && !this.alertasGeneradas.has('5minutos')) {
            this.alertasGeneradas.add('5minutos');
            this.mostrarToast('¡Quedan 5 minutos!', 'warning');
            this.reproducirAlerta();
        }
    }

    mostrarAlertaPorcentaje(porcentaje) {
        const tiempoRestante = this.tiempoObjetivo - this.tiempoTranscurrido;
        const minutosRestantes = Math.floor(tiempoRestante / 60);
        const segundosRestantes = tiempoRestante % 60;

        // Configuración básica de colores
        let bgColor;
        if (porcentaje === 100) {
            bgColor = '#dc3545'; // rojo
        } else if (porcentaje >= 90) {
            bgColor = '#ffc107'; // amarillo
        } else if (porcentaje >= 75) {
            bgColor = '#17a2b8'; // azul
        } else {
            bgColor = '#007bff'; // primary
        }

        // Alerta básica de SweetAlert2
        Swal.fire({
            title: `Alerta de Tiempo - ${porcentaje}%`,
            html: `
                <h4>Ticket #${this.id}</h4>
                <p>Has alcanzado el ${porcentaje}% del tiempo objetivo</p>
                <p>Tiempo restante: ${Math.abs(minutosRestantes)}:${String(Math.abs(segundosRestantes)).padStart(2, '0')} ${tiempoRestante < 0 ? 'excedido' : 'minutos'}</p>
            `,
            icon: porcentaje >= 90 ? 'warning' : 'info',
            confirmButtonText: 'Entendido',
            confirmButtonColor: bgColor,
            timer: 5000,
            timerProgressBar: true,
            showCloseButton: true,
            showConfirmButton: true,
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true
        });
    }

    mostrarToast(mensaje, tipo = 'success') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
        
        Toast.fire({
            icon: tipo,
            title: mensaje
        });
    }

    async recuperarEstado() {
        try {
            const response = await fetch(`../../controller/Administrador/cronometro.php?id=${this.id}`);
            const data = await response.json();
            
            if (data.success) {
                // Convertir el tiempo guardado a número y asegurar que sea válido
                let tiempoBase = parseInt(data.tiempoTranscurrido) || 0;
                
                // Si el cronómetro estaba activo, calcular el tiempo adicional
                if (data.estado === 'activo' && data.ultimaActualizacion) {
                    const ultimaActualizacion = new Date(data.ultimaActualizacion + ' UTC').getTime();
                    const ahora = Date.now();
                    const diferencia = Math.floor((ahora - ultimaActualizacion) / 1000);
                    
                    // Solo agregar el tiempo adicional si es razonable (menos de 1 hora)
                    if (diferencia > 0 && diferencia < 3600) {
                        tiempoBase += diferencia;
                    }
                    
                    console.log('Recuperando estado:', {
                        tiempoGuardado: data.tiempoTranscurrido,
                        ultimaActualizacion: data.ultimaActualizacion,
                        tiempoAdicional: diferencia,
                        tiempoFinal: tiempoBase
                    });
                }

                // Asignar el tiempo calculado
                this.tiempoTranscurrido = tiempoBase;
                this.actualizarDisplay();

                // Si estaba activo, reiniciar el cronómetro
                if (data.estado === 'activo') {
                    this.iniciar(true);
                }
            }
        } catch (error) {
            console.error('Error al recuperar estado:', error);
            this.mostrarToast('Error al recuperar estado', 'error');
        }
    }

    async guardarEstado(accion, silencioso = false) {
        try {
            const response = await fetch("../../controller/Administrador/cronometro.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    accion: `${accion}Cronometro`,
                    idCronometro: this.id,
                    tiempoTranscurrido: this.tiempoTranscurrido,
                    timestamp: new Date().toISOString()
                })
            });

            const data = await response.json();
            if (!silencioso && !data.success) {
                this.mostrarToast('Error al guardar estado', 'error');
            }
        } catch (error) {
            console.error('Error al guardar estado:', error);
            if (!silencioso) {
                this.mostrarToast('Error de conexión', 'error');
            }
        }
    }

    async iniciarSincronizacion() {
        // Sincronizar cada 10 segundos
        this.sincronizacionIntervalo = setInterval(() => {
            this.sincronizarTiempo();
        }, 10000);

        // Sincronización inicial
        await this.sincronizarTiempo();
    }

    async sincronizarTiempo() {
        try {
            const response = await fetch(`../../controller/Administrador/cronometro.php?id=${this.id}`);
            const data = await response.json();
            
            if (data.success) {
                const tiempoServidor = parseInt(data.tiempoTranscurrido);
                const estadoServidor = data.estado;
                
                // Actualizar tiempo solo si hay una diferencia significativa
                if (Math.abs(this.tiempoTranscurrido - tiempoServidor) > 2) {
                    this.tiempoTranscurrido = tiempoServidor;
                    this.actualizarDisplay();
                }

                // Sincronizar estado
                if (estadoServidor === 'activo' && !this.intervalo) {
                    this.iniciar(true);
                } else if (estadoServidor === 'pausado' && this.intervalo) {
                    this.pausar(true);
                }
            }
        } catch (error) {
            console.error('Error en sincronización:', error);
        }
    }

    iniciar(recuperado = false) {
        if (!this.intervalo) {
            if (!recuperado) {
                this.guardarEstado('iniciar');
            }

            this.intervalo = setInterval(() => {
                this.tiempoTranscurrido++;
                this.actualizarDisplay();
                this.verificarAlertas();
                
                // Guardar estado cada 5 segundos
                if (this.tiempoTranscurrido % 5 === 0) {
                    this.guardarEstado('actualizar', true);
                }
            }, 1000);

            this.btnIniciar.style.display = 'none';
            this.btnPausar.style.display = 'inline-block';
        }
    }

    pausar(silencioso = false) {
        if (this.intervalo) {
            clearInterval(this.intervalo);
            this.intervalo = null;
            this.btnIniciar.style.display = 'inline-block';
            this.btnPausar.style.display = 'none';
            
            if (!silencioso) {
                this.guardarEstado('pausar');
                this.mostrarToast('Cronómetro pausado', 'warning');
            }
        }
    }

    reiniciar() {
        this.pausar();
        this.tiempoTranscurrido = 0;
        this.actualizarDisplay();
        this.alertasGeneradas.clear();
        this.guardarEstado('reiniciar');
        this.mostrarToast('Cronómetro reiniciado', 'info');
    }

    actualizarDisplay() {
        if (this.elementoTiempo) {
            const tiempoFormateado = this.formatearTiempo(this.tiempoTranscurrido);
            this.elementoTiempo.textContent = tiempoFormateado;

            // Actualizar tiempo restante
            const elementoRestante = document.getElementById(`restante_${this.id}`);
            const tiempoRestante = this.tiempoObjetivo - this.tiempoTranscurrido;
            
            if (elementoRestante) {
                if (tiempoRestante <= 0) {
                    // Tiempo excedido
                    const tiempoExcedido = Math.abs(tiempoRestante);
                    elementoRestante.textContent = `Tiempo excedido: ${this.formatearTiempo(tiempoExcedido)}`;
                    elementoRestante.classList.add('tiempo-excedido');
                    this.elementoTiempo.classList.add('tiempo-excedido');
                } else {
                    // Aún hay tiempo
                    elementoRestante.textContent = `Tiempo restante: ${this.formatearTiempo(tiempoRestante)}`;
                    elementoRestante.classList.remove('tiempo-excedido');
                    this.elementoTiempo.classList.remove('tiempo-excedido');
                }
            }

            // Actualizar barra de progreso
            if (this.elementoProgreso) {
                const progreso = Math.min(100, (this.tiempoTranscurrido / this.tiempoObjetivo) * 100);
                this.elementoProgreso.style.width = `${progreso}%`;
                this.elementoProgreso.className = `progress-bar ${progreso >= 100 ? 'bg-danger' : 'bg-success'}`;
            }
        }
    }

    formatearTiempo(segundos) {
        segundos = Math.max(0, Math.floor(Number(segundos)));
        const horas = Math.floor(segundos / 3600);
        const minutos = Math.floor((segundos % 3600) / 60);
        const segs = segundos % 60;
        return `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}:${String(segs).padStart(2, '0')}`;
    }

    destruir() {
        // Limpiar todos los intervalos al destruir
        if (this.intervalo) {
            clearInterval(this.intervalo);
        }
        if (this.intervaloTiempoRestante) {
            clearInterval(this.intervaloTiempoRestante);
        }
        if (this.sincronizacionIntervalo) {
            clearInterval(this.sincronizacionIntervalo);
        }
    }

    iniciarActualizacionPeriodica() {
        // Actualizar cada 5 minutos (300000 ms)
        this.intervaloActualizacion = setInterval(() => {
            this.actualizarTiempoRestante();
        }, 300000);
    }

    manejarRecarga() {
        // Guardar tiempo actual antes de recargar
        window.addEventListener('beforeunload', () => {
            localStorage.setItem(`cronometro_${this.id}_tiempo`, this.tiempoTranscurrido);
            localStorage.setItem(`cronometro_${this.id}_ultima`, Date.now());
        });

        // Recuperar tiempo al cargar
        const tiempoGuardado = localStorage.getItem(`cronometro_${this.id}_tiempo`);
        const ultimaActualizacion = localStorage.getItem(`cronometro_${this.id}_ultima`);
        
        if (tiempoGuardado && ultimaActualizacion) {
            const tiempoTranscurrido = parseInt(tiempoGuardado);
            const tiempoPasado = Math.floor((Date.now() - parseInt(ultimaActualizacion)) / 1000);
            
            // Actualizar tiempo si ha pasado menos de 1 hora
            if (tiempoPasado < 3600) {
                this.tiempoTranscurrido = tiempoTranscurrido + tiempoPasado;
                this.actualizarDisplay();
            }
        }
    }

    iniciarActualizacionTiempoRestante() {
        // Actualizar cada 2 minutos (120000 ms)
        this.intervaloTiempoRestante = setInterval(() => {
            this.actualizarDisplay();
        }, 120000);
    }

    actualizarTiempoRestante() {
        // Obtener el tiempo actual del servidor
        fetch(`../../controller/Administrador/cronometro.php?id=${this.id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar el tiempo transcurrido
                    this.tiempoTranscurrido = parseInt(data.tiempoTranscurrido);
                    this.actualizarDisplay();

                    // Verificar alertas después de actualizar el tiempo
                    this.verificarAlertas();
                }
            })
            .catch(error => {
                console.error('Error al actualizar tiempo restante:', error);
            });
    }

    async inicializarAudio() {
        try {
            // Verificar si ya tenemos el permiso guardado
            if (localStorage.getItem('audioPermiso') === 'granted') {
                this.audioPermiso = true;
                return;
            }

            // Solicitar permiso solo si no se ha pedido antes
            if (localStorage.getItem('audioPermiso') !== 'denied') {
                // Usar async/await en lugar de then()
                const result = await Swal.fire({
                    title: '¿Permitir notificaciones de audio?',
                    text: 'Esto te ayudará a estar atento a los tiempos de los tickets',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Permitir',
                    cancelButtonText: 'No permitir'
                });

                if (result.isConfirmed) {
                    this.audioPermiso = true;
                    this.audioHabilitado = true;
                    localStorage.setItem('audioPermiso', 'granted');
                    localStorage.setItem('audioHabilitado', 'true');
                    
                    // Inicializar el audio después de obtener permiso
                    this.audio = new Audio(this.rutaSonido);
                    await this.audio.load(); // Precargar el audio
                } else {
                    localStorage.setItem('audioPermiso', 'denied');
                }
            }
        } catch (error) {
            console.error('Error al inicializar audio:', error);
        }
    }

    toggleAudio() {
        if (!this.audioPermiso) {
            this.inicializarAudio();
            return;
        }

        this.audioHabilitado = !this.audioHabilitado;
        localStorage.setItem('audioHabilitado', this.audioHabilitado);
        
        // Actualizar ícono del botón
        const btnSonido = document.getElementById(`sonido-${this.id}`);
        if (btnSonido) {
            const icono = btnSonido.querySelector('i');
            icono.className = `fas fa-volume-${this.audioHabilitado ? 'up' : 'mute'}`;
        }

        // Mostrar toast de confirmación
        this.mostrarToast(
            `Sonido ${this.audioHabilitado ? 'activado' : 'desactivado'}`,
            this.audioHabilitado ? 'success' : 'info'
        );
    }

    reproducirAlerta() {
        if (this.audioPermiso && this.audioHabilitado) {
            try {
                this.audio.currentTime = 0;
                this.audio.play().catch(error => {
                    console.error('Error al reproducir audio:', error);
                });
            } catch (error) {
                console.error('Error al reproducir alerta:', error);
            }
        }
    }
}

// Inicialización global
document.addEventListener('DOMContentLoaded', () => {
    const cronometros = new Map();
    
    document.querySelectorAll('.timer-card').forEach(card => {
        const id = card.dataset.cronometroId;
        const tiempoTranscurrido = parseInt(card.dataset.tiempoTranscurrido);
        const tiempoObjetivo = parseInt(card.dataset.tiempoObjetivo);
        const rutaSonido = card.dataset.rutaSonido;
        
        const cronometro = new Cronometro(id, tiempoTranscurrido, tiempoObjetivo, rutaSonido, true);
        cronometros.set(id, cronometro);
    });

    // Manejar visibilidad de la página
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'visible') {
            cronometros.forEach(cronometro => {
                cronometro.actualizarTiempoRestante();
            });
        }
    });

    // Agregar botón global de audio en el navbar
    const navbar = document.querySelector('.navbar-nav.ml-auto');
    if (navbar) {
        const audioGlobal = document.createElement('li');
        audioGlobal.className = 'nav-item';
        audioGlobal.innerHTML = `
            <button id="audioGlobal" class="btn btn-link nav-link">
                <i class="fas fa-volume-${localStorage.getItem('audioHabilitado') === 'true' ? 'up' : 'mute'}"></i>
            </button>
        `;
        navbar.insertBefore(audioGlobal, navbar.firstChild);

        // Manejar click en botón global
        document.getElementById('audioGlobal').addEventListener('click', () => {
            const audioHabilitado = localStorage.getItem('audioHabilitado') === 'true';
            localStorage.setItem('audioHabilitado', !audioHabilitado);
            
            // Actualizar todos los cronómetros
            cronometros.forEach(cronometro => {
                cronometro.audioHabilitado = !audioHabilitado;
                const btnSonido = document.getElementById(`sonido-${cronometro.id}`);
                if (btnSonido) {
                    const icono = btnSonido.querySelector('i');
                    icono.className = `fas fa-volume-${!audioHabilitado ? 'up' : 'mute'}`;
                }
            });

            // Actualizar ícono global
            const iconoGlobal = audioGlobal.querySelector('i');
            iconoGlobal.className = `fas fa-volume-${!audioHabilitado ? 'up' : 'mute'}`;

            // Mostrar toast
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                title: `Sonido ${!audioHabilitado ? 'activado' : 'desactivado'} globalmente`,
                icon: !audioHabilitado ? 'success' : 'info'
            });
        });
    }
});

// Agregar estilos CSS
const estilos = `
    .tiempo-excedido {
        color: #dc3545 !important;
        animation: parpadeo 1s infinite;
    }

    @keyframes parpadeo {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }

    .timer-display {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }

    .tiempo-transcurrido {
        font-size: 2rem;
        font-weight: bold;
    }

    .tiempo-restante {
        font-size: 1.2rem;
        color: #666;
    }
`;

// Insertar estilos en el documento
const styleSheet = document.createElement("style");
styleSheet.textContent = estilos;
document.head.appendChild(styleSheet);
</script>


</body>
</html>
