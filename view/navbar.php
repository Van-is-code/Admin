
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>demo web</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/table.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="home.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../products.php"><i class="fas fa-table"></i><span>Product</span></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="../category.php"   aria-expanded="false">
                            <i class="fas fa-table"></i><span>Category</span>
                        </a>
                        <ul class="dropdown-menu navbar-nav dropdown-content" aria-labelledby="navbarDropdown">
                            <?php
                            // session_start();
                            // Include the database configuration file
                             include_once __DIR__ . '/../config/database.php';

                            // // Fetch the categories from the database
                            $query = "SELECT * FROM category";
                            $result = $conn->query($query);

                            // Check if the query was successful
                            if ($result) {
                                // Loop through the categories and display them in the dropdown menu
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<li class="nav-item"><a class="nav-link" href="../category/show.web.php?id=' . $row['id'] . '"><i class="fas fa-table"></i><span>' . $row['category'] . '</span></a></li>';
                                    echo '<li class="nav-item><hr class="dropdown-divider fas fa-table"></li>';
                                }
                            } else {
                                // Handle the error if the query fails
                                echo "Error: " . mysqli_error($conn);
                            }

                          
                            ?>
                        </ul>
                    </li>
                    <!-- <li class="nav-item"><a class="nav-link" href="../user.php"><i class="far fa-user-circle"></i><span>User</span></a></li> -->
                    <li class="nav-item"><a class="nav-link" href="../user.php"><i class="fas fa-user"></i><span>User</span></a></li>
                    
                    <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-table"></i><span>items</span></a></li> -->

                    <li class="nav-item"><a class="nav-link" href="../auth/auth.admin.php"><i class="fas fa-user-circle"></i><span>Admin</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
                    
                </ul>
                <!-- show -->
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                           
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                            <?php
                            // session_start();
                            include_once __DIR__ . '/../config/database.php';

                            if (isset($_SESSION["login_user"]) ) {
                                // Get the user information from the session.
                                $email = $_SESSION["login_user"];

                                // Query the database for the user's name and image.
                                $query = "SELECT * FROM user WHERE email = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("s", $email);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    // Fetch the user's name and image.
                                    $row = $result->fetch_assoc();
                                    $name = $row["first_name"].$row["last_name"];
                                    $image = $row["image"];

                                    // Update the user's name and image in the session.
                                    $_SESSION["name"] = $name;
                                    $_SESSION["image"] = $image;


                                    // Display the user's name and image.
                                    echo '<div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">'. $name .'</span><img class="border rounded-circle img-profile" src="upload/admin/' . $image. '"></a>';
                                   
                                } else {
                                    echo "No user found with username: " . $email;
                                }
                            } else {
                                echo "You are not logged in."; 
                            }
                            ?>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>