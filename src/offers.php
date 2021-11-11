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
                <style>
                    body {
                        background-image: url("./Images/Bees/pink_flower.jpg");
                    }

                    form {
                        width: 50%;
                        height: 70vh;
                        margin-left: 25%;
                        margin-right: 25%;
                        border-radius: 15px;
                        bottom: 7vh;
                        padding: 4vh;
                        position: fixed;
                        background-color: rgba(255, 255, 255, 0.9);
                        box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
                    }

                    #content {
                        margin-left: 10vh;
                    }

                    input[type="text"], #product, #district, #type {
                        width: 30vh;
                        height: 4vh;
                        border-radius: 15px;
                    }

                    form #image {
                        width: 25vh;
                        height: 10vh;
                        border: 2px solid black;
                        padding: 1vh;
                    }

                    h3 {
                        margin-bottom: 3vh;
                    }

                    #product-title, #district-title, #type-title {
                        display: inline-block;
                        margin-right: 10px;
                    }
                </style>
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