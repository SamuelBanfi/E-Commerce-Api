<?php
    /** 
     * https://github.com/PHPMailer/PHPMailer/blob/master/examples/smtp.phps
     * https://www.geeksforgeeks.org/how-to-send-an-email-using-phpmailer/
     * This class is used to send mails to users when a new offer is created.
     * The phpmailer example is a standard to send mails with SMTP.
     */

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require './vendor/autoload.php';
    require "server_config.php";

    session_start();

    $name = $_POST["name"];
    $description = $_POST["description"];
    $image = "";
    $user_id = $_SESSION["id"];
    $product = $_POST["product"];
    $district = $_POST["district"];
    $type = $_POST["type"];

    $product_id = $conn->query("SELECT id FROM prodotto WHERE nome='$product'");
    $district_id = $conn->query("SELECT id FROM distretto WHERE nome='$district'");
    $product_result = $product_id->fetch_array();
    $district_result = $district_id->fetch_array();

    if (!empty($_FILES["image"]["name"])) {
        // Refactor the image path  
        $file_name = basename($_FILES["image"]["name"]); 
        $extension = pathinfo($file_name, PATHINFO_EXTENSION); 
         
        $types = array('jpg','png','jpeg');

        // Check if image extension is contained in the array of types allowed 
        if (in_array($extension, $types)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 

            // Replace special character with \<special>
            $name = str_replace("'", "\'", $name);
            $name = str_replace(";", "\;", $name);
            $description = str_replace("'", "\'", $description);
            $description = str_replace(";", "\;", $description);
 
            // Query if inserction is a offer
            $add_offer_query = "INSERT INTO vendita(nome, descrizione, immagine, utente_id, prodotto_id, distretto_id)
            VALUES('$name', '$description', '$image', $user_id, " . $product_result["id"] . ", " . $district_result["id"] . ")";

            // Query if inserction is a request
            $add_request_query = "INSERT INTO richiesta(nome, descrizione, immagine, utente_id, prodotto_id, distretto_id)
            VALUES('$name', '$description', '$image', $user_id, " . $product_result["id"] . ", " . $district_result["id"] . ")";

            $insert_query = $type == "Offerta" ? $add_offer_query : $add_request_query;

            if ($conn->query($insert_query)) {
                if ($type == "Offerta") {
                    $get_match_request_email = "SELECT utente.email AS mail,richiesta.nome AS rnome
                                                FROM richiesta,utente
                                                WHERE richiesta.utente_id=utente.id
                                                AND richiesta.prodotto_id=" . $product_result["id"] . "
                                                AND richiesta.distretto_id=" . $district_result["id"];

                    $match = $conn->query($get_match_request_email);
                    
                    // Send mail to each user that search the same product in the same district.
                    while ($row = $match->fetch_assoc()) {
                        $mail = new PHPMailer(); // create a new object
                        $mail->IsSMTP(); // enable SMTP
                        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages
                        $mail->SMTPAuth = true; // authentication enabled
                        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = 465; // or 587
                        $mail->IsHTML(true);
                        $mail->Username = "beecommerce2021@gmail.com";
                        $mail->Password = "Password&1";
                        $mail->SetFrom("beecommerce2021@gmail.com");
                        $mail->Subject = "Nuova offerta per " . $row["rnome"];
                        $mail->Body = "<p>$description</p>";
                        $mail->AddAddress($row["mail"]);
                        $mail->Send();
                    }
                }

                header("location: ../../index.php");
            } else {
                echo "<p>Qualcosa è andato storto. Riprova più tardi</p>";
                echo "<br>";
                echo "<a href='../../index.php'>Pagina iniziale</a>";
            } 
        }else{ 
            echo 'Sorry, only JPG, JPEG, PNG allowed'; 
        } 
    }else{ 
        echo 'Please select an image file to upload.'; 
    }
?>