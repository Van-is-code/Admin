
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
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="products.php">
                    <div class="sidebar-brand-icon d-none d-md-block"><i class="fas fa-bars"></i></div>
                    <div class="sidebar-brand-text mx-3"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <!-- <li class="nav-item"><a class="nav-link active" href="home.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li> -->
                    <li class="nav-item"><a class="nav-link" href="../products.php"><i class="fas fa-table"></i><span>Product</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../brand.php"><i class="fas fa-table"></i><span>Brand</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../order.php"><i class="fas fa-table"></i><span>Order</span></a></li>
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
                    <img src="../img/logo.png" style=" width: 20%; " alt="Logo">
                        <ul class="navbar-nav flex-nowrap ms-auto">
                                
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
                                $query = "SELECT * FROM admin WHERE email = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("s", $email);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    // Fetch the user's name and image.
                                    $row = $result->fetch_assoc();
                                    $name = $row["firstname"]." ".$row["lastname"];
                                    $code = $row["admin_code"];
                                    // $image = $row["image"];

                                    // Update the user's name and image in the session.
                                    $_SESSION["name"] = $name;
                                    $_SESSION["admin_code"] = $code;
                                    // $_SESSION["image"] = $image;


                                    // Display the user's name and image.
                                    echo '<div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">'. $name .' | '.$code.'</span></a>';
                                   
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