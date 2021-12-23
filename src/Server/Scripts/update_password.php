<?php
    /**
     * This script is used to update the password.
     * The password must be different and meet the password minimum security standard.
     */
    require "server_config.php";
    session_start();

    $old_password = password_hash($_POST["old_password"], PASSWORD_DEFAULT);
    $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
    $id = $_SESSION["id"];

    $get_password = $conn->query("SELECT codice FROM utente WHERE id=$id");
    $get_old_password = $get_password->fetch_array()["codice"];

    if ($get_old_password == $old_password) {
        if ($new_password != $old_password) {
            $update_password_query = "UPDATE utente
                                    SET codice='$new_password'
                                    WHERE codice='$old_password'";
            
            if ($conn->query($update_password_query)) {
                header("location: ../../index.php");
            } else {
                echo "<p>Errore nell'aggiornamento della password</p><br>";
                echo "<a href='../../index.php'>Pagina iniziale</a>";
            }
        } else {
            echo "<p>Le password non possono essere uguali</p><br>";
            echo "<a href='../../index.php'>Pagina iniziale</a>";
        }
    } else {
        echo "<p>La vecchia password inserita non è corretta</p><br>";
        echo "<a href='../../index.php'>Pagina iniziale</a>";
    }
?>