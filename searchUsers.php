<?php
require("session.php");
require("db.php");

$nick = $_POST["nick"];
$interestId = $_POST["interestId"];

$sql = "SELECT id, nick, bio, pfp FROM users";
if( $nick != "" )  $sql .= " WHERE nick LIKE '$nick'";

$users = $conn->query($sql);

while( $user = $users->fetch_object() ) {

    $id = $user->id;
    $nick = $user->nick;
    $bio = $user->bio;
    $pfp = $user->pfp;

    if( $interestId != 0 ) {

        $sql = "SELECT id FROM usersInterests WHERE userId=$id AND interestId=$interestId";

        if( mysqli_num_rows($conn->query($sql)) == 0 ) continue;
    }

    ( $pfp == "" )? $src = "./pictures/defaultProfile.png" : $src = "./pictures/pfp/$pfp";

    echo "<tr>";
        echo "<td><img src='$src' class='smallPfp'></th>";
        echo "<td><a href='profile.php?id=$id'>$nick</a></th>";
        echo "<td>$bio</th>";
    echo "</tr>";
}
?>