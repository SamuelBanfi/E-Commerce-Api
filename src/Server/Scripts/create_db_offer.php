<?php
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
        $file_name = basename($_FILES["image"]["name"]); 
        $extension = pathinfo($file_name, PATHINFO_EXTENSION); 
         
        $types = array('jpg','png','jpeg','gif');

        if (in_array($extension, $types)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
 
            $add_offer_query = "INSERT INTO vendita(nome, descrizione, immagine, utente_id, prodotto_id, distretto_id)
            VALUES('$name', '$description', '$image', $user_id, " . $product_result["id"] . ", " . $district_result["id"] . ")";
            $add_request_query = "INSERT INTO richiesta(nome, descrizione, immagine, utente_id, prodotto_id, distretto_id)
            VALUES('$name', '$description', '$image', $user_id, " . $product_result["id"] . ", " . $district_result["id"] . ")";

            $insert_query = $type == "Offerta" ? $add_offer_query : $add_request_query;

            if ($conn->query($insert_query)) {
                header("location: ../../index.php");
            } else {
                echo "<p>Qualcosa è andato storto. Riprova più tardi</p>";
                echo "<br>";
                echo "<a href='../../index.php'>Pagina iniziale</a>";
            } 
        }else{ 
            echo 'Sorry, only JPG, JPEG, PNG'; 
        } 
    }else{ 
        echo 'Please select an image file to upload.'; 
    }
?>