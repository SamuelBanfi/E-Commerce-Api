<?php
    /**
     * This method is used to confirm or reject a offer.
     * If the user press confirm a new deal is entered on the database. 
     */
    require "./server_config.php";

    $req_id = $_POST["req_id"];
    $off_id = $_POST["off_id"];
    $req_usr_id = $_POST["req_usr_id"];
    $off_usr_id = $_POST["off_usr_id"];

    if (isset($_POST["confirm"])) {
        $add_match_query = "INSERT INTO richiesta_vendita(data_contratto, vendita_id, richiesta_id, venditore_id, acquirente_id)
                            VALUES('" . date("Y-m-d") . "', $off_id, $req_id, $off_usr_id, $req_usr_id)";

        if ($conn->query($add_match_query)) {
            header("location: ../../match.php");
        } else {
            echo "<p>Qualcosa è andato storto. Riprova più tardi</p>";
            echo "<br>";
            echo "<a href='../../index.php'>Pagina iniziale</a>";
        }
    } else {
        header("location: ../../match.php");
    }
?>