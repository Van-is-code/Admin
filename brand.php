
<?php 
include_once dirname(__FILE__) . '/auth/auth.php'; 
require_once ("./view/navbar.php") ; ?>
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Brand</p>
                             <button id="tooltip" class="btn_add" type="button" onclick="addBrand()"><img class="icon" width="30" height="30" src="./img/add.png"> <span class="tooltiptext">Add</span></button>
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
                                     <form class="input-group" action="brand.php" method="get">
                                        <input class="bg-light form-control border-0 small"  type="text" name="term" placeholder="Search..." id="searchInput">
                                        
                                        <button class="btn btn-primary py-0"type="submit" value="search" ><i class="fas fa-search"></i></button>
                                        <a href="brand.php" id="tooltip" style="padding-left: 1rem;" type="submit"  ><img width="30" height="30" src="https://img.icons8.com/office/30/refresh--v1.png" alt="refresh--v1"/><span class="tooltiptext">reset</span></a>

                                    </form>
                                   
                                    <div class="col"><i class="fa fa-long-arrow-left"></i><span style="font-family:2% ;" ></span></div>
                                </div>
                            </div>
                            <div id="myModal" class="modal" style="background-color: rgba(0,0,0,0.9);">
                <span class="close" onclick="closeModal()">&times;</span>
                <img class="modal-content" id="modalImg" style="background-color: #808080;">
            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th style="max-width: 50%;">Image</th>
                                            <th>Brand ID</th>
                                            <th>Name</th>
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
            $query = "SELECT * FROM brand WHERE name LIKE ? LIMIT ?, ?";
            $stmt = $conn->prepare($query);
            $searchTerm = "%$searchTerm%";
            $stmt->bind_param("sii", $searchTerm, $start, $limit);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT * FROM brand LIMIT ?, ?";
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
                // echo '<td style="max-width:50%"><img style="width: 10%; " src="../upload/brand/'.$row['image'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)"></td>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td><img style=" border: 1px solid #808080 ;" class="rounded-circle me-2" width="30" height="30"  " src="../upload/brand/'.$row['image'].'" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" onclick="openModal(this)">' . $row['name'] . '</td>';
                // echo '<td>' . $row['time_update'] . '</td>';
                echo '<td>
                    <a href="brand/edit.web.php?id=' . $row['id'] . '" id="tooltip" class="btn_edit"><img class="icon" width="35" height="35" src="./img/editing.png"> <span class="tooltiptext">Edit</span></a>
                    <a href="brand/delete.php?id=' . $row['id'] . '" id="tooltip" class="btn_delete"><img class="icon" width="40" height="40" src="./img/delete.svg"> <span class="tooltiptext">Delete</span></a>

                    </td>';
                echo '</tr>';
               
                $count++;
            }
        }

        // Calculate the total number of pages
        if (isset($_GET['term'])) {
            $searchTerm = $_GET['term'];
            $query = "SELECT COUNT(*) AS total FROM brand WHERE name LIKE ?";
            $stmt = $conn->prepare($query);
            $searchTerm = "%$searchTerm%";
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT COUNT(*) AS total FROM brand";
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
                <style>
                .modal {
                    display: none;
                    position: fixed;
                    z-index: 9999;
                    padding-top: 60px;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgb(0,0,0);
                    background-color: rgba(0,0,0,0.9);
                }
                .modal-content {
                    margin: auto;
                    display: block;
                    width: 80%;
                    max-width: 700px;
                }
                .close {
                    position: absolute;
                    top: 15px;
                    right: 35px;
                    color: #f1f1f1;
                    font-size: 40px;
                    font-weight: bold;
                    transition: 0.3s;
                }
                .close:hover,
                .close:focus {
                    color: #bbb;
                    text-decoration: none;
                    cursor: pointer;
                }
         </style>
         <script>
                function zoomIn(image) {
                    image.style.transform = "scale(1.5)";
                    image.style.zIndex = "9999";
                }

                function zoomOut(image) {
                    image.style.transform = "scale(1)";
                    image.style.zIndex = "auto";
                }

                function openModal(image) {
                    var modal = document.getElementById("myModal");
                    var modalImg = document.getElementById("modalImg");
                    modal.style.display = "block";
                    modalImg.src = image.src;
                }

                function closeModal() {
                    var modal = document.getElementById("myModal");
                    modal.style.display = "none";
                }

                document.addEventListener("DOMContentLoaded", function() {
                    var modal = document.getElementById("myModal");
                    window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                    }
                });
         </script>
            <?php require_once ("./view/footer.php");?>