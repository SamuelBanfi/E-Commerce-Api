<?php
    require "./Server/Scripts/server_config.php";
    session_start();

    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $user_data = $conn->query("SELECT * FROM utente WHERE id=$id");
        $user_data_array = $user_data->fetch_assoc();
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Profilo | E-Commerce Api</title>
                <link rel="stylesheet" href="./Styles/header.css">
                <link rel="stylesheet" href="./Styles/insertion.css">
                <link rel="stylesheet" href="./Styles/profile.css">
            </head>
            <body>
                <?php require "./Models/header.php"?>
                <main>
                    <h2>Benvenuto <?php echo $user_data_array["nome"] . " " . $user_data_array["cognome"];?></h2>
                    <button onclick="location.href='./Server/Scripts/logout.php'">Esci</button>
                    <hr>
                    <h2>Informazioni personali</h2>
                    <div id="personal-info">
                        <?php
                            // Print all user informations.
                            $user = $conn->query("SELECT * FROM utente WHERE id=$id");
                            $user = $user->fetch_assoc();
                            
                            echo "<p><b>Nome</b></p>";
                            echo "<p>" . $user["nome"] . "</p>";
                            echo "<br>";
                            echo "<p><b>Cognome</b></p>";
                            echo "<p>" . $user["cognome"] . "</p>";
                            echo "<br>";
                            echo "<p><b>Nome utente</b></p>";
                            echo "<p>" . $user["nome_utente"] . "</p>";
                            echo "<br>";
                            echo "<p><b>E-Mail</b></p>";
                            echo "<p>" . $user["email"] . "</p>";
                        ?>
                    </div>
                    <hr>
                    <h2>Modifica E-Mail</h2>
                    <form action="./Server/Scripts/update_email.php" method="POST">
                        <label for="old_pass">Vecchia password</label>
                        <input type="email" name="old_email" id="old_email" required>
                        <label for="new_pass">Nuova password</label>
                        <input type="email" name="new_email" id="new_email" required>
                        <input type="submit" value="Aggiorna">
                    </form>
                    <hr>
                    <h2>Modifica password</h2>
                    <form action="./Server/Scripts/update_password.php" method="POST">
                        <label for="old_pass">Vecchia password</label>
                        <input type="email" name="old_password" id="old_password" required>
                        <label for="new_pass">Nuova password</label>
                        <input type="email" name="new_password" id="new_password" required>
                        <input type="submit" value="Aggiorna">
                    </form>
                    <hr>
                    <h2>Le tue inserzioni</h2>
                    <h3>Inserzioni - offerte</h3>
                    <?php
                        /**
                         * Search the offers of the current user.
                         * In this section the user could remove his insertion.
                         */ 
                        $get_offers_query = "SELECT vendita.nome AS vnome, vendita.id AS vid,
                                                vendita.descrizione, vendita.immagine, utente.nome AS unome
                                                FROM vendita JOIN utente
                                                ON vendita.utente_id = utente.id
                                                AND utente.id = $id";

                        $result = $conn->query($get_offers_query);

                        while ($row = $result->fetch_assoc()) {
                            echo "<form action='./Server/Scripts/remove_db_offer.php' method='POST'>";
                            echo "<div class='offer-container'>";
                            echo "<div class='image-container'>";
                            echo "<img src='" . $row['immagine'] . "' alt='" . $row['vnome'] . "'>";
                            echo "</div>";
                            echo "<div class='description-container'>";
                            echo "<h3>" . $row['vnome'] . "</h3>";
                            echo "<p>" . $row["descrizione"] . "</p></div>";
                            echo "<input type='number' value=" . $row["vid"] . " name='id' style='display:none'></div>";
                            echo "<input type='submit' value='Rimuovi'></form>";
                        }
                    ?>
                    <h3>Inserzioni - richieste</h3>
                    <?php
                        /**
                         * Search the requests of the current user.
                         * In this section the user could remove his insertion.
                         */ 
                        $get_requests_query = "SELECT richiesta.nome AS rnome, richiesta.id AS rid, 
                                            richiesta.descrizione, richiesta.immagine, utente.nome AS unome
                                            FROM richiesta JOIN utente
                                            ON richiesta.utente_id = utente.id
                                            AND utente.id = $id";

                        $result = $conn->query($get_requests_query);

                        while ($row = $result->fetch_assoc()) {
                            echo "<form action='./Server/Scripts/remove_db_request.php' method='POST'>";
                            echo "<div class='offer-container'>";
                            echo "<div class='image-container'>";
                            echo "<img src='" . $row["immagine"] . "' alt='" . $row["rnome"] . "'>";
                            echo "</div>";
                            echo "<div class='description-container'>";
                            echo "<h3>" . $row["rnome"] . "</h3>";
                            echo "<p>" . $row["descrizione"] . "</p></div>";
                            echo "<input type='number' value=" . $row["rid"] . " name='id' style='display:none'></div>";
                            echo "<input type='submit' value='Rimuovi'></form>";
                        }
                    ?>
                </main>
            </body>
        </html>
    <?php
    } else {
        header("location:./signin.html");
    } 
?>