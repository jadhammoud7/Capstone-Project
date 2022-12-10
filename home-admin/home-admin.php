<?php

session_start();
include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] != 'admin') {
    header("Location: ../home-page/home-page.php");
}
$admin_id = $_SESSION['logged_id'];
$query = "SELECT first_name, last_name  from admins WHERE admin_id =  '" . $admin_id . "' ";
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


//sum of all admins
$query_total_admins = "SELECT COUNT(admin_id) as count FROM admins";
$stmt_total_admins = $connection->prepare($query_total_admins);
$stmt_total_admins->execute();
$results_total_admins = $stmt_total_admins->get_result();
$row_total_admins = $results_total_admins->fetch_assoc();

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

//getting latest customers added to us
require_once("../php/admin_page_php.php");
$query_get_latest_customer = "SELECT username, email FROM customers ORDER BY customer_id DESC LIMIT 5";
$stmt_get_latest_customer = $connection->prepare($query_get_latest_customer);
$stmt_get_latest_customer->execute();
$results_get_latest_customer = $stmt_get_latest_customer->get_result();

//getting latest admins added to us
require_once("../php/admin_page_php.php");
$query_get_latest_admins = "SELECT first_name, last_name, email_address FROM admins ORDER BY admin_id DESC LIMIT 5";
$stmt_get_latest_admins = $connection->prepare($query_get_latest_admins);
$stmt_get_latest_admins->execute();
$results_get_latest_admins = $stmt_get_latest_admins->get_result();


//updating working status from buttons
if (isset($_GET['set_to_done']) && isset($_GET['getAppointmentID'])) {
    $working_status = $_GET['set_to_done'];
    $appointmentID = $_GET['getAppointmentID'];
    $status = "";
    if ($working_status == "true") {
        $status = "Done Work";
        $query_settodone = $connection->prepare("UPDATE appointments SET status=? WHERE appointment_id='" . $appointmentID . "'");
        $query_settodone->bind_param("s", $status);
        $query_settodone->execute();
        header("Location:../home-admin/home-admin.php");
    } else if ($working_status == "false") {
        $status = "Pending";
        $query_settodone = $connection->prepare("UPDATE appointments SET status=? WHERE appointment_id='" . $appointmentID . "'");
        $query_settodone->bind_param("s", $status);
        $query_settodone->execute();
        header("Location:../home-admin/home-admin.php");
    }
}


//updating working status from buttons checkouts
if (isset($_GET['set_to_done']) && isset($_GET['getCheckoutID'])) {
    $working_status = $_GET['set_to_done'];
    $checkoutID = $_GET['getCheckoutID'];
    $status = "";
    if ($working_status == "true") {
        $status = "Done Work";
        $query_settodone = $connection->prepare("UPDATE checkouts SET status=? WHERE checkout_id='" . $checkoutID . "'");
        $query_settodone->bind_param("s", $status);
        $query_settodone->execute();
        header("Location:../home-admin/home-admin.php");
    } else if ($working_status == "false") {
        $status = "Pending";
        $query_settodone = $connection->prepare("UPDATE checkouts SET status=? WHERE checkout_id='" . $checkoutID . "'");
        $query_settodone->bind_param("s", $status);
        $query_settodone->execute();
        header("Location:../home-admin/home-admin.php");
    }
}
//get all comments
$query_comment = "SELECT * FROM comments";
$stmt_comment = $connection->prepare($query_comment);
$stmt_comment->execute();
$results_comment = $stmt_comment->get_result();

//get all checkouts
$query_checkouts = "SELECT * FROM checkouts";
$stmt_checkouts = $connection->prepare($query_checkouts);
$stmt_checkouts->execute();
$results_checkouts = $stmt_checkouts->get_result();

//get count of appointments pending
$status = "Pending";
$query_get_pending_appointments = "SELECT COUNT(*) as total_pending_appointments FROM appointments WHERE status=?";
$stmt_get_pending_appointments = $connection->prepare($query_get_pending_appointments);
$stmt_get_pending_appointments->bind_param("s", $status);
$stmt_get_pending_appointments->execute();
$results_get_pending_appointments = $stmt_get_pending_appointments->get_result();
$row_get_pending_appointments = $results_get_pending_appointments->fetch_assoc();

//get count of appointments done work
$status = "Done Work";
$query_get_done_appointments = "SELECT COUNT(*) as total_done_appointments FROM appointments WHERE status=?";
$stmt_get_done_appointments = $connection->prepare($query_get_done_appointments);
$stmt_get_done_appointments->bind_param("s", $status);
$stmt_get_done_appointments->execute();
$results_get_done_appointments = $stmt_get_done_appointments->get_result();
$row_get_done_appointments = $results_get_done_appointments->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../images/Newbie Gamers-logos.jpeg">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="home-admin.css">
    <link rel="stylesheet" href="../admin-main/admin-main.css">
    <title>Admin | Home - Newbies Gamers</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body onunload="myFunction()">

    <!-- started popup message login successful -->
    <div class="popup" id="login-confirmation">
        <img src="../images/tick.png" alt="successfully logged in">
        <h2>Login Successful</h2>
        <p>Welcome Admin to Newbies Gamers Admin Page</p>
        <button type="button" onclick="RemoveLogInPopUp()">OK</button>
    </div>

    <!-- started popup message logout -->
    <div class="popup" id="logout-confirmation">
        <img src="../images/question-mark.png" alt="">
        <h2>Log Out Confirmation</h2>
        <p>Are you sure that you want to logout?</p>
        <button type="button" onclick="GoToLogIn()">YES</button>
        <button type="button" onclick="CloseLogOutPopUp()">NO</button>
    </div>

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
                    <a href="../home-admin/home-admin.php" id="dashboard-link">
                        <span class="las la-igloo" class="active"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../customer-admin/customer-admin.php" id="customers-link">
                        <span class="las la-users"></span>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="../appointments-admin/appointments-admin.php" id="appointments-link">
                        <span class="las la-clipboard-list"></span>
                        <span>Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="../checkouts-admin/checkouts-admin.php" id="checkouts-link">
                        <span class="las la-receipt"></span>
                        <span>Checkouts</span>
                    </a>
                </li>
                <li>
                    <a href="../store_sale-admin/store_sale-admin.php" id="store_sale-link">
                        <span class="las la-money-check"></span>
                        <span>Store Sales</span>
                    </a>
                </li>
                <li>
                    <a href="../product-admin/product-admin.php" id="products-link">
                        <span class="las la-box"></span>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="../offers-admin/offers-admin.php" id="offers-link">
                        <span class="las la-percent"></span>
                        <span>Offers</span>
                    </a>
                </li>
                <li>
                    <a href="../repairs-admin/repairs-admin.php" id="repairs-link">
                        <span class="las la-tools"></span>
                        <span>Repairs</span>
                    </a>
                </li>
                <li>
                    <a href="../admin-admin/admin-admin.php" id="admins-link">
                        <span class="las la-user-circle"></span>
                        <span>Admin Accounts</span>
                    </a>
                </li>
                <li>
                    <a>
                        <a class="logout-btn" onclick="OpenLogOutPopUp()">
                            <span class="las la-sign-out-alt"></span>
                            <span>Logout</span>
                        </a>
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
                            <canvas id="AppointmentsChart"></canvas>
                        </div>
                        <div class="card-header">
                            <h3>Recent Appointments</h3>
                            <button onclick="window.location.href = '../appointments-admin/appointments-admin.php'" title="Go To See the list of all appointments requested by your customers">See all <span class="las la-arrow-right"></span></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Repair Type</td>
                                            <td>Customer Name</td>
                                            <td>Price Per Hour</td>
                                            <td>Date</td>
                                            <td>Hour</td>
                                            <td>Status</td>
                                            <td>working status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //getting appointments
                                        require_once("../php/admin_page_php.php");
                                        $stmt_get_appointments = $connection->prepare("SELECT * FROM appointments ORDER BY appointment_id DESC LIMIT 5");
                                        $stmt_get_appointments->execute();
                                        $results_get_appointments = $stmt_get_appointments->get_result();

                                        while ($row_get_appointments = $results_get_appointments->fetch_assoc()) {

                                            $query_getuser = "SELECT username, customer_id FROM customers WHERE customer_id ='" . $row_get_appointments['customer_id'] . "'";
                                            $stmt_getuser = $connection->prepare($query_getuser);
                                            $stmt_getuser->execute();
                                            $results_getuser = $stmt_getuser->get_result();
                                            $row_getuser = $results_getuser->fetch_assoc();

                                            get_appointment_in_admin_page_for_table_connection(
                                                $row_get_appointments['appointment_id'],
                                                $row_getuser['username'],
                                                $row_getuser['customer_id'],
                                                $row_get_appointments['appointment_name'],
                                                $row_get_appointments['appointment_type'],
                                                $row_get_appointments['price_per_hour'],
                                                $row_get_appointments['date'],
                                                $row_get_appointments['hour'],
                                                $row_get_appointments['status']
                                            );
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="customers">
                    <div class="card">

                        <div class="card-header">
                            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                        </div>

                        <div class="card-header">
                            <h3>Latest Customers</h3>
                            <button onclick="window.location.href = '../customer-admin/customer-admin.php';" title="Go To See the list of all customers accounts created">See all <span class="las la-arrow-right"></span></button>
                        </div>
                        <div class="card-body">
                            <?php
                            while ($row_get_latest_customer = $results_get_latest_customer->fetch_assoc()) {
                                latest_customers_connection($row_get_latest_customer['username'], $row_get_latest_customer['email']);
                            }
                            ?>
                        </div>
                        <div class="card-header">
                            <h3>Latest Admins</h3>
                            <button onclick="window.location.href = '../admin-admin/admin-admin.php';" title="Go To See the list of all admins accounts created">See all <span class="las la-arrow-right"></span></button>
                        </div>
                        <div class="card-body">
                            <?php
                            while ($row_get_latest_admins = $results_get_latest_admins->fetch_assoc()) {
                                latest_admins_connection($row_get_latest_admins['first_name'], $row_get_latest_admins['last_name'], $row_get_latest_admins['email_address']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="recent-grid-complete">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Comments added by customers</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Customer Username</td>
                                            <td>Comment</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row_comment = $results_comment->fetch_assoc()) {
                                            get_comments_connection($row_comment['customer_id'], $row_comment['username'], $row_comment['comment']);
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="recent-grid-complete">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Recent Checkouts Orders</h3>
                            <button onclick="window.location.href='../checkouts-admin/checkouts-admin.php';" title="See the list of all checkout orders sent by customers and proceed to deliver them">See all <span class="las la-arrow-right"></span></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>Email</td>
                                            <td>Phone Number</td>
                                            <td>Total Price</td>
                                            <td>Total Price Inc. Tax</td>
                                            <td>Date</td>
                                            <td>Status</td>
                                            <td>Change Status</td>
                                            <td>View Order</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row_checkouts = $results_checkouts->fetch_assoc()) {
                                            get_all_checkouts_connection(
                                                $row_checkouts['checkout_id'],
                                                $row_checkouts['customer_id'],
                                                $row_checkouts['first_name'],
                                                $row_checkouts['last_name'],
                                                $row_checkouts['email'],
                                                $row_checkouts['phone_number'],
                                                $row_checkouts['total_price'],
                                                $row_checkouts['total_price_including_tax'],
                                                $row_checkouts['date'],
                                                $row_checkouts['status']
                                            );
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- slideshow management -->
            <div class="recent-grid-complete">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Slideshow Management</h3>
                        </div>

                        <div class="card-single add_modify_slideshow">
                            <button class="add_modify_slideshow" id="add_user1" onclick="OpenAddProduct()" title="Add or manage slideshow of customer home page">
                                <span class="las la-plus"></span>
                                Add / Modify Customer Home Slideshow
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Slide 1 Image</td>
                                            <td>Slide 1 Text</td>
                                            <td>Slide 2 Image</td>
                                            <td>Slide 2 Text</td>
                                            <td>Slide 3 Image</td>
                                            <td>Slide 3 Text</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt_select_slideshow_info = $connection->prepare("SELECT * FROM slideshow_slides");
                                        $stmt_select_slideshow_info->execute();
                                        $result_slideshow_info = $stmt_select_slideshow_info->get_result();
                                        while ($row_slideshow = $result_slideshow_info->fetch_assoc()) {
                                            get_slideshow_connection(
                                                $row_slideshow['slide1_image'],
                                                $row_slideshow['slide1_text'],
                                                $row_slideshow['slide2_image'],
                                                $row_slideshow['slide2_text'],
                                                $row_slideshow['slide3_image'],
                                                $row_slideshow['slide3_text'],
                                            );
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->

</body>
<script src="home_admin.js"></script>
<script src="../admin-main/admin-main.js"></script>
<script>
    var xValues = ["Customers", "Admins"];
    var yValues = [<?php echo $row_total_customers['count']; ?>, <?php echo $row_total_admins['count']; ?>];
    var barColors = [
        "#b91d47",
        '#00aba9'
    ]

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Distribution of All Accounts"
            }
        }
    });
    var xValuesAppointments = ["Pending Appointments", "Done Appointments"];
    var yValuesAppointments = [<?php echo $row_get_pending_appointments['total_pending_appointments']; ?>, <?php echo $row_get_done_appointments['total_done_appointments']; ?>]
    var barColorsAppointments = [
        "#b91d47",
        "#00aba9"
    ]

    new Chart("AppointmentsChart", {
        type: "pie",
        data: {
            labels: xValuesAppointments,
            datasets: [{
                backgroundColor: barColorsAppointments,
                data: yValuesAppointments
            }]
        },
        options: {
            title: {
                display: true,
                text: "Distribution of All Appointments"
            }
        }
    });
</script>

</html>