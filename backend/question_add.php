<?php
    include("database.php");
    $output = '';
    if(isset($_POST['question'])) {
        $question = $_POST['question'];
        $sql = "INSERT INTO questions(Question) VALUES('$question')";
        $result = mysqli_query($conn,$sql);

        if($result) {
            $output .= 'Question has been added';
        }
    }
    echo $output;
?>