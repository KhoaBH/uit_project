<?php
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

<div class="profile_wrapper">
    <section class="user-profile">
        <h1 class="heading" style>Profile</h1>
        <div class="info">
            <div class="user">
                <img src="images/pic-1.jpg" alt="">
                <h3>Thông tin cá nhân</h3>
                <p><?php echo $role; ?></p>
                <h3><?php echo $full_name; ?></h3>
                <a href="update.html" class="inline-btn">update profile</a>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="flex">
                        <i class="fas fa-user"></i>
                        <div>
                            <span><?php echo $gender; ?></span>
                            <p>Giới tính</p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="flex">
                        <i class="fas fa-birthday-cake"></i>
                        <div>
                            <span><?php echo $date_of_birth; ?></span>
                            <p>Ngày sinh</p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="flex">
                        <i class="fas fa-book"></i>
                        <div>
                            <span><?php echo $class_name; ?></span>
                            <p><?php if($role=="Teacher") echo "Giáo viên chủ nhiệm";
                                    else echo "Lớp"?></p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="flex">
                        <i class="fas fa-phone"></i>
                        <div>
                            <span><?php echo $phone; ?></span>
                            <p>Thông tin liên hệ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<!-- custom js file link  -->
<script src="js/script.js">

</script>
<script>
    var role = '<?php echo $role; ?>';
    hideElementOnLoad(role);
</script>


</body>
</html>