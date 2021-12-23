const WebSocket = require("ws");
var mysql = require("mysql");

// Create a new WebSocket server.
const wss = new WebSocket.Server({port:8080});

// Create a new connection to MySQL database.
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "Password&1",
    database: "vendita_api"
});

// Connection to MySQL database.
// https://www.w3schools.com/nodejs/nodejs_mysql_select.asp
con.connect();

wss.on("connection", ws => {
    console.log("Utente connesso");
    
    ws.on("message", data => {
        // Send data to each client.
        wss.clients.forEach(client => {
            var split = ("" + data).split("_");
            var dataContent = split[1];
            var mes = JSON.parse(dataContent);
                    
            if (split[0] == "send") {
                var query = "INSERT INTO messaggi(committente_id, destinatario_id, messaggio) VALUES('" + 
                                mes.from + "', '" + mes.to + "', '" + mes.message + "')";
    
                con.query(query, function () {
                    client.send(data);
                });
            } else {
                var query = "SELECT * FROM messaggi WHERE committente_id=" + mes.from + 
                                " AND destinatario_id=" + mes.to;
    
                con.query(query, function (result) {
                    client.send("get_" + result);
                });
            }
        });
    });

    ws.on("close", () => {
        console.log("Utente disconnesso");
    });
});
