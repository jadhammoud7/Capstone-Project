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
$query = "SELECT first_name, last_name, username, image FROM admins WHERE admin_id = $admin_id";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();


//sum of all customers in appointments
$query_total_customers_in_appointments = "SELECT DISTINCT customer_id FROM appointments";
$stmt_total_customers_in_appointments = $connection->prepare($query_total_customers_in_appointments);
$stmt_total_customers_in_appointments->execute();
$results_total_customers_in_appointments = $stmt_total_customers_in_appointments->get_result();

//count of all appointments
$query_total_appointments = "SELECT COUNT(appointment_id) as total_appointments FROM appointments";
$stmt_total_appointments = $connection->prepare($query_total_appointments);
$stmt_total_appointments->execute();
$results_total_appointments = $stmt_total_appointments->get_result();
$row_total_appointments = $results_total_appointments->fetch_assoc();

//sum of all appointments price per hour
$query_total_appointments_prices = "SELECT SUM(price_per_hour) as total_appointments_prices FROM appointments";
$stmt_total_appointments_prices = $connection->prepare($query_total_appointments_prices);
$stmt_total_appointments_prices->execute();
$results_total_appointments_prices = $stmt_total_appointments_prices->get_result();
$row_total_appointments_prices = $results_total_appointments_prices->fetch_assoc();

//get total appointments today
$currentDate = new DateTime();
$query_total_appointments_today = "SELECT COUNT(*) as total_appointments_today FROM appointments WHERE date LIKE '" . $currentDate->format('Y-m-d') . "'";
$stmt_total_appointments_today = $connection->prepare($query_total_appointments_today);
$stmt_total_appointments_today->execute();
$results_total_appointments_today = $stmt_total_appointments_today->get_result();
$row_total_appointments_today = $results_total_appointments_today->fetch_assoc();

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
        header("Location:../appointments-admin/appointments-admin.php");
    } else if ($working_status == "false") {
        $status = "Pending";
        $query_settodone = $connection->prepare("UPDATE appointments SET status=? WHERE appointment_id='" . $appointmentID . "'");
        $query_settodone->bind_param("s", $status);
        $query_settodone->execute();
        header("Location:../appointments-admin/appointments-admin.php");
    }
}
//get all types of repairs
$query_type_of_repairs = "SELECT repair_type as repair_type FROM repairs";
$stmt_type_of_repairs = $connection->prepare($query_type_of_repairs);
$stmt_type_of_repairs->execute();
$results_type_of_repairs = $stmt_type_of_repairs->get_result();

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
    <link rel="stylesheet" href="../admin-main/admin-main.css">
    <title>Admin | Appointments - Newbies Gamers</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body onunload="myFunction()">

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
                Appointments List
            </h2>

            <div class="user-wrapper">
                <img src="../images/Admins/<?php echo $row['username']; ?>/<?php echo $row['image']; ?>" width="40px" height="40px" alt="">
                <div>
                    <h4> <?php echo $row["first_name"], " ", $row['last_name']; ?></h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>

        <main>
            <div class="cards">
                <div class="card-single" title="This is the total number of customers that booked appointments">
                    <div>
                        <h1><?php echo $results_total_customers_in_appointments->num_rows; ?></h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total number of booked appointments by customers">
                    <div>
                        <h1><?php echo $row_total_appointments['total_appointments'] ?></h1>
                        <span>Appointments</span>
                    </div>
                    <div>
                        <span class="las la-clipboard"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total number of appointments scheduled today">
                    <div>
                        <h1><?php echo $row_total_appointments_today['total_appointments_today'] ?></h1>
                        <span>Appointments Today</span>
                    </div>
                    <div>
                        <span class="las la-calendar-day"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total price of booked appointments">
                    <div>
                        <h1>$<?php echo $row_total_appointments_prices['total_appointments_prices'] ?></h1>
                        <span>Total Appointments Prices</span>
                    </div>
                    <div>
                        <span class="las la-wallet"></span>
                    </div>
                </div>
            </div>
            <div>
                <canvas id="myChart" style="width:100%;max-width:600px;float:left"></canvas>
                <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
            </div>
            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Appointments List</h3>
                        </div>
                        <div class="card-header">
                            <h3>
                                <p style="text-decoration: underline; color: royalblue;" id="filter-text"></p>
                                <br>
                                <p id="table-sort"></p>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="div-search">
                                    <span class="las la-search" style="font-size: 1.8rem; color: royalblue;"></span>
                                    <input type="text" id="SearchInput" onkeyup="FilterTable()" placeholder="Search in table Appointments...">
                                </div>
                                <table width="100%" id="appointments_table">
                                    <thead>
                                        <tr>
                                            <td id="appointment-name-column" title="Sort Appointment Name by descending">Appointment Name</td>
                                            <td id="customer-name-column" title="Sort Customer Name by descending">Customer Name</td>
                                            <td id="price-per-hour-column" title="Sort Price Per Hour by descending">Price Per Hour</td>
                                            <td id="date-column" title="Sort Date by descending">Date</td>
                                            <td>Hour</td>
                                            <td id="status-column" title="Sort Status by descending">Status</td>
                                            <td>Change Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //get all appointments
                                        require_once("../php/admin_page_php.php");
                                        $query_appointments = "SELECT * FROM appointments";
                                        $stmt_appointments = $connection->prepare($query_appointments);
                                        $stmt_appointments->execute();
                                        $results_appointments = $stmt_appointments->get_result();

                                        while ($row_appointments = $results_appointments->fetch_assoc()) {
                                            $query_get_user = "SELECT first_name, last_name FROM customers WHERE customer_id = '" . $row_appointments['customer_id'] . "' ";
                                            $stmt_get_user = $connection->prepare($query_get_user);
                                            $stmt_get_user->execute();
                                            $results_get_user = $stmt_get_user->get_result();
                                            $row_get_user = $results_get_user->fetch_assoc();

                                            echo get_appointment_in_admin_page_for_table_connection(
                                                $row_appointments['appointment_id'],
                                                $row_get_user['first_name'] . ' ' . $row_get_user['last_name'],
                                                $row_appointments['customer_id'],
                                                $row_appointments['appointment_name'],
                                                $row_appointments['appointment_type'],
                                                $row_appointments['price_per_hour'],
                                                $row_appointments['date'],
                                                $row_appointments['hour'],
                                                $row_appointments['status'],
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
<script src="appointments-admin.js"></script>
<script src="../admin-main/admin-main.js"></script>
<script>
    var xValues = ["Pending Appointments", "Done Appointments"];
    var yValues = [<?php echo $row_get_pending_appointments['total_pending_appointments']; ?>, <?php echo $row_get_done_appointments['total_done_appointments']; ?>]
    var barColors = [
        "#b91d47",
        "#00aba9"
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
                text: "Distribution of All Appointments"
            }
        }
    });

    //start of t=second chart
    const type_array = [];
    const array_repair_count = [];
    <?php
    if (isset($results_type_of_repairs)) {
        while ($row_type_of_repairs = $results_type_of_repairs->fetch_assoc()) {
    ?>
            type_array.push("<?php
                                echo $row_type_of_repairs['repair_type'];
                                ?>");
            <?php
            $query_repair_count = "SELECT COUNT(appointment_name) as repair_count FROM appointments WHERE appointment_name='" . $row_type_of_repairs['repair_type'] . "'";
            $stmt_repair_count = $connection->prepare($query_repair_count);
            $stmt_repair_count->execute();
            $results_repair_count = $stmt_repair_count->get_result();
            $row_repair_count = $results_repair_count->fetch_assoc();
            ?>

            array_repair_count.push("<?php
                                        echo $row_repair_count['repair_count'];
                                        ?>");
    <?php }
    }
    ?>;
    var xValues = type_array;
    console.log(xValues);
    var yValues = array_repair_count;
    console.log(yValues);
    var barColors = ["red", "green", "blue", "orange", "brown", "purple", "yellow"];

    new Chart("myChart2", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Chosen Repairs"
            }
        }
    });
</script>

</html>