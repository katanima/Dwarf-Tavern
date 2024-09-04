<?php
    require("session.php");
    require("db.php");

    $propId = $_POST["propId"];

    if( isset($_POST["accepted"]) ) {

        $name = $_POST["name"];
        $website = $_POST["website"];
        $url = $_POST["url"];

        $sql = "INSERT INTO games (name, website, url) VALUES ('$name', '$website', '$url')";
        $conn->query($sql);
    }

    $sql = "DELETE FROM proposedGames WHERE id=$propId";
    $conn->query($sql);

    header( "Location: adminPanel.php" );
?>