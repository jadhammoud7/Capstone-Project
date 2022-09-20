<?php

session_start();
include("../php/connection.php");
require('../php/admin_page_php.php');

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
$admin_id = $_SESSION['logged_id'];
$query = "SELECT first_name, last_name FROM admins WHERE admin_id = $admin_id";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();

if (isset($_GET['product_id'])) {
    $stmt_get_product = $connection->prepare("SELECT * FROM products WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_get_product->execute();
    $result_product = $stmt_get_product->get_result();
    $row_product = $result_product->fetch_assoc();
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
    <link rel="stylesheet" href="product-details.css">
    <title>Admin | Product Details - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

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
                Product Details
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
            <!-- started with checkout form -->
            <div>
                <div class="details">
                    <div class="card">
                        <div class="card-header">
                            <h2>Product Details</h2>
                        </div>
                        <div class="form-container card-body">
                            <form>
                                <div class="form-container-part">

                                    <div>
                                        <h3 class="form-container-part-title">Product Information</h3>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="product_id" id="product_id" value="<?php if (isset($row_product)) {
                                                                                                                echo $row_product['product_id'];
                                                                                                            } ?>" readonly class="is-valid">
                                            <label for="product_id">Product ID</label>
                                        </div>

                                        <div class="input-container">

                                            <input type="text" name="product_name" id="product_name" value="<?php if (isset($row_product)) {
                                                                                                                echo $row_product['name'];
                                                                                                            } ?>" readonly class="is-valid">
                                            <label for="product_name">Product Name</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="price" id="price" value="<?php if (isset($row_product)) {
                                                                                                    echo $row_product['price'];
                                                                                                } ?>" readonly class="is-valid">
                                            <label for="price">Price</label>
                                        </div>
                                        <div class="input-container">

                                            <input type="text" name="type" id="type" value="<?php if (isset($row_product)) {
                                                                                                echo $row_product['type'];
                                                                                            } ?>" readonly class="is-valid">
                                            <label for="type">Type</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="text" name="category" value="<?php if (isset($row_product)) {
                                                                                            echo $row_product['category'];
                                                                                        } ?>" readonly class="is-valid">
                                            <label for="category">Category</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container description">
                                            <div class="description-body">
                                                <h3>Description</h3>
                                                <p><?php if (isset($row_product)) {
                                                        echo $row_product['description'];
                                                    } ?></p>
                                            </div>


                                            <!-- <input type="text" name="description" id="description" value="<?php if (isset($row_product)) {
                                                                                                                    echo $row_product['description'];
                                                                                                                } ?>" readonly class="is-valid">
                                            <label for="description">Description</label> -->
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">

                                            <input type="text" name="age" id="age" value="<?php if (isset($row_product)) {
                                                                                                echo $row_product['age'];
                                                                                            } ?>" readonly class="is-valid">
                                            <label for="age">Age</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="inventory" id="inventory" value="<?php if (isset($row_product)) {
                                                                                                            echo $row_product['inventory'];
                                                                                                        } ?>" readonly class="is-valid">
                                            <label for="inventory">Inventory</label>
                                        </div>
                                    </div>

                                    <!-- here to add upload file -->

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="product-details-buttons">
                    <button class="back" onclick="history.back();" title="Return to Previous Page"><span class="las la-arrow-left" style="font-size: 1.4rem;"></span>Return to
                        Previous Page</button>
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

    var xValuesCheckouts = ["Pending Checkouts", "Done Checkouts"];
    var yValuesCheckouts = [<?php echo $row_get_pending_checkouts['total_pending_checkouts']; ?>, <?php echo $row_get_done_checkouts['total_done_checkouts']; ?>]
    var barColorsCheckouts = [
        "#b91d47",
        "#00aba9"
    ]

    new Chart("CheckoutsChart", {
        type: "pie",
        data: {
            labels: xValuesCheckouts,
            datasets: [{
                backgroundColor: barColorsCheckouts,
                data: yValuesCheckouts
            }]
        },
        options: {
            title: {
                display: true,
                text: "Distribution of All Checkouts"
            }
        }
    });
</script>

</html>