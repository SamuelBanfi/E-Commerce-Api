<?php
    require "server_config.php";
    session_start();

    $old_email = $_POST["old_email"];
    $new_email = $_POST["new_email"];
    $id = $_SESSION["id"];

    $get_email = $conn->query("SELECT email FROM utente WHERE id=$id");
    $email = $get_email->fetch_array()["email"];

    if ($old_email == $email) {
        if ($new_email != $email) {
            $update_mail_query = "UPDATE utente
                                  SET email='$new_email'
                                  WHERE email='$old_email'";
            
            if ($conn->query($update_mail_query)) {
                header("location: ../../index.php");
            } else {
                echo "<p>Errore nell'aggiornamento dell'email</p><br>";
                echo "<a href='../../index.php'>Pagina iniziale</a>";
            }
        } else {
            echo "<p>Le email non possono essere uguali</p><br>";
            echo "<a href='../../index.php'>Pagina iniziale</a>";
        }
    } else {
        echo "<p>La vecchia email non è corretta</p><br>";
        echo "<a href='../../index.php'>Pagina iniziale</a>";
    }
?>