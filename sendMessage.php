<?php
    require("session.php");
    require("db.php");

    $content = $_REQUEST["content"];
    $roomId = $_REQUEST["roomId"];
    $userId = $_SESSION["id"];

    $sql = "INSERT INTO messages (roomId, userId, content) VALUES ($roomId, $userId, '$content')";

    if( $conn->query($sql) == TRUE ) {

        echo "success";

    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>