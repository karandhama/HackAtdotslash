<?php
    $username = 'root';
    $password = '';
    $host = 'localhost';
    $db = 'e-campus';

    $conn = mysqli_connect($host,$username,$password,$db);
    if ($conn->connect_error) {
        die("Connection Error ".$conn->connect_error);
    }
?>