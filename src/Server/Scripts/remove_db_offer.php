<?php
    require "./server_config.php";

    $id = $_POST["id"];

    $remove_offer_query = "DELETE 
                           FROM vendita
                           WHERE id = $id";
    
    if ($conn->query($remove_offer_query)) {
        header("location: ../../profile.php");
    } else {
        echo "<p>Errore nell'eliminazione dell'inserzione, riprova più tardi</p><br>";
        echo "<a href='../../index.php'>Pagina iniziale</a>";
    }
?>