<?php
    include("database.php");
    if($_GET['department']) {
        $department = $_GET['department'];
        $subject = $_GET['subject'];

        $sql = "SELECT * FROM videos WHERE Dept_name = '$department' AND Subject_name = '$subject'";
        $result = mysqli_query($conn,$sql);
        $empty = 0;
        if(mysqli_num_rows($result)==0) {
            $empty = 1;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Videos</title>
    <link href="https://fonts.googleapis.com/css?family=Padauk" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/videolectures.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div id="header">
            <h2><?php echo $subject; ?> Video Lectures</h2>
            <a href="../app/computer.html">Back</a>
        </div>
        <div id="main">
            <p style="padding-top:1%;"><?php if($empty==1) echo "No Videos available" ?></p>
            <?php
                if($empty==0) {
                    while($row = mysqli_fetch_array($result)) { ?>
                        <div id="video_div">
                            <video width="320" height="240" controls>
                                <source src='../video/<?php echo $department; ?>/<?php echo $subject."/".$row['video_name']; ?>' type="video/mp4">
                            </video>
                        </div>
                    <?php }
                }
            ?>
        </div>
    </div>
</body>
</html>