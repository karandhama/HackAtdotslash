<?php
    include("database.php");
    $sql = "SELECT * FROM questions";
    $result = mysqli_query($conn,$sql);
    $output = '';
    if($result) {
        while ($row = mysqli_fetch_array($result)) {
           $output .= '<p>'.$row['Question'].'</p>';
        }
    }
    echo $output;
?>