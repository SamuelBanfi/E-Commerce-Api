<?php
    /**
     * This class is used to set session variables when the user 
     * inserted the correct username and password.
     */
    require "server_config.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $login_query = "SELECT id, nome, nome_utente, codice 
                    FROM utente
                    WHERE nome_utente = '$username'";

    $result = $conn->query($login_query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_array();

        /** 
         * This function check if the hash of the password on 
         * database match the inserted password.
         */
        $passwordCheck = password_verify($password, $row["codice"]);

        if ($passwordCheck) {
            $first_letter = substr(lcfirst($row["nome"]), 0, 1);

            session_start();

            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["nome_utente"];
            $_SESSION["image"] = "./Images/Letters/$first_letter.png";
            header("location: ../../index.php");
        } else {
            header("location:../../signin.html");
        }
    } else {
        header("location:../../signin.html");
    }
?>