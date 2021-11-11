<?php
    require "./Server/Scripts/server_config.php";
    require "./Models/insertion.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accordi | E-Commerce Api</title>
        <link rel="stylesheet" href="./Styles/header.css">
        <link rel="stylesheet" href="./Styles/insertion.css">
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
            }

            main {
                margin-top: 10vh;
            }

            .match-request {
                display: flex;
                width: 50%;
                height: 15vh;
            }

            .offer-container {
                flex: 2;
                height: 20vh;
            }

            .confirm-reject {
                flex: 1;
                margin-top: 3vh;
            }

            .confirm-reject button {
                width: 70%;
                height: 8vh;
                margin-left: 3vh;
                margin-bottom: 3vh;
                margin-top: 0.5vh;
                border-radius: 10px;
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php require "./Models/header.php"?>
        <main>
            <h1>Match</h1>
            <?php
                $get_requests_query = "SELECT * FROM richiesta WHERE utente_id=" . $_SESSION['id'];
                $user_requests = $conn->query($get_requests_query);

                while ($req = $user_requests->fetch_assoc()) {
                    echo "<h2>La tua richiesta: " . $req["nome"] . "</h2>";
                    
                    $get_offers_query = "SELECT * 
                                         FROM vendita, richiesta_vendita
                                         WHERE prodotto_id=" . $req["prodotto_id"] . "
                                         AND distretto_id=" . $req["distretto_id"]. "
                                         AND vendita.id <> richiesta_vendita.vendita_id";

                    $users_offers = $conn->query($get_offers_query);

                    while ($off = $users_offers->fetch_assoc()) {
                        echo "<div class='match-request'>";

                        createInsertion($off["prodotto_id"], 
                                        $off["distretto_id"], 
                                        $off["immagine"],
                                        $off["nome"], 
                                        $off["descrizione"]
                        );

                        echo "<form class='confirm-reject' action='./Server/Scripts/confirm_or_reject_offer.php' method='POST'>
                              <button name='confirm'>CONFERMA</button>
                              <br><button name='reject'>RIFIUTA</button>
                              <input type='number' value='" . $req["id"] . "' name='req_id'>
                              <input type='number' value='" . $off["id"] . "' name='off_id'>
                              </form></div>";
                    }
                }
            ?>
        </main>
    </body>
</html>