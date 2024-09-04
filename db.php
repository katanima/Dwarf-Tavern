<?php
    $conn = new mysqli("localhost", "root", "", "partygamez");
    
    if ($conn->connect_error) {

        exit("Connection failed: " . $conn->connect_error);
    }
?>