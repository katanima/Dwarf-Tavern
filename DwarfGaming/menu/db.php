<?php
    $conn = new mysqli("localhost", "root", "", "partyGamez");
    
    if ($conn->connect_error) {

        exit("Connection failed: " . $conn->connect_error);
    }
?>