<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wIdth=device-wIdth, initial-scale=1.0">
    <title>Profil</title>
</head>

<body>
<div class='main'>
<?php
    require("menu.php");

    ( isset($_GET["id"]) )? $id = $_GET["id"] : $id = $_SESSION["id"];

    $sql = "SELECT * FROM users WHERE id='$id'";
    $profile = $conn->query($sql)->fetch_object();

    $userId = $_SESSION["id"];

    $profileId = $profile->id;
    $nick = $profile->nick;
    $email = $profile->email;
    $pfp = $profile->pfp;
    $createDate = $profile->createDate;
    $bio = $profile->bio;
    
    echo "<div class='profileContent'>";
    if( isset($_GET["id"]) ) {

        echo "<h3>Profil {$profile->nick}</h3>";
        if( $pfp != "" ) {

            echo "<img class='pfpLarge' src='./pictures/pfp/$pfp' alt=''>";

        } else {

            echo "<img class='pfpLarge' src='./pictures/defaultProfile.png'>";
        }
        echo $bio;


        echo "<h4>Zainteresowania</h4>";
        $sql = "SELECT interestId FROM usersinterests WHERE userId=$id";
        $result = $conn->query($sql);
        
        echo "<ul>";
            while( $row = $result->fetch_object() ) {

                $interestId = $row->interestId;
                $sql = "SELECT name FROM interests WHERE id='$interestId'";
                $interest = $conn->query($sql)->fetch_object();
                echo "<li>{$interest->name}</li>";
            }
        echo "</ul>";
        echo "<p>Członek od: {$createDate}</p>";


        if( $profileId == $userId ) {

            echo "<form metod='POST'>";
                echo "<input type='submit' value='EDYTUJ PROFIL'>";
            echo "</form>";

        } else {

            //private chat
            echo "<button id='privateChatButton'>Otwórz chat</button>";
            echo "<div class='privateChat'>";
                echo "<div id='messages'>";
                    require("generateMessages.php");
                echo "</div>";
                echo "<br><textarea id='messageContent' rows='4' cols='50'></textarea>";
                echo "<button id='sendMessage' data-id='$profileId' data-chatType='room'>SEND</button>";
            echo "</div>";
        }


    } else {

        echo "<h3>Mój profil</h3>";
        if( $pfp != "" ) {

            echo "<img class='pfpLarge' src='./pictures/pfp/$pfp' alt=''>";

        } else {

            echo "<img class='pfpLarge' src='./pictures/defaultProfile.png'>";
        }

        //edit profile inputs
        echo "<form action='updateProfile.php' method='post' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='oldPfp' value='$pfp'>";
            echo "<input type='file' name='pfp'>";
            
            echo "<input type='text' name='nick' value='$nick'>";
            echo "<input type='text' name='email' value='$email'>";
            echo "<input type='text' name='bio' value='$bio'>";
            echo "<a href='changePassword.php'>Zmień hasło</a><br>";


            //display interests
            echo "<h3>Zainteresowania</h3>";
            $sql = "SELECT id, name FROM interests";
            $interests = $conn->query($sql);
            while( $interest = $interests->fetch_object() ) {

                $interestName = $interest->name;
                $interestId = $interest->id;
                $sql = "SELECT id FROM usersinterests WHERE userId=$id AND interestId=$interestId";

                $line = "<input type='checkbox' name='$interestId' style='display:inline-block;'";
                $result = $conn->query($sql);
                if( mysqli_num_rows( $result ) != 0 ) $line .= " checked";
                $line .= ">";

                echo $line;
                echo "<label for='$interestName'> $interestName </label></br>";
            }
            
            echo "<input type='submit' value='EDYTUJ'>";
        echo "</form>";
        
        //preview profile
        echo "<form method='GET'>";
            echo "<input type='hidden' name='id' value='$profileId'>";
            echo "<input type='submit' value='ANULUJ'>";
        echo "</form>";

        //delete account
        echo "<form action='deleteAccount.php' method='POST'>";
            echo "<input type='hidden' name='userId' value='$userId'>";
            echo "<input type='submit' value='DELETE ACCOUNT'>";
        echo "</form>";
    }
    echo "</div>";
?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="general.js"></script>
</body>
</html>