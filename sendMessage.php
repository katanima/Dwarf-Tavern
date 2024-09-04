<?php
require("session.php");
require("db.php");

$content = $_REQUEST["content"];
$userId = $_SESSION["id"];

$sql = "INSERT INTO messages (userId, content";

//define query depends on type of the chat
if( $chatType === "room" ) {

    $roomId = $_REQUEST["id"];
    $sql .= ", roomId) VALUES ($userId, '$content', $roomId)";

} else if( $chatType === "private" ) {

    $profileId = $_REQUEST["id"];
    $sql .= ", receiverId) VALUES ($userId, '$content', $profileId)";
}

if( $conn->query($sql) == TRUE ) {

    echo "success";

} else {

    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>