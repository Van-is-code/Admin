<?php
require('./config/database.php');

$sql = "SELECT product_id, product_name, prd_price, Description FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ProductId: " . $row["product_id"]. " - Name: " . $row["product_name"]
            . " - Price: " . $row["prd_price"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>