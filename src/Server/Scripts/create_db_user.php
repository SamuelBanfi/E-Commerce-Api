<?php
    /**
     * This class is used to create a new user.
     * During the profile creation phase, it is checked whether the password 
     * meets the minimum security requirements.
     */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require './vendor/autoload.php';
    require "server_config.php";

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $email = $_POST["mail"];

    if ($_POST["password1"] == $_POST["password2"]) {
        $pass = str_split($_POST["password1"]);
        $upper = 0;
        $lower = 0;
        $special = 0;

        if (count($pass) < 8 || count($pass) > 30) {
            echo "<p>La password non soddisfa i requisiti minimi</p>";
            echo "<br>";
            echo "<a href='../../index.php'>Pagina iniziale</a>";
            return;
        }

        for ($i = 0; $i < count($pass); $i++) {
            if (ctype_upper($pass[$i])) {
                $upper++;
            } else if (ctype_lower($pass[$i])) {
                $lower++;
            } else {
                $special++;
            }
        }

        if ($upper >= 1 && $lower >= 1 && $special >= 1) {
            $password = password_hash($_POST["password1"], PASSWORD_DEFAULT);

            $add_user_query = "INSERT INTO utente(
                nome, cognome, nome_utente, email, codice) 
                VALUES('$name', '$surname', '$username', '$email', '$password')";

            if ($conn->query($add_user_query)) {
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPDebug = 1;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->IsHTML(true);
                $mail->Username = "beecommerce2021@gmail.com";
                $mail->Password = "Password&1";
                $mail->SetFrom("beecommerce2021@gmail.com");
                $mail->Subject = "Conferma iscrizione beecommerce.com";
                $mail->Body = "<p>Grazie $name,</p><br><p>Benevuto nella comunity di venditori e compratori di api</p>";
                $mail->AddAddress($email);
                $mail->Send();
                
                header("location: ../../signin.html");
            } else {
                echo "<p>Qualcosa è andato storto, riprova più tardi!!!</p>";
                echo "<br>";
                echo "<a href='../../index.php'>Pagina iniziale</a>";
            }
        }
    } else {
        echo "<p>Le due password non corrispondono</p>";
        echo "<br>";
        echo "<a href='../../index.php'>Pagina iniziale</a>";
    }
?>