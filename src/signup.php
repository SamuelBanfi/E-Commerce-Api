<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iscrizione | E-Commerce Api</title>
    </head>
    <body>
        <div class="image-container">

        </div>
        <div class="form-container">
            <form action="./Server/Scripts/create_db_user" method="post">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name">
                <label for="surname">Cognome</label>
                <input type="text" name="surname" id="surname">
                <label for="">Nome utente</label>
                <input type="text" name="username" id="username">
                <label for="mail">E-Mail</label>
                <input type="email" name="mail" id="mail">
                <label for="district">Distretto</label>
                <input list="districts" name="district" id="district">
                <datalist id="districts">
                    <option value="Mendrisio">
                    <option value="Lugano">
                    <option value="Locarno">
                    <option value="Vallemaggia">
                    <option value="Bellinzona">
                    <option value="Riviera">
                    <option value="Blenio">
                    <option value="Leventina">
                </datalist>
                <label for="address"></label>
                <input type="text" name="address" id="address">
            </form>
        </div>
    </body>
</html>