<?php 
include_once dirname(__FILE__) . '../../auth/auth.php';
session_start();
require_once "../view/navbar.php";
require_once "../config/database.php";

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
  $name = isset($_POST['category']) ? $_POST['category'] : '';
  $timeUpdate = isset($_POST['time_update']) ? $_POST['time_update'] : '';

  

  
  if(isset($_POST['edit_category'])) {
    // UPDATE DB
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeUpdate = date('Y-m-d H:i:s');
    $update = "UPDATE `category` SET `category_id`=IF('$category_id'='', `category_id`, '$category_id'), `category`=IF('$name'='', `category`, '$name'),  `time_update`=IF('$timeUpdate'='', `time_update`, '$timeUpdate') WHERE `id`='$id'";
    if ($conn->query($update) === TRUE) {
      echo "<div class='alert alert-success'>The category has been updated.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 500);</script>";
      echo "<script>setTimeout(function() { window.location.href = '../category.php'; }, 1000);</script>";
      
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
                        <!-- <?php 
                        include "../config/database.php";
                      
                        // Tạo kết nối cơ sở dữ liệu
                        $conn = mysqli_connect("localhost", "root", "", "dbwebsite");
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }

                        // Kiểm tra xem ID sản phẩm đã được đặt chưa
                        if (isset($_GET['id'])) {
                          $id = $_GET['id'];
                          $detail = "SELECT * FROM products WHERE id = ?";

                          // Chuẩn bị câu lệnh
                          $stmt = mysqli_prepare($conn, $detail);

                          // Liên kết tham số
                          mysqli_stmt_bind_param($stmt, "i", $id);

                          // Thực thi câu lệnh
                          mysqli_stmt_execute($stmt);

                          // Lấy kết quả
                          $result = mysqli_stmt_get_result($stmt);

                          // Lấy các hàng
                          $row = mysqli_fetch_array($result);
                          if ($row && !empty($row['product_id'])) {

                            echo '<p class="text-primary m-0 fw-bold">Product ID : ' . $row['product_id'] . '</p>';
                          } else {
                            echo 'Product not found.';
                          }
                        } else {
                          echo 'No product ID specified.';
                        }

                        mysqli_close($conn);
                        ?> -->
                        <p class="text-primary m-0 fw-bold">Edit category </p>
                              </div>
                                 <div class="card-body">
                          
                                 <div class="row" style=" margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
                    <a href="../category.php" style="text-decoration: none; color:#4e73df; "><div class="col"><i  class="fa fa-long-arrow-left"></i><span style="font-family:2% ;">⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>                
    <form  method="post" enctype="multipart/form-data">
    <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Category ID:</label>
  <input type="text" class="form-control" name="category_id" id="category_id" placeholder="category_id">
</div>   

       <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Name:</label>
  <input type="text" class="form-control" name="category" id="category" placeholder="category ">
</div>

      <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
        <input name="edit_category" class="btn btn-primary" type="submit" value="Edit category"/>
      </div>
    
    </form>
      
                    </div>
                </div>
              
              
                <?php require_once ("../view/footer.php");?>