<?php
    include 'db_connect.php';
//$conn = mysqli_connect("localhost", "root", "", "sdb_prod");

if(isset($_POST[formData])){
        $date=$_POST["formData"]["date"];
        $subject=$_POST["formData"]["subject"];
        $subjectContent=$_POST["formData"]["subjectContent"];
        $documentary=$_POST["formData"]["documentInput"];

        $start_time = $_POST["formData"]["date"] . ' ' .  $_POST["formData"]["startTime"];
        $end_time = $_POST["formData"]["date"] . ' ' .  $_POST["formData"]["endTime"];
        $sql = "INSERT INTO schedule (schedule_id,subject_id, start_time, end_time) VALUES (UUID(),'$subject', '$start_time', '$end_time')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }