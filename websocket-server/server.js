const WebSocket = require('ws');

const wss = new WebSocket.Server({ 
    port: 8080,
    perMessageDeflate: false
});

const clients = new Set();

wss.on('connection', function connection(ws) {
    console.log('Nueva conexión establecida');
    clients.add(ws);
    
    ws.on('message', function incoming(message) {
        try {
            const data = JSON.parse(message);
            // Retransmitir el mensaje a todos los clientes excepto al remitente
            clients.forEach(client => {
                if (client !== ws && client.readyState === WebSocket.OPEN) {
                    client.send(JSON.stringify(data));
                }
            });
        } catch (error) {
            console.error('Error al procesar mensaje:', error);
        }
    });
    
    ws.on('error', function error(err) {
        console.error('Error de WebSocket:', err);
    });

    ws.on('close', function close() {
        console.log('Cliente desconectado');
        clients.delete(ws);
    });
});

// Mantener vivas las conexiones
setInterval(() => {
    wss.clients.forEach((client) => {
        if (client.readyState === WebSocket.OPEN) {
            client.ping();
        }
    });
}, 30000);

console.log('Servidor WebSocket iniciado en puerto 8080');

// Manejo de errores del servidor
wss.on('error', function error(err) {
    console.error('Error en el servidor WebSocket:', err);
});