<?php
session_start(); // Start the session.

if (!isset($_SESSION['loggedin'])) {
    // If the 'loggedin' session variable is not set, redirect to the login page.
    header("Location: Adminlogin.php");
    exit;
}
?>