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
    $user_id = $_SESSION["user_id"];
    $start_time = $data["date"] . ' ' . $data["startTime"];
    $end_time = $data["date"] . ' ' . $data["endTime"];
    $substitute = $data["substitute"];

    if($substitute === '1'){
        $sub_teacher_id=$data["substitute_teacher"];
    }
    else{
        $sub_teacher_id=null;
    }

    // Sử dụng prepared statement để tránh SQL injection
    $stmt = $conn->prepare("INSERT INTO schedule (schedule_id, subject_name, start_time, end_time, description,class_id,teacher_id,substitute,sub_teacher_id) VALUES (UUID(), ?, ?, ?, ?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $subject, $start_time, $end_time, $subjectContent, $class_id,$user_id,$substitute,$sub_teacher_id);

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
    $attendanceJson = json_encode($data["attendance"]);
    $start_time = $data["date"] . ' ' . $data["startTime"];
    $end_time = $data["date"] . ' ' . $data["endTime"];
    $sql= "Update schedule set start_time = '$start_time', end_time = '$end_time',description='$subjectContent',subject_name='$subject',attendance_list='$attendanceJson', completed='1' where schedule_id='$schedule_id' " ;
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
