<?php
    include("database.php");
    if (isset($_POST['add'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM students where Email = '$email' and Password = '$password'";
        $query = mysqli_query($conn,$sql);
        $output = '';
        if($query) {
            $row = mysqli_fetch_array($query);
            if($row['Email']== $email && $row['Password']==$password) {
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