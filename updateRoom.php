<?php
    require("session.php");
    require("db.php");
    $ownerNickname = $_REQUEST["ownerNickname"];

    $roomID = $_REQUEST["roomID"];
    $roomName = $_REQUEST["roomName"];
    $roomDescription = $_REQUEST["roomDescription"];
    $roomGame = $_REQUEST["roomGame"];
    $roomLimit = $_REQUEST["roomLimit"];
    $roomStrictLimit = $_REQUEST["roomStrictLimit"];

    $sql = "UPDATE rooms SET name='$roomName', description='$roomDescription', usersLimit=$roomLimit, strictLimit=$roomStrictLimit, gameID=$roomGame WHERE ID=$roomID";
    echo $sql;
    $conn->query($sql);

    $sql = "SELECT * FROM rooms WHERE $roomID = id";
    $result = $conn->query($sql);
    $room = $result->fetch_object();
    
    echo "<h2> {$room->name}</h2>";
    echo "<p>Opis {$room->description}</p>";
    echo "<p>Właściciel {$ownerNickname}</p>";
    echo "<p>Gra {$gameName}</p>";
    echo "<p>Data utworzenia {$room->date}</p>";
?>