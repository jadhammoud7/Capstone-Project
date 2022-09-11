<?php

session_start();
include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
$customerid = $_SESSION['logged_id'];
$query = "SELECT first_name, last_name  from customers WHERE customer_id = $customerid";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();


//sum of all customers
$query_total_customers = "SELECT COUNT(customer_id) as count FROM customers";
$stmt_total_customers = $connection->prepare($query_total_customers);
$stmt_total_customers->execute();
$results_total_customers = $stmt_total_customers->get_result();
$row_total_customers = $results_total_customers->fetch_assoc();


//count of all appointments
$query_total_appointments = "SELECT COUNT(appointment_id) as total_appointments FROM appointments";
$stmt_total_appointments = $connection->prepare($query_total_appointments);
$stmt_total_appointments->execute();
$results_total_appointments = $stmt_total_appointments->get_result();
$row_total_appointments = $results_total_appointments->fetch_assoc();

//sum of all appointments
$query_total_profit = "SELECT SUM(total_price_including_tax) as total_profit FROM checkouts";
$stmt_total_profit = $connection->prepare($query_total_profit);
$stmt_total_profit->execute();
$results_total_profit = $stmt_total_profit->get_result();
$row_total_profit = $results_total_profit->fetch_assoc();

//get total checkouts made
$query_total_checkouts = "SELECT COUNT(checkout_id) as total_checkout FROM checkouts";
$stmt_total_checkouts = $connection->prepare($query_total_checkouts);
$stmt_total_checkouts->execute();
$results_total_checkouts = $stmt_total_checkouts->get_result();
$row_total_checkouts = $results_total_checkouts->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../admin-admin/admin-admin.css">
    <title>Home Admin - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

    <!-- started popup message login successful -->
    <!-- <div class="popup" id="login-confirmation">
        <img src="../images/tick.png" alt="successfully logged in">
        <h2>Login Successful</h2>
        <p>Welcome to Newbies Gamers</p>
        <button type="button" onclick="RemoveLogInPopUp()">OK</button>
    </div> -->

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>
                <span class="lab la-newbiesgamers"></span> <span>Newbies Gamers</span>
            </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="../home-admin/home-admin.php">
                        <span class="las la-igloo" class="active"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../customer-admin/customer-admin.php">
                        <span class="las la-users"></span>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-clipboard-list"></span>
                        <span>Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-receipt"></span>
                        <span>Checkouts</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-product-hunt"></span>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="../admin-admin/admin-admin.php">
                        <span class="las la-user-circle"></span>
                        <span> Admin Accounts</span>
                    </a>
                </li>

            </ul>

        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span><i class="las la-bars"></i></span>
                </label>

                Dashboard
            </h2>

            <div class="user-wrapper">
                <img src="../images/info.png" width="40px" height="40px" alt="">
                <div>
                    <h4> <?php echo $row["first_name"], " ", $row['last_name']; ?></h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>

        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1><?php echo  $row_total_customers['count']; ?></h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_appointments['total_appointments'] ?></h1>
                        <span>Appointments</span>
                    </div>
                    <div>
                        <span class="las la-clipboard"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_checkouts['total_checkout'] ?></h1>
                        <span>Chekouts</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$<?php echo $row_total_profit['total_profit'] ?></h1>
                        <span>Profit</span>
                    </div>
                    <div>
                        <span class="las la-google-wallet"></span>
                    </div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Recent Appointments</h3>
                            <!-- <button>See all <span class="las la-arrow-right"></span></button> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>Username</td>
                                            <td>Email</td>
                                            <td>Phone Number</td>
                                            <td>Address</td>
                                            <td>Date of Birth</td>
                                            <td>Remove Customer</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                        </tr>
                                        <tr>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                        </tr>
                                        <tr>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                        </tr>
                                        <tr>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                        </tr>
                                        <tr>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                            <td>f</td>
                                            <td>g</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <!-- <button class="add_user" id="add_user1" onclick="myFunction()">Add Admin Account</button> -->
                                <button class="add_user" id="add_user1" onclick="OpenAddUser()">Add Admin Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="id01" class="modal">
                <span onclick="CloseAddUser()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content">
                    <div class="container">
                        <h1 class="title">Sign Up</h1>
                        <p class="title">Please fill in this form to create an account.</p>
                        <hr>
                        <p class="error" id="first_name_error">
                            <?php
                            session_start();
                            if (isset($_SESSION['first_name_error'])) {
                                echo "<script>document.getElementById('first_name_error').style.display='block';</script>";
                                echo $_SESSION['first_name_error'];
                                unset($_SESSION['first_name_error']);
                            } ?>
                        </p>
                        <label for="first_name"><b>First Name</b></label>
                        <input type="text" placeholder="Enter your first name" name="first_name" id="first_name" value="<?php if (isset($_SESSION['first_name'])) {
                                                                                                                            echo $_SESSION['first_name'];
                                                                                                                        } ?>" required />

                        <p class="error" id="last_name_error">
                            <?php
                            if (isset($_SESSION['last_name_error'])) {
                                echo "<script>document.getElementById('last_name_error').style.display='block';</script>";
                                echo $_SESSION['last_name_error'];
                                unset($_SESSION['last_name_error']);
                            } ?>
                        </p>
                        <label for="last_name"><b>Last Name</b></label>
                        <input type="text" placeholder="Enter your last name" name="last_name" id="last_name" value="<?php if (isset($_SESSION['last_name'])) {
                                                                                                                            echo $_SESSION['last_name'];
                                                                                                                        } ?>" required>

                        <p class="error" id="email_error">
                            <?php
                            if (isset($_SESSION['email_error'])) {
                                echo "<script>document.getElementById('email_error').style.display='block';</script>";
                                echo $_SESSION['email_error'];
                                unset($_SESSION['email_error']);
                            } ?>
                        </p>
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="Enter Email" name="email" id="email" value="<?php if (isset($_SESSION['email'])) {
                                                                                                        echo $_SESSION['email'];
                                                                                                    } ?>" required>

                        <label for="date_of_birth"><b>Date Of Birth</b></label>
                        <input type="date" placeholder="Enter your date of birth" name="date_of_birth" id="date_of_birth" value="<?php if (isset($_SESSION['date_of_birth'])) {
                                                                                                                                        echo $_SESSION['date_of_birth'];
                                                                                                                                    } ?>" required> <br> <br>


                        <p class="error" id="phone_number_error">
                            <?php
                            if (isset($_SESSION['phone_number_error'])) {
                                echo "<script>document.getElementById('phone_number_error').style.display='block';</script>";
                                echo $_SESSION['phone_number_error'];
                                unset($_SESSION['phone_number_error']);
                            } ?>
                        </p>
                        <label for="phone_number"><b>Phone Number</b></label>
                        <input type="text" placeholder="Enter your phone number" name="phone_number" id="phone_number" value="<?php if (isset($_SESSION['phone_number'])) {
                                                                                                                                    echo $_SESSION['phone_number'];
                                                                                                                                } ?>" required> <br> <br>

                        <p class="error" id="address_error">
                            <?php
                            if (isset($_SESSION['address_error'])) {
                                echo "<script>document.getElementById('address_error').style.display='block';</script>";
                                echo $_SESSION['address_error'];
                                unset($_SESSION['address_error']);
                            } ?>
                        </p>
                        <label for="address"><b>Address</b></label>
                        <input type="text" placeholder="Enter address" name="address" id="address" value="<?php if (isset($_SESSION['address'])) {
                                                                                                                echo $_SESSION['address'];
                                                                                                            } ?>" required>


                        <p class="error" id="username_error">
                            <?php
                            if (isset($_SESSION['username_error'])) {
                                echo "<script>document.getElementById('username_error').style.display='block';</script>";
                                echo $_SESSION['username_error'];
                                unset($_SESSION['username_error']);
                            } ?>
                        </p>
                        <label for="username"><b>Username</b></label>
                        <input type="text" placeholder="Enter username of your own" name="username" id="username" value="<?php if (isset($_SESSION['username'])) {
                                                                                                                                echo $_SESSION['username'];
                                                                                                                            } ?>" required>

                        <p class="error" id="password_error">
                            <?php
                            if (isset($_SESSION['password_error'])) {
                                echo "<script>document.getElementById('password_error').style.display='block';</script>";
                                echo $_SESSION['password_error'];
                                unset($_SESSION['password_error']);
                            } ?>
                        </p>
                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" id="password" value="<?php if (isset($_SESSION['password'])) {
                                                                                                                        echo $_SESSION['password'];
                                                                                                                    } ?>" required>


                        <div class="clearfix">
                            <button type="submit" class="signupbtn" title="Sign Up"><strong>Sign Up</strong></button>
                        </div>
                    </div>
                </form>






        </main>
    </div>




    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->

</body>
<script src="../profile/profile.js"></script>
<script src="../admin-admin/admin-admin.js"></script>
<script>

</script>

</html>
</php>