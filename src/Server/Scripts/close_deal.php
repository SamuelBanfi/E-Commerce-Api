<?php
    /**
     * This script is used to close a deal.
     * When buyer want to close a deal this script set concluso_acquirente to 1.
     * When seller want to close a deal this script set concluso_venditore to 1.
     * If concluso_venditore and concluso_acquire are set to 1 the deal is removed
     * and request and sell are removed from database.
     */
    require "server_config.php";
    $set_deal_query = "";

    if (isset($_POST["buyer"])) {        
        $set_deal_query = "UPDATE richiesta_vendita
                           SET concluso_acquirente=1
                           WHERE id=" . $_POST["buyer"];
    } else {
        $set_deal_query = "UPDATE richiesta_vendita
                           SET concluso_venditore=1
                           WHERE id=" . $_POST["seller"];
    }

    $conn->query($set_deal_query);

    $close_deal_query = "SELECT vendita_id, richiesta_id, concluso_venditore, concluso_acquirente, venditore_id, acquirente_id
                         FROM richiesta_vendita";

    $close_deal = $conn->query($close_deal_query);
    $close_deal = $close_deal->fetch_assoc();

    if (intval($close_deal["acquirente_id"]) == 1 && intval($close_deal["venditore_id"]) == 1) {
        $delete_offer = "DELETE FROM vendita WHERE id=" . $close_deal["vendita_id"];
        $delete_request = "DELETE FROM richiesta WHERE id=" . $close_deal["richiesta_id"];

        if ($conn->query($delete_offer) && $conn->query($delete_request)) {
            header("location: ../../match.php");
        }
    }

    header("location: ../../match.php");
?>