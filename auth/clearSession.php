<?php
session_start();
    unset($_SESSION["password"]);
    unset($_SESSION["expiry_time"]);
    echo '<script>window.location.href = "./auth.admin.php";</script>';
?>