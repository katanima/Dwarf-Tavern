<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
<div class='main'>
<?php
    require("menu.php");

    $sql = "SELECT id, userId, name, website, url, date FROM proposedGames";
    $propositions = $conn->query($sql);
    
    echo "<h2>Propozycje gier</h2>";
    echo "<table class='propositions'>";
        echo "<tr>";
            echo "<th>Zaproponowane przez</th>";
            echo "<th>Nazwa gry</th>";
            echo "<th>Nazwa strony</th>";
            echo "<th>Url strony</th>";
            echo "<th>Data wysłania</th>";
        echo "</tr>";
        while( $prop = $propositions->fetch_object() ) {

            $sql = "SELECT login FROM users WHERE id=$prop->userId";
            $user = $conn->query($sql)->fetch_object()->login;

            echo "<tr>";
                echo "<form action='deleteProposition.php' method='POST'>";
                    echo "<input type='hidden' name='accepted'>";
                    echo "<input type='hidden' name='propId' value='{$prop->id}'>";
                    echo "<td>$user</td>";
                    echo "<td><input type='text' name='name' value='{$prop->name}'></td>";
                    echo "<td><input type='text' name='website' value='{$prop->website}'></td>";
                    echo "<td><input type='text' name='url' value='{$prop->url}'></td>";
                    echo "<td>{$prop->date}</td>";
                    echo "<td><input type='submit' value='ZATWIERDŹ'></td>";
                echo "</form>";

                echo "<form action='deleteProposition.php' method='POST'>";
                    echo "<input type='hidden' name='propId' value='{$prop->id}'>";
                    echo "<td><input type='submit' value='ODRZUĆ'></td>";
                echo "</form>";

            echo "</tr>";
        }
    echo "</table>";
?>
</div>
<?php
    require("footer.php");
?>
</body>
</html>