<?php
header('Content-Type: application/json');
require_once '../../model/conexion.php';
require_once '../../model/consultasA.php';

// Manejo de CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    $consultasA = new consultasA();
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $resultado = $consultasA->obtenerEstadoCronometro($id);
            $estadoGuardado = $consultasA->obtenerUltimoEstadoCronometro($id);
            
            if ($estadoGuardado && $estadoGuardado['estado'] === 'activo') {
                $ultimaActualizacion = new DateTime($estadoGuardado['ultima_actualizacion'], new DateTimeZone('America/Bogota'));
                $ahora = new DateTime('now', new DateTimeZone('America/Bogota'));
                $diferencia = $ahora->getTimestamp() - $ultimaActualizacion->getTimestamp();
                
                // Calcular tiempo transcurrido incluyendo el tiempo desde la última actualización
                $tiempoTotal = (int)($resultado['tiempo_transcurrido'] ?? 0);
                if ($diferencia > 0 && $diferencia < 3600) { // Menos de 1 hora
                    $tiempoTotal += $diferencia;
                }
                
                echo json_encode([
                    'success' => true,
                    'tiempoTranscurrido' => $tiempoTotal,
                    'estado' => 'activo',
                    'ultimaActualizacion' => $ultimaActualizacion->format('Y-m-d H:i:s')
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'tiempoTranscurrido' => (int)($resultado['tiempo_transcurrido'] ?? 0),
                    'estado' => 'pausado',
                    'ultimaActualizacion' => null
                ]);
            }
        } else {
            throw new Exception('ID no proporcionado');
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $ahora = new DateTime('now', new DateTimeZone('America/Bogota'));
        
        switch ($data['accion']) {
            case 'iniciarCronometro':
            case 'pausarCronometro':
            case 'reiniciarCronometro':
            case 'actualizarCronometro':
                $resultado = $consultasA->{$data['accion']}(
                    $data['idCronometro'],
                    $data['tiempoTranscurrido'] ?? 0,
                    $ahora->format('Y-m-d H:i:s')
                );
                break;
            default:
                throw new Exception('Acción no válida');
        }
        
        echo json_encode([
            'success' => true,
            'data' => $resultado,
            'timestamp' => $ahora->format('Y-m-d H:i:s')
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

if (function_exists('fastcgi_finish_request')) {
    fastcgi_finish_request();
}
?>
