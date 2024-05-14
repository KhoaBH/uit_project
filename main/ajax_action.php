<?php
include 'db_connect.php';
session_start();
switch ($_POST["type"]) {
    case 'saveSchedule':
    {
        saveSchedule($_POST["data"]);
        break;
    }
    case 'editSchedule':
    {
        editSchedule($_POST["data"]);
        break;
    }
    case 'deleteSchedule':{
        deleteSchedule($_POST["data"]);
        break;
    }
}
function saveSchedule($data)
{
    global $conn; // Đảm bảo rằng bạn có thể truy cập biến $conn ở trong hàm

    $date = $data["startTime"];
    $subject = $data["subject"];
    $subjectContent = $data["subjectContent"];
    $documentary = $data["documentInput"];
    $class_id = $_SESSION["class_id"];
    $start_time = $data["date"] . ' ' . $data["startTime"];
    $end_time = $data["date"] . ' ' . $data["endTime"];

    // Sử dụng prepared statement để tránh SQL injection
    $stmt = $conn->prepare("INSERT INTO schedule (schedule_id, subject_name, start_time, end_time, description,class_id) VALUES (UUID(), ?, ?, ?, ?,?)");
    $stmt->bind_param("sssss", $subject, $start_time, $end_time, $subjectContent, $class_id);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
function editSchedule($data){
    global $conn;
    $date = $data["startTime"];
    $subject = $data["subject"];
    $subjectContent = $data["subjectContent"];
    $documentary = $data["documentInput"];
    $schedule_id = $data["schedule_id"];

    $start_time = $data["date"] . ' ' . $data["startTime"];
    $end_time = $data["date"] . ' ' . $data["endTime"];
    $sql= "Update schedule set start_time = '$start_time', end_time = '$end_time',description='$subjectContent',subject_name='$subject' where schedule_id='$schedule_id' " ;
    if ($conn->query($sql) === TRUE) {
        echo "Thêm dữ liệu thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
function deleteSchedule($data){
    global $conn;
    $schedule_id = $data["schedule_id"];
    $sql= "Delete from schedule where schedule_id='$schedule_id'";
    $conn->query($sql);
}
?>
