<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sổ đầu bài</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
            <table >
                <caption>Thời khóa biểu</caption>
                <tr>
                    <th colspan="2">Thời gian</th>
                    <th>Thứ 2</th>
                    <th>Thứ 3</th>
                    <th>Thứ 4</th>
                    <th>Thứ 5</th>
                    <th>Thứ 6</th>
                </tr>
                <tr>
                    <th rowspan="5" class="schedule_time">Sáng</th>
                    <th class="schedule_time">Tiết 1<br>06:45 - 07:45</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>

                    <th class="schedule_time">Tiết 2<br>07:35 - 08:20</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="schedule_time">Tiết 3<br>08:40 - 09:25</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="schedule_time">Tiết 4<br>09:30 - 10:15</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="schedule_time">Tiết 5<br>10:25 - 11:10</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th rowspan="5" class="schedule_time">Chiều</th>
                    <th class="schedule_time">Tiết 6<br>12:30 - 13:15</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="schedule_time">Tiết 7<br>13:25 - 14:10</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="schedule_time">Tiết 8<br>14:15 - 15:00</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="schedule_time">Tiết 9<br>15:20 - 16:05</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="schedule_time">Tiết 10<br>16:10 - 16:45</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </table>
        <button class="schedule_create_btn" id="openPageBtn">Tạo lịch sổ đầu bài</button>
    </div>
<!-- custom js file link  -->
<script src="js/script.js">
    document.getElementById("openPageBtn").addEventListener("click", function() {
        // Đường dẫn tới trang HTML nhỏ
        var url = "te.php";

        // Mở trang HTML nhỏ trong cửa sổ mới
        window.open(url, "_blank", "width=300,height=200");

        // Hoặc chuyển hướng đến trang HTML nhỏ trong cửa sổ hiện tại
        // window.location.href = url;
    });
</script>


</body>
</html>
