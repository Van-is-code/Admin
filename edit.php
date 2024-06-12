<?php
//kết nối 
require_once __DIR__ . "/config/database.php";
// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "dbwebsite");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//câu lệnh 
if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['image'])) {
  $id = 66;
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $image = $_POST['image'];

  $update = "UPDATE `products` SET `product_name` = '$name', `prd_price` = '$price', `prd_description` = '$description', `prd_image` = '$image' WHERE `id` = $id";
  //thực thi 
  $result = mysqli_query($conn, $update);
  if ($result) {
    echo "Data updated successfully!";
  } else {
    echo "Error updating data: " . mysqli_error($conn);
  }
  $conn->close();
}
?>

<form enctype="multipart/form-data" method="POST">
  <tr>
    Name Product:
    <input type="text" name="name" id="name" />
  </tr>
  <br>
  <br>
  <tr>
    Price:
    <input type="number" name="price" id="price"/>
  </tr>
  <br>
  <br>
  <tr>
    Description:
    <input type="text" name="description" id="description"/>
  </tr>
  <br>
  <br>
  <tr>
    Image:
    <input type="file" name="image" id="image"/>
  </tr>
  <br>
  <br>
  <button type="submit" value="Edit Product" class="btn btn-primary">Save changes</button>
</form>
