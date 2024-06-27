<?php 
include_once dirname(__FILE__) . '../../auth/auth.php';
require_once ("../view/navbar.php");
require_once "../config/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // $admin_id = substr(uniqid('admin'), 0, 8);
  $admin_id = "Admin" . rand(0, 10000);
  $admin_id = uniqid('Admin');
  // Check if admin_id already exists in the database
  // $checkQuery = "SELECT admin_code FROM admin WHERE admin_code = '$admin_id'";
  // $checkResult = $conn->query($checkQuery);

  // if ($checkResult->num_rows > 0) {
  //   // Generate a new admin_id if it already exists
  //   $admin_id = "Admin" . rand(0, 1000);
  // }

  // Continue with the rest of the code
  $first = $_POST['first_name'];
  $last = $_POST['last_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // INSERT INTO DB
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $timeUpdate = date('Y-m-d H:i:s');
  $sql = "INSERT INTO `admin` (`admin_code`,`firstname`,`lastname`,`email`,  `password`, `updated_at`) "
  . " VALUES ('$admin_id', '$first', '$last','$email','$password','$timeUpdate');";
  if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success'>Dữ liệu đã được lưu vào database</div>";
    echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    // echo "<script>setTimeout(function() { window.location.href = '../products.php'; }, 3000);</script>";
    
    $message = "Insert OK";
   
  } else {
    echo "<div class='alert alert-danger'>Something went wrong</div>";
    echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    $error = "Something wrong";
  }

  $conn->close();
}

?>

<div class="container-fluid">
                    
<div class="card shadow">
                        <div class="card-header py-3">
         <p class="text-primary m-0 fw-bold"> Add admin</p>
                              </div>
                                 <div class="card-body">
                          
                                 <div class="row" style=" margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
                    <a href="../admin.php" style="text-decoration: none; color:#4e73df; "><div class="col"><i  class="fa fa-long-arrow-left"></i><span style="font-family:2% ;">⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>                
    <form  method="post" enctype="multipart/form-data">
    <!-- <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">admin ID:</label>
  <input type="text" class="form-control" name="admin_id" id="admin_id" placeholder="admin_id">
</div>    -->

       <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">First Name:</label>
  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first_name ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Last Name:</label>
  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last_name ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Email:</label>
  <input type="text" class="form-control" name="email" id="email" placeholder="email ">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">password:</label>
  <input type="text" class="form-control" name="password" id="password" placeholder="password">
</div>


      <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
        <input class="btn btn-primary" type="submit" value="Create admin"/>
      </div>
     
    </form>
      
                    </div>
                </div>
                
              
                <?php require_once ("../view/footer.php");?>