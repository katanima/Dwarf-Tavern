<?php
    require("session.php");
    require("db.php");

    $roomId = $_REQUEST["roomId"];
    $userId = $_SESSION["id"];

    $sql = "SELECT usersLimit, strictLimit, password FROM rooms WHERE Id=$roomId";
    $room = $conn->query($sql)->fetch_object();

    //check if user is banned
    $sql = "SELECT isBanned FROM usersInRooms WHERE userId=$userId AND roomId=$roomId";
    if( mysqli_num_rows($result = $conn->query($sql)) > 0 && $result->isBanned == true ) {

        echo "banned";
        exit;
    }

    //check if room is not full
    if( $room->strictLimit == true ) {

        $sql = "SELECT id FROM userInRooms WHERE roomId=$roomId";
        $result = $conn->query($sql);

        $userCounter = 0;
        while( $result->fetch_object() ) {

            ++$userCounter;
        }

        if( $userCounter >= $room->limit ) {

            echo "full";
            exit;
        }
    }
    
    //check if room has password
    if( $room->password != "" ) {

        if( !(isset($_REQUEST["password"]) && md5( $_REQUEST["password"] ) == $room->password) ) {

            echo "password";
            exit;
        }
    }

    $sql = "INSERT INTO usersInRooms (userId, roomId) VALUES ($userId, $roomId)";
    $conn->query($sql);

?>