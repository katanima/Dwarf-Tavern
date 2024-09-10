<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmiana hasła</title>
</head>

<body>
<?php
require("db.php");
require("session.php");

if (isset($_POST["password"])) {

    $login = $_SESSION["login"];
    $password = $_POST["password"];

    $sql = "UPDATE users SET password = '" . md5($password) ."' WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result) {

        echo "<div class='form'>";
        echo "<h3> Pomyślnie zmieniono hasło. </h3><br/>";
        echo "<p class='link'><a href='profile.php'> Wróć na stronę profilu. </a></p>";
        echo "</div>";
    } else {

        echo "<div class='form'>";
        echo "<h3> Wystąpił błąd. </h3><br/>";
        echo "<p class='link'><a href='changePassword.php'> Ponów próbę. </a></p>";
        echo "</div>";
    }
} else {

    ?>
    <form class="form" method="post">
        <h1 class="login-title"> Zmiana hasła </h1>
        <input type="password" class="login-input" name="password" placeholder="Hasło" required/>
        <input type="submit" name="submit" value="Zmień hasło" class="login-button">
    </form>
    <?php
}
?>
</body>
</html>