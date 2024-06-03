<?php
    require("./session/session.php");
    require("db.php");
?>
<div id="menu">
    <div>
        <div id="logo">
            <h1>Dwarf Gaming</h1>
        </div>

        <div id="login">
            <?php
            if(isset($_SESSION['login'])) {

                echo "<p>Rock & Stone, {$_SESSION['login']}!</p>";
                echo "<a href='./session/logout.php'>Wyloguj</a>";
            } else {

                echo "<a href='./session/login.php'>Zaloguj</a>";
            }
            ?>
        </div>
    </div>
    
    <ul id="nav">
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="rooms.php">Pokoje</a></li>
    </ul>
</div>