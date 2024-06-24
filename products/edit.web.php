<?php 
session_start();
require_once ("../view/navbar.php");
require_once "../config/database.php";

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $price = isset($_POST['price']) ? $_POST['price'] : '';
  $desc = isset($_POST['description']) ? $_POST['description'] : '';
  $timeUpdate = isset($_POST['time_update']) ? $_POST['time_update'] : '';
  $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : ''; // Modified variable name


  // Check if the image file is set
  if(isset($_FILES["image"])) {
    $image = $_FILES['image']['name'];
  
    // Upload image
    $targetDir = "../upload/products/";
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
  
  if(isset($_POST['edit_product'])) {
    // UPDATE DB
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeUpdate = date('Y-m-d H:i:s');
    $update = "UPDATE `products` SET `product_id`=IF('$product_id'='', `product_id`, '$product_id'), `product_name`=IF('$name'='', `product_name`, '$name'), `prd_price`=IF('$price'='', `prd_price`, '$price'), `prd_description`=IF('$desc'='', `prd_description`, '$desc'), `prd_image`=IF('$image'='', `prd_image`, '$image'), `category_id`=IF('$category_id'='', `category_id`, '$category_id'), `time_update`=IF('$timeUpdate'='', `time_update`, '$timeUpdate') WHERE `id`='$id';";
    if ($conn->query($update) === TRUE) {
      echo "<div class='alert alert-success'>The product has been updated.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 500);</script>";
      echo "<script>setTimeout(function() { window.location.href = '../products.php'; }, 1000);</script>";
      
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
    <p class="text-primary m-0 fw-bold">Edit Product </p>
  </div>
  <div class="card-body">
    <div class="row" style=" margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
      <a href="../products.php" style="text-decoration: none; color:#4e73df; "><div class="col"><i  class="fa fa-long-arrow-left"></i><span style="font-family:2% ;">⟵ back</span></div></a>
      <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
    </div>
  </div>                
  <form  method="post" enctype="multipart/form-data">
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

    <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
      <input name="edit_product" class="btn btn-primary" type="submit" value="Edit Product"/>
    </div>

    <div class="mb-3">
      <label for="formGroupExampleInput" class="form-label">Category:</label>
      <input type="text" list="category" name="category_id"> <!-- Use name="category_id" instead of name="brand" -->
      <datalist id="category">
        <?php 
        require_once "../config/database.php"; // Include the database connection file
        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<option value=".$row['category_id'].">" .$row['category']."</option>";
          }
        }
        $conn->close();
        ?>
      </datalist>
    </div>
  </form>
</div>

<?php require_once ("../view/footer.php");?>
