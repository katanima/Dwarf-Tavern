<?php
    $conn = new mysqli("localhost", "root", "", "wwwwwww");
    
    if ($conn->connect_error) {

        exit("Connection failed: " . $conn->connect_error);
    }
?>