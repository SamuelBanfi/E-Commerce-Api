<?php
    require "./Server/Scripts/server_config.php";
    require "./Models/insertion.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home | E-Commerce Api</title>
        <link rel="stylesheet" href="./Styles/header.css">
        <link rel="stylesheet" href="./Styles/insertion.css">
        <link rel="stylesheet" href="./Styles/index.css">
    </head>
    <body>
        <?php require "./Models/header.php"?>
        <main>
            <div class="filters-container">
                <h2>Filtri disponibili</h2>
                <br>
                <hr id="filters-title-underline">
                <br>
                <br>
                <h3>Tipi di prodotto</h3>
                <br>
                <input type="checkbox" id="bee-family-check" onchange="filterProduct(1)" checked>
                <label for="bee-family-check">Famiglia di api</label>
                <br>
                <input type="checkbox" id="core-of-bees-check" onchange="filterProduct(2)" checked>
                <label for="core-of-bees-check">Nucleo di api</label>
                <br>
                <input type="checkbox" id="queen-bees-check" onchange="filterProduct(3)" checked>
                <label for="queen-bees-check">Api regine</label>
                <br>
                <br>
                <h3>Distretti</h3>
                <br>
                <div id="filters-district">
                    <div id="first-four">
                        <input type="checkbox" id="locarno-check" onchange="filterDistrict(3)" checked>
                        <label for="locarno-check">Locarno</label>
                        <br>
                        <input type="checkbox" id="bellinzona-check" onchange="filterDistrict(5)" checked>
                        <label for="bellinzona-check">Bellinzona</label>
                        <br>
                        <input type="checkbox" id="blenio-check" onchange="filterDistrict(7)" checked>
                        <label for="blenio-check">Blenio</label>
                        <br>
                        <input type="checkbox" id="leventina-check" onchange="filterDistrict(8)" checked>
                        <label for="leventina-check">Leventina</label>
                    </div>
                    <div id="second-four">
                        <input type="checkbox" id="riviera-check" onchange="filterDistrict(6)" checked>
                        <label for="riviera-check">Riviera</label>
                        <br>
                        <input type="checkbox" id="vallemaggia-check" onchange="filterDistrict(4)" checked>
                        <label for="vallemaggia-check">Vallemaggia</label>
                        <br>
                        <input type="checkbox" id="lugano-check" onchange="filterDistrict(2)" checked>
                        <label for="lugano-check">Lugano</label>
                        <br>
                        <input type="checkbox" id="mendrisio-check" onchange="filterDistrict(1)" checked>
                        <label for="mendrisio-check">Mendrisio</label>
                    </div>
                </div>
            </div>
            <div class="offers-container">
                <div id="search-box">
                    <input type="search">
                    <button><img src="./Images/search.png" alt="search"></button>
                </div>
                <?php
                    $get_offers_query = "SELECT vendita.nome AS vnome, descrizione, 
                                         immagine, prodotto_id, distretto_id, utente.nome AS unome
                                         FROM vendita JOIN utente
                                         ON vendita.utente_id = utente.id";
                    $result = $conn->query($get_offers_query);
                    while ($row = $result->fetch_assoc()) {
                        createInsertion($row["prodotto_id"], $row["distretto_id"], $row["immagine"], $row["vnome"], $row["descrizione"]);
                    }
                ?>
                <?php
                    $get_requests_query = "SELECT richiesta.nome AS rnome, descrizione,
                                           immagine, prodotto_id, distretto_id, utente.nome AS unome
                                           FROM richiesta JOIN utente
                                           ON richiesta.utente_id = utente.id";
                    $result = $conn->query($get_requests_query);
                    while ($row = $result->fetch_assoc()) {
                        createInsertion($row["prodotto_id"], $row["distretto_id"], $row["immagine"], $row["rnome"], $row["descrizione"]);
                    }
                ?>
            </div>
        </main>
        <script>
            var offers = document.getElementsByClassName("offer-container");

            var beeFamilyCheck = document.getElementById("bee-family-check");
            var coreOfBeesCheck = document.getElementById("core-of-bees-check");
            var queenBeesCheck = document.getElementById("queen-bees-check");

            var locarnoCheck = document.getElementById("locarno-check");
            var bellinzonaCheck = document.getElementById("bellinzona-check");
            var blenioCheck = document.getElementById("blenio-check");
            var leventinaCheck = document.getElementById("leventina-check");
            var rivieraCheck = document.getElementById("riviera-check");
            var vallemaggiaCheck = document.getElementById("vallemaggia-check");
            var luganoCheck = document.getElementById("lugano-check");
            var mendrisioCheck = document.getElementById("mendrisio-check");

            function swapState(filterName, pos, checkbox) {
                for (var i = 0; i < offers.length; i++) {
                    if (offers[i].className.split(" ")[pos] == filterName) {
                        if (checkbox.checked)
                            offers[i].style.display="";
                        else
                            offers[i].style.display="none";
                    }
                }
            }

            function filterProduct(id) {
                switch(id) {
                    case 1:
                        swapState("bee-family", 1, beeFamilyCheck);
                        break;
                    case 2:
                        swapState("core-of-bees", 1, coreOfBeesCheck);
                        break;
                    case 3:
                        swapState("queen-bees", 1, queenBeesCheck);
                        break;
                    default:
                        for (var i = 0; i < offers.length; i++) {
                            offers[i].style.display="none";
                        }
                        break;
                }
            }

            function filterDistrict(id) {
                switch(id) {
                    case 1:
                        swapState("1", 2, mendrisioCheck);
                        break;
                    case 2:
                        swapState("2", 2, luganoCheck);
                        break;
                    case 3:
                        swapState("3", 2, locarnoCheck);
                        break;
                    case 4:
                        swapState("4", 2, vallemaggiaCheck);
                        break;
                    case 5:
                        swapState("5", 2, bellinzonaCheck);
                        break;
                    case 6:
                        swapState("6", 2, rivieraCheck);
                        break;
                    case 7:
                        swapState("7", 2, blenioCheck);
                        break;
                    case 8:
                        swapState("8", 2, leventinaCheck);
                        break;
                    default:
                        for (var i = 0; i < offers.length; i++) {
                            offers[i].style.display="none";
                        }
                        break;
                }
            }
        </script>
    </body>
</html>