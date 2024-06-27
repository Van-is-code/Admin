<?php

//Login
require_once "./config/database.php";
$error = '';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  //get username && password
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    //OK
    if($row = $result->fetch_assoc()) {
      $_SESSION['login_user'] = $row['email']; // Save the email in session
     
        header("location: products.php"); // Redirect to products.php if user is admin
      
    }
  } else {
    $error = "Email and password are invalid";
  }

  $conn->close();
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
    <input type="text" name="email" required="">
    <label>Email</label>
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
    <?php if (isset($error)): ?>
      <p class="error" style="color: red;"><?php echo $error; ?></p>
      <?php endif; ?>
      <script>
        setTimeout(function(){
          document.querySelector('.error').style.display = 'none';
        }, 2000);
      </script>
  </form>
  </div>
</div>
</body>
</html>
