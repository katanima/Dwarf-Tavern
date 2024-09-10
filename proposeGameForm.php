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
?>

<h3>Podziel się ciekawą grą</h3>
<form class='gameProp' action="proposeGame.php" method="POST">
    <input type="text" name="name" placeholder="Nazwa gry"> 
    <input type="text" name="website" placeholder="Nazwa strony">
    <input type="text" name="url" placeholder="Url strony">
    <input type="submit" value="WYŚLIJ">
</form>
</div>
    
</body>
</html>