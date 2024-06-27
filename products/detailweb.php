
<?php 
include_once dirname(__FILE__) . '../../auth/auth.php';
require_once "../view/navbar.php"; ?>

    <div class="container-fluid" >
<div class="card shadow">
                        <div class="card-header py-3">
        

                        <?php
                     
require_once "../config/database.php";
                   
                       // Kiểm tra xem ID sản phẩm đã được đặt chưa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $detail = "SELECT * FROM product WHERE id = ?";
  
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
                          if ($row && !empty($row['product_code'])) {
                          
                            echo '<p class="text-primary m-0 fw-bold">Product ID : '.$row['product_code'].'</p>';
                          } else {
                            echo 'Product not found.';
                          }
                        } else {
                          echo 'No product ID specified.';
                        }
                        
                        ?>
                            
                        </div>
                        <div class="card-body">
        <!-- <div class="card-body"> -->
        <div style="overflow:hidden;">
            <section class="clean-block about-us" style="margin-bottom: -1px;padding-bottom: 15px;">
                <div class="row" style="margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
                    <a href="../products.php" style="text-decoration: none; color:#4e73df;"><div class="col"><i class="fa fa-long-arrow-left"></i><span>&nbsp; ⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>
                        <?php
                       
                       require_once "../config/database.php";

                    

                        // Kiểm tra xem ID sản phẩm đã được đặt chưa
                        if (isset($_GET['id'])) {
                          $id = $_GET['id'];
                          $detail = "SELECT p.*, b.name AS brand_name, i.* FROM product p 
                          INNER JOIN brand b ON p.brand_id = b.id 
                          INNER JOIN image i ON p.id = i.product_id 
                          WHERE p.id = ?";

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
                            
                            <div class="row">  
                            <div class="col image-container" style=" width: 75% ">
                            <img style="width:75% " class="card-img-top w-80 d-block" src="../upload/product/'.$row['image_1'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this) ">
                            </div>
                            <div class="col image-container" style="width: 75% ">
                            <img style="width:75% " class="card-img-top w-80 d-block" src="../upload/product/'.$row['image_2'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">
                            </div>
                            <div class="col image-container" style="width: 75%  ">
                            <img style="width:75% " class="card-img-top w-80 d-block" src="../upload/product/'.$row['image_3'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">
                            </div>
                            <div class="col image-container" style="width: 75% ">
                            <img style="width:75% " class="card-img-top w-80 d-block" src="../upload/product/'.$row['image_4'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">
                            </div>
                            <div class="col image-container" style="width: 75% ">
                            <img style="width:75% " class="card-img-top d-block" src="../upload/product/'.$row['image_5'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">
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
                              <div class="col" style="padding-bottom: 6px;">
                                <p class="labels"><strong>Product Name</strong></p>
                              </div>
                              <div class="col">
                                <p class="labels">' . $row["product_name"] . '</p>
                              </div>
                              </div>';
                          echo '<div class="row" style="margin-top: 10px;">
                              <div class="col">
                                <p class="labels"><strong>Price</strong></p>
                              </div>
                              <div class="col">
                                <p class="labels">' . $row["price"] . '</p>
                              </div>
                              </div>';
                          echo '<div class="row" style="margin-top: 10px;">
                              <div class="col">
                                <p class="labels"><strong>Brand</strong></p>
                              </div>
                              <div class="col">
                                <p class="labels">' . $row["brand_name"] . '</p>
                              </div>
                              </div>';
                        
                          echo '<div class="row" style="margin-top: 10px;">
                                  <div class="col">
                                      <p class="labels"><strong>Size</strong><br></p>
                                  </div>
                                  <div class="col">
                                      <p class="labels">No ' . $row["size"] . '</p>
                                  </div>
                              </div>';
                          echo '<div class="row" style="margin-top: 10px;">
                                  <div class="col">
                                      <p class="labels"><strong>Weight</strong></p>
                                  </div>
                                  <div class="col">
                                      <p class="labels">' . $row["weight"] . '</p>
                                  </div>
                              </div>';
                          echo '<div class="row" style="margin-top: 10px;">
                                  <div class="col">
                                      <p class="labels"><strong>Shape</strong></p>
                                  </div>
                                  <div class="col">
                                      <p class="labels">' . $row["shape"] . '</p>
                                  </div>
                              </div>';
                              echo '<div class="row" style="margin-top: 10px;">
                              <div class="col">
                                  <p class="labels"><strong>Switch</strong></p>
                              </div>
                              <div class="col">
                                  <p class="labels">' . $row["switch_type"] . '</p>
                              </div>
                          </div>';
                          echo '<div class="row" style="margin-top: 10px;">
                          <div class="col">
                              <p class="labels"><strong>Sensor</strong></p>
                          </div>
                          <div class="col">
                              <p class="labels">' . $row["sensor_type"] . '</p>
                          </div>
                      </div>';
                      echo '<div class="row" style="margin-top: 10px;">
                      <div class="col">
                          <p class="labels"><strong>Warranty</strong></p>
                      </div>
                      <div class="col">
                          <p class="labels">' . $row["warranty"] . '</p>
                      </div>
                  </div>';
                  echo '<div class="row" style="margin-top: 10px;">
                  <div class="col">
                    <p class="labels"><strong>Description</strong></p>
                  </div>
                  <div class="col">
                    <p class="labels">' . $row["description"] . '</p>
                  </div>
                  </div>';
          
              echo '<div class="row" style="margin-top: 10px;">
                      <div class="col">
                          <p class="labels"><strong>' . $row["infor_name"] . '</strong><br></p>
                      </div>
                      <div class="col">
                          <p class="labels">' . $row["detail"] . '</p>
                      </div>
                  </div>';
                  echo '<div class="row" style="margin-top: 10px;">
                  <div class="col">
                    <p class="labels"><strong>Youtobe</strong></p>
                  </div>
                  <div class="col">
                    <p class="labels">'.$row["youtube_link"] .'</p>
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
                                <p class="labels"><strong>Time Update</strong></p>
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

                       
                        ?>
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
     
