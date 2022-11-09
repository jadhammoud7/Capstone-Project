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
$query = "SELECT first_name, last_name FROM admins WHERE admin_id = $admin_id";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();


//sum of all repairs
$query_total_repairs = "SELECT COUNT(*) as total_repairs FROM repairs";
$stmt_total_repairs = $connection->prepare($query_total_repairs);
$stmt_total_repairs->execute();
$results_total_repairs = $stmt_total_repairs->get_result();
$row_total_repairs = $results_total_repairs->fetch_assoc();


//count of all appointments
$query_total_appointments = "SELECT COUNT(appointment_id) as total_appointments FROM appointments";
$stmt_total_appointments = $connection->prepare($query_total_appointments);
$stmt_total_appointments->execute();
$results_total_appointments = $stmt_total_appointments->get_result();
$row_total_appointments = $results_total_appointments->fetch_assoc();

//sum of all total price per hour
$query_total_prices_per_hour = "SELECT SUM(price_per_hour) as total_price_per_hour FROM repairs";
$stmt_total_prices_per_hour = $connection->prepare($query_total_prices_per_hour);
$stmt_total_prices_per_hour->execute();
$results_total_prices_per_hour = $stmt_total_prices_per_hour->get_result();
$row_total_prices_per_hour = $results_total_prices_per_hour->fetch_assoc();

//get total appointments total prices
$query_total_repairs_profits = "SELECT SUM(price_per_hour) as total_repairs_profits FROM appointments";
$stmt_total_repairs_profits = $connection->prepare($query_total_repairs_profits);
$stmt_total_repairs_profits->execute();
$results_total_repairs_profits = $stmt_total_repairs_profits->get_result();
$row_total_repairs_profits = $results_total_repairs_profits->fetch_assoc();

require_once("../php/admin_page_php.php");

//delete customer
if (isset($_GET['getRepairIDtoRemove'])) {
    $remove_repair_id = $_GET['getRepairIDtoRemove'];
    $query_delete_repair = "DELETE FROM repairs WHERE repair_id = '" . $remove_repair_id . "' ";
    $stmt_delete_repair = $connection->prepare($query_delete_repair);
    $stmt_delete_repair->execute();
}

$stmt_select_repairs = $connection->prepare("SELECT * FROM repairs");
$stmt_select_repairs->execute();
$results_repairs = $stmt_select_repairs->get_result();

$repair_type = "";
$price_per_hour = 0;
$description = "";
$repair_image = "";

if (isset($_POST['repair_type'])) {
    $repair_type = $_POST['repair_type'];
}

if (isset($_POST['price_per_hour'])) {
    $price_per_hour = $_POST['price_per_hour'];
}

if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

if ($repair_type != "" && $price_per_hour != 0 && $description != "") {
    //make new dir of same name as repair type
    mkdir('../images/Repairs/' + $repair_type);
    $target_dir = "../images/Repairs/$repair_type/";
    $filename = basename($_FILES['repair_image']['name']);
    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['repair_image']['tmp_name'], $target_file)) {
            $repair_image = $filename;
            //create new repair in table repairs
            $stmt_add_new_repair = $connection->prepare("INSERT INTO repairs(repair_type, price_per_hour, description, image) VALUES (?,?,?,?)");
            $stmt_add_new_repair->bind_param("siss", $repair_type, $price_per_hour, $description, $repair_image);
            $stmt_add_new_repair->execute();
            $stmt_add_new_repair->close();
            header("Location: repairs-admin.php?repair-added=1");
        }
    }
}

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
    <link rel="stylesheet" href="repairs-admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="../admin-main/admin-main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Admin | Repairs - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

    <!-- started popup message login successful -->
    <div class="popup" id="remove-repair-confirmation">
        <img src="../images/question-mark.png" alt="remove confirmation">
        <h2>Delete Confirmation</h2>
        <p id="remove-confirmation-text"></p>
        <button type="button" onclick="DeleteRepair()">YES</button>
        <button type="button" onclick="CloseRemoveRepairPopUp()">NO</button>
    </div>

    <!-- started popup message logout -->
    <div class="popup" id="logout-confirmation">
        <img src="../images/question-mark.png" alt="">
        <h2>Log Out Confirmation</h2>
        <p>Are you sure that you want to logout?</p>
        <button type="button" onclick="GoToLogIn()">YES</button>
        <button type="button" onclick="CloseLogOutPopUp()">NO</button>
    </div>

    <!-- started popup message logout -->
    <div class="popup" id="repair-added-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Repair Added Confirmation</h2>
        <p>A new repair was added successfully</p>
        <button type="button" onclick="CloseRepairAddedPopUp()">OK</button>
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
                Repairs List
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
                        <h1><?php echo  $row_total_repairs['total_repairs']; ?></h1>
                        <span>Total Repairs</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_appointments['total_appointments'] ?></h1>
                        <span>Total Appointments Repairs</span>
                    </div>
                    <div>
                        <span class="las la-clipboard"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_prices_per_hour['total_price_per_hour'] ?></h1>
                        <span>Total Price Per Hour</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$<?php echo $row_total_repairs_profits['total_repairs_profits'] ?></h1>
                        <span>Total Repairs Profits</span>
                    </div>
                    <div>
                        <span class="las la-wallet"></span>
                    </div>
                </div>
            </div>
            <div style="margin-top: 30px;">
                <canvas id="myChart1" style="width:100%;max-width:600px; float:left;"></canvas>
                <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
            </div>
            <div class="card-single add_admin">
                <button class="add_repair" onclick="OpenAddRepair()" title="Add a new repair"><span class="las la-plus"></span> Add Repair</button>
            </div>
            <div class="recent-grid" style="display: block !important;">

                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Repairs List</h3>
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
                                    <input type="text" id="SearchInput" onkeyup="FilterTable()" placeholder="Search in table Repairs...">
                                </div>
                                <table width="100%" id="repairs_table">
                                    <thead>
                                        <tr>
                                            <td id="repair-type-column" title="Sort Repair Type by descending">Repair Type</td>
                                            <td id="price-per-hour-column" title="Sort Price Per Hour by descending">Price Per Hour</td>
                                            <td>View Details</td>
                                            <td>Remove Repair</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row_repair = $results_repairs->fetch_assoc()) {
                                            get_all_repairs(
                                                $row_repair['repair_id'],
                                                $row_repair['repair_type'],
                                                $row_repair['price_per_hour']
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
            <!-- adding form -->
            <div id="new_repair_form" class="modal">
                <span onclick="CloseAddRepair()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content" action="repairs-admin.php" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <h1 class="title">Add New Repair</h1> <br>
                        <p class="title">Please fill in this form to add a new repair.</p>
                        <br>

                        <label for="repair_type"><b>Repair Type</b></label>
                        <input type="text" placeholder="Enter repair type name" name="repair_type" id="repair_type" value="" required />

                        <label for="price_per_hour"><b>Price Per Hour</b></label><br>
                        <input style="height: 35px;" type="number" placeholder="Enter repair's price per hour" name="price_per_hour" id="price_per_hour" value="" required>
                        <br><br>

                        <label for="description"><b>Desciption</b></label>
                        <input type="text" placeholder="Enter repair's desciption" name="description" id="description" value="" required>
                        <br><br>

                        <label><b>Upload Repair Image:</b></label>
                        <input type="file" name="repair_image" id="repair_image" value="" required>
                        <br>

                        <div class="clearfix">
                            <button type="submit" class="addrepairbtn" title="Add new repair"><strong>Add Repair</strong></button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->

</body>
<script src="repairs-admin.js"></script>
<script src="../admin-main/admin-main.js"></script>
<script>
    var array_repairs = [];
    var array_repairs_count = [];
    <?php
    $stmt_select_all_repairs = $connection->prepare("SELECT repair_type FROM repairs");
    $stmt_select_all_repairs->execute();
    $results_all_repairs = $stmt_select_all_repairs->get_result();
    while ($row_all_repairs = $results_all_repairs->fetch_assoc()) {
    ?>
        array_repairs.push("<?php
                            echo $row_all_repairs['repair_type'];
                            ?>");
        <?php
        $query_repairs_count = "SELECT COUNT(*) as total_appointments_count FROM appointments WHERE appointment_name ='" . $row_all_repairs['repair_type'] . "'";
        $stmt_repairs_count = $connection->prepare($query_repairs_count);
        $stmt_repairs_count->execute();
        $results_repairs_count = $stmt_repairs_count->get_result();
        $row_repairs_count = $results_repairs_count->fetch_assoc();
        ?>

        array_repairs_count.push("<?php
                                    echo $row_repairs_count['total_appointments_count'];
                                    ?>");
    <?php
    }
    ?>;
    var xValues = array_repairs;
    var yValues = array_repairs_count;
    var random_colors = [];

    var size = array_repairs.length;

    function getNewColor(start) {
        for (var i = start; i < size; i++) {
            var random = "#" + Math.floor(Math.random() * (255 + 1));
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
                text: "Repairs by Total Appointments"
            }
        }
    });
    //started second chart
    var array_repairs_price_per_hour = [];
    var xValues2 = array_repairs;
    <?php
    $stmt_select_all_repairs = $connection->prepare("SELECT price_per_hour FROM repairs");
    $stmt_select_all_repairs->execute();
    $results_all_repairs = $stmt_select_all_repairs->get_result();
    while ($row_all_repairs = $results_all_repairs->fetch_assoc()) {
    ?>
        array_repairs_price_per_hour.push("<?php
                                            echo $row_all_repairs['price_per_hour'];
                                            ?>");
    <?php } ?>;
    var yValues2 = array_repairs_price_per_hour;
    const size2 = array_repairs_price_per_hour.length;

    var random_colors2 = [];

    function getNewColor2(start) {
        for (var i = start; i < size2; i++) {
            const random2 = "#" + Math.floor(Math.random() * (255 + 1));
            if (random_colors2.values != random2) {
                random_colors2.push(random2);
            } else {
                getNewColor2(i);
            }
        }
    }
    getNewColor2(0);

    var barColors2 = random_colors2;

    new Chart("myChart2", {
        type: "pie",
        data: {
            labels: xValues2,
            datasets: [{
                backgroundColor: barColors2,
                data: yValues2
            }]
        },
        options: {
            title: {
                display: true,
                text: "Distribution of Appointments By Price Per Hour"
            }
        }
    });
</script>

</html>