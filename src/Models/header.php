<header>
    <div class="logo-container">
        
    </div>
    <div class="actions">
        <?php
            echo "<a href='./index.php'><img src='./Images/home.png' alt='home' id='home'></a>";
            
            if (!isset($_SESSION["id"])) {
                echo "<a href='./signin.html'><img src='./Images/add.svg' alt='add' id='add'>Aggiungi inserzione</a>";
                echo "<a href='./signin.html'><img src='./Images/handshake.svg' alt='match' id='match'></a>";
                echo "<a href='./signin.html'><img src='./Images/chat.svg' alt='chat' id='chat'></a>";
                echo "<a href='./signin.html'><img src='./Images/login.svg' alt='login' id='login'></a>";
            } else {
                echo "<a href='./offers.php'><img src='./Images/add.svg' alt='add' id='add'>Aggiungi inserzione</a>";
                echo "<a href='./match.php'><img src='./Images/handshake.svg' alt='match' id='match'></a>";
                echo "<a href='./chat.php'><img src='./Images/chat.svg' alt='chat' id='chat'></a>";
                echo "<a href='./profile.php'><img src='" . $_SESSION["image"] . "' alt='profilo' id='login'></a>";
            }
        ?>
    </div>
</header>