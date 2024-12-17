<?php
require_once __DIR__ . '/../../model/conexion.php';
require_once __DIR__ . '/../../model/consultasA.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class CronometroWebSocket implements MessageComponentInterface {
    protected $clients;
    protected $cronometros;
    protected $cronometroModel;
    protected $lastUpdate;
    protected $updateInterval = 1;
    protected $clientReconnectAttempts;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->cronometros = [];
        $this->cronometroModel = new consultasA();
        $this->lastUpdate = [];
        $this->clientReconnectAttempts = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        $this->clientReconnectAttempts[$conn->resourceId] = 0;
        
        echo "Nueva conexión: {$conn->resourceId}\n";
        
        $conn->send(json_encode([
            'tipo' => 'conexion',
            'status' => 'conectado',
            'mensaje' => 'Conexión establecida exitosamente'
        ]));
        
        $this->sincronizarEstadoInicial($conn);
    }

    protected function sincronizarEstadoInicial(ConnectionInterface $conn) {
        try {
            $cronometros = $this->cronometroModel->obtenerTodosCronometros();
            if ($cronometros) {
                $conn->send(json_encode([
                    'tipo' => 'inicializacion',
                    'cronometros' => $cronometros
                ]));
            }
        } catch (\Exception $e) {
            error_log("Error en sincronización inicial: " . $e->getMessage());
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        try {
            $data = json_decode($msg, true);
            if (!$data) return;

            $idCronometro = $data['idCronometro'];
            $tiempoActual = time();

            if (!isset($this->lastUpdate[$idCronometro]) || 
                ($tiempoActual - $this->lastUpdate[$idCronometro]) >= $this->updateInterval) {

                $result = $this->procesarAccion($data);

                if ($result) {
                    $this->lastUpdate[$idCronometro] = $tiempoActual;
                    $this->broadcastMessage($from, $data, $tiempoActual);
                }
            }
        } catch (\Exception $e) {
            error_log("Error en WebSocket: " . $e->getMessage());
        }
    }

    protected function procesarAccion($data) {
        switch ($data['accion']) {
            case 'iniciarCronometro':
                return $this->cronometroModel->iniciarCronometro(
                    $data['idCronometro'],
                    $data['tiempoTranscurrido'] ?? 0
                );
            case 'pausarCronometro':
                return $this->cronometroModel->pausarCronometro(
                    $data['idCronometro'],
                    $data['tiempoTranscurrido']
                );
            case 'reiniciarCronometro':
                return $this->cronometroModel->reiniciarCronometro($data['idCronometro']);
            case 'actualizarCronometro':
                return $this->cronometroModel->actualizarCronometro(
                    $data['idCronometro'],
                    $data['tiempoTranscurrido']
                );
            default:
                return false;
        }
    }

    protected function broadcastMessage($from, $data, $timestamp) {
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send(json_encode([
                    'tipo' => 'actualizacion',
                    'data' => $data,
                    'timestamp' => $timestamp
                ]));
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        unset($this->clientReconnectAttempts[$conn->resourceId]);
        echo "Conexión cerrada: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error en conexión {$conn->resourceId}: {$e->getMessage()}\n";
        
        $this->clientReconnectAttempts[$conn->resourceId] = 
            ($this->clientReconnectAttempts[$conn->resourceId] ?? 0) + 1;

        if ($this->clientReconnectAttempts[$conn->resourceId] >= 5) {
            $conn->send(json_encode([
                'tipo' => 'error',
                'mensaje' => 'Máximo número de intentos de reconexión alcanzado'
            ]));
            $conn->close();
        }
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new CronometroWebSocket()
        )
    ),
    8080
);

echo "Servidor WebSocket iniciado en el puerto 8080\n";
$server->run(); 