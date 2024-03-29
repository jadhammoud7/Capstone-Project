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


//sum of all customers
$query_total_customers = "SELECT COUNT(customer_id) as total_customers FROM customers";
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


//get all customer
require_once("../php/admin_page_php.php");
$query_customer = "SELECT * FROM customers";
$stmt_customer = $connection->prepare($query_customer);
$stmt_customer->execute();
$results_customer = $stmt_customer->get_result();

//delete customer
if (isset($_GET['getCustomerIDtoRemove'])) {
    $remove_customer = $_GET['getCustomerIDtoRemove'];
    $query_delete_customer = "DELETE FROM customers WHERE customer_id=$remove_customer";
    $stmt_delete_customer = $connection->prepare($query_delete_customer);
    $stmt_delete_customer->execute();
    echo "<script>window.location = 'customer-admin.php';</script>";
}
//get id from repair
$query_loyalty_customers = "SELECT username,loyalty_points FROM customers ORDER BY loyalty_points DESC LIMIT 5";
$stmt_loyalty_customers = $connection->prepare($query_loyalty_customers);
$stmt_loyalty_customers->execute();
$results_loyalty_customers = $stmt_loyalty_customers->get_result();


//get locations
$query_location = "SELECT DISTINCT city FROM customers";
$stmt_location = $connection->prepare($query_location);
$stmt_location->execute();
$results_location = $stmt_location->get_result();

//sum of all checkouts
$query_total_price_checkouts = "SELECT SUM(total_price_including_tax) as total_price_checkouts FROM checkouts WHERE status = 'DONE WORK'";
$stmt_total_price_checkouts = $connection->prepare($query_total_price_checkouts);
$stmt_total_price_checkouts->execute();
$results_total_price_checkouts = $stmt_total_price_checkouts->get_result();
$row_total_price_checkouts = $results_total_price_checkouts->fetch_assoc();

$query_total_cost_checkouts = "SELECT SUM(total_cost) as total_cost_checkouts FROM checkouts WHERE status = 'DONE WORK'";
$stmt_total_cost_checkouts = $connection->prepare($query_total_cost_checkouts);
$stmt_total_cost_checkouts->execute();
$results_total_cost_checkouts = $stmt_total_cost_checkouts->get_result();
$row_total_cost_checkouts = $results_total_cost_checkouts->fetch_assoc();

$query_total_price_store_sales = "SELECT SUM(total_price_after_discount) as total_price_store_sales FROM store_sales";
$stmt_total_price_store_sales = $connection->prepare($query_total_price_store_sales);
$stmt_total_price_store_sales->execute();
$results_total_price_store_sales = $stmt_total_price_store_sales->get_result();
$row_total_price_store_sales = $results_total_price_store_sales->fetch_assoc();

$query_total_cost_store_sales = "SELECT SUM(total_cost) as total_cost_store_sales FROM store_sales";
$stmt_total_cost_store_sales = $connection->prepare($query_total_cost_store_sales);
$stmt_total_cost_store_sales->execute();
$results_total_cost_store_sales = $stmt_total_cost_store_sales->get_result();
$row_total_cost_store_sales = $results_total_cost_store_sales->fetch_assoc();

$total_profit = $row_total_price_checkouts['total_price_checkouts'] - $row_total_cost_checkouts['total_cost_checkouts'] + $row_total_price_store_sales['total_price_store_sales'] - $row_total_cost_store_sales['total_cost_store_sales'];


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
    <link rel="stylesheet" href="customer-admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="../admin-main/admin-main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Admin | Customers - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

    <!-- started popup message login successful -->
    <div class="popup" id="remove-confirmation">
        <img src="../images/question-mark.png" alt="remove confirmation">
        <h2>Delete Confirmation</h2>
        <p id="remove-confirmation-text"></p>
        <button type="button" onclick="DeleteCustomer()">YES</button>
        <button type="button" onclick="CloseRemoveCustomerPopUp()">NO</button>
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
                Customers List
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
                <div class="card-single" title="This is the total number of customers">
                    <div>
                        <h1><?php echo  $row_total_customers['total_customers']; ?></h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total number of appointments scheduled by customers">
                    <div>
                        <h1><?php echo $row_total_appointments['total_appointments'] ?></h1>
                        <span>Appointments</span>
                    </div>
                    <div>
                        <span class="las la-clipboard"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total number of checkout orders sent by customers">
                    <div>
                        <h1><?php echo $row_total_checkouts['total_checkout'] ?></h1>
                        <span>Chekouts</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total profits of the shop">
                    <div>
                        <h1>$<?php echo $total_profit; ?></h1>
                        <span>Profit</span>
                    </div>
                    <div>
                        <span class="las la-wallet"></span>
                    </div>
                </div>
            </div>
            <div style="margin-top: 30px;">
                <canvas id="myChart1" style="width:100%;max-width:600px; float:left;"></canvas>
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            </div>
            <div class="recent-grid" style="display: block !important;">

                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Customers List</h3>
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
                                    <input type="text" id="SearchInput" onkeyup="FilterTable()" placeholder="Search in table Customers...">
                                </div>
                                <table width="100%" id="customers_table">
                                    <thead>
                                        <tr>
                                            <td id="customer-name-column" title="Sort Customer Name by descending">Customer Name</td>
                                            <td id="username-column" title="Sort Username by descending">Username</td>
                                            <td id="email-column" title="Sort Email by descending">Email</td>
                                            <td id="phone-number-column" title="Sort Phone Number by descending">Phone Number</td>
                                            <td id="city-column" title="Sort City by descending">City</td>
                                            <td id="loyalty-points-column" title="Sort Loyalty Points by descending">Loyalty Points</td>
                                            <td id="date-of-birth-column" title="Sort Date Of Birth by descending">Date of Birth</td>
                                            <td>Remove Customer</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row_customer = $results_customer->fetch_assoc()) {
                                            get_all_customer_connection(
                                                $row_customer['customer_id'],
                                                $row_customer['first_name'],
                                                $row_customer['last_name'],
                                                $row_customer['username'],
                                                $row_customer['email'],
                                                $row_customer['phone_number'],
                                                $row_customer['city'],
                                                $row_customer['loyalty_points'],
                                                $row_customer['date_of_birth']
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
<script src="customer-admin.js"></script>
<script src="../admin-main/admin-main.js"></script>
<script>
    const array_cities = [];
    const array_cities_count = [];
    <?php
    if (isset($results_location)) {
        while ($row_location = $results_location->fetch_assoc()) {
    ?>
            array_cities.push("<?php
                                echo $row_location['city'];
                                ?>");
            <?php
            $query_location_count = "SELECT COUNT(city) as city FROM customers WHERE city='" . $row_location['city'] . "'";
            $stmt_location_count = $connection->prepare($query_location_count);
            $stmt_location_count->execute();
            $results_location_count = $stmt_location_count->get_result();
            $row_location_count = $results_location_count->fetch_assoc();
            ?>

            array_cities_count.push("<?php
                                        echo $row_location_count['city'];
                                        ?>");
    <?php }
    }
    ?>;
    var xValues = array_cities;
    var yValues = array_cities_count;
    var random_colors = [];

    const size = array_cities.length;

    function getNewColor(start) {
        for (var i = start; i < size; i++) {
            const random = "#" + Math.floor(Math.random() * (255 + 1));
            if (random_colors.values != random) {
                random_colors.push(random);
            } else {
                getNewColor(i);
            }
        }
    }
    getNewColor(0);

    var barColors = random_colors;
    new Chart("myChart1", {
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
                text: "Where Newbie Gamers is most famous from"
            }
        }
    });



    //2nd chart
    const array_repair = [];
    const array_repair_count = [];
    <?php
    if (isset($results_loyalty_customers)) {
        while ($row_loyalty_customers = $results_loyalty_customers->fetch_assoc()) {
    ?>
            array_repair.push("<?php
                                echo $row_loyalty_customers['username'];
                                ?>");
            array_repair_count.push("<?php
                                        echo $row_loyalty_customers['loyalty_points'];
                                        ?>");
    <?php }
    }
    ?>;
    var xValues = array_repair;
    var yValues = array_repair_count;
    var barColors = ["red", "green", "blue", "orange", "brown"];

    new Chart("myChart", {
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
                text: "Loyalty Customers"
            }
        }
    });
</script>

</html>