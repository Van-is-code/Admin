<?php
session_start();

if (!isset($_SESSION["login_user"])) {
    // If the user is not logged in, redirect them to the login page.
    header("Location: Adminlogin.php");
    exit;
}

// Check if the logged-in user data is still valid in the database
$login_user = $_SESSION["login_user"];

// Assuming you have a database connection established
// $connection = mysqli_connect("localhost", "correct_username", "correct_password", "database_name");
include_once __DIR__ . '/../config/database.php';

// Establish a database connection
// $connection = mysqli_connect("localhost", "correct_username", "correct_password", "database_name");

// Assuming you have a table named "users" with a column named "username"
$query = "SELECT * FROM user WHERE email = '$login_user'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    // If the logged-in user data is not present in the database, redirect them to the login page.
    header("Location: Adminlogin.php");
    exit;
}

// Continue accessing the web content here...