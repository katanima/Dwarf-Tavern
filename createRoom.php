<?php
    require("db.php");
    require("session.php");

    $name = $_POST["name"];
    $usersLimit = $_POST["usersLimit"];
    $gameId = $_POST["gameId"];
    $roomNumber = $_POST["roomNumber"];
    $userId = $_SESSION["id"];

    /* define a query */
    $sql = "INSERT INTO rooms (ownerId, usersLimit, gameId, roomNumber, name";
    if( isset($_POST["strictLimit"]) ) $sql .= ", strictLimit";
    if( isset($_POST["password"]) ) $sql .= ", password";
    if( isset($_POST["description"]) ) $sql .= ", description";
    $sql .= ") VALUES ($userId, $usersLimit, $gameId, $roomNumber, '$name'";
    if( isset($_POST["strictLimit"]) ) $sql .= ", 1";
    if( isset($_POST["password"]) ) $sql .= ", '" . md5($_POST["password"]) . "'";
    if( isset($_POST["description"]) ) {

        $description = $_POST["description"];
        $sql .= ", '$description'";
    }
    $sql .= ")";
    $conn->query($sql);

    /*
    $sql = "SELECT SCOPE_IdENTITY() FROM rooms";
    $roomId = $conn->query($sql);
    $sql = "INSERT INTO usersInRoom (userId, roomId) VALUES ($userId, $roomId)";
    $conn->query($sql);
    header( "Location: ./room.php?roomId=$roomId" )
    */

    header( "Location: ./rooms.php" )
?>