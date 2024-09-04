
<?php
if( !isset($_SESSION["login"]) ) {

    require("session.php");
    require("db.php");

    $roomId = $_REQUEST["roomId"];
}

$sql = "SELECT userId, content, date FROM messages WHERE $roomId = roomId ORDER BY date";
$result = $conn->query($sql);

while( $message = $result->fetch_object() ) {

    $userSql = "SELECT nick FROM users WHERE id={$message->userId}";
    $profile = $conn->query($userSql)->fetch_object();

    echo "<p><a href='profile.php?id={$message->userId}'>{$profile->nick}</a> $message->content </p>";
}
?>