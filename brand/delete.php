<?php
include_once dirname(__FILE__) . '../../auth/auth.php';
// Lấy dữ liệu id cần xóa
$id = $_GET['id'];

// Kết nối
require_once "../config/database.php";

// Câu lệnh sql
$xoa = "DELETE FROM brand WHERE id = $id";

// Thực thi câu lệnh sql
mysqli_query($conn, $xoa);

// Đóng kết nối
$conn->close();

// Redirect back to category.php
header("Location: ../brand.php");
exit;
?>