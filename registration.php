<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="general.css">
</head>
<body>

<?php
require("db.php");

if (isset($_POST["login"])) {

    $login = $_POST["login"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $sql = "INSERT INTO users (login, nick, password, email) VALUES ('$login', '$login', '" . md5($password) . "', '$email')";
    $result = $conn->query($sql);

    if ($result) {

        echo "<div class='messageBox'>";
            echo "<h4>Zostałeś pomyślnie zarejestrowany.</h4>";
            echo "<p>Kliknij tutaj, aby się <a href='login.php'>zalogować</a></p>";
        echo "</div>";
    } else {

        echo "<div class='messageBox'>";
            echo "<h4>Nie wypełniłeś wymaganych pól.</h4>";
            echo "<p>Kliknij tutaj, aby ponowić próbę <a href='registration.php'>rejestracji</a></p>";
        echo "</div>";
    }
} else {

    ?>
    <form class="form" method="post">
        <h1>Rejestracja</h1>
        <input type="text" name="login" placeholder="Login" required/>
        <input type="password" name="password" placeholder="Hasło" required/>
        <input type="text" name="email" placeholder="Adres email" required/>
        <input type="submit" name="submit" value="Zarejestruj się">
        <p><a href="login.php">Zaloguj się</a></p>
    </form>
    <?php
}
?>
</body>
</html>