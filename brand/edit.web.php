<?php 
include_once dirname(__FILE__) . '../../auth/auth.php';
require_once "../view/navbar.php";
require_once "../config/database.php";

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $timeUpdate = isset($_POST['updated_at']) ? $_POST['updated_at'] : '';

  
  // Check if the image file is set
  if(isset($_FILES["image"])) {
    $image = $_FILES['image']['name'];
  
    // Upload image
    $targetDir = "../upload/brand/";
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
  
  if(isset($_POST['edit_brand'])) {
    // UPDATE DB
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeUpdate = date('Y-m-d H:i:s');
    $update = "UPDATE `brand` SET `name`=IF('$name'='', `name`, '$name'),`image`=IF('$image'='', `image`, '$image'),`updated_at`=IF('$timeUpdate'='', `updated_at`, '$timeUpdate') WHERE `id`='$id'";
    if ($conn->query($update) === TRUE) {
      echo "<div class='alert alert-success'>The brand has been updated.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 500);</script>";
      // echo "<script>setTimeout(function() { window.location.href = '../brand.php'; }, 1000);</script>";
      
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
                       
                        <p class="text-primary m-0 fw-bold">Edit Brand </p>
                              </div>
                                 <div class="card-body">
                          
                                 <div class="row" style=" margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
                    <a href="../brand.php" style="text-decoration: none; color:#4e73df; "><div class="col"><i  class="fa fa-long-arrow-left"></i><span style="font-family:2% ;">⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>                
    <form  method="post" enctype="multipart/form-data">

       <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Name:</label>
  <input type="text" class="form-control" name="name" id="name" placeholder="name ">
</div>

<div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Image 1:</label>
      <input type="file" class="form-control" name="image" id="image" placeholder="">
      <div id="image-preview"></div>
    </div>
    <script>
      // Preview the selected image before uploading
      document.getElementById("image").addEventListener("change", function() {
        var reader = new FileReader();
        reader.onload = function(e) {
          var imagePreview = document.getElementById("image-preview");
          imagePreview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 200px; max-height: 200px;">';
        };
        reader.readAsDataURL(this.files[0]);
      });</script>

      <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
        <input name="edit_brand" class="btn btn-primary" type="submit" value="Edit Brand"/>
      </div>
    
    </form>
      
                    </div>
                </div>
              
              
                <?php require_once ("../view/footer.php");?>