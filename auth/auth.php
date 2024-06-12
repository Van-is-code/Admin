<?php
session_start(); // Start the session.

if (!isset($_SESSION['login_user'])) {
    // If the 'login_user' session variable is not set, redirect to the login page.
    header("Location: ../AdminLogin.php");
    exit;
}

// Check the user's access level or role.
$accessLevel = $_SESSION['access_level'];

// Check if the user has access to the current page.
if ($accessLevel !== 'admin') {
    // If the user does not have access, redirect to an error page or display an error message.
    header("Location: ../AccessDenied.php");
    exit;
}

// The rest of your admin page code goes here.