<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title" id="myModalLabel">Detail product</h4>
      </div>
      <div class="modal-body" id="modal-body-content">
      <?php
require_once "../config/database.php";

// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "dbwebsite");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the product ID is set
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $detail = "SELECT * FROM products WHERE id = ?";

  // Prepare the statement
  $stmt = mysqli_prepare($conn, $detail);

  // Bind the parameter
  mysqli_stmt_bind_param($stmt, "i", $id);

  // Execute the statement
  mysqli_stmt_execute($stmt);

  // Get the result
  $result = mysqli_stmt_get_result($stmt);

  // Fetch the rows
  $row = mysqli_fetch_array($result);
  if ($row) {
    echo '<h1>'.$row['product_name'].'</h1>';
    echo '<h1>'.$row['prd_price'].'</h1>';
    echo '<h1>'.$row['prd_description'].'</h1>';
    echo '<img src="../upload/'.$row['prd_image'].'" width="100px" height="100px">';
  } else {
    echo 'Product not found.';
  }
} else {
  echo 'No product ID specified.';
}
?>

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function closeModal() {
    // Close the modal
    $("#detailModal").modal("hide");
}

// Show Modal    
$(document).ready(function(){
  $("#detail").click(function(){
    // Get product ID (replace with actual ID or method to get the ID)
    var productId = $(this).data("id"); // Assuming the button has data-id attribute

    // Make AJAX request to fetch product details
    $.ajax({
      url: "fetch_product.php",
      method: "GET",
      data: { id: productId },
      success: function(data) {
        // Load data into modal-body
        $("#modal-body-content").html(data);
        // Show the modal
        $("#detailModal").modal("show");
      },
      error: function() {
        alert("Failed to fetch product details.");
      }
    });
  });
});
</script>
