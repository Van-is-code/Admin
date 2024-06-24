<?php 
include_once dirname(__FILE__) . '../../auth/auth.php';
session_start();
require_once ("../view/navbar.php");
require_once "../config/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["category_id"];
    $name = $_POST['category'];
   
 

    // INSERT INTO DB
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeUpdate = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `category` ( `category_id`,`category`,  `time_update`) "
    . " VALUES ( '$id','$name', '$timeUpdate');";
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
         <p class="text-primary m-0 fw-bold"> Add Category</p>
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
  <label for="formGroupExampleInput" class="form-label">Name category:</label>
  <input type="text" class="form-control" name="category" id="category" placeholder="Name category">
</div>

      <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
        <input class="btn btn-primary" type="submit" value="Create category"/>
      </div>
      <!-- <div style="width: 16%; margin-top: 10px;" >
        <a type="button" class="btn btn-default" onclick="backtoproduct()" >Back to Product</a>
      </div> -->
    </form>
      
                    </div>
                </div>
                <!-- <script>
                  function backtoproduct() {
                    window.location.href = "../products.php";
                  }
                </script> -->
              
                <?php require_once ("../view/footer.php");?>