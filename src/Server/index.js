const WebSocket = require("ws");

const wss = new WebSocket.Server({port:8080});

wss.on("connection", ws => {
    console.log("Utente connesso"); 
    
    ws.on("message", data => {
        console.log("Il client ha inviato al server: " + data);

        ws.send(data);

        wss.clients.forEach(client => {
            if (client !== ws && client.readyState === WebSocket.OPEN) {
                client.send(data);
            }
        });
    });

    ws.on("close", () => {
        console.log("Utente disconnesso");
    });
});
