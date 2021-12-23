<?php
    require "./Server/Scripts/server_config.php";
    session_start();

    if (isset($_SESSION["id"])) {
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Crea Offerta | E-Commerce Api</title>
                <link rel="stylesheet" href="./Styles/header.css">
                <link rel="stylesheet" href="./Styles/offers.css">
            </head>
            <body>
                <?php require "./Models/header.php"?>
                <main>
                    <form action="./Server/Scripts/create_db_offer.php" method="POST" enctype="multipart/form-data">
                        <div id="content">
                            <div id="image">
                                <input type="file" name="image">
                            </div>
                            <br>
                            <h3>Nome</h3>
                            <input type="text" name="name" id="name" required>
                            <br>
                            <h3>Descrizione</h3>
                            <textarea name="description" id="description"></textarea>
                            <br>
                            <h3 id="product-title">Prodotto</h3>
                            <input list="products" name="product" id="product" required>
                            <datalist id="products">
                                <?php
                                    // Fetch all products to produce dropdown options.
                                    $products_query = "SELECT id, nome
                                                        FROM prodotto";
                                    
                                    $result = $conn->query($products_query);
    
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
                                    }
                                ?>
                            </datalist>
                            <br>
                            <h3 id="district-title">Distretto</h3>
                            <input list="districts" name="district" id="district" required>
                            <datalist id="districts">
                                <?php
                                    // Fetch all districts to produce dropdown options.
                                    $districts_query = "SELECT id, nome
                                                        FROM distretto";
                                    
                                    $result = $conn->query($districts_query);
    
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
                                    }
                                ?>
                            </datalist>
                            <br>
                            <h3 id="type-title">Tipo</h3>
                            <input list="types" name="type" id="type">
                            <datalist id="types">
                                <option value="Offerta"></option>
                                <option value="Richiesta"></option>
                            </datalist>
                            <br>
                            <button>PUBBLICA</button>
                        </div>
                    </form>
                </main>
            </body>
        </html>
    <?php 
    } else {
        header("location:./signin.html");
    } 
?>