<head>
    <link rel="stylesheet" href="general.css">
</head>

<?php
    require("session.php");
    require("db.php");
?>
<div id="topBar">
    <a href="index.php" id="logo"><h1>Dwarf Tavern</h1></a>
    
    <ul id="nav">
        <li><a href="rooms.php">STOŁY</a></li>
        <li><a href="users.php">KRASNOLUDY</a></li>
        <?php
        if(isset($_SESSION['login'])) {

            echo "<li><a href='profile.php?id={$_SESSION['id']}'>PROFIL</a></li>";
            echo "<li><a href='logout.php'>WYLOGUJ</a></li>";
        } else {

            echo "<li><a href='login.php'>Zaloguj</a></li>";
        }
        ?>
    </ul>
</div>