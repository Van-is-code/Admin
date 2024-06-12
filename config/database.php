<?php
$servername = "localhost";
$username = "root";
$password = "";
$datbase = "dbwebsite";

// Create connection
$conn = new mysqli($servername, $username, $password, $datbase);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>