<?php
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "sdb_prod");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
// Truy vấn INSERT
$sql2 = "INSERT INTO class (id,class_id, semester_id, total, main_teacher)
VALUES 
    (UUID(),'12A7', 'Spring 2024', 30, 'John Doe'),
    (UUID(),'12A8', 'Spring 2024', 25, 'Jane Smith'),
    (UUID(),'12A9', 'Spring 2024', 28, 'Michael Johnson'),
    (UUID(),'12A10', 'Spring 2024', 32, 'Emily Brown'),
    (UUID(),'12A11', 'Spring 2024', 29, 'David Wilson');
";

// Thực thi truy vấn
if ($conn->query($sql2) === TRUE) {
    echo "Thêm dữ liệu thành công.";
} else {
    echo "Lỗi: " . $conn->error;
}

// Đóng kết nối
mysqli_close($conn);
?>
