<?php
include_once dirname(__FILE__) . '../../auth/auth.php';
//kết nối 
require_once "../config/database.php";
// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "dbwebsite");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//câu lệnh 
if(isset($_GET['67'])) {
  $id = $_GET['67'];
  $update = "UPDATE `products` SET `product_name` = ?, `prd_price` = ?, `prd_description` = ?, `prd_image` = ? WHERE `id` = $id";
  //thực thi 
  $result = mysqli_query($conn, $update);
  $conn->close();
}
?>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title" id="myModalLabel">Edit product</h4>
      </div>
      <div class="modal-body">
        <!-- Your modal content here -->
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
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Close</button>
        <button type="submit" value="Edit Product" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  // closeModal
  function closeModal() {
    // Add your close logic here

    // Close the modal
    $("#editModal").modal("hide");
  }

  // saveChanges
function saveChanges() {
  // Get the form data
  var name = $("#name").val();
  var price = $("#price").val();
  var description = $("#description").val();
  var image = $("#image").val();

  // Send an AJAX request to update the database
  $.ajax({
    url: "update.php",
    method: "POST",
    data: {
      id: <?php echo $id; ?>,
      name: name,
      price: price,
      description: description,
      image: image
    },
    success: function(response) {
      // Close the modal
      $("#editModal").modal("hide");
  
      // Reload the home page
      window.location.href = "../products.php";
    },
    error: function(xhr, status, error) {
      // Handle the error
      console.log(error);
    }
  });
}

  // Show Modal    
  $(document).ready(function(){
    $("#edit").click(function(){
      // Show the modal
      $("#editModal").modal("show");
    });
  });
</script>