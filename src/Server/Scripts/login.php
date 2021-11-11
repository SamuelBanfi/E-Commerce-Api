<?php
    require "server_config.php";

    $username = $_POST["username"];

    $login_query = "SELECT id, nome, nome_utente 
                    FROM utente
                    WHERE nome_utente = '$username'";

    $result = $conn->query($login_query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_array();

        $password = password_hash($_POST["password"], $row["codice"]);
        $passwordCheck = password_verify($_POST["password"], $password);

        if ($passwordCheck) {
            $first_letter = substr(lcfirst($row["nome"]), 0, 1);

            session_start();

            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["nome_utente"];
            $_SESSION["image"] = "./Images/Letters/$first_letter.png";
            header("location: ../../index.php");
        } else {
            require "../../Models/login_model.php";
        }
    } else {
        require "../../Models/login_model.php";
    }
?>