
<?php 
include_once dirname(__FILE__) . '/auth/auth.php'; 
 require_once ("./view/navbar.php") ; ?>
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Order</p>
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
                                    <form class="input-group" action="order.php" method="get">
                                        <input class="bg-light form-control border-0 small"  type="text" name="term" placeholder="Search..." id="searchInput">
                                        <button class="btn btn-primary py-0"type="submit" value="search" ><i class="fas fa-search"></i></button>
                                        <a href="order.php" id="tooltip" style="padding-left: 1rem;" type="submit"  ><img width="30" height="30" src="https://img.icons8.com/office/30/refresh--v1.png" alt="refresh--v1"/><span class="tooltiptext">reset</span></a>

                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">

                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Order ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <!-- <th>Salary</th> -->
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                    
        <?php
        require_once "./config/database.php";

        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10; // Number of records to display per page

        // Get the current page number from the URL
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $limit; // Calculate the starting index for the records

        // Check if there is a search term.
        if (isset($_GET['term'])) {
            $searchTerm = $_GET['term'];
            $query = "SELECT o.*, od.* FROM `order` AS o JOIN order_details AS od ON o.id = od.order_id WHERE od.order_code LIKE ? LIMIT ?, ?";
            $stmt = $conn->prepare($query);
            $searchTerm = "%$searchTerm%";
            $stmt->bind_param("sii", $searchTerm, $start, $limit);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT o.*, od.* FROM `order` AS o JOIN order_details AS od ON o.id = od.order_id LIMIT ?, ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $start, $limit);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if ($result->num_rows > 0) {
            // output data of each row
            $count = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $count . '</td>';
                echo '<td>' . $row['order_code'] . '</td>';
                echo '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '<td>' . $row['total_money'] . '</td>';
                // echo '<td>' . $row['updated_at'] . '</td>';
                // echo '<td>' . $row['created_at'] . '</td>';

                echo '<td>
                    <a href="order/edit.web.php?id=' . $row['id'] . '" id="tooltip" class="btn_edit"><img class="icon" width="35" height="35" src="./img/editing.png"> <span class="tooltiptext">Edit</span></a>
                    <a href="order/delete.php?id=' . $row['id'] . '" id="tooltip" class="btn_delete"><img class="icon" width="40" height="40" src="./img/delete.svg"> <span class="tooltiptext">Delete</span></a>
                    <a href="order/detailweb.php?id=' . $row['id'] . '"  id="tooltip" class="btn_detail" ><img class="icon" width="40" height="40" src="./img/details.png"> <span class="tooltiptext">Detail</span></a>
                    </td>';
                echo '</tr>';
                $count++;
            }
        }

        // Calculate the total number of pages
        if (isset($_GET['term'])) {
            $searchTerm = $_GET['term'];
            $query = "SELECT COUNT(*) AS total FROM `order` AS o JOIN order_details AS od ON o.id = od.order_id WHERE o.id LIKE ?";
            $stmt = $conn->prepare($query);
            $searchTerm = "%$searchTerm%";
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT COUNT(*) AS total FROM `order`";
            $result = $conn->query($sql);
        }

        $row = $result->fetch_assoc();
        $total_pages = ceil($row['total'] / $limit);

        // Display pagination links
        echo '<nav aria-label="Page navigation">';
        // ... (your existing code to display pagination links)
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
            
            <?php require_once ("./view/footer.php");?>