<?php

session_start();
include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
$admin_id = $_SESSION['logged_id'];
$query = "SELECT first_name, last_name FROM admins WHERE admin_id = $admin_id";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();

if (isset($_GET['customer_id'])) {
    $stmt_get_customer = $connection->prepare("SELECT * FROM customers WHERE customer_id = '" . $_GET['customer_id'] . "'");
    $stmt_get_customer->execute();
    $result_customer = $stmt_get_customer->get_result();
    $row_customer = $result_customer->fetch_assoc();

    //get appointments for this customer
    $query_get_customer_appointments = "SELECT appointment_id, appointment_name, date, hour, status FROM appointments WHERE customer_id = '" . $_GET['customer_id'] . "'";
    $stmt_get_customer_appointments = $connection->prepare($query_get_customer_appointments);
    $stmt_get_customer_appointments->execute();
    $results_get_customer_appointments = $stmt_get_customer_appointments->get_result();

    //get checkouts for this customer
    $query_get_customer_checkouts = "SELECT * FROM checkouts WHERE customer_id = '" . $_GET['customer_id'] . "'";
    $stmt_get_customer_checkouts = $connection->prepare($query_get_customer_checkouts);
    $stmt_get_customer_checkouts->execute();
    $results_get_customer_checkouts = $stmt_get_customer_checkouts->get_result();

    //sum of all comments
    $query_total_comments = "SELECT COUNT(*) as count FROM comments WHERE username = '" . $row_customer['username'] . "'";
    $stmt_total_comments = $connection->prepare($query_total_comments);
    $stmt_total_comments->execute();
    $results_total_comments = $stmt_total_comments->get_result();
    $row_total_comments = $results_total_comments->fetch_assoc();

    //count of all appointments
    $query_total_appointments = "SELECT COUNT(*) as total_appointments FROM appointments WHERE customer_id = '" . $_GET['customer_id'] . "'";
    $stmt_total_appointments = $connection->prepare($query_total_appointments);
    $stmt_total_appointments->execute();
    $results_total_appointments = $stmt_total_appointments->get_result();
    $row_total_appointments = $results_total_appointments->fetch_assoc();

    //sum of all appointments
    $query_total_profit = "SELECT SUM(total_price_including_tax) as total_profit FROM checkouts WHERE customer_id = '" . $_GET['customer_id'] . "'";
    $stmt_total_profit = $connection->prepare($query_total_profit);
    $stmt_total_profit->execute();
    $results_total_profit = $stmt_total_profit->get_result();
    $row_total_profit = $results_total_profit->fetch_assoc();

    //get total checkouts made
    $query_total_checkouts = "SELECT COUNT(checkout_id) as total_checkout FROM checkouts WHERE customer_id = '" . $_GET['customer_id'] . "'";
    $stmt_total_checkouts = $connection->prepare($query_total_checkouts);
    $stmt_total_checkouts->execute();
    $results_total_checkouts = $stmt_total_checkouts->get_result();
    $row_total_checkouts = $results_total_checkouts->fetch_assoc();

    //get count of appointments pending
    $status = "Pending";
    $query_get_pending_appointments = "SELECT COUNT(*) as total_pending_appointments FROM appointments WHERE status=? AND customer_id = '" . $_GET['customer_id'] . "'";
    $stmt_get_pending_appointments = $connection->prepare($query_get_pending_appointments);
    $stmt_get_pending_appointments->bind_param("s", $status);
    $stmt_get_pending_appointments->execute();
    $results_get_pending_appointments = $stmt_get_pending_appointments->get_result();
    $row_get_pending_appointments = $results_get_pending_appointments->fetch_assoc();

    //get count of appointments done work
    $status = "Done Work";
    $query_get_done_appointments = "SELECT COUNT(*) as total_done_appointments FROM appointments WHERE status=? AND customer_id = '" . $_GET['customer_id'] . "'";
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
            header("Location:../customer-admin/customer-details.php?customer_id=" . $_GET['customer_id']);
        } else if ($working_status == "false") {
            $status = "Pending";
            $query_settodone = $connection->prepare("UPDATE appointments SET status=? WHERE appointment_id='" . $appointmentID . "'");
            $query_settodone->bind_param("s", $status);
            $query_settodone->execute();
            header("Location:../customer-admin/customer-details.php?customer_id=" . $_GET['customer_id']);
        }
    }

    //get count of checkouts done work
    $status = "Done Work";
    $query_get_done_checkouts = "SELECT COUNT(*) as total_done_checkouts FROM checkouts WHERE status=?";
    $stmt_get_done_checkouts = $connection->prepare($query_get_done_checkouts);
    $stmt_get_done_checkouts->bind_param("s", $status);
    $stmt_get_done_checkouts->execute();
    $results_get_done_checkouts = $stmt_get_done_checkouts->get_result();
    $row_get_done_checkouts = $results_get_done_checkouts->fetch_assoc();

    //updating working status from buttons
    if (isset($_GET['set_to_done']) && isset($_GET['getCheckoutID'])) {
        $working_status = $_GET['set_to_done'];
        $checkoutID = $_GET['getCheckoutID'];
        $status = "";
        if ($working_status == "true") {
            $status = "Done Work";
            $query_settodone = $connection->prepare("UPDATE checkouts SET status=? WHERE checkout_id='" . $checkoutID . "'");
            $query_settodone->bind_param("s", $status);
            $query_settodone->execute();
            header("Location:../checkouts-admin/checkouts-admin.php");
        } else if ($working_status == "false") {
            $status = "Pending";
            $query_settodone = $connection->prepare("UPDATE checkouts SET status=? WHERE checkout_id='" . $checkoutID . "'");
            $query_settodone->bind_param("s", $status);
            $query_settodone->execute();
            header("Location:../checkouts-admin/checkouts-admin.php");
        }
    }
}

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
    <link rel="stylesheet" href="../admin-main/admin-main.css">
    <link rel="stylesheet" href="customer-details.css">
    <title>Admin | Customer Detail - Newbies Gamers</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>

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
                    <a href="../product-admin/product-admin.php" id="products-link">
                        <span class="la la-product-hunt"></span>
                        <span>Products</span>
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
                Customer Detail
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
                        <h1><?php echo  $row_total_comments['count']; ?></h1>
                        <span>Comments</span>
                    </div>
                    <div>
                        <span class="las la-comments"></span>
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

            <!-- started with checkout form -->
            <div>
                <div class="details">
                    <h2>Customer Details</h2>
                    <div class="form-container">
                        <form>
                            <div class="form-container-part">

                                <div>
                                    <h3 class="form-container-part-title">Personal Information</h3>
                                </div>

                                <div class="form-container-part-inputs">
                                    <div class="input-container">
                                        <input type="text" name="first_name" id="first_name" value="<?php if (isset($row_customer)) {
                                                                                                        echo $row_customer['first_name'];
                                                                                                    } ?>" readonly class="is-valid">
                                        <label for="first_name">First Name</label>
                                    </div>

                                    <div class="input-container">

                                        <input type="text" name="last_name" id="last_name" value="<?php if (isset($row_customer)) {
                                                                                                        echo $row_customer['last_name'];
                                                                                                    } ?>" readonly class="is-valid">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                </div>

                                <div class="form-container-part-inputs">
                                    <div class="input-container">
                                        <input type="email" name="email" id="email" value="<?php if (isset($row_customer)) {
                                                                                                echo $row_customer['email'];
                                                                                            } ?>" readonly class="is-valid">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="input-container">

                                        <input type="tel" name="phone_number" id="phone_number" value="<?php if (isset($row_customer)) {
                                                                                                            echo $row_customer['phone_number'];
                                                                                                        } ?>" readonly class="is-valid">
                                        <label for="phone_number">Phone Number</label>
                                    </div>
                                </div>

                                <div class="form-container-part-inputs">
                                    <div class="input-container">
                                        <input type="date" name="date_of_birth" value="<?php if (isset($row_customer)) {
                                                                                            echo $row_customer['date_of_birth'];
                                                                                        } ?>" readonly class="is-valid">
                                        <label for="date_of_birth">Date Of Birth</label>
                                    </div>
                                </div>

                                <div class="form-container-part-inputs">
                                    <div class="input-container">

                                        <input type="text" name="city" id="city" value="<?php if (isset($row_customer)) {
                                                                                            echo $row_customer['city'];
                                                                                        } ?>" readonly class="is-valid">
                                        <label for="city">City</label>
                                    </div>
                                </div>

                                <div class="form-container-part-inputs">
                                    <div class="input-container">

                                        <input type="text" name="address" id="address" value="<?php if (isset($row_customer)) {
                                                                                                    echo $row_customer['address'];
                                                                                                } ?>" readonly class="is-valid">
                                        <label for="address">Address</label>
                                    </div>
                                </div>

                                <div class="form-container-part-inputs">
                                    <div class="input-container" style="width: 100%;">

                                        <input type="text" name="username" id="username" value="<?php if (isset($row_customer)) {
                                                                                                    echo $row_customer['username'];
                                                                                                } ?>" readonly class="is-valid">
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="recent-grid" style="grid-template-columns: 100%;">
                    <div class="projects">
                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <canvas id="AppointmentsChart" style="width: 100%; max-width: 600px;"></canvas>
                            </div>
                            <div class="card-header">
                                <h3>Appointments from <?php echo $row_customer['first_name']; ?> <?php echo $row_customer['last_name']; ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <td>Appointment Name</td>
                                                <td>Date</td>
                                                <td>Hour</td>
                                                <td>Status</td>
                                                <td>Change Status</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require('../php/admin_page_php.php');
                                            while ($row_get_appointments = $results_get_customer_appointments->fetch_assoc()) {
                                                echo get_appointments_in_customer_details(
                                                    $row_get_appointments['appointment_id'],
                                                    $row_get_appointments['appointment_name'],
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
                </div>

                <div class="recent-grid" style="grid-template-columns: 100%;">
                    <div class="projects">
                        <div class="card">
                            <div class="card-header" style="text-align: center;">
                                <canvas id="AppointmentsChart" style="width: 100%; max-width: 600px;"></canvas>
                            </div>
                            <div class="card-header">
                                <h3>Checkouts from <?php echo $row_customer['first_name']; ?> <?php echo $row_customer['last_name']; ?></h3>
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
                                            while ($row_get_checkouts = $results_get_customer_checkouts->fetch_assoc()) {
                                                get_all_checkouts_connection(
                                                    $row_get_checkouts['checkout_id'],
                                                    $row_get_checkouts['customer_id'],
                                                    $row_get_checkouts['first_name'],
                                                    $row_get_checkouts['last_name'],
                                                    $row_get_checkouts['email'],
                                                    $row_get_checkouts['phone_number'],
                                                    $row_get_checkouts['total_price'],
                                                    $row_get_checkouts['total_price_including_tax'],
                                                    $row_get_checkouts['date'],
                                                    $row_get_checkouts['status']
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

                <div class="checkout-buttons">
                    <button class="back_to_shoppingbasket" onclick="window.location.href='../checkouts-admin/checkouts-admin.php';" title="Return to checkouts list"><span class="las la-arrow-left"></span>Return to
                        Checkouts List</button>
                </div>
            </div>
        </main>
    </div>
    <!-- ended with checkout form -->


    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->
</body>
<script src="../admin-main/admin-main.js"></script>
<script src="customer-details.js"></script>
<script>
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