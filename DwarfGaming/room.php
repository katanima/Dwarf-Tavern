<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokój</title>
    <link rel="stylesheet" href="general.css">
</head>
<body>
<?php
    require("menu/menu.php");

    $id = $_POST["id"];
    $sql = "SELECT * FROM rooms WHERE id=$id";
    $result = $conn->query($sql);
    $room = $result->fetch_object();

    $nameSql = "SELECT title FROM games WHERE id={$room->gameId}";
    $gameName = $conn->query($nameSql)->fetch_object()->title;

    echo "<h3>{$room->name}</h3>
    <p>{$room->description}</p>
    <p>{$room->userAmount}/{$room->maxAmount}</p>
    <p>{$room->date}</p>";
?>
<div>
    <textarea name="tresc" id="tresc" rows="4" cols="50"></textarea>
</div>
</body>
</html>