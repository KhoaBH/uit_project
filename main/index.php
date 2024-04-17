<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sổ đầu bài</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
    <form method="post" action="index.php"  autocomplete="off">
        <h1>Login</h1>
        <div class="input-box">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <i class='bx bxs-user'></i>
        </div>
        <!-- Warning message -->
        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="remember-forgot">
            <label>
                <input type="checkbox">
                Remember me
            </label>
            <a href="#">Forgot password</a>
        </div>
        <button type="submit" class="login_btn" name="login_btn">Login</button>
        <div class="register">
            <span id="user_not_found" style="color: red; display: none; margin-left:5px">User not found. Please try again!</span>
            <span id="wrong_password" style="color: red; display: none; margin-left:5px">Wrong password. Please try again!</span>
        </div>
    </form>
</div>
<script>
    // Disable form resubmission
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    // Function to show user not found message
    function showUserNotFoundMessage() {
        document.getElementById("user_not_found").style.display = "inline";
    }
    function showUserWrongPassWord() {
        document.getElementById("wrong_password").style.display = "inline";
    }
</script>
</body>
</html>z


<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login_db");
if(isset($_POST['login_btn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM login_info WHERE name=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result) == 0){ // If no rows were returned
        echo "<script>showUserNotFoundMessage();</script>"; // Call JavaScript function to show the message
    } else {
        $row = mysqli_fetch_assoc($result);
        $resultPassword = $row['password'];
        if($password === $resultPassword){
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            header('Location: main.php');
            exit();
        } else {
            echo "<script>showUserWrongPassWord();</script>";
        }
    }
}
?>
