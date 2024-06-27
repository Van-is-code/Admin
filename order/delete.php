<?php
include_once dirname(__FILE__) . '../../auth/auth.php';
// Lấy dữ liệu id cần xóa
$id = $_GET['id'];

// Kết nối
require_once "../config/database.php";

// Câu lệnh sql
$xoa_order_details = "DELETE FROM order_details WHERE id = " . mysqli_real_escape_string($conn, $id);
// $xoa_order = "DELETE FROM order WHERE id = " . mysqli_real_escape_string($conn, $id);

// Thực thi câu lệnh sql
mysqli_query($conn, $xoa_order_details);
// mysqli_query($conn, $xoa_order);
// // Câu lệnh sql
// $xoa = "DELETE FROM user WHERE id = $id";

// // Thực thi câu lệnh sql
// mysqli_query($conn, $xoa);

// Đóng kết nối
$conn->close();

// Redirect back to products.php
header("Location: ../order.php");
exit;
?>