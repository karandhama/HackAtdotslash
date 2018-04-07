<?php
    include("database.php");
    if(isset($_POST['upload_button'])) {
        $dept_name = $_POST['dept_name'];
        $dept_name = str_replace(' ', '', $dept_name);
        $subject_name = $_POST['subject_name'];
        $subject_name = str_replace(' ', '', $subject_name);
        $lecture_name = $_POST['lecture_name'];

        if(!file_exists("../video/".$dept_name)) {
            mkdir("../video/".$dept_name);
        }
        if(!file_exists("../video/".$dept_name."/".$subject_name)) {
            mkdir("../video/".$dept_name."/".$subject_name);
        }
        $target = "../video/".$dept_name."/".$subject_name."/";
        $test = explode('.',$_FILES['file']['name']);
        $extension = end($test);
        $link_name = $lecture_name.'.'.$extension;
        $target_file = $target . $link_name;
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($FileType != "mp4" && $FileType != "avi" && $FileType != "mov" && $FileType != "3gp" && $FileType != "mpeg")
        {
            echo '<script>alert("File format not supported");</script>';
        }
        else {
            $sql = "INSERT INTO Videos(Dept_name,Subject_name,Lecture_name,video_name) VALUES('$dept_name','$subject_name','$lecture_name','$link_name')";
            $result = mysqli_query($conn,$sql);
            if($result) {
                echo '<script>alert("Inserted");</script>';
                move_uploaded_file($_FILES["file"]["tmp_name"],$target_file);
            }
            else {
                echo mysqli_error($conn);
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Videos</title>
    <link href="https://fonts.googleapis.com/css?family=Padauk" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/videolectures.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div id="header">
            <h2>Upload Videos</h2>
        </div>
        <div id="main">
            <div id="upload_form">
                <form method="post" action="#" enctype="multipart/form-data">
                    <table id="upload_table">
                        <tr>
                            <th>
                                <select name="dept_name" id="dept_name">
                                    <option>Computer Department</option>
                                    <option>Electronics Department</option>
                                    <option>Mechanical Department</option>
                                    <option>Electrical Department</option>
                                    <option>Civil Department</option>
                                    <option>Chemical Department</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <select id="subject_name" name="subject_name">

                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input type="text" name="lecture_name" id="lecture_name" placeholder="Enter the Lecture name">
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input type="file" name="file" id="file">
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <button id="upload_button" name="upload_button">Upload Video</button>
                            </th>
                        </tr>
                    </table>
                </form>
            </div>
            <div>
                <a href="../app/videolectures.html">Back</a>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        var department = ['ComputerDepartment','ElectronicsDepartment','MechanicalDepartment','EletricalDepartment',
        'CivilDepartment','ChemicalDepartment'];

        department['Computer Department'] = ['Computer Organization','DBMS','Data Structures & Algorithms',
        'Theoretical Computer Science','Microprocessor and Interfacing Techniques','Design and Analysis of Algorithms','AIML','Computer Networks',
        'Operating Systems','System Software','Computer Graphics','ITA','Software Engineering','Cryptography and Network Security','Principles of Programming Language',
        'Distributed Algorithms'];

        department['Mechanical Department'] = [];
        department['Electronics Department'] = [];
        department['Electrical Department'] = [];
        department['Civil Department'] = [];
        department['Chemical Department'] = [];
        var dept_name = $("#dept_name").val();
        var length = department[dept_name].length;
        for (var i = 0; i < length; i++) {
            $("#subject_name").append('<option>'+ department[dept_name][i] +'</option>');
        };

        $("#dept_name").change(function() {
            var dept_name = $("#dept_name").val();
            var length = department[dept_name].length;
            $("#subject_name").empty();
            for (var i = 0; i < length; i++) {
                $("#subject_name").append('<option>'+ department[dept_name][i] +'</option>');
            };
        });
    });
</script>
</html>