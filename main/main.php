<?php
// Kiểm tra kết nối đã được thiết lập hay chưa
include 'db_connect.php';
global $conn;
session_start();
if(isset($_SESSION["username"])&&($_SESSION["username"]!="")){
    $user=$_SESSION["username"];
    $mail=$_SESSION["mail"];
    $phone=$_SESSION["phone"];
    $role=$_SESSION["role"];
    $class_id=$_SESSION["class_id"];
    $date_of_birth=$_SESSION["date_of_birth"];
}
if(isset($_SESSION['password'])&&($_SESSION['password']!="")){
    $pass=$_SESSION['password'];
}

// Định nghĩa hàm myFunction()
function myFunction($class_id) {
    $tmp= $class_id;
    return $tmp;
}
$fetch_event = mysqli_query($conn, "select * from schedule where class_id is null");
$subject_list = mysqli_query($conn, "select * from subject");
$subject_list_detail = mysqli_query($conn, "select * from subject");
$class_list = mysqli_query($conn, "select * from class");
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
                <h3 class="name"><?php echo $user; ?></h3>
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
            <h3 class="name"><?php echo $user; ?></h3>
            <p class="role"><?php echo $role; ?></p>
            <a href="profile.php" class="btn">Thông tin cá nhân</a>
        </div>
        <nav class="navbar">
            <a href="profile.php"><i class="fas fa-user"></i><span>Thông tin cá nhân</span></a>
            <a href="courses.html"><i class="fas fa-graduation-cap"></i><span>Thống kê</span></a>
            <a href="teachers.html"><i class="fas fa-chalkboard-user"></i><span>Giáo viên</span></a>
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
<!--        <select id="week_select">-->
<!--            <option value="1">Tuần 1</option>-->
<!--            <option value="2">Tuần 2</option>-->
<!--        </select>-->
<!--        <table >-->
<!--            <caption>Thời khóa biểu</caption>-->
<!--            <tr>-->
<!--                <th colspan="2">Thời gian</th>-->
<!--                <th>Thứ 2</th>-->
<!--                <th>Thứ 3</th>-->
<!--                <th>Thứ 4</th>-->
<!--                <th>Thứ 5</th>-->
<!--                <th>Thứ 6</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th rowspan="5" class="schedule_time">Sáng</th>-->
<!--                <th class="schedule_time">Tiết 1<br>06:45 - 07:45</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!---->
<!--                <th class="schedule_time">Tiết 2<br>07:35 - 08:20</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="schedule_time">Tiết 3<br>08:40 - 09:25</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="schedule_time">Tiết 4<br>09:30 - 10:15</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="schedule_time">Tiết 5<br>10:25 - 11:10</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th rowspan="5" class="schedule_time">Chiều</th>-->
<!--                <th class="schedule_time">Tiết 6<br>12:30 - 13:15</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="schedule_time">Tiết 7<br>13:25 - 14:10</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="schedule_time">Tiết 8<br>14:15 - 15:00</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="schedule_time">Tiết 9<br>15:20 - 16:05</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="schedule_time">Tiết 10<br>16:10 - 16:45</th>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--                <td></td>-->
<!--            </tr>-->
<!--        </table>-->

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
                            <select name="start_time" id="start_time">
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
                            <select name="end_time" id="end_time">
                                <option value="-none-">-none-</option>
                                <option value="08:15:00">Tiết 1</option>
                                <option value="09:00:00">Tiết 2</option>
                                <option value="10:30:00">Tiết 3</option>
                                <option value="09:45:00">Tiết 4</option>
                                <option value="12:45:00">Tiết 5</option>
                                <option value="13:30:00">Tiết 6</option>
                                <option value="14:15:00">Tiết 7</option>
                                <option value="15:00:00">Tiết 8</option>
                                <option value="15:45:00">Tiết 9</option>
                                <option value="04:30:00">Tiết 10</option>
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
                    <input class="subject_content" id="subject_content" type="text">
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
                <div class="submit_btn">
                    <input type="submit" value="Lưu">
                </div>
            </form>
        </div>
    </div>
    <div class="schedule_form_detail" id="schedule_form_detail">
        <div class="fas fa-times" id="close_btn_detail"></div>
        <div method="POST" class="form_container">
            <form name="schedule_form_detail">
                <label class="test">Thông tin lịch giảng dạy</label>
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
                                <option value="10:30:00">Tiết 3</option>
                                <option value="09:45:00">Tiết 4</option>
                                <option value="12:45:00">Tiết 5</option>
                                <option value="13:30:00">Tiết 6</option>
                                <option value="14:15:00">Tiết 7</option>
                                <option value="15:00:00">Tiết 8</option>
                                <option value="15:45:00">Tiết 9</option>
                                <option value="04:30:00">Tiết 10</option>
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
                        <select id="status" name="status" disabled>
                            <option>Chưa bắt đầu</option>
                            <option>Đã hoàn thành</option>
                        </select>
                    </div>
                </div>
                <div class="detail_buttons">
                    <button type="button" class="btn btn-success" id="save_button_detail">Lưu</button>
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
                        { ?>
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
                            },
                            color: '#0096FF',
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

        // if (document.getElementById('calendar')) {
        //     renderCalendar();
        // }
        // document.getElementById("openPageBtn").addEventListener("click", function() {
        //     renderCalendar();
        // }
    </script>
</body>
</html>

