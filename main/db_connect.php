<?php
$conn = mysqli_connect("localhost", "root", "", "sdb_prod");
$conn->set_charset("utf8mb4");
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ cho PHP
$current_time = time();