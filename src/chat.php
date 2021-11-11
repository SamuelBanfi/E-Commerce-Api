<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client</title>
    <link rel="stylesheet" href="./Styles/chat.css">
    <link rel="stylesheet" href="./Styles/chat_user.css">
</head>
<body>
    <input type="text" id="username">
    <input type="text" id="destination">
    <div class="user-container">
        <div class="user-image-container">
            <img src="" alt="">
        </div>
        <div class="name-container">
            <p>Ciao</p>
        </div>
    </div>
    <div class="chat-container">
        <div class="old-messages">
            <div class="mine" id="mine"></div>
            <div class="other" id="other"></div>
        </div>
        <div class="chat">
            <input type="text" id="message" placeholder="Scrivi un messaggio...">
            <button onclick="sendMessage()" id="send">INVIA</button>
        </div>
    </div>
    <script>
        var message = document.getElementById("message");
        var myMessage = document.getElementById("mine");
        var otherMessage = document.getElementById("other");

        // Websocket -----------------------------------
        const ws = new WebSocket("ws://localhost:8080");
        ws.binaryType = "arraybuffer";

        ws.addEventListener("open", () => {
            console.log("Siamo connessi");
        });

        function sendMessage() {
            if (message.value.trim()) {
                var msg = {
                    message: message.value,
                    from: document.getElementById("username").value,
                    to: document.getElementById("destination").value,
                    date: Date.now()
                };

                message.value = "";

                createMessage(myMessage, msg, true);

                console.log(JSON.stringify(msg));

                ws.send(JSON.stringify(msg));
            }
        }

        ws.addEventListener("message", e => {
            var data = new Uint8Array(e.data);
            var message = "";
            
            for (var i = 0; i < data.length; i++) {
                message += String.fromCharCode(data[i]);
            }

            var mes = JSON.parse(message);

            if (mes.to == document.getElementById("username").value) {
                createMessage(otherMessage, mes, false);
            }
        });

        function createMessage(destintation, data, mine) {
            if (mine)
                destintation.innerHTML += "<div class='msg-mine'>" + "<p>" + data.message + "</p>" + "<p class='date'><strong>" + getDate(data.date) + "</strong></p></div>";
            else
                destintation.innerHTML += "<div class='msg-other'>" + "<p>" + data.message + "</p class='date'>" + "<p><strong>" + getDate(data.date) + "</strong></p></div>";
        }

        function getDate(date) {
            var d = new Date(date);
            var hours = format(d.getHours());
            var minutes = format(d.getMinutes());

            return hours + ":" + minutes;
        }

        function format(value) {
            return value < 10 ? "0" + value : value.toString();
        }
    </script>
</body>
</html>