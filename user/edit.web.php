<?php 
include_once dirname(__FILE__) . '../../auth/auth.php';
require_once ("../view/navbar.php");
require_once "../config/database.php";

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $first = isset($_POST['firstname']) ? $_POST['firstname'] : '';
  $last = isset($_POST['lastname']) ? $_POST['lastname'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $timeUpdate = isset($_POST['updated_at']) ? $_POST['updated_at'] : '';

  
  
  
  
  if(isset($_POST['edit_user'])) {
    // UPDATE DB
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeUpdate = date('Y-m-d H:i:s');
    $update = "UPDATE `user` SET `firstname`=IF('$first'='', `firstname`, '$first'), `lastname`=IF('$last'='', `lastname`, '$last'), `email`=IF('$email'='', `email`, '$email'),  `password`=IF('$password'='', `password`, '$password'), `updated_at`=IF('$timeUpdate'='', `updated_at`, '$timeUpdate') WHERE `id`='$id';";
    if ($conn->query($update) === TRUE) {
      echo "<div class='alert alert-success'>The product has been updated.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 500);</script>";
      echo "<script>setTimeout(function() { window.location.href = '../user.php'; }, 1000);</script>";
      
      $message = "Update OK";
     
    } else {
      echo "<div class='alert alert-danger'>Something went wrong</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
      $error = "Something wrong";
    }

    $conn->close();
  }
}

?>

<div class="container-fluid">
                    
<div class="card shadow">
                        <div class="card-header py-3">
                       
                        <p class="text-primary m-0 fw-bold">Edit User </p>
                              </div>
                                 <div class="card-body">
                          
                                 <div class="row" style=" margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
                    <a href="../user.php" style="text-decoration: none; color:#4e73df; "><div class="col"><i  class="fa fa-long-arrow-left"></i><span style="font-family:2% ;">⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>                
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">First Name:</label>
        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname" >
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Last Name:</label>
        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="lastname" >
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="email" >
       
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="password" >
      </div>
      <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Create User"/>
      </div>
    </form>
                    </div>
                </div>
              
              
                <?php require_once ("../view/footer.php");?>