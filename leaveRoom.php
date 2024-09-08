<?php
    require("session.php");
    require("db.php");

    $userId = $_SESSION["id"];
    $roomId = $_REQUEST["roomId"];

    $sql = "DELETE FROM usersInRooms WHERE userId=$userId AND roomID=$roomId";
    $conn->query($sql);                                                            

    header( "Location: rooms.php" );
?>