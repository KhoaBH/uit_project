<?php
// Kiểm tra kết nối đã được thiết lập hay chưa
include 'db_connect.php';
global $conn;
session_start();
if(isset($_SESSION["username"])&&($_SESSION["username"]!="")){
    $user=$_SESSION["username"];
    $full_name = $_SESSION["full_name"];
    $mail=$_SESSION["mail"];
    $phone=$_SESSION["phone"];
    $role=$_SESSION["role"];
    $date_of_birth=$_SESSION["date_of_birth"];
    $class_name=$_SESSION["class_name"];
    $gender=$_SESSION["gender"];
    $class_id = $_SESSION["class_id"];
    if($gender=="F"){
        $gender = "Nữ";
    }
    else{
        $gender = "Nam";
    }
}
if(isset($_SESSION['password'])&&($_SESSION['password']!="")){
    $pass=$_SESSION['password'];
}
    $result = mysqli_query($conn, "SELECT class_name FROM class WHERE id = '$class_id'");
    $class_name =  mysqli_fetch_array($result)[0];
// Định nghĩa hàm myFunction()
function myFunction($class_id) {
    $tmp= $class_id;
    return $tmp;
}
$fetch_event = mysqli_query($conn, "select * from schedule where class_id is null");
$subject_list = mysqli_query($conn, "select * from subject");
$subject_list_detail = mysqli_query($conn, "select * from subject");
$class_list = mysqli_query($conn, "select * from class");
$substitute_teacher_list= mysqli_query($conn, "select * from user where role='teacher'");
$attendance_list= mysqli_query($conn, "select * from user where class_id='$class_id' and role='student'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sổ đầu bài</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--    <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> <!--Thêm thư viện Moment.js-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="style_main.css">
    <!-- Include plugin -->

    <!-- Or using a CDN -->

    <!-- Include the default stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
    <!-- Include plugin -->
    <script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>
</head>
<body>

    <header class="header">
        <section class="flex">
            <a href="home.html" class="logo">MDC Education</a>

            <form action="search.html" method="post" class="search-form">
                <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
                <button type="submit" class="fas fa-search"></button>
            </form>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>

            <div class="profile">
                <img src="images/pic-1.jpg" class="image" alt="">
                <h3 class="name"><?php echo $full_name; ?></h3>
                <p class="role"><?php echo $role; ?></p>
                <a href="profile.html" class="btn">view profile</a>
                <div class="flex-btn">
                    <a href="login.html" class="option-btn">login</a>
                    <a href="register.html" class="option-btn">register</a>
                </div>
            </div>

        </section>

    </header>

    <div class="side-bar">
        <div id="close-btn">
            <i class="fas fa-times"></i>
        </div>
        <div class="profile">
            <img src="images/pic-1.jpg" class="image" alt="">
            <h3 class="name"><?php echo $full_name; ?></h3>
            <p class="role"><?php echo $role; ?></p>
            <a href="profile.php" class="btn">Thông tin cá nhân</a>
        </div>
        <nav class="navbar">
            <a href="profile.php"><i class="fas fa-user"></i><span>Thông tin cá nhân</span></a>
            <a href="statistic.php" id="stat"><i class="fas fa-graduation-cap"></i><span id="stat">Thống kê</span></a>
            <a href="main.php"><i class="fas fa-chalkboard-user"></i><span>Sổ đầu bài</span></a>
            <a href="log_out.php"><i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span></a>
        </nav>
    </div>
    <div class="schedule_content" style="display: flex; flex-direction: column; width:100%;">

        <div id="calendar">
            <select id="class_dropdown" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php
                // $subject_list là kết quả của truy vấn SQL để lấy danh sách môn học từ cơ sở dữ liệu
                while ($result = mysqli_fetch_array($class_list )) {
                    echo "<option value='" . $result['id'] . "'>" . $result['class_name'] . "</option>";
                }
                ?>
            </select>
            <button class="schedule_create_btn" id="openPageBtn">Tạo lịch sổ đầu bài</button>
        </div>
    </div>
<!--    Schedule_form-->
    <div class="schedule_form" id="schedule_form">
        <div class="fas fa-times" id="close_btn"></div>
        <div method="POST" class="form_container">
            <form name="schedule_form">
                <label class="test">Lên lịch giảng dạy</label>
                <div>
                    <input class="class_id" id="class_id" style="display:none" type="text" value="<?php echo json_encode($_SESSION["class_id"]); ?>"></input>
                </div>
                <div class="form_wrap form_grp">
                    <div class="form_item">
                        <div class="form_item">
                            <label>Tiết bắt đầu</label>
                            <select name="start_time" id="start_time" required>
                                <option value="-none-" disabled selected value="">-none-</option>
                                <option value="07:30:00">Tiết 1</option>
                                <option value="08:15:00">Tiết 2</option>
                                <option value="09:00:00">Tiết 3</option>
                                <option value="10:30:00">Tiết 4</option>
                                <option value="09:45:00">Tiết 5</option>
                                <option value="12:45:00">Tiết 6</option>
                                <option value="13:30:00">Tiết 7</option>
                                <option value="14:15:00">Tiết 8</option>
                                <option value="15:00:00">Tiết 9</option>
                                <option value="15:45:00">Tiết 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_item">
                        <div class="form_item">
                            <label>Tiết kết thúc</label>
                            <select name="end_time" id="end_time" required>
                                <option value="-none-" disabled selected value="">-none-</option>
                                <option value="08:15:00">Tiết 1</option>
                                <option value="09:00:00">Tiết 2</option>
                                <option value="10:30:00">Tiết 3</option>
                                <option value="09:45:00">Tiết 4</option>
                                <option value="12:45:00">Tiết 5</option>
                                <option value="13:30:00">Tiết 6</option>
                                <option value="14:15:00">Tiết 7</option>
                                <option value="15:00:00">Tiết 8</option>
                                <option value="15:45:00">Tiết 9</option>
                                <option value="16:30:00">Tiết 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_item">
                        <div class="form_item">
                            <label>Ngày</label>
                            <input name="date" id="date" type="date" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>
                </div>
                <div class="form_wrap">
                    <div class="form_item">
                        <label>Môn học</label>
                        <select name="subject" id="subject">
                            <?php
                            // $subject_list là kết quả của truy vấn SQL để lấy danh sách môn học từ cơ sở dữ liệu
                            while ($result = mysqli_fetch_array($subject_list)) {
                                echo "<option>" . $result['subject_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form_item">
                    <label>Nội dung môn học</label>
                    <input class="subject_content" id="subject_content" type="text" required>
                </div>
                <div class="form_item">
                    <label>Tài liệu</label>
                    <input class="document" id="document" type="text">

                </div>
                <div class="form_wrap">
                    <div class="form_item">
                        <label>Tình trạng tiết học</label>
                        <select id="status" name="status" disabled>
                            <option>Chưa bắt đầu</option>
                            <option>Đã hoàn thành</option>
                        </select>
                    </div>
                </div>
                <div style="display: flex; width: 100%;justify-content: space-between;">
                    <label for="checkbox_label"  style="font-size: 20px;">
                        <input type="checkbox" id="substitute_checkbox" class="substitute_checkbox"> <!-- Ô kiểm -->
                        Phân công dạy thay <!-- Nhãn -->
                    </label>
                    <select name="substitute_teacher" class="substitute_teacher" id="substitute_teacher" style="align-self: flex-end" disabled>
                        <option disabled selected value="">Chọn giáo viên dạy thay</option>
                        <?php
                        while ($result = mysqli_fetch_array($substitute_teacher_list)) {
                            echo "<option value='" . $result['user_id'] . "'>" . $result['full_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="submit_btn" id ="submit_btn">
                    <input type="submit" value="Lưu">
                </div>
            </form>
        </div>
    </div>
    <div class="schedule_form_detail" id="schedule_form_detail">
        <div class="fas fa-times" id="close_btn_detail"></div>
        <div method="POST" class="form_container">
            <form name="schedule_form_detail">
                <label class="test">Thông tin lịch giảng dạy - <?php echo $class_name ?></label>
                <div class="form_wrap form_grp">
                    <div>
                        <input class="schedule_id" id="schedule_id" style="display:none" type="text"></input>
                    </div>
                    <div>
                        <input class="schedule_id" id="schedule_id" style="display:none" type="text"></input>
                    </div>
                    <div class="form_item">
                        <div class="form_item">
                            <label>Tiết bắt đầu</label>
                            <select name="start_time_detail" id="start_time_detail">
                                <option value="-none-">-none-</option>
                                <option value="07:30:00">Tiết 1</option>
                                <option value="08:15:00">Tiết 2</option>
                                <option value="09:00:00">Tiết 3</option>
                                <option value="10:30:00">Tiết 4</option>
                                <option value="09:45:00">Tiết 5</option>
                                <option value="12:45:00">Tiết 6</option>
                                <option value="13:30:00">Tiết 7</option>
                                <option value="14:15:00">Tiết 8</option>
                                <option value="15:00:00">Tiết 9</option>
                                <option value="15:45:00">Tiết 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_item">
                        <div class="form_item">
                            <label>Tiết kết thúc</label>
                            <select name="end_time_detail" id="end_time_detail">
                                <option value="-none-">-none-</option>
                                <option value="08:15:00">Tiết 1</option>
                                <option value="09:00:00">Tiết 2</option>
                                <option value="09:45:00">Tiết 3</option>
                                <option value="10:30:00">Tiết 4</option>
                                <option value="12:45:00">Tiết 5</option>
                                <option value="13:30:00">Tiết 6</option>
                                <option value="14:15:00">Tiết 7</option>
                                <option value="15:00:00">Tiết 8</option>
                                <option value="15:45:00">Tiết 9</option>
                                <option value="16:30:00">Tiết 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_item">
                        <div class="form_item">
                            <label>Ngày</label>
                            <input name="date_detail" id="date_detail" type="date" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>
                </div>
                <div style="display: flex; flex-direction: row; font-size:20px">
                        <span>Giáo viên chính: </span>
                        <p id="main_teacher_detail" ></p>
                </div>
                <lable style=" font-size:20px">
                    Điểm danh
                    <select id="attendance_select" multiple="multiple" style="width: 300px;height:50px">
                        <?php
                        while ($result = mysqli_fetch_array($attendance_list)) {
                            echo "<option value='" . $result['user_id'] . "'>" . $result['full_name'] . "</option>";
                        }
                        ?>
                    </select>
                </lable>
                <div class="form_wrap">
                    <div class="form_item">
                        <label>Môn học</label>
                        <select name="subject_detail" id="subject_detail">
                            <?php
                            // $subject_list là kết quả của truy vấn SQL để lấy danh sách môn học từ cơ sở dữ liệu
                            while ($result = mysqli_fetch_array($subject_list_detail)) {
                                echo "<option>" . $result['subject_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form_item">
                    <label>Nội dung môn học</label>
                    <input class="subject_content_detail" id="subject_content_detail" type="text">
                </div>
                <div class="form_item">
                    <label>Tài liệu</label>
                    <input class="document_detail" id="document_detail" type="text">

                </div>
                <div class="form_wrap">
                    <div class="form_item">
                        <label>Tình trạng tiết học</label>
                        <select id="status_detail" name="status" disabled>
                            <option>Chưa bắt đầu</option>
                            <option>Đã hoàn thành</option>
                        </select>
                    </div>
                </div>
                <div class="detail_buttons">
                    <button type="button" class="btn btn-success" id="save_button_detail" >Điểm danh</button>
                    <button type="button" class="btn btn-danger" id="delete_button_detail">Xóa</button>
                </div>
            </form>
        </div>
    </div>
<!-- custom js file link  -->
    <script src="js/script.js"></script>
    <script>
        renderCalendar();
        function updateCurrentWeek() {
            var currentWeek = calculateCurrentWeek(); // Tính toán tuần hiện tại
            document.getElementById("week_select").value = currentWeek; // Cập nhật dropdown với tuần hiện tại
            updateSchedule(currentWeek); // Cập nhật nội dung của bảng dựa trên tuần hiện tại
        }
        $(document).ready(function() {
            var classId = <?php echo json_encode($_SESSION["class_id"]); ?>; // Lấy giá trị từ PHP và chuyển đổi thành JavaScript
            var classList = document.getElementById('class_dropdown');
            classList.value = classId; // Thiết lập giá trị mặc định cho hộp chọn
        });
        function renderCalendar() {
            document.addEventListener('DOMContentLoaded', function(){
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    select: function(start, end) {
                        $(modal_id).modal('show');
                        // Lưu thời gian bắt đầu và kết thúc khi chọn trên lịch
                        $("#eventStart").val(start.format());
                        $("#eventEnd").val(end.format());
                    },
                    headerToolbar: {
                        left: 'prev,next today',
                        right: 'title',
                    },
                    initialView: 'timeGridWeek', // Thay đổi chế độ xem thành tuần
                    eventClick: function(info) {
                        showSchedule(info);
                    },
                    aspectRatio: 2,
                    timeZone: 'UTC',
                    hiddenDays: [0],
                    allDaySlot: false,
                    selectable: true,
                    // selectMirror: true,
                    slotMinTime: '07:30:00',
                    slotMaxTime: '16:30:00',
                    defaultTimedEventDuration: '00:45:00',
                    slotDuration: '00:45:00',
                    slotLabelInterval: '00:45:00',
                    editable: false,
                    eventContent: function(arg) {
                        // Tạo chuỗi nội dung sự kiện với tiêu đề và thời gian
                        var eventContent = '<div class="event-content">' +
                            '<div class="event-title">' + arg.event.title + '</div>' +
                            '<div class="event-time">' +
                            '<i class="fa fa-clock"></i> ' + arg.timeText +
                            '</div>' +
                            '</div>';

                        // Trả về HTML cho sự kiện
                        return {
                            html: eventContent
                        };
                    },
                    eventOverlap: false,
                    events:[
                        <?php
                        $id = myFunction($_SESSION["class_id"]);
                        $fetch_event = mysqli_query($conn, "select * from schedule where class_id='$id'");
                        while($result = mysqli_fetch_array($fetch_event))
                        {
                            $main_teacher_id = $result['teacher_id'];
                            $main_teacher = mysqli_query($conn, "select full_name from user where user_id = '$main_teacher_id'");
                            $main_teacher = mysqli_fetch_array($main_teacher)[0];
                            $attendance_list = json_encode($result['attendance_list']);
                            $color = '#CCCCCC'; // Màu mặc định
                            if ($result['teacher_id'] === $_SESSION["user_id"] ||$result['sub_teacher_id'] === $_SESSION["user_id"]) { // Thay some_condition bằng điều kiện cụ thể của bạn
                                $color = '#0096FF'; // Đổi màu thành xanh lá nếu điều kiện được đáp ứng
                            }
                            if (strtotime($result['end_time']) < time() && $result['completed'] == 1) {
                                $color = '#2ea44f'; // Note Xám: Đã qua thời gian , Xanh lá: Lịch avalable do mình đăng ký, Xanh dương: lịch của giáo viên khác
                            }
                            else if(strtotime($result['end_time']) < time() && $result['completed'] == 0){
                                $color = '#de0a26';
                            }
                            if($result['completed'] == 1){
                                $color = '#2ea44f';
                            }
                            ?>

                        {
                            title: '<?php echo '<i class="fa fa-book"></i> ' . $result['subject_name'] . '<br>' .'<i class="fa fa-info-circle"></i> '. $result['description']; ?>',
                            start: '<?php echo $result['start_time']; ?>',
                            end: '<?php echo $result['end_time']; ?>',
                            extendedProps: {
                                subject_name: '<?php echo $result['subject_name']; ?>',
                                start_time: '<?php echo $result['start_time']; ?>',
                                end_time: '<?php echo $result['end_time']; ?>',
                                description: '<?php echo $result['description']; ?>',
                                schedule_id: '<?php echo $result['schedule_id']; ?>',
                                teacher_id: '<?php echo $result['teacher_id']; ?>',
                                class_id: '<?php echo $result['class_id']; ?>',
                                attendance_list: '<?php echo $attendance_list ?>',
                                main_teacher:'<?php echo $main_teacher ?> ',
                                status:'<?php echo $result['completed']; ?>',
                            },

                            color: '<?php echo $color; ?>',
                            textColor: 'white'
                        },
                        <?php } ?>

                    ],
                });
                calendar.setOption('slotLabelFormat', function (data) {
                    return moment(data.date).format("HH:mm") + " - " + moment(data.date).add(45, 'minutes').format("HH:mm");
                });
                calendar.render();
                document.getElementById("class_dropdown").addEventListener("change", function() {
                    // Lấy giá trị hiện tại của dropdown khi có sự thay đổi
                    var selectedValue = this.value;

                    // In ra giá trị đã chọn để kiểm tra

                    console.log(selectedValue);
                    $.ajax({
                        url: 'set_session.php',
                        method: "POST",
                        data: {
                            data: selectedValue,
                        },
                        success: function(data) {
                            location.reload();
                            // renderCalendar();
                            // calendar.refetchEvents();
                        }
                    });
                });
            });
        }
        var role = '<?php echo $role; ?>';
        hideElementOnLoad(role);
        // if (document.getElementById('calendar')) {
        //     renderCalendar();
        // }
        // document.getElementById("openPageBtn").addEventListener("click", function() {
        //     renderCalendar();
        // }
    </script>
</body>
</html>

