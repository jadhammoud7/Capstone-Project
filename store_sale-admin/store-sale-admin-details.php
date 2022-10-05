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

if (isset($_GET['store_sale_id'])) {
    //select sales total products
    $stmt_get_sales_total_products = $connection->prepare("SELECT total_products FROM store_sales WHERE store_sales_id = '" . $_GET['store_sale_id'] . "'");
    $stmt_get_sales_total_products->execute();
    $results_total_products = $stmt_get_sales_total_products->get_result();
    $row_total_products = $results_total_products->fetch_assoc();

    //select sales total quantities
    $stmt_get_sales_total_quantity = $connection->prepare("SELECT total_quantity FROM store_sales WHERE store_sales_id = '" . $_GET['store_sale_id'] . "'");
    $stmt_get_sales_total_quantity->execute();
    $results_total_quantity = $stmt_get_sales_total_quantity->get_result();
    $row_total_quantity = $results_total_quantity->fetch_assoc();

    //select sales total price
    $stmt_get_sales_total_price = $connection->prepare("SELECT total_price FROM store_sales WHERE store_sales_id = '" . $_GET['store_sale_id'] . "'");
    $stmt_get_sales_total_price->execute();
    $results_total_price = $stmt_get_sales_total_price->get_result();
    $row_total_price = $results_total_price->fetch_assoc();


    $stmt_get_store_sale = $connection->prepare("SELECT * FROM store_sales WHERE store_sales_id = '" . $_GET['store_sale_id'] . "'");
    $stmt_get_store_sale->execute();
    $result_store_sale = $stmt_get_store_sale->get_result();
    $row_store_sale = $result_store_sale->fetch_assoc();

    //to display products in table summary
    $stmt_get_store_sale_products = $connection->prepare("SELECT product_name, quantity, price FROM sales_products WHERE sales_id = '" . $_GET['store_sale_id'] . "' ");
    $stmt_get_store_sale_products->execute();
    $result_store_sale_products = $stmt_get_store_sale_products->get_result();
}

//for product summary in checkout
function store_sales_products_connection($product_name, $quantity, $price)
{
    $element = "
    <tr>
        <td>$product_name</td>
        <td>$quantity</td>
        <td>$price$</td>
    </tr>";

    echo $element;
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
    <link rel="stylesheet" href="store-sale-admin-details.css">
    <title>Admin | Store Sale Details - Newbies Gamers</title>
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
                    <a href="../store_sale-admin/store_sale-admin.php" id="store_sale-link">
                        <span class="las la-money-check"></span>
                        <span>Store Sales</span>
                    </a>
                </li>
                <li>
                    <a href="../product-admin/product-admin.php" id="products-link">
                        <span class="la la-product-hunt"></span>
                        <span>Products</span>
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
                Store Sale Details
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
                        <h1><?php echo $_GET['store_sale_id']; ?></h1>
                        <span>Store Sales No.</span>
                    </div>
                    <div>
                        <span class="las la-list-ol"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h2><?php echo $row_total_products['total_products'] ?></h2>
                        <span>Total Products</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_quantity['total_quantity'] ?></h1>
                        <span>Total Quantities</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$<?php echo $row_total_price['total_price'] ?></h1>
                        <span>Total Price</span>
                    </div>
                    <div>
                        <span class="las la-wallet"></span>
                    </div>
                </div>
            </div>

            <!-- started with checkout form -->
            <div>
                <div class="billing-details">
                    <div class="card">
                        <div class="card-header">
                            <h2>Billing Details</h2>
                        </div>
                        <div class="form-container card-body">
                            <form>
                                <div class="form-container-part">

                                    <div>
                                        <h3 class="form-container-part-title">Customer Personal Information</h3>
                                    </div>

                                    <div class="form-container-part-inputs">

                                        <div class="input-container">

                                            <input type="text" name="customer_name" id="customer_name" value="<?php if (isset($row_store_sale)) {
                                                                                                                    echo $row_store_sale['customer_name'];
                                                                                                                } ?>" readonly class="is-valid">
                                            <label for="customer_name">Customer Name</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">

                                            <input type="text" name="username" id="username" value="<?php if (isset($row_store_sale)) {
                                                                                                        echo $row_store_sale['username'];
                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="email" name="email" id="email" value="<?php if (isset($row_store_sale)) {
                                                                                                    echo $row_store_sale['email'];
                                                                                                } ?>" readonly class="is-valid">
                                            <label for="email">Email</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-container-part">
                                    <div>
                                        <h3 class="form-container-part-title">Sales Details</h3>
                                    </div>
                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="text" name="date" value="<?php if (isset($row_checkout)) {
                                                                                        echo $row_checkout['date'];
                                                                                    } ?>" readonly class="is-valid">
                                            <label for="date">Date</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">

                                            <input type="number" name="total_products" id="total_products" value="<?php if (isset($row_store_sale)) {
                                                                                                                        echo $row_store_sale['total_products'];
                                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="total_products">Total Products</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container" style="width: 100%;">

                                            <input type="number" name="total_quantity" id="total_quantity" value="<?php if (isset($row_store_sale)) {
                                                                                                                        echo $row_store_sale['total_quantity'];
                                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="total_quantity">Total Quantity</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-summary">
                <h2>Order Summary</h2>
                <table id="order-products">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                    <?php
                    while ($row_store_sale_products = $result_store_sale_products->fetch_assoc()) {
                        store_sales_products_connection($row_store_sale_products['product_name'], $row_store_sale_products['quantity'], $row_store_sale_products['price']);
                    }
                    ?>
                </table>
                <table id="order-totals">
                    <tr>
                        <th>Total Price</th>
                        <td><?php echo $row_store_sale['total_price']; ?>$</td>
                    </tr>
                </table>
            </div>
            <div class="checkout-details-buttons">

                <button class="back" onclick="history.back();" title="Return to previous page"><span class="las la-arrow-left"></span>Return to
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

</html>