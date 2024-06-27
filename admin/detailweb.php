
<?php
include_once dirname(__FILE__) . '../../auth/auth.php';
require_once "../view/navbar.php"; ?>
<!-- <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/table.css"> -->
    <div class="container-fluid" >
<div class="card shadow">
                        <div class="card-header py-3">
        
<!-- //                             <p class="text-primary m-0 fw-bold"> echo $row.</p> -->
                        <?php
                        require_once "../config/database.php";

                        // Tạo kết nối cơ sở dữ liệu
                        $conn = mysqli_connect("localhost", "root", "", "xmouse");
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        
                       // Kiểm tra xem ID sản phẩm đã được đặt chưa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $detail = "SELECT * FROM admin WHERE id = ?";
  
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
                          if ($row && !empty($row['admin_code'])) {
                          
                            echo '<p class="text-primary m-0 fw-bold">User ID : '.$row['admin_code'].'</p>';
                          } else {
                            echo 'user not found.';
                          }
                        } else {
                          echo 'No user ID specified.';
                        }
                        
                        ?>
                            
                        </div>
                        <div class="card-body">
        <!-- <div class="card-body"> -->
        <div style="overflow:hidden;">
            <section class="clean-block about-us" style="margin-bottom: -1px;padding-bottom: 15px;">
                <div class="row" style="margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
                    <a href="../admin.php" style="text-decoration: none; color:#4e73df;"><div class="col"><i class="fa fa-long-arrow-left"></i><span>&nbsp; ⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>
                        <?php
require_once "../config/database.php";

// Tạo kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "xmouse");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Kiểm tra xem ID sản phẩm đã được đặt chưa
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $detail = "SELECT * FROM admin WHERE id = ?";

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
                        if ($row) {
                          // <h2 class="text-info" style="padding-bottom: 0px;margin-bottom: -20px;">' . $row["product_name"] . '</h2>
                            echo '<div class="block-heading" style="padding-top: 15px;">
                           
                        </div>
                       <div class="row justify-content-center">
                            <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5" style="padding-right: 0px;padding-left: 0px;">
                                <div class="card clean-card text-center">
                                    <div class="card-body info">';

                    echo '<div class="row">
                            <div class="col" style="padding-bottom: 6px;">
                                <p class="labels"><strong>First Name</strong></p>
                            </div>
                            <div class="col">
                                <p class="labels">' . $row["firstname"] . '</p>
                            </div>
                        </div>';
                    echo '<div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <p class="labels"><strong>Last Name</strong></p>
                            </div>
                            <div class="col">
                                <p class="labels">' . $row["lastname"] . '</p>
                            </div>
                        </div>';
                    echo '<div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <p class="labels"><strong>Email</strong></p>
                            </div>
                            <div class="col">
                                <p class="labels">' . $row["email"] . '</p>
                            </div>
                        </div>';
                   
                    echo '<div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <p class="labels"><strong>Password</strong><br></p>
                            </div>
                            <div class="col">
                                <p class="labels">' . $row["password"] . '</p>
                            </div>
                        </div>';
               
                    echo '<div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <p class="labels"><strong>Time Update</strong></p>
                            </div>
                            <div class="col">
                                <p class="labels">'.$row["updated_at"] .'</p>
                            </div>
                        </div>';
                        echo '<div class="row" style="margin-top: 10px;">
                        <div class="col">
                            <p class="labels"><strong>Time Create</strong></p>
                        </div>
                        <div class="col">
                            <p class="labels">'.$row["created_at"] .'</p>
                        </div>
                    </div>';
                 
                        } else {
                          echo 'Product not found.';
                        }
                      } else {
                        echo 'No product ID specified.';
                      }
                      
                    //  echo '<button type="submit" value="Edit Product" class="btn btn-primary" onclick="backtoproduct()">Back to product</button>';
?>
     <!-- <button type="submit" value="Edit Product" class="btn btn-primary" onclick="backtoproduct()">Back to product</button> -->
                    </div>
                </div>
  </div>
  </div>
  </div>
  </div>
  </div>
    <script>
    function backtoproduct() {
        // // Reload the home page 
          window.location.href = "../products.php";
        }
    </script>
    <?php require_once "../view/footer.php"; ?>
     
