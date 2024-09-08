<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class='main'>
<?php
    require("menu.php");

    $id = $_SESSION["id"];

    $sql = "SELECT content, receiverId, userId FROM messages WHERE (receiverId=$id OR userId=$id) AND roomId=NULL ORDER BY receiverId";

    echo "<p>$sql</p>";
    $result = $conn->query($sql);

    while( $message = $result->fetch_object() ) {

        echo "<p>{$message->content}</p>";
    }
?>
</div>
</body>
</html>