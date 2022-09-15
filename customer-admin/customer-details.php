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

    //to display products in table summary
    // $stmt_get_checkout_products = $connection->prepare("SELECT product_id, quantity, total_price FROM checkouts_customers_products WHERE checkout_id = '" . $_GET['checkout_id'] . "' ");
    // $stmt_get_checkout_products->execute();
    // $results_get_checkout_products = $stmt_get_checkout_products->get_result();

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
}

//for product summary in checkout
// function checkout_products_connection($name, $quantity, $price)
// {
//     $element = "
//     <tr>
//         <td>$name</td>
//         <td>$quantity</td>
//         <td>$price$</td>
//     </tr>";

//     echo $element;
// }

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
                <div class="billing-details">
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
                <!-- <div class="order-summary">
                    <h2>Order Summary</h2>
                    <table id="order-products">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                        <?php
                        while ($row_get_checkout_products = $results_get_checkout_products->fetch_assoc()) {
                            $stmt_get_product = $connection->prepare("SELECT name, price FROM products WHERE product_id = '" . $row_get_checkout_products["product_id"] . "' ");
                            $stmt_get_product->execute();
                            $results_get_product = $stmt_get_product->get_result();
                            $row_get_product = $results_get_product->fetch_assoc();
                            checkout_products_connection($row_get_product['name'], $row_get_checkout_products['quantity'], $row_get_checkout_products['total_price']);
                        }
                        ?>
                    </table>
                    <table id="order-totals">
                        <tr>
                            <th>Subtotal</th>
                            <td><?php echo $row_checkout['total_price']; ?>$</td>
                        </tr>
                        <tr>
                            <th>Taxes</th>
                            <td><?php echo $row_checkout['tax_price']; ?>$</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td><?php echo $row_checkout['total_price_including_tax']; ?>$</td>
                        </tr>
                    </table>
                </div> -->
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


</html>