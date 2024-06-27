
<?php
include_once dirname(__FILE__) . '../../auth/auth.php';
require_once "../view/navbar.php"; ?>

    <div class="container-fluid" >
<div class="card shadow">
                        <div class="card-header py-3">
        
                        <?php
                        require_once "../config/database.php";

                        // // Tạo kết nối cơ sở dữ liệu
                        // $conn = mysqli_connect("localhost", "root", "", "xmouse");
                        // if (!$conn) {
                        //   die("Connection failed: " . mysqli_connect_error());
                        // }
                        
                       // Kiểm tra xem ID sản phẩm đã được đặt chưa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $detail = "SELECT * FROM order_details WHERE id = ?";
  
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
                          if ($row && !empty($row['order_code'])) {
                          
                            echo '<p class="text-primary m-0 fw-bold">Order ID : '.$row['order_code'].'</p>';
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
                    <a href="../order.php" style="text-decoration: none; color:#4e73df;"><div class="col"><i class="fa fa-long-arrow-left"></i><span>&nbsp; ⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>
                        <?php
require_once "../config/database.php";



// Kiểm tra xem ID sản phẩm đã được đặt chưa
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $detail = "SELECT * FROM order_details 
           INNER JOIN `order` ON order_details.order_id = `order`.id
           INNER JOIN product ON order_details.product_id = product.id
           INNER JOIN image ON product.id = image.product_id
           WHERE order_details.id = ?";
    

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
                          <div class="row justify-content-center" >
                          <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5" style="padding-right: 0px;padding-left: 0px;">
                          <div class="card clean-card text-center">
                          
                          <div class="row">  
                          <div class="col image-container" style=" width: 75% ">
                          <img style="width:75% " class="card-img-top w-80 d-block" src="../upload/'.$row['image_1'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this) ">
                          </div>
                          <div class="col image-container" style="width: 75% ">
                          <img style="width:75% " class="card-img-top w-80 d-block" src="../upload/'.$row['image_2'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">
                          </div>
                          <div class="col image-container" style="width: 75%  ">
                          <img style="width:75% " class="card-img-top w-80 d-block" src="../upload/'.$row['image_3'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">
                          </div>
                          <div class="col image-container" style="width: 75% ">
                          <img style="width:75% " class="card-img-top w-80 d-block" src="../upload/'.$row['image_4'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">
                          </div>
                          <div class="col image-container" style="width: 75% ">
                          <img style="width:75% " class="card-img-top d-block" src="../upload/'.$row['image_5'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">
                          </div>
                          </div>
                          
                          <div class="card-body info">';
                          echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                              var images = document.querySelectorAll(".card-img-top");
                              images.forEach(function(image) {
                                  // Khi người dùng di chuột qua ảnh
                                  image.addEventListener("mouseover", function() {
                                      this.style.transform = "scale(1.5)"; // Phóng to ảnh lên 1.5 lần
                                      this.style.zIndex = "9999"; // Đưa ảnh lên phía trước các ảnh khác
                                  });
                                  // Khi người dùng rời chuột khỏi ảnh
                                  image.addEventListener("mouseout", function() {
                                      this.style.transform = "scale(1)"; // Trả ảnh về kích thước ban đầu
                                      this.style.zIndex = "auto"; // Đưa ảnh về vị trí mặc định
                                  });
                                  // // Khi người dùng nhấp vào ảnh
                                  // image.addEventListener("click", function() {
                                  //     this.style.transform = "scale(1)"; // Trả ảnh về kích thước ban đầu
                                  //     this.style.zIndex = "auto"; // Đưa ảnh về vị trí mặc định
                                  // });
                              });
                          });
                          
                          function bringToFront(image) {
                              var images = document.querySelectorAll(".card-img-top");
                              images.forEach(function(img) {
                                  img.style.zIndex = "auto"; // Đưa tất cả các ảnh về vị trí mặc định
                              });
                              image.style.zIndex = "9999"; // Đưa ảnh được hover lên phía trước
                          }
                          </script>';
                          echo '<style>
                            .modal {
                              display: none;
                              position: fixed;
                              z-index: 9999;
                              padding-top: 60px;
                              left: 0;
                              top: 0;
                              width: 100%;
                              height: 100%;
                              overflow: auto;
                              background-color: rgb(0,0,0);
                              background-color: rgba(0,0,0,0.9);
                            }
                            .modal-content {
                              margin: auto;
                              display: block;
                              width: 80%;
                              max-width: 700px;
                            }
                            .close {
                              position: absolute;
                              top: 15px;
                              right: 35px;
                              color: #f1f1f1;
                              font-size: 40px;
                              font-weight: bold;
                              transition: 0.3s;
                            }
                            .close:hover,
                            .close:focus {
                              color: #bbb;
                              text-decoration: none;
                              cursor: pointer;
                            }
                            </style>';

                          echo '<script>
                            function openModal(image) {
                              var modal = document.getElementById("myModal");
                              var modalImg = document.getElementById("modalImg");
                              modal.style.display = "block";
                              modalImg.src = image.src;
                            }
                            
                            function closeModal() {
                              var modal = document.getElementById("myModal");
                              modal.style.display = "none";
                            }

                            document.addEventListener("DOMContentLoaded", function() {
                              var modal = document.getElementById("myModal");
                              window.onclick = function(event) {
                                if (event.target == modal) {
                              modal.style.display = "none";
                                }
                              }
                            });
                            </script>';

                          echo '<div class="row">
                            <div id="myModal" class="modal">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <img class="modal-content" id="modalImg">
                            </div>
                            </div>';
                            echo '<div class="row" style="margin-top: 10px;">
                                   <div class="col">
                                       <p class="labels"><strong>Receiver</strong><br></p>
                                   </div>
                                   <div class="col">
                                       <p class="labels">' . $row["first_name"] . '' . $row["last_name"] . '</p>
                                   </div>
                               </div>';
                               echo '<div class="row" style="margin-top: 10px;">
                               <div class="col">
                                   <p class="labels"><strong>Phone Number</strong><br></p>
                               </div>
                               <div class="col">
                                   <p class="labels">' . $row["phone"] . '</p>
                               </div>
                           </div>';
                    echo '<div class="row">
                            <div class="col" style="padding-bottom: 6px;">
                                <p class="labels"><strong>First Name</strong></p>
                            </div>
                            <div class="col">
                                <p class="labels">' .$row["product_name"]. '</p>
                            </div>
                        </div>';
                   
                    echo '<div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <p class="labels"><strong>Price</strong></p>
                            </div>
                            <div class="col">
                                <p class="labels">' . $row["price"] . '$</p>
                            </div>
                        </div>';
                    echo '<div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <p class="labels"><strong>Quantity</strong></p>
                            </div>
                            <div class="col">
                                <p class="labels">' . $row["quantity"] . '</p>
                            </div>
                        </div>';
                    echo '<div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <p class="labels"><strong>Total</strong><br></p>
                            </div>
                            <div class="col">
                                <p class="labels">' . $row["total_money"] . '</p>
                            </div>
                        </div>';
                    // echo '<div class="row" style="margin-top: 10px;">
                    //         <div class="col">
                    //             <p class="labels"><strong>Sanitización de Suelo</strong><br></p>
                    //         </div>
                    //         <div class="col">
                    //             <p class="labels">' . $row["product_name"] . '</p>
                    //         </div>
                    //     </div>';
                    // echo '<div class="row" style="margin-top: 10px;">
                    //         <div class="col">
                    //             <p class="labels"><strong>Sanitización de Asientos</strong><br></p>
                    //         </div>
                    //         <div class="col">
                    //             <p class="labels">No ' . $row["product_name"] . '</p>
                    //         </div>
                    //     </div>';
                    // echo '<div class="row" style="margin-top: 10px;">
                    //         <div class="col">
                    //             <p class="labels"><strong>Fecha de Creación</strong></p>
                    //         </div>
                    //         <div class="col">
                    //             <p class="labels">' . $row["product_name"] . '</p>
                    //         </div>
                    //     </div>';
                    // echo '<div class="row" style="margin-top: 10px;">
                    //         <div class="col">
                    //             <p class="labels"><strong>Fecha de Edición</strong></p>
                    //         </div>
                    //         <div class="col">
                    //             <p class="labels">' . $row["product_name"] . '</p>
                    //         </div>
                    //     </div>';
                    // echo '<div class="row" style="margin-top: 10px;">
                    //         <div class="col">
                    //             <p class="labels"><strong>Time Update</strong></p>
                    //         </div>
                    //         <div class="col">
                    //             <p class="labels">'.$row["time_update"] .'</p>
                    //         </div>
                    //     </div>';
                    // echo '<div class="row" style="margin-top: 10px;">
                    //         <div class="col">
                    //             <p class="labels"><strong>Recipiente y Franela</strong></p>
                    //         </div>
                    //         <div class="col">
                    //             <p class="labels"><i class="fa fa-close" style="color: rgb(251,2,2);"></i></p>
                    //         </div>
                    //     </div>';
                    // echo "<div class='row'>";
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
     
