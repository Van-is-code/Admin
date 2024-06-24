<?php
session_start();
    unset($_SESSION["login_user"]);
    unset($_SESSION["password"]);
    unset($_SESSION["expiry_time"]);
    unset($_SESSION["name"]);
    unset($_SESSION["image"]);
    echo '<script>window.location.href = "../Adminlogin.php";</script>';
?>