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
    $user_id=$_SESSION["user_id"];
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
$schedule_made = mysqli_query($conn, "Select count(*) as total from schedule where teacher_id='$user_id'");
$schedule_made = $schedule_made->fetch_assoc()['total'];

$incomplete = mysqli_query($conn, "Select count(*) as total from schedule where teacher_id='$user_id' and completed='0'");
$incomplete = $incomplete ->fetch_assoc()['total'];

$complete = mysqli_query($conn, "Select count(*) as total from schedule where teacher_id='$user_id' and completed='1'");
$complete = $complete ->fetch_assoc()['total'];

$substitute = mysqli_query($conn, "Select count(*) as total from schedule where sub_teacher_id='$user_id' and completed='1' ");
$substitute = $substitute ->fetch_assoc()['total'];

$sum =  mysqli_query($conn, "Select count(*) as total from schedule where (sub_teacher_id='$user_id' or teacher_id='$user_id') and completed='1' ");
$sum =$sum -> fetch_assoc()['total'];
$complete_percent = ($complete/$schedule_made)*100;
$complete_percent = number_format($complete_percent, 2);
$sume = array(); // Khởi tạo mảng trống để lưu kết quả
for ($i = 1; $i <= 12; $i++) {
    // Truy vấn dữ liệu cho mỗi tháng
    $query = "
        SELECT MONTH(end_time) AS month,
        COALESCE(COUNT(*), 0) AS number_of_sessions
        FROM schedule
        WHERE YEAR(end_time) = 2024
          AND MONTH(end_time) = $i
          AND teacher_id = '$user_id'";

    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result); // Lấy kết quả truy vấn
        $number_of_sessions = $row['number_of_sessions'];
    } else {
        $number_of_sessions = 0;
    }
    $sume[] = $number_of_sessions;
}
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    <!--    chart import-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <a href="statistic.php"><i class="fas fa-graduation-cap"></i><span>Thống kê</span></a>
        <a href="main.php"><i class="fas fa-chalkboard-user"></i><span>Sổ đầu bài</span></a>
        <a href="log_out.php"><i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span></a>
    </nav>
</div>
<div class="statistic_container">
    <div class="stat" style="">
        <div style="display: flex;flex-direction: column;align-items: center">
            <i class='bx bxs-doughnut-chart' ></i>
            <p class="stat_label" style="color: #264de4;">Đã đăng ký</p>
        </div>
        <p class="stat_value">
            <?php
                echo $schedule_made;
            ?>
        </p>
    </div>
    <div class="stat" style="">
        <div style="display: flex;flex-direction: column;align-items: center">
            <i class='bx bxs-calendar-x' ></i>
            <p class="stat_label" style="color: #f76040">Chưa hoàn thành</p>
        </div>
        <p class="stat_value">
            <?php
                echo $incomplete;
            ?>
        </p>
    </div>
    <div class="stat" style="">
        <div style="display: flex;flex-direction: column;align-items: center">
            <i class='bx bxs-cube-alt'></i>
            <p class="stat_label" style="color: #c68844;">Đã hoàn thành</p>
        </div>
        <p class="stat_value">
            <?php
                echo $complete;
            ?>
        </p>
    </div>
    <div class="stat" style="">
        <div style="display: flex;flex-direction: column;align-items: center">
            <i class='bx bx-accessibility' ></i>
            <p class="stat_label" style="color: #663190;">Số buổi dạy thay</p>
        </div>
        <p class="stat_value">
            <?php
                echo $substitute;
            ?>
        </p>
    </div>
    <div class="stat" style="">
        <div style="display: flex;flex-direction: column;align-items: center">
            <i class='bx bxs-crown'></i>
            <p class="stat_label" style="color: #e50618;">Tổng số buổi</p>
        </div>
        <p class="stat_value">
            <?php
            echo $sum;
            ?>
        </p>
    </div>
    <div class="stat" style="width: 400px; height: 400px;margin-left: 0px">
        <canvas id="completionChart"></canvas>
        <p>
            Tỉ lệ hoàn thành công việc <?php echo $complete_percent;?>%
        </p>
    </div>
    <div class="stat" style="width: 700px; height: 400px;margin-left: 0px">
        <canvas id="salesChart"></canvas>
        <p>
            Biểu đồ thống kê lịch dạy năm 2024
        </p>
    </div>

</div>



<script src="js/script.js"></script>
<script>
    // Bước 2: Tính toán dữ liệu
    var totalSessions = <?php echo $schedule_made;?>; // Tổng số buổi
    var completedSessions = <?php echo $complete;?>; // Số buổi đã hoàn thành

    var data = {
        labels: [
            'Đã hoàn thành',
            'Chưa hoàn thành'
        ],
        datasets: [{
            data: [completedSessions, totalSessions - completedSessions],
            backgroundColor: [
                '#08c26e', // Màu cho phần chưa hoàn thành
                '#e50618', // Màu cho phần hoàn thành

            ],
            hoverBackgroundColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)'
            ]
        }]
    };

    // Bước 3: Tạo biểu đồ doughnut
    var ctx = document.getElementById('completionChart').getContext('2d');
    var completionChart = new Chart(ctx, {
        type: 'doughnut', // Đổi loại biểu đồ thành 'doughnut'
        data: data,
        options: {
            responsive: false, // Đặt thành false để không tự động điều chỉnh kích thước
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var label = tooltipItem.label || '';
                            var value = tooltipItem.raw;
                            var total = completedSessions + (totalSessions - completedSessions);
                            var percentage = ((value / total) * 100).toFixed(2);
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
    // Dữ liệu doanh số bán hàng của 12 tháng
    var salesData = <?php echo json_encode($sume); ?>;

    // Lấy tham chiếu của canvas
    var ctx = document.getElementById('salesChart').getContext('2d');

    // Tạo biểu đồ cột
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Số buổi dạy',
                data: salesData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Màu nền của cột
                borderColor: 'rgba(54, 162, 235, 1)', // Màu viền của cột
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Bắt đầu trục y từ 0
                }
            }
        }
    });
</script>
</body>
</html>

