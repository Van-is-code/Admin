<?php
session_start();
require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $desc = $_POST['description'];

  echo $name . " " . $price . " " . $image . " " . $desc;

  
  // Establish database connection
  $servername = "localhost";
  $username = "your_username";
  $password = "your_password";
  $dbname = "your_database_name";
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
    // Upload image
    $targetDir = "../upload";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    $newFileName = uniqid() . '.' . $imageFileType;
    $targetPath = $targetDir . $newFileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

  
  // INSERT INTO DB
  $sql = "INSERT INTO `products` (`product_name`, `prd_price`, `prd_description`, `prd_image`) "
    . " VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $name, $price, $desc, $image);
  if ($stmt->execute()) {
    $message = "Insert OK";
    //header("location: home.php");
  } else {
    $error = "Something wrong";
  }

  $stmt->close();
  $conn->close();
}
?>

<html>
<head>
  <meta charset="utf-8"/>
</head>
<body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title" id="myModalLabel">Add product</h4>
      </div>
      <form action="add.php" method="POST">
        <div class="modal-body">
          <!-- Your modal content here -->
          <!-- <form action="process_form.php" method="POST"> -->
          <tr>
            Name Product:
            <input type="text" name="name" id="name"/>
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
          <!-- <br>
          <br>
          <tr>
           <input type="submit" value="Create Product" class="btn btn-primary"/>
          </tr> -->
          <!-- </form> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Close
          </button>
          <input type="submit" value="Create Product" class="btn btn-primary" onclick="saveChanges()"/>

          <!-- <button type="submit" value="Create Product" class="btn btn-primary" onclick="saveChanges()">Save changes</button> -->


        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // closeModal
  function closeModal() {
    // Add your close logic here

    // Close the modal
    $("#myModal").modal("hide");
  }

  // SaveChanges
  function saveChanges() {
      // Add your save logic here
      // Show success message
      alert("Data has been added successfully");

      // Close the modal after 2 seconds
      setTimeout(function() {
        $("#myModal").modal("hide");
      }, 10);

      // Reload the home page after 3 seconds
      setTimeout(function() {
        window.location.href = "../products.php";
      }, 10);
  }

  // Show Modal    
  $(document).ready(function () {
    $("#addButton").click(function () {
      // Show the modal
      $("#myModal").modal("show");
    });
  });
</script>


  <script>


    $(document).ready(function () {
      // Xử lý sự kiện khi người dùng nhấn nút "Create Product"
      $("#myModal form").submit(function (e) {
        e.preventDefault(); // Ngăn chặn form gửi dữ liệu mặc định
  
        // Lấy dữ liệu từ form
        var name = $("#name").val();
        var price = $("#price").val();
        var desc = $("#description").val();
        var image = $("#image").val();
  
        // Gửi dữ liệu bằng AJAX
        $.ajax({
          url: "add.php",
          method: "POST",
          data: {
            name: name,
            price: price,
            description: desc,
            image: image
          },
          // beforeSend: function () {
          //   // Hiển thị loading spinner hoặc thông báo đang xử lý
          //   // Ví dụ: $("#loading").show();
          // },
          success: function (response) {
            // Xử lý phản hồi từ server
            if (response === "success") {
              alert("dữ liệu đã được thêm thành công");
              // Nếu thành công, đóng modal và tải lại trang ../products.php
              closeModal();
              setTimeout(function() {
                window.location.href = "../products.php";
              }, 500);
            } else {
              // Nếu có lỗi, hiển thị thông báo lỗi
              console.error("Something went wrong. Please try again.");
            }
          },
          complete: function () {
            // Ẩn loading spinner hoặc thông báo đang xử lý
            // Ví dụ: $("#loading").hide();
          }
        });
      });
    });
  
    // closeModal
    function closeModal() {
      // Add your close logic here
  
      // Close the modal
      $("#myModal").modal("hide");
    }
  </script>
</body>
</html>