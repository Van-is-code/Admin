<?php 
include_once dirname(__FILE__) . '../../auth/auth.php';
require_once ("../view/navbar.php");
require_once "../config/database.php";

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $first = isset($_POST['first_name']) ? $_POST['first_name'] : '';
  $last = isset($_POST['last_name']) ? $_POST['last_name'] : '';
  $region = isset($_POST['region']) ? $_POST['region'] : '';
  $address = isset($_POST['address']) ? $_POST['address'] : '';
  $city = isset($_POST['city']) ? $_POST['city'] : '';
  $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : '';
  $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
  $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
  $price = isset($_POST['price']) ? $_POST['price'] : '';
  $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
  $total = isset($_POST['total_money']) ? $_POST['total_money'] : '';

  if(isset($_POST['edit_order'])) {
    // UPDATE DB
    $updateOrder = "UPDATE `order` SET `first_name`=IF('$first'='', `first_name`, '$first'), `last_name`=IF('$last'='', `last_name`, '$last'), `region`=IF('$region'='', `region`, '$region'), `address`=IF('$address'='', `address`, '$address'), `city`=IF('$city'='', `city`, '$city'), `postal_code`=IF('$postal_code'='', `postal_code`, '$postal_code'), `phone`=IF('$phone'='', `phone`, '$phone') WHERE `id`='$id';";
    $updateOrderDetails = "UPDATE `order_details` SET `product_id`=IF('$product_id'='', `product_id`, '$product_id'), `price`=IF('$price'='', `price`, '$price'), `quantity`=IF('$quantity'='', `quantity`, '$quantity'), `total_money`=IF('$total'='', `total_money`, '$total') WHERE `order_id`='$id';";

    if ($conn->query($updateOrder) === TRUE && $conn->query($updateOrderDetails) === TRUE) {
      echo "<div class='alert alert-success'>The order has been updated.</div>";
      echo "<script>setTimeout(function(){ $('.alert').fadeOut(); }, 500);</script>";
      echo "<script>setTimeout(function() { window.location.href = '../order.php'; }, 1000);</script>";
      
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
                       
                        <p class="text-primary m-0 fw-bold">Edit User </p>
                              </div>
                                 <div class="card-body">
                          
                                 <div class="row" style=" margin-right: 0px;margin-left: 0px;margin-bottom: -96px;padding-bottom: 0px;">
                    <a href="../order.php" style="text-decoration: none; color:#4e73df; "><div class="col"><i  class="fa fa-long-arrow-left"></i><span style="font-family:2% ;">⟵ back</span></div></a>
                   
                    <div class="col-md-12" style="margin-bottom: 25px;padding-left: 75px;font-size: 21px;margin-top: 73px;"><a class="anone" href="listaBitacoras.html"></a></div>
                </div>
            </div>                
    <form  method="post" enctype="multipart/form-data">
    <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">First Name:</label>
  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first_name ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Last Name:</label>
  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last_name ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Region</label>
  <input type="text" class="form-control" name="region" id="region" placeholder="region ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">address</label>
  <input type="number" class="form-control" name="address" id="address" placeholder="address">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">City</label>
  <input type="text" class="form-control" name="city" id="city" placeholder="city">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Postal Code</label>
  <input type="text" class="form-control"  name="postal_code" id="postal_code" placeholder="">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Phone</label>
  <input type="text" class="form-control"  name="phone" id="phone" placeholder="">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Product ID</label>
  <input type="text" class="form-control"  name="product_id" id="product_id" placeholder="">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">price</label>
  <input type="text" class="form-control"  name="price" id="price" placeholder="">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Quantity</label>
  <input type="text" class="form-control"  name="quantity" id="quantity" placeholder="">
</div>

<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Total</label>
  <input type="text" class="form-control"  name="total_money" id="total_money" placeholder="">
</div>


      <div style="width: 16%;margin-left: 45%;margin-bottom: 5%;margin-top: 5%;">
        <input class="btn btn-primary" type="submit" name="edit_order" value="Edit Order"/>
      </div>
     
    
    </form>
      
                    </div>
                </div>
              
              
                <?php require_once ("../view/footer.php");?>