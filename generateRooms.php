<?php
if( !isset($_SESSION["login"]) ) {

    require("session.php");
    require("db.php");
}

$userId = $_SESSION["id"];
$sql = "SELECT * FROM rooms r WHERE id>0";

//filter
if( isset($_REQUEST['roomName'] ) && $_REQUEST['roomName'] != "" ) $sql .= " AND r.name='{$_REQUEST['roomName']}'"; //name
( isset($_REQUEST['hideFull']) )? $hideFull = true : $hideFull = false;
( isset($_REQUEST['considerInterests']) )? $considerInterests = true : $considerInterests = false ;
echo $_REQUEST['considerInterests'];
$result = $conn->query($sql);

/* set first row */
echo "<table>";
echo "<tr>";
    echo "<th>Gra</th>";
    echo "<th>Nazwa</th>";
    echo "<th>Opis</th>";
    echo "<th>Krasnoludów</th>";
    echo "<th>Godzina założenia</th>";
echo "</tr>";

/* if user is in room, generate it */
$sql = "SELECT roomId FROM usersInRooms WHERE userId=$userId AND isBanned=0";
$isUserInRoom = $conn->query($sql);

$userIsInRoom = false;
if( mysqli_num_rows( $isUserInRoom ) > 0 ) {

    $userIsInRoom = true;

    /* get room informations from db */
    $joinedRoomId = $isUserInRoom->fetch_object()->roomId;
    $sql = "SELECT * FROM rooms WHERE id=$joinedRoomId";
    $userRoom = $conn->query($sql)->fetch_object();

    /* check name of the game */
    $nameSql = "SELECT name, website, url FROM games WHERE id={$userRoom->gameId}";
    $game = $conn->query($nameSql)->fetch_object();
    $strictLimit = $userRoom->strictLimit;

    /* check how many users are in the room */
    $sql = "SELECT userId FROM usersInRooms WHERE roomId={$userRoom->id}";
    $users = $conn->query($sql);
    $userCounter = 0;
    while( $user = $users->fetch_object() ) {

        ++$userCounter;
        if( $user->userId == $userId ) $didUserEnter = true;
    }
    /* define information of current users */
    $string = "$userCounter/{$userRoom->usersLimit}";
    if( $strictLimit == false ) $string .= " NR";

    /* generate row */
    echo "<tr>";
        echo "<td><a href='{$game->url}' target='_blank'>{$game->name} ({$game->website})</a></td>";
        echo "<td>{$userRoom->name}</td>";
        echo "<td>{$userRoom->description}</td>";
        echo "<td>$string</td>";
        echo "<td>{$userRoom->date}</td>";
        echo "<td> <button><a href='./room.php?roomId={$userRoom->id}'>WEJDŹ</a></button> </td>";
        echo "<td> <button class='leaveRoom' data-room='{$userRoom->id}'>WYJDŹ</button> </td>";
    echo "</tr>";
    echo "*Możesz przebywać w maksymalnie jednym pokoju";
}

//generate rooms
if( $result->num_rows > 0 ) {

    /* generate other rooms */
    while( $room = $result->fetch_object() ) {
        
        /* check name of the game */
        $nameSql = "SELECT name, website, url FROM games WHERE id={$room->gameId}";
        $game = $conn->query($nameSql)->fetch_object();   
        $strictLimit = $room->strictLimit;

        /* check how many users are in the room */
        $sql = "SELECT id, userId FROM usersInRooms WHERE roomId={$room->id}";


        $users = $conn->query($sql);
        $userCounter = 0;
        $didUserEnter = false;
        $considerInterestsBool = false;

        while( $user = $users->fetch_object() ) {

            //if consider interests was checked check if at least one user in room has same interest
            $sql = "SELECT interestId FROM usersInterests WHERE userId=$userId";

            if( $considerInterests == true && $interests = $conn->query($sql) ) {

                while( $interest = $interests->fetch_object() ) {
                    echo $interests->fetch_object();
                    //&& $considerInterestsBool == false 

                    $sql = "SELECT id FROM usersInterests WHERE userId={$user->id} AND interestId={$interest->interestId}";
                    $ddd = $conn->query($sql)->fetch_object();
                    echo $sql;

                    if( mysqli_num_rows( $ddd ) > 0 ) {

                        $considerInterestsBool = true;
                        break;
                    }
                }
            }
            //count users
            ++$userCounter;
            //flag this room as entered
            if( $user->userId == $userId ) $didUserEnter = true;
        }
        ( $userCounter >= $room->usersLimit )? $limitReached = true : $limitReached = false;

        if( $didUserEnter == true ) continue;
        if( $hideFull == true && $limitReached == true ) continue;
        if( $considerInterests == true && $considerInterestsBool == false ) continue;


        /* define information of current users */
        $string = "$userCounter/{$room->usersLimit}";
        if( $strictLimit == false ) $string .= " NR";


        /* generate columns */
        echo "<tr>";
            echo "<td><a href='{$game->url}' target='_blank'>{$game->name} ({$game->website})</a></td>";
            echo "<td>{$room->name}</td>";
            echo "<td>{$room->description}</td>";
            echo "<td>$string</td>";

            echo "<td>{$room->date}</td>";

            /* if can join, generate button */ 
            if( $userIsInRoom == false && ($strictLimit == false || $limitReached == false) ) {

                echo "<td> <button class='join' data-roomId='{$room->id}'>DOŁĄCZ</button> </td>";
            }
        echo "</tr>";
    }
    echo "</table>";
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="general.js"></script>