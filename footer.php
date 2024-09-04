<div class="footer">
    <ul id="nav">
        <li><a href="proposeGameForm.php">ZAPROPONUJ GRĘ</a></li>
        <?php
        $userId = $_SESSION["id"];
        $sql = "SELECT role FROM users WHERE id=$userId";
        $role = $conn->query($sql)->fetch_object()->role;
        if( $role == 1 )
            echo "<li><a href='adminPanel.php'>ADMINISTRATION</a></li>";
        ?>
    </ul>
</div>