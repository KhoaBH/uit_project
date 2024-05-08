<?php
// Kiểm tra kết nối đã được thiết lập hay chưa
include 'db_connect.php';
session_start();
if(isset($_SESSION["username"])&&($_SESSION["username"]!="")){
    $user=$_SESSION["username"];
    $mail=$_SESSION["mail"];
    $phone=$_SESSION["phone"];
    $role=$_SESSION["role"];
    $date_of_birth=$_SESSION["date_of_birth"];
}
if(isset($_SESSION['password'])&&($_SESSION['password']!="")){
    $pass=$_SESSION['password'];
}
$fetch_event = mysqli_query($conn, "select * from schedule");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sổ đầu bài</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
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
            <a href="index.php"><i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span></a>
        </nav>
    </div>
    <div class="schedule_content" style="display: flex; flex-direction: column; width:100%;">
        <div id="calendar"></div>
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

        </table>
        <button class="schedule_create_btn" id="openPageBtn">Tạo lịch sổ đầu bài</button>
    </div>
<!--    Schedule_form-->
    <div class="schedule_form" id="schedule_form">
        <div class="fas fa-times" id="close_btn"></div>
        <div method="POST" class="form_container">
            <form name="schedule_form">
                <label class="test">Lên lịch giảng dạy</label>
                <div class="form_wrap form_grp">
                    <div class="form_item">
                        <div class="form_item">
                            <label>Tiết bắt đầu</label>
                            <select name="start_time" id="start_time">
                                <option value="-none-">-none-</option>
                                <option value="07:30:00">Tiết 1</option>
                                <option value="08:15:00">Tiết 2</option>
                                <option value="09:00:00">Tiết 3</option>
                                <option value="09:45:00">Tiết 4</option>
                                <option value="09:30:00">Tiết 5</option>
                                <option value="10:15:00">Tiết 6</option>
                                <option value="13:30:00">Tiết 7</option>
                                <option value="14:15:00">Tiết 8</option>
                                <option value="9">Tiết 9</option>
                                <option value="10">Tiết 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_item">
                        <div class="form_item">
                            <label>Tiết kết thúc</label>
                            <select name="end_time" id="end_time">
                                <option value="-none-">-none-</option>
                                <option value="14:00:00">Tiết 1</option>
                                <option value="2">Tiết 2</option>
                                <option value="3">Tiết 3</option>
                                <option value="4">Tiết 4</option>
                                <option value="5">Tiết 5</option>
                                <option value="6">Tiết 6</option>
                                <option value="7">Tiết 7</option>
                                <option value="8">Tiết 8</option>
                                <option value="9">Tiết 9</option>
                                <option value="10">Tiết 10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_item">
                        <div class="form_item">
                            <label>Tiết kết thúc</label>
                            <input name="date" id="date" type="date" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>
                </div>
                <div class="form_wrap">
                    <div class="form_item">
                        <label>Môn học</label>
                        <select name="subject" id="subject">
                            <option>Toán</option>
                            <option>Vật lý</option>
                            <option>Hóa học</option>
                            <option>Sinh</option>
                            <option>Thể dục</option>
                            <option>Giáo dục công dân</option>
                            <option>Ngữ văn</option>
                            <option>Tiếng anh</option>
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
<!-- custom js file link  -->
    <script src="js/script.js"></script>
    <script>
        // Thêm sự kiện "change" cho dropdown chọn tuần
        document.getElementById("week_select").addEventListener("change", function() {
            var selectedWeek = parseInt(this.value); // Lấy giá trị tuần được chọn
            updateSchedule(selectedWeek); // Cập nhật nội dung của bảng dựa trên tuần được chọn
        });

        // Hàm tính toán và cập nhật tuần hiện tại (ví dụ: mỗi giây)
        function updateCurrentWeek() {
            var currentWeek = calculateCurrentWeek(); // Tính toán tuần hiện tại
            document.getElementById("week_select").value = currentWeek; // Cập nhật dropdown với tuần hiện tại
            updateSchedule(currentWeek); // Cập nhật nội dung của bảng dựa trên tuần hiện tại
        }
        // Gọi hàm updateCurrentWeek mỗi giây
        setInterval(updateCurrentWeek, 1000); // Mỗi giây
        // Hàm xử lý sự kiện khi nút submit được nhấn

    </script>
    <script>

        document.addEventListener('DOMContentLoaded', function(){
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                select: function(start, end) {
                    $('#myModal').modal('show');
                    // Lưu thời gian bắt đầu và kết thúc khi chọn trên lịch
                    $("#eventStart").val(start.format());
                    $("#eventEnd").val(end.format());
                },

                initialView: 'timeGridWeek', // Thay đổi chế độ xem thành tuần
                header: {
                    left: 'month, agendaWeek, agendaDay, list',
                    center: 'title',
                    right: 'prev, today, next'
                },

                eventClick: function(info) {
                    alert('Event: ' + info.description);
                    $(this).css('border-color', 'red');
                },
                aspectRatio: 2,
                timeZone: 'UTC',
                columnHeaderFormat: 'dddd', // Hiển thị tên của các ngày trong tuần
                allDaySlot: false,
                selectable: true,
                // selectMirror: true,
                columnFormat: 'ddd DD/MM',
                slotMinTime: '07:30:00',
                slotMaxTime: '16:30:00',
                defaultTimedEventDuration: '00:45:00',
                slotDuration: '00:45:00',
                slotLabelInterval: '00:45:00',
                editable: true,
                events:[
                    <?php
                    while($result = mysqli_fetch_array($fetch_event))
                    { ?>
                    {
                        title: '<?php echo $result['schedule_id']; ?>',
                        description: 'test',
                        start: '<?php echo $result['start_time']; ?>',
                        end: '<?php echo $result['end_time']; ?>',
                        color: '#f16621',
                        textColor: 'black'
                    },
                    <?php } ?>
                ],


            });
            calendar.setOption('slotLabelFormat', function (data) {
                return moment(data.date).format("HH:mm") + " - " + moment(data.date).add(45, 'minutes').format("HH:mm");
            });
            calendar.render();
        });

    </script>
</body>
</html>

