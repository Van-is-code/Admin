<?php require_once ("./view/navbar.php") ;?>
      
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Team</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Employee Info</p>
                             <button id="tooltip" class="btn_add" type="button"><img class="icon" width="30" height="30" src="./img/add.png"> <span class="tooltiptext">Add</span></button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                      
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 function">
                                            <!-- <button class="btn_add" type="button">Add</button>
                                            <button class="btn_edit" type="button">Edit</button>
                                            <button class="btn_delete" type="button">Delete</button> -->
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                    <!-- <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                        <label class="form-label">
                                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search" name="search">
                                        </label>
                                    
                                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                    </div> -->
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <!-- <th>Salary</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <!-- Modal -->
    <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <label>Hi Add</label>
    </div>
  </div>
  </div> -->

        <?php
        require_once "./config/database.php";

        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10; // Number of records to display per page

        // Get the current page number from the URL
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
         else {
            $page = 1;
        }

        $start = ($page - 1) * $limit; // Calculate the starting index for the records

        $sql = "SELECT product_id, product_name, prd_price, prd_image, prd_description FROM products LIMIT $start, $limit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $count = 1;
            while ($row = $result->fetch_assoc()) {

            echo '<tr>';
            echo '<td>' . $count . '</td>';
            echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/sql' . $row["prd_image"] . '">' . $row['product_name'] . '</td>';
            echo '<td>' . $row['prd_price'] . '</td>';
            echo '<td>' . $row['prd_description'] . '</td>';
            echo '<td>
                <a href="#edit" id="tooltip" class="btn_edit"><img class="icon" width="35" height="35" src="./img/editing.png"> <span class="tooltiptext">Edit</span></a>
                <a href="products/delete.php?product_id=' . $row['product_id'] . '" id="tooltip" class="btn_delete"><img class="icon" width="40" height="40" src="./img/delete.svg"> <span class="tooltiptext">Delete</span></a>
                <a href="products/detail.php?product_id=' . $row['product_id'] . '"  id="tooltip" class="btn_detail" ><img class="icon" width="40" height="40" src="./img/details.png"> <span class="tooltiptext">Detail</span></a>
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
        // echo '<ul class="pagination">';
        // for ($i = 1; $i <= $total_pages; $i++) {
        //     echo '<li class="page-item' . ($i == $page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        // }
        echo '</ul>';
        echo '</nav>';
        ?>

                <!-- <tr>
             <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/avatars/avatar1.jpeg">Airi Satou</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>33</td>
            <td>2008/11/28</td>
    <td>$162,700</td>
            <td>
    <a href="add.php" class="btn_add"><img class="icon" width="30" height="30" src="./img/add.png"></a>
            <a href="#edit" id="tooltip" class="btn_edit"><img class="icon" width="35" height="35" src="./img/editing.png"> <span class="tooltiptext">Edit</span></a>
            <a href="delete.php" id="tooltip" class="btn_delete"><img class="icon" width="40" height="40" src="./img/delete.svg"> <span class="tooltiptext">Delete</span></a>
            <a href="#detail" id="tooltip" class="btn_detail"><img class="icon" width="40" height="40" src="./img/details.png"> <span class="tooltiptext">Detail</span></a>
            </td>
            </tr> -->
        
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
           
               <?php require_once ("./view/footer.php") ;?>
            
    <!-- <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
     <script src="./js/add.js"></script>
     <script src="./js/edit.js"></script>
     <script src="./js/detail.js"></script> -->
