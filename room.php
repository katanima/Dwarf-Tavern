<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokój</title>
</head>

<body>
<div class="main">
<?php
    require("menu.php");
    echo "<div class='room'>";
    $userId = $_SESSION["id"];
    $roomId = $_REQUEST["roomId"];
    
    /* description */
    $sql = "SELECT * FROM rooms WHERE $roomId = id";
    $result = $conn->query($sql);
    $room = $result->fetch_object();

    /* get game name */
    $sql = "SELECT name, website, url FROM games WHERE id={$room->gameId}";
    $game = $conn->query($sql)->fetch_object();
    $gameName = $game->name;
    $gameWebsite = $game->website;
    $gameUrl = $game->url;

    /* get owner name */
    $sql = "SELECT nick FROM users WHERE id={$room->ownerId}";
    $roomOwner = $conn->query($sql)->fetch_object()->nick;
    
    /* check if user is owner */
    ( $room->ownerId == $userId )? $isOwner = true : $isOwner = false;

    /* generate informations */
    echo "<div id='roomInformations'>";
        echo "<h2> {$room->name}</h2>";
        echo "<p>Opis {$room->description}</p>";
        echo "<p>Właściciel <a href='profile.php?id={$room->ownerId}'>{$roomOwner}</a></p>";
        echo "<a href='$gameUrl' target='_blank'><p>Gra {$gameName} ($gameWebsite)</a></p>";
        echo "<p>Numer stolika {$room->roomNumber}</p>";
        echo "<p>Data utworzenia {$room->date}</p>";

    /* if user is owner generate description with hidden edit form */
    if( $isOwner == true ) {

        echo "<button id='editButton'>EDYTUJ POKÓJ</button>";

        echo "<div id='editForm' style='display:none;'>";
            echo "<input id='roomName' type='text' value='{$room->name}'>";
            echo "<input id='roomDescription' type='text' value='{$room->description}'>";

            /* generate all games */
            echo "<select id='roomGame' name='gameId'>";
                $sql = "SELECT name, website, id FROM games";
                $result = $conn->query($sql);
                while( $game = $result->fetch_object() ) {

                    echo "<option value='{$game->id}'>{$game->name} ({$game->website})</option>";
                }
            echo "</select>";

            echo "<input id='roomLimit' type='number' value='{$room->usersLimit}'>";
            
            /* generate strict limit checkbox */
            $line = "<input id='roomStrictLimit' type='checkbox' style='display:inline-block;'";
            ( $room->strictLimit == true )? $line .= " checked>" : ">";
            echo $line;
            echo "<label for='roomStrictLimit'>Restrykcyjny limit<label>";
            
            echo "<button id='editRoom' type='submit' data-room='{$roomId}' data-owner='$roomOwner'>Edytuj</button>";
            echo "<p>Data utworzenia {$room->date}</p>";


        echo "</div>";
        
        echo "<form action='leaveRoom.php' method='post'>";
        echo "<input type='hidden' name='roomId' value='$roomId'>";
        echo "<input type='submit' value='OPUŚĆ STOLIK'>";
    echo "</form>";
    }
    echo "</div>";
?>

<!-- chat -->
<div id="chat">
    <h4>Chat</h4>
    <div id="messages"></div>
    
    <br><textarea id="messageContent" rows="4" cols="50"></textarea>
    <button id="sendMessage" data-id="<?php echo $roomId; ?>" data-type='room'>SEND</button>
</div>


<!-- users -->
<div>
    <h4>Users</h4>
    <?php

        $sql = "SELECT userId FROM usersInRooms WHERE roomId=$roomId";
        $result = $conn->query($sql);
        $userCounter = 0;

        echo "<ul>";
            while( $user = $result->fetch_object() ) {

                $sql = "SELECT id, nick FROM users WHERE id=$user->userId";
                $profile = $conn->query($sql)->fetch_object();

                echo "<li><a href='profile.php?id={$profile->id}'> {$profile->nick} </a></li>";
                ++$userCounter;
            }
        echo "</ul>";
        $string = "$userCounter/{$room->usersLimit}";
        if( $room->strictLimit == false ) $string .= " (nierestrykcyjny)";
        echo "<p>$string</p>";
    ?>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="general.js"></script>
</body>
</html>