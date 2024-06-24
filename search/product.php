<?php
include_once dirname(__FILE__) . '../auth/auth.php';
// Include your database connection file here.
include '../config/database.php';

// Get the search term from the request.
$searchTerm = $_GET['term'];


$limit = isset($_GET['limit']) ? $_GET['limit'] : 10; // Number of records to display per page

        // Get the current page number from the URL
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
         else {
            $page = 1;
        }

        $start = ($page - 1) * $limit; // Calculate the starting index for the records

       // Query the database for products that match the search term.
$query = "SELECT * FROM products WHERE product_id LIKE ?";
$stmt = $conn->prepare($query);
$searchTerm = "%$searchTerm%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // output data of each row
            $count = 1;
            while ($row = $result->fetch_assoc()) {

            echo '<tr>';
             
            echo '<td>' . $count . '</td>';
            echo '<td>' . $row['product_id'] . '</td>';
             echo '<td><img class="rounded-circle me-2" width="30" height="30" src="upload/products/' . $row["prd_image"] . '">' . $row['product_name'] . '</td>';
            echo '<td>' . $row['prd_price'] . '</td>';
            echo '<td>' . $row['time_update'] . '</td>';
            // echo '<td>' . $row['prd_description'] . '</td>';
            echo '<td>
                <a href="products/edit.web.php?id=' . $row['id'] . '" id="tooltip" class="btn_edit"><img class="icon" width="35" height="35" src="./img/editing.png"> <span class="tooltiptext">Edit</span></a>
                <a href="products/delete.php?id=' . $row['id'] . '" id="tooltip" class="btn_delete"><img class="icon" width="40" height="40" src="./img/delete.svg"> <span class="tooltiptext">Delete</span></a>
                <a href="products/detailweb.php?id=' . $row['id'] . '"  id="tooltip" class="btn_detail" ><img class="icon" width="40" height="40" src="./img/details.png"> <span class="tooltiptext">Detail</span></a>
                </td>';

            echo '</tr>';
            $count++;
            }
        }

        // Calculate the total number of pages
        $sql = "SELECT COUNT(*) AS total FROM products";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row['total'] / $limit);

        // Display pagination links
        echo '<nav aria-label="Page navigation">';
        
        echo '</ul>';
        echo '</nav>';
        ?>
