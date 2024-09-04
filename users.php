<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="main users">
<?php
    require("menu.php");
?>

<h2>Wyszukaj krasnoluda po nazwie i/lub zainteresowaniu</h2>
<input type="text" placeholder="nick" id="nick">
<select name="interest" id="interest">

    <option value="0"></option>
    <?php
        $sql = "SELECT id, name FROM interests";
        $result = $conn->query($sql);

        while( $interest = $result->fetch_object() ) {

            echo "<option value='$interest->id'>$interest->name</option>";
        }
    ?>
</select>
<input type="submit" id="submit">

<div id="userList"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="general.js"></script>
</body>
</html>