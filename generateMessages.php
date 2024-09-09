
<?php
if( !isset($_SESSION["login"]) ) {

    require("session.php");
    require("db.php");
}

$userId = $_SESSION["id"];
$chatType = $_POST["chatType"];

$sql = "SELECT userId, content, date FROM messages";

//define query depends on type of the chat
if( $chatType === "room" ) {

    $roomId = $_POST["id"];
    $sql .= " WHERE $roomId = roomId ORDER BY date";

} else if( $chatType === "private" ) {

    $profileId = $_POST["id"];
    $sql .= " WHERE receiverId=$userId AND userId=$profileId OR receiverId=$profileId AND userId=$userId ORDER BY date";
}

$result = $conn->query($sql);


while( $message = $result->fetch_object() ) {

    $userSql = "SELECT nick FROM users WHERE id={$message->userId}";
    $profile = $conn->query($userSql)->fetch_object();

    echo "<p><a href='profile.php?id={$message->userId}'>{$profile->nick}</a>$message->content</p>";
}
?>