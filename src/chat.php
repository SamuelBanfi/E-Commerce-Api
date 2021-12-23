<?php
    require "./Server/Scripts/server_config.php";
    session_start();
?>
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
    <input type="text" id="user" value="<?php echo $_SESSION["id"] ?>" style="display: none">
    <?php
        // Search for all users in contract with the current user and set the link to chat.
        $get_user_chat_query = "SELECT utente.nome_utente AS uname,
                                utente.id AS uid
                                FROM richiesta_vendita, richiesta, utente 
                                WHERE venditore_id=" . $_SESSION["id"] . "
                                AND richiesta_vendita.richiesta_id=richiesta.id
                                AND richiesta.utente_id=utente.id";

        $result = $conn->query($get_user_chat_query);

        while ($row = $result->fetch_assoc()) {
            echo "<div class='user-container'>";
            echo "<input type='text' id='destination' value='" . $row["uid"] . "' readonly onclick='getMessages()'>";
            echo "</div>";
        }
    ?>
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
        var from = document.getElementById("user");
        var to = document.getElementById("destination");

        // --- WebSocket ---
        const ws = new WebSocket("ws://localhost:8080");
        ws.binaryType = "arraybuffer";

        // This event checks whether a connection has been established with the WebSocket server.
        ws.addEventListener("open", () => {
            console.log("Siamo connessi");
        });

        /**
         * This function is used to get the messages between two users.
         * The message sent to server contains the sender and the receiver user.
         */
        function getMessages() {
            var msg = {
                from: from.value,
                to: to.value,
            };

            ws.send("get_" + JSON.stringify(msg));
        }

        /**
         * This function is used to generate the message to be sent to the other user (to) via the server.
         * The message sent to server contains the message, the sender, the receiver 
         * and the date when the message was sent. 
         */
        function sendMessage() {
            if (message.value.trim()) {
                var msg = {
                    message: message.value,
                    from: from.value,
                    to: to.value,
                    date: Date.now()
                };

                message.value = "";

                createMessage(myMessage, msg, true);

                console.log(JSON.stringify(msg));

                ws.send("send_" + JSON.stringify(msg));
            }
        }

        /**
         * This event is triggered whenever a message received from the server is detected.
         */
        ws.addEventListener("message", e => {
            var datas = new Uint8Array(e.data);
            var message = "";

            console.log(e.data);
            
            for (var i = 0; i < datas.length; i++) {
                message += String.fromCharCode(datas[i]);
            }

            var split = message.split("_");

            if (split[0] == "send") {
                var mes = JSON.parse(split[1]);

                if (mes.to == from.value) {
                    createMessage(otherMessage, mes, false);
                }
            } else {
                console.log(split);
            }
        });

        /**
         * This function is used to attach the message to chat div.
         */
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