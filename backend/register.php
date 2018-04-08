<?php
    include("database.php");
    if (isset($_POST['add'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "INSERT INTO students(Email,Password) VALUES('$email','$password')";
        $query = mysqli_query($conn,$sql);
        $output = '';
        if($query) {
            if($query) {
                $output .= 'success';
                session_start();
                $_SESSION['email'] = $email;
            }
            else {
                $output .= 'failed';
            }
        }
        echo $output;
    }
?>