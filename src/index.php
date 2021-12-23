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
        <link rel="stylesheet" href="./Styles/checkbox.css">
        <!--<link rel="stylesheet" href="./Styles/dropdown.css">-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
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
                <div class="control-group">
                    <label class="control control-checkbox">
                        Famiglia di api
                        <input type="checkbox" id="bee-family-check" onchange="filterProduct(1)" checked>
                    <div class="control_indicator"></div>
                    </label>
                    <label class="control control-checkbox">
                        Nucleo di api
                        <input type="checkbox" id="core-of-bees-check" onchange="filterProduct(2)" checked>
                    <div class="control_indicator"></div>
                    </label>
                    <label class="control control-checkbox">
                        Ape regina
                        <input type="checkbox" id="queen-bees-check" onchange="filterProduct(3)" checked>
                    <div class="control_indicator"></div>
                    </label>
                </div>
                <br>
                <br>
                <h3>Distretti</h3>
                <br>
                <div id="filters-district">
                    <div id="first-four">
                        <div class="control-group">
                            <label class="control control-checkbox">
                                Locarno
                                <input type="checkbox" id="locarno-check" onchange="filterDistrict(3)" checked>
                            <div class="control_indicator"></div>
                            </label>
                            <label class="control control-checkbox">
                                Bellinzona
                                <input type="checkbox" id="bellinzona-check" onchange="filterDistrict(5)" checked>
                            <div class="control_indicator"></div>
                            </label>
                            <label class="control control-checkbox">
                                Blenio
                                <input type="checkbox" id="blenio-check" onchange="filterDistrict(7)" checked>
                            <div class="control_indicator"></div>
                            </label>
                            <label class="control control-checkbox">
                                Leventina
                                <input type="checkbox" id="leventina-check" onchange="filterDistrict(8)" checked>
                            <div class="control_indicator"></div>
                            </label>
                        </div>
                    </div>
                    <div id="second-four">
                        <div class="control-group">
                            <label class="control control-checkbox">
                                Riviera
                                <input type="checkbox" id="riviera-check" onchange="filterDistrict(6)" checked>
                            <div class="control_indicator"></div>
                            </label>
                            <label class="control control-checkbox">
                                Vallemaggia
                                <input type="checkbox" id="vallemaggia-check" onchange="filterDistrict(4)" checked>
                            <div class="control_indicator"></div>
                            </label>
                            <label class="control control-checkbox">
                                Lugano
                                <input type="checkbox" id="lugano-check" onchange="filterDistrict(2)" checked>
                            <div class="control_indicator"></div>
                            </label>
                            <label class="control control-checkbox">
                                Mendrisio
                                <input type="checkbox" id="mendrisio-check" onchange="filterDistrict(1)" checked>
                            <div class="control_indicator"></div>
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <h3>Tipologia</h3>
                <br>
                <label class="control control-checkbox">
                    Offerta
                    <input type="checkbox" id="sell-check" onchange="filterType(1)" checked>
                <div class="control_indicator"></div>
                </label>
                <label class="control control-checkbox">
                    Richiesta
                    <input type="checkbox" id="request-check" onchange="filterType(2)" checked>
                <div class="control_indicator"></div>
                </label>
            </div>
            <div class="offers-container">
                <div id="search-box">
                    <input type="search" id="search">
                    <button><img src="./Images/search.png" alt="search"></button>
                </div>
                <?php
                    // returns all sales present in the vendita table of the database.
                    $get_offers_query = "SELECT vendita.nome AS vnome, descrizione, 
                                         immagine, prodotto_id, distretto_id, utente.nome AS unome
                                         FROM vendita JOIN utente
                                         ON vendita.utente_id = utente.id";

                    $result = $conn->query($get_offers_query);

                    while ($row = $result->fetch_assoc()) {
                        createInsertion($row["prodotto_id"], $row["distretto_id"], "sell", $row["immagine"], $row["vnome"], $row["descrizione"]);
                    }
                ?>
                <?php
                    // returns all requests present in the richiesta table of the database.
                    $get_requests_query = "SELECT richiesta.nome AS rnome, descrizione,
                                           immagine, prodotto_id, distretto_id, utente.nome AS unome
                                           FROM richiesta JOIN utente
                                           ON richiesta.utente_id = utente.id";

                    $result = $conn->query($get_requests_query);

                    while ($row = $result->fetch_assoc()) {
                        createInsertion($row["prodotto_id"], $row["distretto_id"], "request", $row["immagine"], $row["rnome"], $row["descrizione"]);
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

            var sellCheck = document.getElementById("sell-check");
            var requestCheck = document.getElementById("request-check");

            var search = document.getElementById("search");

            /**
             * Change the status of the insertions from visible to hidden based on the class name.
             * @param filterName the class name of the filter to swap
             * @param pos the position of the class name
             * @param checkbox the checkbox which is used to control whether an advertisement should be visible or not
             */
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

            /**
             * It calls the function swapstate setting the position of the class to 1, the product filter.
             * @param id switch 1. bee family 2. core of bees 3. queen bees
             */
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

            /**
             * It calls the function swapstate setting the position of the class to 2, the district filter.
             * @param id switch 1. mendrisio 2. lugano 3. locarno 4. vallemaggia 5. bellinzona 6. riviera 7. blenio 8. leventina 
             */
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

            /**
             * It calls the function swapstate setting the position of the class to 3, the type filter.
             * @param id switch 1. sell 2. request
             */
            function filterType(id) {
                switch(id) {
                    case 1:
                        swapState("sell", 3, sellCheck);
                        break;
                    case 2:
                        swapState("request", 3, requestCheck);
                        break;
                    default:
                        for (var i = 0; i < offers.length; i++) {
                            offers[i].style.display="none";
                        }
                        break;
                }
            }

            /**
             * This function is used to show only insertions that contains search text. 
             */
            function searchInsertion() {
                for (var i = 0; i < offers.length; i++) {
                    offers[i].style.display="";

                    if (!offers[i].textContent.includes(search.value)) {
                        offers[i].style.display="none";
                    }
                }
            }
        </script>
    </body>
</html>