<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokoje</title>
    <link rel="stylesheet" href="general.css">
</head>
<body>
<?php
    require("menu/menu.php");
?>

<div class="main">
    <div class="sideBar">
        <form action="rooms.php" method="get">
            <p>Filtrowanie</p>
            Nazwa <input type="text" name="roomName" id="roomName">
            Nie zapełnione <input type="checkbox" name="searchForNotFull">
            <input type="submit">
        </form>


        <?php
            $sql = "SELECT title, id FROM games";
            $result = $conn->query($sql);
        ?>
        <p class="createButton">Stwórz pokój</p>
        <input type="text" name="name" placeholder="Nazwa">
        <input type="text" name="description" placeholder="Opis (opcjonalnie)">
        <input type="number" name="maxAmount" placeholder="Limit">
        <select name="" id="">
        <?php
            while($game = $result->fetch_object()) {
                
                echo "<option value='{$game->id}'>{$game->title}</option>";
            }
        ?>
        </select>
    </div>

    <div class="mainContent">
    <?php

        $sql = "SELECT * FROM rooms";
        
        if( isset($_GET['roomName']) && $_GET['roomName'] != "" ) $sql .= " WHERE name='{$_GET['roomName']}'";

        echo $sql;
        $result = $conn->query($sql);

        if($result->num_rows > 0) {

            echo "<table>
            <tr>
            <th>Gra</th>
            <th>Nazwa</th>
            <th>Opis</th>
            <th>Krasnoludów</th>
            <th>Godzina założenia</th>
            </tr>";

            while($room = $result->fetch_object()) {

                $nameSql = "SELECT title, link FROM games WHERE id={$room->gameId}";
                $game = $conn->query($nameSql)->fetch_object();

                echo "<tr>
                <td><a href='{$game->link}' target='_blank'>{$game->title}</a></td>
                <td>{$room->name}</td>
                <td>{$room->description}</td>
                <td>{$room->userAmount}/{$room->maxAmount}</td>
                <td>{$room->date}</td>";
                
                if($room->userAmount < $room->maxAmount) {

                    echo "<td><form action='room.php' method='post'><button name='id' value='{$room->id}'>Dołącz</button></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
    </div>
</div>
</body>
</html>