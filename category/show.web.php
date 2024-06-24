
<?php 
include_once dirname(__FILE__) . '../../auth/auth.php';
require_once ("../view/navbar.php") ; ?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Team</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Employee Info</p>
                             <button id="tooltip" class="btn_add" type="button" onclick="addproduct()"><img class="icon" width="30" height="30" src="./img/add.png"> <span class="tooltiptext">Add</span></button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                      
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 function">
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..." id="searchInput">
                                        <button class="btn btn-primary py-0" type="button" onclick="searchProduct()"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>ProductID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Time Update</th>
                                            <!-- <th>Salary</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    require_once "../config/database.php";

                                    $limit = isset($_GET['limit']) ? $_GET['limit'] : 10; // Number of records to display per page

                                    // Get the current page number from the URL
                                    if (isset($_GET['page'])) {
                                        $page = $_GET['page'];
                                    } else {
                                        $page = 1;
                                    }

                                    $start = ($page - 1) * $limit; // Calculate the starting index for the records

                                    $category_id = isset($_GET['id']) ? $_GET['id'] : null; // Get the category_id from the URL

                                    // Modify the SQL query to include the WHERE clause for category_id
                                    if ($category_id !== null) {
                                        $sql = "SELECT p.* FROM products p
                                                INNER JOIN category_product cp ON p.product_id = cp.product_id
                                                INNER JOIN category c ON cp.category_id = c.category_id
                                                WHERE c.id = $category_id
                                                LIMIT $start, $limit";
                                    } else {
                                        // Handle the case when $category_id is null
                                        // For example, display an error message or redirect to another page
                                        // You can modify this part based on your specific requirements
                                        echo "Invalid category ID";
                                        exit;
                                    }
                                    echo "SQL Query: " . $sql;

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            // Display the product information
                                            echo '<tr>';
                                            echo '<td>' . $count . '</td>';
                                            echo '<td>' . $row['product_id'] . '</td>';
                                            echo '<td><img class="rounded-circle me-2" width="30" height="30" src="upload/' . $row["prd_image"] . '">' . $row['product_name'] . '</td>';
                                            echo '<td>' . $row['prd_price'] . '</td>';
                                            echo '<td>' . $row['time_update'] . '</td>';
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
                                    $sql = "SELECT COUNT(*) AS total FROM products p
                                            INNER JOIN category_product cp ON p.product_id = cp.product_id
                                            INNER JOIN category c ON cp.category_id = c.category_id
                                            WHERE c.category_id = $category_id";
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    $total_pages = ceil($row['total'] / $limit);

                                    // Display pagination links
                                    echo '<nav aria-label="Page navigation">';
                                    echo '<ul class="pagination">';
                                    if ($page > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">«</a></li>';
                                    } else {
                                        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">«</span></a></li>';
                                    }
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $page) {
                                            echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                                        } else {
                                            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                    if ($page < $total_pages) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">»</a></li>';
                                    } else {
                                        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">»</span></a></li>';
                                    }
                                    echo '</ul>';
                                    echo '</nav>';
                                    ?>


                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <?php
                                    $start_index = ($page - 1) * $limit + 1;
                                    $end_index = min($start + $limit , $row['total']);
                                    echo '<p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing ' . $start_index . ' to ' . $end_index . ' of ' . $row['total'] . '</p>';
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <?php
                                        // Display pagination links
                                        echo '<ul class="pagination">';
                                        if ($page > 1) {
                                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">«</a></li>';
                                        } else {
                                            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">«</span></a></li>';
                                        }
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == $page) {
                                                echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                                            } else {
                                                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                            }
                                        }
                                        if ($page < $total_pages) {
                                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">»</a></li>';
                                        } else {
                                            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">»</span></a></li>';
                                        }
                                        echo '</ul>';
                                        ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once ("./view/footer.php");?>