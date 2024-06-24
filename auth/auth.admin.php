
<?php include_once dirname(__FILE__) . '/auth.php'; 
 require_once "../view/navbar.php";?>



                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Admin</p>
                        </div>
                        <div class="card-body">
                            <h3 style="text-align: center;" >Enter the password to continue accessing the admin management page:</h3>
                         
                        <form method="POST">
                            <div class="user-box" style="text-align: center;">
                                <input type="password" name="password" id="password" required="" placeholder="password" >
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $password = $_POST["password"];
                                    // Replace "YOUR_PASSWORD" with the actual password you want to validate against
                                    $validPassword = "quanlyadmin";

                                    if ($password == $validPassword) {
                                        // Store the password in session storage
                                        // session_start();
                                        $_SESSION["password"] = $password;
                                        $_SESSION["expiry_time"] = time() + (15 * 60); // Set expiry time to 30 minutes from now

                                        // Redirect to the admin management page
                                        echo '<script>window.location.href = "../admin.php";</script>';
                                        exit();
                                    } else {
                                        echo '<p class="error" style="text-align: center; font-size: 90%; color: red; margin-top: 1%;">Wrong password<script>setTimeout(function(){ $(".error").fadeOut(); }, 3000);</script></p>';
                                    }
                                } else {
                                    // Check if password is already stored in session storage and not expired
                                    // session_start();
                                    if (isset($_SESSION["password"]) && isset($_SESSION["expiry_time"]) && $_SESSION["expiry_time"] > time()) {
                                        // Redirect to the admin management page
                                        echo '<script>window.location.href = "../admin.php";</script>';
                                        exit();

                                    }
                                }
                                ?>
                            </div>
                        </form>

                       
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once ("../view/footer.php");?>