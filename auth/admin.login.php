<?php
/**
 * Copyright C2009G
 *
 * Trang đăng nhập quản trị
 */
// Cấu hình hệ thống
include_once '../config/database.php';

// Nếu người dùng điền thông tin đăng nhập vào form và đẩy lên
if ( $_SERVER['REQUEST_METHOD'] == "POST" )  
{ 
	// Mở phiên kết nối mới
	@session_destroy();
    session_start();
    session_regenerate_id();
    
    // Xác thực định danh của user
	include_once 'admin.auth.php';
	die();
} // end login

// Hiển thị màn hình đăng nhập
$web_title  = "Đăng Nhập Quản trị";

// Define the function 'check_file_layout' if it is not already defined
if (!function_exists('check_file_layout')) {
	function check_file_layout($layout) {
		// Function implementation goes here
	}
}

check_file_layout($web_layout_adminlogin);

include_once $web_layout_adminlogin;
