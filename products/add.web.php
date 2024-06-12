<?php 
session_start();
require_once ("../view/navbar.php");
require_once "../config/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["product_id"];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    // Check if the image file is set
    if(isset($_FILES["image"])) {
        $image = $_FILES['image']['name'];
    
        // Upload image
        $targetDir = "../upload/";
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
    $sql = "INSERT INTO `products` (`product_name`, `prd_price`, `prd_description`, `prd_image`, `time_update`) "
    . " VALUES ('$name', '$price', '$desc', '$image', '$timeUpdate');";
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
         <p class="text-primary m-0 fw-bold"> Add Product</p>
                              </div>
                                 <div class="card-body">
                          
                           
    <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Product ID:</label>
  <input type="text" class="form-control" name="product_id" id="product_id" placeholder="product_id">
</div>   

       <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Name Product:</label>
  <input type="text" class="form-control" name="name" id="name" placeholder="Name product">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Price:</label>
  <input type="number" class="form-control" name="price" id="price" placeholder="Price">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Description:</label>
  <input type="text" class="form-control" name="description" id="description" placeholder="Description">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Image:</label>
  <input type="file" class="form-control"  name="image" id="image" placeholder="">
</div>
      <div >
        <input class="btn btn-primary" type="submit" value="Create Product"/>
      </div>
      <div >
        <a type="button" class="btn btn-default"  >Back to Product</a>
      </div>
    </form>
      
                    </div>
                </div>
                <?php require_once ("../view/footer.php");?>