<?php 
include_once dirname(__FILE__) . '../../auth/auth.php'; 

require_once ("../view/navbar.php");
require_once "../config/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // $user_id = substr(uniqid('USER'), 0, 8);
  $user_id = "User" . rand(0, 1000);
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = "user";

    // Check if the image file is set
    if(isset($_FILES["image"])) {
        $image = $_FILES['image']['name'];
    
        // Upload image
        $targetDir = "../upload/user/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        $newFileName = uniqid() . '.' . $imageFileType;
        $targetPath = $targetDir . $newFileName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            echo "<div class='alert alert-success'>The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.</div>";
            echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
            // echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            $image = $newFileName; // Update the image variable with the new file name
        } else {
            
           echo "<div class='alert alert-danger'> Sorry, there was an error uploading your file.</div>";
           echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
        }
    } else {
        $image = "";
    }
    
    // INSERT INTO DB
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeUpdate = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `user` (`user_id`,`first_name`,`last_name`,`email`, `phone`, `password`,`role`,`image`, `time_update`) "
    . " VALUES ('$user_id ', '$first', '$last','$email','$phone','$password','$role','$image', '$timeUpdate');";
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
         <p class="text-primary m-0 fw-bold"> Add User</p>
                              </div>
                                 <div class="card-body">
                          
                                 <div class="row" style=" margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
                    <a href="../products.php" style="text-decoration: none; color:#4e73df; "><div class="col"><i  class="fa fa-long-arrow-left"></i><span style="font-family:2% ;">⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>                
    <form  method="post" enctype="multipart/form-data">
    <!-- <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">User ID:</label>
  <input type="text" class="form-control" name="user_id" id="user_id" placeholder="user_id">
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
  <label for="formGroupExampleInput2" class="form-label">Phone:</label>
  <input type="number" class="form-control" name="phone" id="phone" placeholder="phone">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">password:</label>
  <input type="text" class="form-control" name="password" id="password" placeholder="password">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Image:</label>
  <input type="file" class="form-control"  name="image" id="image" placeholder="">
</div>
      <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
        <input class="btn btn-primary" type="submit" value="Create User"/>
      </div>
     
    </form>
      
                    </div>
                </div>
                
              
                <?php require_once ("../view/footer.php");?>