
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Validate username and password
  if ($username == "admin" && $password == "admin123") {
    // Redirect to admin.php if credentials are correct
    header("Location: admin.php");
    exit;
  } else {
    // Display error message if credentials are incorrect
    $errorMessage = "Invalid username or password";
    header("Refresh: 3;"); // Redirect to login page after 3 seconds
  }
}
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/login.css">
</head>
<body>

<div>
  <div class="login-box">
    <form method="POST">
      <i class="fa-light fa-key"></i>
      <img src="./img/admin1.png" class="admin">
      <h1>Admin</h1>
      <div class="user-box">
        <input type="text" name="username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <center>
        <button type="submit">
          SEND
          <span></span>
        </button>
      </center>
      <?php if (isset($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
      <?php endif; ?>
    </form>
  </div>
</div>
</body>
</html>





