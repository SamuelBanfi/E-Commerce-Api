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
        <link rel="stylesheet" href="./Styles/match.css">
    </head>
    <body>
        <?php require "./Models/header.php"?>
        <main>
            <h1>Possibili accordi</h1>
            <?php
                $get_requests_query = "SELECT * FROM richiesta WHERE utente_id=" . $_SESSION['id'];
                $user_requests = $conn->query($get_requests_query);

                while ($req = $user_requests->fetch_assoc()) {
                    echo "<h2>La tua richiesta: " . $req["nome"] . "</h2>";
                    
                    $get_offers_query = "SELECT * 
                                         FROM vendita
                                         WHERE prodotto_id=" . $req["prodotto_id"] . "
                                         AND distretto_id=" . $req["distretto_id"];

                    $users_offers = $conn->query($get_offers_query);

                    while ($off = $users_offers->fetch_assoc()) {
                        echo "<div class='match-request'>";

                        createInsertion($off["prodotto_id"], 
                                        $off["distretto_id"],
                                        "", 
                                        $off["immagine"],
                                        $off["nome"],
                                        $off["descrizione"]
                        );

                        echo "<form class='confirm-reject' action='./Server/Scripts/confirm_or_reject_offer.php' method='POST'>
                              <button name='confirm'>CONFERMA</button>
                              <br><button name='reject'>RIFIUTA</button>
                              <input type='number' value='" . $req["id"] . "' name='req_id'>
                              <input type='number' value='" . $off["id"] . "' name='off_id'>
                              <input type='number' value='" . $req["utente_id"] . "' name='req_usr_id'>
                              <input type='number' value='" . $off["utente_id"] . "' name='off_usr_id'>
                              </form></div>";
                    }
                }
            ?>
            <h1>Contrattazioni in atto</h1>
            <?php 
                // Fetch all negotiations
                $get_current_match = "SELECT * 
                                      FROM richiesta_vendita 
                                      WHERE venditore_id=" . $_SESSION["id"] . "
                                      OR acquirente_id=" . $_SESSION["id"];
                
                $match = $conn->query($get_current_match);

                while ($row = $match->fetch_assoc()) {
                    if ($row["acquirente_id"] == $_SESSION["id"]) {
                        $offer_query = "SELECT * 
                                        FROM vendita 
                                        WHERE id=" . $row["vendita_id"];

                        $offer = $conn->query($offer_query);
                        $offer = $offer->fetch_assoc();

                        createInsertion($offer["prodotto_id"], 
                                        $offer["distretto_id"],
                                        "", 
                                        $offer["immagine"],
                                        $offer["nome"],
                                        $offer["descrizione"]
                        );

                        echo "<h4>Concluso venditore</h4>";

                        // https://www.php.net/manual/en/function.intval.php
                        // Convert string to int and check if concluso_venditore is 0
                        if (intval($row["concluso_venditore"]) == 0) {
                            echo "<input type='checkbox' disabled>";
                        } else {
                            echo "<input type='checkbox' checked disabled>";
                        }

                        echo "<h4>Concluso acquirente</h4>";

                        // https://www.php.net/manual/en/function.intval.php
                        // Convert string to int and check if concluso_acquirente is 0
                        if (intval($row["concluso_acquirente"]) == 0) {
                            echo "<input type='checkbox' disabled>";
                        } else {
                            echo "<input type='checkbox' checked disabled>";
                        }

                        echo "<form class='close-deal' action='./Server/Scripts/close_deal.php' method='POST'>
                              <button>Concludere trattativa</button>
                              <input type='number' value='" . $row["id"] . "' name='buyer' id='buyer'></form>";
                    } else {
                        $request_query = "SELECT * 
                                          FROM vendita 
                                          WHERE id=" . $row["richiesta_id"];

                        $request = $conn->query($request_query);
                        $request = $request->fetch_assoc();

                        createInsertion($request["prodotto_id"], 
                                        $request["distretto_id"],
                                        "", 
                                        $request["immagine"],
                                        $request["nome"],
                                        $request["descrizione"]
                        );

                        echo "<h4>Concluso venditore</h4>";

                        // https://www.php.net/manual/en/function.intval.php
                        if (intval($row["concluso_venditore"]) == 0) {
                            echo "<input type='checkbox' readonly>";
                        } else {
                            echo "<input type='checkbox' checked readonly>";
                        }

                        echo "<h4>Concluso acquirente</h4>";

                        // https://www.php.net/manual/en/function.intval.php
                        if (intval($row["concluso_acquirente"]) == 0) {
                            echo "<input type='checkbox' readonly>";
                        } else {
                            echo "<input type='checkbox' checked readonly>";
                        }

                        echo "<form 'close-deal' action='./Server/Scripts/close_deal.php' method='POST'>
                              <button>Concludere trattativa</button>
                              <input type='number' value='" . $row["id"] . "' name='seller' id='seller'></form>";
                    }
                }
            ?>
        </main>
    </body>
</html>