<?php
    require "./server_config.php";

    $req_id = $_POST["req_id"];
    $off_id = $_POST["off_id"];

    if (isset($_POST["confirm"])) {
        $add_match_query = "INSERT INTO richiesta_vendita(data_contratto, vendita_id, richiesta_id)
                            VALUES('" . date("Y-m-d") . "', $off_id, $req_id)";

        echo $add_match_query;

        if ($conn->query($add_match_query)) {
            header("location: ../../match.php");
        }
    }
?>