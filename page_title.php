<?php
function change_file_name($url, $new_name) {
    // Lấy tên file từ URL.
    $file_name = basename($url);

    // Thay thế tên file cũ bằng tên mới.
    $new_url = str_replace($file_name, $new_name, $url);

    return $new_url;
}

// Sử dụng hàm change_file_name để thay đổi tên file trên link.
$url = "http://example.com/c:/xampp/htdocs/Admin/page_title.php";
$new_name = "new_page_title.php";
$new_url = change_file_name($url, $new_name);

echo $new_url;
?>