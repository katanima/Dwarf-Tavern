<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomyślnie zaktualizowano profil!</title>
    <link rel="stylesheet" href="general.css">
</head>

<body>
<?php
    require("db.php");
    require("session.php");
    
    $ID = $_SESSION["id"];
    $login = $_SESSION["login"];

    $nick = $_POST["nick"];
    $email = $_POST["email"];
    $bio = $_POST["bio"];
    $pfp = basename( $_FILES["pfp"]["name"] );
    move_uploaded_file( $_FILES["pfp"]["tmp_name"], "./pictures/pfp/$pfp" );
    
    /* update users table */
    $sql = "UPDATE users SET nick='$nick', email='$email', bio='$bio'";
    if( $pfp != "" ) $sql .= ", pfp='$pfp'";
    $sql .= " WHERE login='$login'";
    $conn->query($sql);

    /* insert into usersInterest table */
    $sql = "SELECT id, name FROM interests";
    $result = $conn->query($sql);

    while( $interest = $result->fetch_object() ) {

        $interestID = $interest->id;

        if( isset( $_POST[$interestID] ) ) {

            $sql = "SELECT id FROM usersInterests WHERE userId=$ID AND interestId=$interestID";

            if( mysqli_num_rows($conn->query($sql)) == 0  ) {

                $sql = "INSERT INTO usersInterests (interestId, userId) VALUES ($interestID, $ID)";
                $conn->query($sql);
            }

        } else {

            $sql = "DELETE FROM usersInterests WHERE userId=$ID AND interestId=$interestID";
            $conn->query($sql);
        }
    }

    $conn->close();
?>

    <div class='messageBox'>
        <h4>Pomyślnie zaktualizowano profil!</h4>
        <a href="profile.php">Powrót</a>
    </div>
</body>
</html>
