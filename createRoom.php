<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nie powodzenie</title>
    <link rel="stylesheet" href="general.css">
</head>
<body>
<?php
    require("db.php");
    require("session.php");

    if( $_POST["name"] != "" && $_POST["usersLimit"] != "" && $_POST["gameId"] != "" && $_POST["roomNumber"] != "" )  {

        $name = $_POST["name"];
        $usersLimit = $_POST["usersLimit"];
        $gameId = $_POST["gameId"];
        $roomNumber = $_POST["roomNumber"];
        $userId = $_SESSION["id"];

        /* define a query */
        $sql = "INSERT INTO rooms (ownerId, usersLimit, gameId, roomNumber, name";
        if( isset($_POST["strictLimit"]) ) $sql .= ", strictLimit";
        //if( isset($_POST["password"]) ) $sql .= ", password";
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

        header( "Location: ./rooms.php" );
    } else {

        echo "<div class='messageBox'>";
            echo "<h4>Nie wprowadzono wszystkich danych!</h4>";
            echo "<a href='./rooms.php'>Powrót</a>";
        echo "<div>";
    }
?>  
</body>
</html>