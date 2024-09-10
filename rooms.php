<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokoje</title>
</head>
<body>

<div class="bg-image"></div>

<div class="main">
    <?php
        require("menu.php");
    ?>
    
    <h4 id="createRoom">Stwórz pokój</h4>
    <div class="createRoom">
        <!-- create room -->
        <?php
            $sql = "SELECT name, website, id FROM games";
            $result = $conn->query($sql);
        ?>

        <form class="createRoom" action="createRoom.php" method="POST">
            <input type="text" name="name" placeholder="Nazwa">
            <input type="text" name="description" placeholder="Opis (opcjonalne)">
            <!-- <input type="text" name="description" placeholder="Hasło (opcjonalne)"> -->
            <input type="number" name="usersLimit" placeholder="Ilość miejsc">
            <input type="checkbox" name="strictLimit" style="display:inline-block;"><label for="strictLimit">Restrykcyjny limit</label><br>
            <select name="gameId">
                <?php
                while( $game = $result->fetch_object() ) {

                    $gameId = $game->id;
                    $gameName = $game->name;
                    $gameWebsite = $game->website;
                        
                    echo "<option value='{$gameId}'>{$gameName} ({$gameWebsite})</option>";
                }
                ?>
            </select>
            <input type="number" name="roomNumber" placeholder="Numer stołu">
            <input type="submit">
        </form>
    </div>



    <h4 id="filter">Filtrowanie</h4>
    <div class="filter">
        <!-- filter -->
        <input type="text" name="roomName" id="roomName" placeholder="Nazwa">
        <input type="checkbox" name="hideFull" id="hideFull"><label for='hideFull'>Ukryj pełne</label>
        <input type='checkbox' name="considerInterests" id='considerInterests'><label for="considerInterests">Uwzględnij zainteresowania</label>
        <button class="refresh">WYSZUKAJ</button>
    </div>
    
    <button class="refresh">ODŚWIEŻ</button>
    <div id="listOfRooms"></div>
</div>

<?php
    require("footer.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="general.js"></script>
</body>
</html>