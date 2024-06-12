<?php
/**
 * Copyright C2009G
 *
 * Trang xác thực tài khoản nhân viên hệ thống
 */
// Cấu hình hệ thống
include_once '../config/database.php';

// // Thư viện hàm
// include_once 'lib/tool.image.php';
include_once 'admin.login.php';

// Define the missing functions and constants
function userVerifyLogin($username, $password) {
	// Your implementation here
}

function userGetById($id) {
	// Your implementation here
}

define('DIR_IMAGE', '/path/to/image/directory');

function img_resize($image, $width, $height) {
	// Your implementation here
}

	// Bắt các thông tin gửi lên từ form đăng nhập
	$username = strtolower(trim($_POST['username']));
	$password = trim($_POST['password']);
	
	// Thực thi quá trình xác thực danh tính của user	
	$uid = userVerifyLogin($username,$password);
	// @todo Clear session files older than 72 hours
	
	// Các tình huống username không hợp lệ.
	switch ($uid) 
	{
		case -1:
			$errLabel = 'Username không tồn tại';
			break;
		case -2:
			$errLabel = 'Mật khẩu không đúng';
			break;
		case -3:
			$errLabel = 'User chưa được kích hoạt'; //The user is inactive
			break;
		case -4:
			$errLabel = 'User đã hết hạn sử dụng'; //The Due date is finished
			break;
	}
	
	//to avoid empty string in user field.  This will avoid a weird message "this row doesn't exist"
	// @todo Cho phép không chỉ sys admin mà cả sys operator
	// được phép vào khu vực admin, tuy nhiên quyền hạn là 
	// khác nhau nên chỉ có admin mới nhìn thấy toàn bộ
	// các menu quản lý, operator chỉ nhìn thấy được một phần. 
	if ( !isset($uid) ) {
		$uid = -1;
		$errLabel = 'Username không tồn tại';
	}
	
	// @todo kiểm tra xem user có quyền vào khu vực admin này không 
	// nếu không thì vẫn quay lại màn hình login
	
	// Nếu đăng nhập thất bại
	if (!isset($uid) || $uid < 0) 
	{ 
		if (isset($_SESSION['FAILED_LOGINS'])) {	// set in login.php
			$_SESSION['FAILED_LOGINS']++;
		}
		
		// Hiện lại thông tin trên form để user đỡ phải nhập lại
		$_SESSION['FAILED_USERNAME'] = $username;
		$_SESSION['FAILED_PASSWORD'] = $password;
		
		// Gửi thông báo lỗi sang view html
		$_SESSION["ERROR_TEXT"] = $errLabel;
		
		
		// Điều hướng quay trở lại trang đăng nhập  
		header ("location: /admin-login.php");
		die;
	}
	
	/* 
	 Các users đăng nhập thành công khu vực admin 
	 @synchronized with logout-admin.php
	  Session Token: Định danh của phiên đăng nhập: chuỗi mã ký tự
	 duy trì giao tiếp (phiên đăng nhập) 
	 giữa trình duyệt (client browser) và máy chủ (web server)
	 */
	
	$_SESSION['USER_LOGGED']  = $uid;
	$_SESSION['USR_USERNAME'] = $username;
	
	$aUser = userGetById($_SESSION['USER_LOGGED']);
	// @todo load roles and permissions if needed
	
	// Tên đầy đủ của user đăng nhập
	$_SESSION['USR_FULLNAME'] = $aUser['fullname'];
		
	// Ảnh đại diện (Profile Image)
	if (is_file(DIR_IMAGE . $aUser['image'])) { 
		$_SESSION['USR_IMG'] = img_resize($aUser['image'], 45, 45);
	} else {
		$_SESSION['USR_IMG'] = img_resize('no_image.png', 45, 45);
	}
		
	unset($_SESSION['FAILED_LOGINS']);
	unset($_SESSION['FAILED_USERNAME']);
	unset($_SESSION['FAILED_PASSWORD']);
	
	// Điều hướng user tới trang được yêu cầu ngay trước lúc đăng nhập
	if ( isset($_REQUEST['ru']) && !empty($_REQUEST['ru']) ) 
	{
		$redirected_url = $_REQUEST['ru'];	
	}
	else 
	{
		// Mặc định: điều hướng sang trang quản lý sản phẩm
		$redirected_url = "/admin/product.php";
	}
	header ("location: $redirected_url");
