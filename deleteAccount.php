<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    require("menu.php");

    $userId = $_POST["userId"];

    if( isset($_POST["agreed"]) ) {

        $sql = "DELETE FROM users WHERE id=$userId";
        $conn->query($sql);
        header( "Location: index.php" );
    }

    if( $password = isset($_POST["password"]) ) {

        $sql = "SELECT password FROM users WHERE id=$userId";
        $correctPassword = $conn->query($sql)->fetch_object()->password;
        echo $correctPassword . "            " . $password;

        if( $correctPassword == md5($password) ) {


            echo "<h1>Czy na pewno chcesz kontynuować?</h1>";
            echo "<h2>Twoje konto zostanie nieodwracalnie usunięte.</h2>";

            echo "<form method='POST'>";
                echo "<input type='hidden' name='userId' value='$userId'>";
                echo "<input type='hidden' name='agreed' value='1'>";
                echo "<input type='submit' value='TAK, USUŃ KONTO'>";
            echo "</form>";

            echo "<form action='profile.php'>";
            echo "<input type='submit' value='NIE, NIE CHCĘ'>";
        }

    } else {

        echo "<h1>Potwierdź wykasowanie konta hasłem</h1>";
        echo "<form method='POST'>";
            echo "<input type='hidden' name='userId' value='$userId'>";
            echo "<input type='text' name='password' placeholder='Hasło'>";
            echo "<input type='submit' value='USUŃ'>";
        echo "</form>";
    }
?>
</body>
</html>