<?php
    require "server_config.php";

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $mail = $_POST["mail"];
    $password = password_hash($_POST["password1"], PASSWORD_DEFAULT);

    echo $password;

    $add_user_query = "INSERT INTO utente(
        nome, cognome, nome_utente, email, codice) 
        VALUES('$name', '$surname', '$username', '$mail', '$password')";

    if ($conn->query($add_user_query)) {
        header("location: ../../signin.html");
    } else {
        echo "<p>Qualcosa è andato storto. Riprova più tardi</p>";
        echo "<br>";
        echo "<a href='../../index.php'>Pagina iniziale</a>";
    }
?>