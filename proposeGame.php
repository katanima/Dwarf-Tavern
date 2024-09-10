<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaproponuj grę</title>
</head>
<body>
<div class='main'>
<?php
    require("menu.php");

    $userId = $_SESSION["id"];
    $name = $_POST["name"];
    $website = $_POST["website"];
    $url = $_POST["url"];

    $sql = "INSERT INTO proposedGames (userId, name, website, url) VALUES ($userId, '$name', '$website', '$url')";
    $conn->query($sql);
?>
    <h2>Dziękujemy za propozycję <3</h2>

</div>

</body>
</html>