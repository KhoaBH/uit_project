<?php
header("Location: index.php");
session_destroy(); // Gọi hàm session_end() để kết thúc phiên làm việc
?>