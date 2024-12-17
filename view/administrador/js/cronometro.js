class CronometroManager {
    constructor() {
        this.ws = new WebSocket('ws://localhost:8080');
        this.initWebSocket();
    }

    initWebSocket() {
        this.ws.onmessage = (event) => {
            const response = JSON.parse(event.data);
            if (response.success && response.data) {
                const cronometro = this.cronometros[response.data.idCronometro];
                if (cronometro) {
                    cronometro.actualizarDesdeWebSocket(response.data);
                }
            }
        };
    }
}

class Cronometro {
    sincronizar(accion) {
        const data = {
            accion: `${accion}Cronometro`,
            idCronometro: this.id,
            tiempoTranscurrido: this.tiempoTranscurrido
        };

        // Enviar por WebSocket
        if (cronometroManager.ws.readyState === WebSocket.OPEN) {
            cronometroManager.ws.send(JSON.stringify(data));
        }

        // También enviar por HTTP para respaldo
        fetch("../../controller/Administrador/cronometro.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        }).catch(console.error);
    }
} 