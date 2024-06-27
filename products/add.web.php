<?php 
require_once "../auth/auth.php";
require_once "../view/navbar.php";
require_once "../config/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["product_code"];
  $name = htmlspecialchars( $_POST['name']);
  $price = $_POST['price'];
  $desc = htmlspecialchars($_POST['description']);
  $title = htmlspecialchars($_POST['infor_name']);
  $detail = htmlspecialchars($_POST['detail']);
  $youtube_link = $_POST['youtube_link'];
  $brand_id = $_POST['brand_id'];
  $size =htmlspecialchars( $_POST['size']);
  $weight =htmlspecialchars( $_POST['weight']);
  $shape = htmlspecialchars($_POST['shape']);
  $switch_type = $_POST['switch_type'];
  $sensor_type = $_POST['sensor_type'];
  $warranty = htmlspecialchars($_POST['warranty']);

  // INSERT INTO DB
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $timeCreated = date('Y-m-d H:i:s');
  $sql = "INSERT INTO `product` (`product_code`,`product_name`, `price`, `description`, `infor_name`, `detail`, `youtube_link`,`size`, `weight`, `shape`, `switch_type`, `sensor_type`, `warranty`, `brand_id`, `created_at`) "
    . " VALUES ('$id','$name', '$price', '$desc', '$title', '$detail', '$youtube_link', '$size', '$weight', '$shape', '$switch_type', '$sensor_type', ' $warranty', '$brand_id', '$timeCreated')"; // Use the correct table name and column names
  if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success'>Dữ liệu đã được lưu vào database</div>";
    echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    // echo "<script>setTimeout(function() { window.location.href = 'add.web.php'; }, 2000);</script>";
  
    $message = "Insert OK";
    
    // Get the last inserted product ID
    $productId = $conn->insert_id;
    
    // Insert product ID into "image" table
    $sqlImage = "INSERT INTO `image` (`product_id`) VALUES ('$productId')"; // Use the correct table name and column names
    $conn->query($sqlImage);
  } else {
    echo "<div class='alert alert-danger'>Something went wrong</div>";
    echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    $error = "Something wrong";
  }

  // Check if the image files are set
  if(isset($_FILES["image"])) {
    $image_1 = $_FILES['image']['name'];
    $image_2 = $_FILES['image2']['name'];
    $image_3 = $_FILES['image3']['name'];
    $image_4 = $_FILES['image4']['name'];
    $image_5 = $_FILES['image5']['name'];
    
    // Upload images
    $targetDir = "../upload/product/"; // Add a dot (.) before the slash (/)
    $image_1_targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $image_2_targetFile = $targetDir . basename($_FILES["image2"]["name"]);
    $image_3_targetFile = $targetDir . basename($_FILES["image3"]["name"]);
    $image_4_targetFile = $targetDir . basename($_FILES["image4"]["name"]);
    $image_5_targetFile = $targetDir . basename($_FILES["image5"]["name"]);
    
    $image_1_fileType = strtolower(pathinfo($image_1_targetFile, PATHINFO_EXTENSION));
    $image_2_fileType = strtolower(pathinfo($image_2_targetFile, PATHINFO_EXTENSION));
    $image_3_fileType = strtolower(pathinfo($image_3_targetFile, PATHINFO_EXTENSION));
    $image_4_fileType = strtolower(pathinfo($image_4_targetFile, PATHINFO_EXTENSION));
    $image_5_fileType = strtolower(pathinfo($image_5_targetFile, PATHINFO_EXTENSION));
    
    $image_1_newFileName = uniqid() . '.' . $image_1_fileType;
    $image_2_newFileName = uniqid() . '.' . $image_2_fileType;
    $image_3_newFileName = uniqid() . '.' . $image_3_fileType;
    $image_4_newFileName = uniqid() . '.' . $image_4_fileType;
    $image_5_newFileName = uniqid() . '.' . $image_5_fileType;
    
    $image_1_targetPath = $targetDir . $image_1_newFileName;
    $image_2_targetPath = $targetDir . $image_2_newFileName;
    $image_3_targetPath = $targetDir . $image_3_newFileName;
    $image_4_targetPath = $targetDir . $image_4_newFileName;
    $image_5_targetPath = $targetDir . $image_5_newFileName;
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_1_targetPath)) {
      echo "<div class='alert alert-success'>The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded image 1.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
      $image_1 = $image_1_newFileName;
      
      // Update image_1 in "image" table
      $sqlImage_1 = "UPDATE `image` SET `image_1` = '$image_1' WHERE `product_id` = '$productId'"; // Use the correct table name and column names
      $conn->query($sqlImage_1);
    } else {
      echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    }
    
    if (move_uploaded_file($_FILES["image2"]["tmp_name"], $image_2_targetPath)) {
      echo "<div class='alert alert-success'>The file " . htmlspecialchars(basename($_FILES["image2"]["name"])) . " has been uploaded image 2.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
      $image_2 = $image_2_newFileName;
      
      // Insert image into "image" table
      $sqlImage_2 = "UPDATE `image` SET `image_2` = '$image_2' WHERE `product_id` = '$productId'"; // Use the correct table name and column names
      $conn->query($sqlImage_2);
    } else {
      echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file iamge 2.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    }
    
    if (move_uploaded_file($_FILES["image3"]["tmp_name"], $image_3_targetPath)) {
      echo "<div class='alert alert-success'>The file " . htmlspecialchars(basename($_FILES["image3"]["name"])) . " has been uploaded image 3.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
      $image_3 = $image_3_newFileName;
      
      // Insert image into "image" table
      $sqlImage_3 = "UPDATE `image` SET `image_3` = '$image_3' WHERE `product_id` = '$productId'"; // Use the correct table name and column names
      $conn->query($sqlImage_3);
    } else {
      echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file iamge 3.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    }
    
    if (move_uploaded_file($_FILES["image4"]["tmp_name"], $image_4_targetPath)) {
      echo "<div class='alert alert-success'>The file " . htmlspecialchars(basename($_FILES["image4"]["name"])) . " has been uploaded image 4.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
      $image_4 = $image_4_newFileName;
      
      // Insert image into "image" table
      $sqlImage_4 = "UPDATE `image` SET `image_4` = '$image_4' WHERE `product_id` = '$productId'"; // Use the correct table name and column names
      $conn->query($sqlImage_4);
    } else {
      echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file iamge 4.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    }
    
    if (move_uploaded_file($_FILES["image5"]["tmp_name"], $image_5_targetPath)) {
      echo "<div class='alert alert-success'>The file " . htmlspecialchars(basename($_FILES["image5"]["name"])) . " has been uploaded image 5.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
      $image_5 = $image_5_newFileName;
      
      // Insert image into "image" table
      $sqlImage_5 = "UPDATE `image` SET `image_5` = '$image_5' WHERE `product_id` = '$productId'"; // Use the correct table name and column names
      $conn->query($sqlImage_5);
    } else {
      echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file iamge 5.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 3000);</script>";
    }
  } else {
    $image_1 = "";
    $image_2 = "";
    $image_3 = "";
    $image_4 = "";
    $image_5 = "";
  }

  $conn->close();
}

?>

<div class="container-fluid">
          
<div class="card shadow">
<div class="card-header py-3">
  <p class="text-primary m-0 fw-bold">Add Product </p>
  </div>
  <div class="card-body">
<div class="row" style="margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
    <a href="../products.php" style="text-decoration: none; color:#4e73df; ">
        <div class="col"><i class="fa fa-long-arrow-left"></i><span style="font-family:2% ;">⟵ Back</span></div>
      </a>
      <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;">
        <a class="anone" href="listaBitacoras.html"></a>
      </div>
    </div>
  
 
     
        <form method="post" enctype="multipart/form-data">
          <table>
            <tr>
              <td>
              <div class="mb-3">
      <label for="formGroupExampleInput" class="form-label">Product ID:</label>
      <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Product code">
    </div>
              </td>
              <td></td>
              <td>
              <div class="mb-3">
      <label for="formGroupExampleInput" class="form-label">Name Product:</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Name product">
    </div>
              </td>
              <td></td>
              <td>
              <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Price:</label>
                <input type="number" step="0.01" class="form-control" name="price" id="price" placeholder="Price" required>
              </div>
              </td>
             
            </tr>

         
            <tr>
            <td>
              <div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Brand ID:</label>
      <input type="text" class="form-control" name="brand_id" id="brand_id" placeholder="Brand ID">
    </div>
              </td>  
              <td></td>
                     <td>
              <div class="mb-3">
   <label for="formGroupExampleInput2" class="form-label">Title</label>
   <input type="text" class="form-control" name="infor_name" id="infor_name" placeholder="title">
 </div>
              </td>
              <td></td>
              <td>
              <div class="mb-3">
   <label for="formGroupExampleInput2" class="form-label">Link Youtobe</label>
   <input type="url" class="form-control" name="youtube_link" id="youtube_link" placeholder="youtube_link">
 </div>
              </td>
   
            </tr>

        

            <tr>
              <td>
              <div class="mb-3">
   <label for="formGroupExampleInput2" class="form-label">Size</label>
   <input type="text" class="form-control" name="size" id="size" placeholder="size">
 </div>

              </td>
              <td></td>
              <td>
              <div class="mb-3">
   <label for="formGroupExampleInput2" class="form-label">Weight:</label>
   <input type="text" class="form-control" name="weight" id="weight" placeholder="weight">
 </div>
              </td>
              <td></td>
              <td>
              <div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Shape:</label>
      <input type="text" class="form-control" name="shape" id="shape" placeholder="shape">
    </div>

              </td>
            </tr>

            <tr>
             
              <td>

              <div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Switch:</label>
      <input type="text" class="form-control" name="switch_type" id="switch_type" placeholder="switch_type">
    </div>
              </td>
              <td></td>
              <td>
              <div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Sensor:</label>
      <input type="text" class="form-control" name="sensor_type" id="sensor_type" placeholder="sensor_type">
    </div>
              </td>
              <td></td>
              <td>

<div class="mb-3">
<label for="formGroupExampleInput2" class="form-label">Warranty:</label>
<input type="text" class="form-control" name="warranty" id="warranty" placeholder="warranty">
</div>
</td>
            </tr>
            
            <tr>
              <td>
              <div class="mb-3">
   <label for="formGroupExampleInput2" class="form-label">detail:</label>
   <textarea style="width: 150%;" type="text" class="form-control" name="detail" id="detail" placeholder="detail"></textarea>
 </div>

              </td>
             
              <td></td>
              
             
              <td>
              <div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Description:</label>
      <textarea style="width: 150%;" type="text" class="form-control" name="description" id="description" placeholder="Description"></textarea>
    </div>
              </td>
             
            </tr>

            <tr>
              <td>
              <div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Image 1:</label>
      <input type="file" class="form-control" name="image" id="image" placeholder="">
      <div id="image-preview"></div>
    </div>
    
              </td>
              <td>

              <div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Image 2:</label>
      <input type="file" class="form-control" name="image2" id="image2" placeholder="">
      <div id="image2-preview"></div>
    </div>
              </td>
              <td>


              <div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Image 3:</label>
      <input type="file" class="form-control" name="image3" id="image3" placeholder="">
      <div id="image3-preview"></div>
    </div>
</td>
<td>

<div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Image 4:</label>
      <input type="file" class="form-control" name="image4" id="image4" placeholder="">
      <div id="image4-preview"></div>
    </div>
</td>
<td>

<div class="mb-3">
      <label for="formGroupExampleInput2" class="form-label">Image 5:</label>
      <input type="file" class="form-control" name="image5" id="image5" placeholder="">
      <div id="image5-preview"></div>
    </div>
</td>
            </tr>

    <script>
      // Preview the selected image before uploading
      document.getElementById("image").addEventListener("change", function() {
        var reader = new FileReader();
        reader.onload = function(e) {
          var imagePreview = document.getElementById("image-preview");
          imagePreview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 200px; max-height: 200px;">';
        };
        reader.readAsDataURL(this.files[0]);
      });

      document.getElementById("image2").addEventListener("change", function() {
        var reader = new FileReader();
        reader.onload = function(e) {
          var imagePreview = document.getElementById("image2-preview");
          imagePreview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 200px; max-height: 200px;">';
        };
        reader.readAsDataURL(this.files[0]);
      });

      document.getElementById("image3").addEventListener("change", function() {
        var reader = new FileReader();
        reader.onload = function(e) {
          var imagePreview = document.getElementById("image3-preview");
          imagePreview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 200px; max-height: 200px;">';
        };
        reader.readAsDataURL(this.files[0]);
      });

      document.getElementById("image4").addEventListener("change", function() {
        var reader = new FileReader();
        reader.onload = function(e) {
          var imagePreview = document.getElementById("image4-preview");
          imagePreview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 200px; max-height: 200px;">';
        };
        reader.readAsDataURL(this.files[0]);
      });

      document.getElementById("image5").addEventListener("change", function() {
        var reader = new FileReader();
        reader.onload = function(e) {
          var imagePreview = document.getElementById("image5-preview");
          imagePreview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 200px; max-height: 200px;">';
        };
        reader.readAsDataURL(this.files[0]);
      });
    </script>
    
    </table>
    <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
      <input class="btn btn-primary" type="submit" value="Create Product" />
    </div>
   
    </div>
    </div>

    
</div>

<?php include_once("../view/footer.php");?>
    
