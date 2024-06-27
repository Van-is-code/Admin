<?php
include_once dirname(__FILE__) . '../../auth/auth.php';
// Lấy dữ liệu id cần xóa
$id = $_GET['id'];

// Kết nối
require_once "../config/database.php";

// Câu lệnh sql
$xoa_image = "DELETE FROM image WHERE product_id = $id";
$xoa_product = "DELETE FROM product WHERE id = $id";

// Thực thi câu lệnh sql
if (mysqli_query($conn, $xoa_image) && mysqli_query($conn, $xoa_product)) {
    // Redirect back to products.php
    header("Location: ../products.php");
    exit;
} else {
    // Báo lỗi nếu không thể xóa
    echo "Error: " . mysqli_error($conn);
}

// Thực thi câu lệnh sql
// mysqli_query($conn, $xoa);

// Đóng kết nối
$conn->close();

// Redirect back to products.php
header("Location: ../products.php");
exit;
?>