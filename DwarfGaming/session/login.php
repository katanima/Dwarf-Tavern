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
require("../menu/db.php");
session_start();

if(isset($_POST["login"])) {

    $login = $_POST["login"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE login='$login' AND password='" . md5($password) ."'";
    $result = $conn->query($sql);


    if($result->num_rows == 1) {
        
        $_SESSION["id"] = $result->fetch_object()->id;
        $_SESSION["login"] = $login;
        echo "Zalogowano pomyślnie";
    } else {
        
        echo "<div class='form'>
            <h3>Nieprawidłowy login lub hasło.</h3><br/>
            <p class='link'>Ponów próbę <a href='login.php'>logowania</a>.</p>
            </div>";
    }
} else {
    ?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Logowanie</h1>
        <input type="text" class="login-input" name="login" placeholder="Login" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Hasło"/>
        <input type="submit" value="Zaloguj" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">Zarejestruj się</a></p>
    </form>
    <?php
}
?>

</body>
</html>