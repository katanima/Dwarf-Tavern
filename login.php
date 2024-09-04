<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="general.css">
</head>

<body>
<?php
require("db.php");
session_start();

if(isset($_POST["login"])) {

    $login = $_POST["login"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE login='$login' AND password='" . md5($password) ."'";
    $result = $conn->query($sql);


    if($result->num_rows == 1) {
        
        $_SESSION["id"] = $result->fetch_object()->id;
        $_SESSION["login"] = $login;

        echo "<div class='form'>";
        echo "Zalogowano pomyślnie <br>";
        echo "<a href='index.php'>Wróć na stronę główną</a>";
        echo "</div>";

    } else {
        
        echo "<div class='form'>";
        echo "<h3>Nieprawidłowy login lub hasło.</h3><br/>";
        echo "<p class='link'>Ponów próbę <a href='login.php'>logowania</a>.</p>";
        echo "</div>";
    }
} else {
    ?>
    <form class="form" method="post" name="login">
        <h1>Logowanie</h1>
        <input type="text" name="login" placeholder="Login" autofocus="true"/>
        <input type="password" name="password" placeholder="Hasło"/>
        <input type="submit" value="Zaloguj" name="submit"/>
        <p><a href="registration.php">Zarejestruj się</a></p>
    </form>
    <?php
}
?>

</body>
</html>