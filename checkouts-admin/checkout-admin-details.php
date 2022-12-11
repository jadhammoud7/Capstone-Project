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

//select status
$query_get_checkout_status = "SELECT status FROM checkouts WHERE checkout_id =  '" . $_GET['checkout_id'] . "'";
$stmt_get_checkout_status = $connection->prepare($query_get_checkout_status);
$stmt_get_checkout_status->execute();
$results_get_checkout_status = $stmt_get_checkout_status->get_result();
$row_get_checkout_status = $results_get_checkout_status->fetch_assoc();

//sum of all quantity products
$query_total_product_quantities = "SELECT SUM(quantity) as total_product_quantities FROM checkouts_customers_products WHERE checkout_id = '" . $_GET['checkout_id'] . "'";
$stmt_total_product_quantities = $connection->prepare($query_total_product_quantities);
$stmt_total_product_quantities->execute();
$results_total_product_quantities = $stmt_total_product_quantities->get_result();
$row_total_product_quantities = $results_total_product_quantities->fetch_assoc();

//sum of all profit
$query_total_profit = "SELECT SUM(total_price_including_tax) as total_profit FROM checkouts";
$stmt_total_profit = $connection->prepare($query_total_profit);
$stmt_total_profit->execute();
$results_total_profit = $stmt_total_profit->get_result();
$row_total_profit = $results_total_profit->fetch_assoc();

if (isset($_GET['checkout_id'])) {
    $stmt_get_checkout = $connection->prepare("SELECT * FROM checkouts WHERE checkout_id = '" . $_GET['checkout_id'] . "'");
    $stmt_get_checkout->execute();
    $result_checkout = $stmt_get_checkout->get_result();
    $row_checkout = $result_checkout->fetch_assoc();

    //to display products in table summary
    $stmt_get_checkout_products = $connection->prepare("SELECT product_id, quantity, total_price FROM checkouts_customers_products WHERE checkout_id = '" . $_GET['checkout_id'] . "' ");
    $stmt_get_checkout_products->execute();
    $results_get_checkout_products = $stmt_get_checkout_products->get_result();
}

//for product summary in checkout
function checkout_products_connection($name, $quantity, $inventory, $price)
{
    $element = "
    <tr>
        <td>$name</td>
        <td>$quantity</td>
        <td>$inventory</td>
        <td>$price$</td>
    </tr>";

    echo $element;
}

//updating working status from buttons
if (isset($_GET['set_to_done']) && isset($_GET['getCheckoutID'])) {
    $working_status = $_GET['set_to_done'];
    $checkoutID = $_GET['getCheckoutID'];
    $status = "";
    if ($working_status == "true") {
        $status = "Done Work";
        $products_found_in_stock = true;

        //check all products in checkout to see if there is enough inventory
        $stmt_check_checkout_products = $connection->prepare("SELECT product_id, quantity FROM checkouts_customers_products WHERE checkout_id = '" . $checkoutID . "'");
        $stmt_check_checkout_products->execute();
        $results_check_checkout_products = $stmt_check_checkout_products->get_result();
        //loop over all products in checkouts
        while ($row_check_checkout_products = $results_check_checkout_products->fetch_assoc()) {
            //get product inventory
            $stmt_select_product_inventory = $connection->prepare("SELECT name, inventory FROM products WHERE product_id = '" . $row_check_checkout_products['product_id'] . "'");
            $stmt_select_product_inventory->execute();
            $results_select_product_inventory = $stmt_select_product_inventory->get_result();
            $row_select_product_inventory = $results_select_product_inventory->fetch_assoc();
            $product_name = $row_select_product_inventory['name'];
            $product_quantity = $row_check_checkout_products['quantity'];
            $product_inventory = $row_select_product_inventory['inventory'];
            //if this product cannot be proceeded, since inventory less than quantity needed, then checkout error
            if ($product_inventory < $product_quantity) {
                $products_found_in_stock = false;
                header("Location: checkout-admin-details.php?checkout_id=$checkoutID&checkout-error=true&product-name=$product_name&quantity=$product_quantity&inventory=$product_inventory");
            }
        }
        //if all products were found in stock, so checkout can be done successfully
        if ($products_found_in_stock == true) {

            //check all products in checkout to see if there is enough inventory
            $stmt_check_checkout_products = $connection->prepare("SELECT product_id, quantity, customer_id FROM checkouts_customers_products WHERE checkout_id = '" . $checkoutID . "'");
            $stmt_check_checkout_products->execute();
            $results_check_checkout_products = $stmt_check_checkout_products->get_result();

            $total_products_quantities = 0;
            //loop over all products in checkout
            while ($row_check_checkout_products = $results_check_checkout_products->fetch_assoc()) {
                //quantity needed in checkout
                $quantity = $row_check_checkout_products['quantity'];
                //select product inventory
                $stmt_select_product_inventory = $connection->prepare("SELECT inventory FROM products WHERE product_id = '" . $row_check_checkout_products['product_id'] . "'");
                $stmt_select_product_inventory->execute();
                $results_select_product_inventory = $stmt_select_product_inventory->get_result();
                $row_select_product_inventory = $results_select_product_inventory->fetch_assoc();
                $inventory = $row_select_product_inventory['inventory'];

                //new product inventory will be inventory minus the quantity delivered
                $new_inventory = $inventory - $quantity;
                $stmt_update_product_inventory = $connection->prepare("UPDATE products SET inventory=? WHERE product_id = '" . $row_check_checkout_products['product_id'] . "'");
                $stmt_update_product_inventory->bind_param("i", $new_inventory);
                $stmt_update_product_inventory->execute();

                $stmt_select_product_sales = $connection->prepare("SELECT sales_number FROM products WHERE product_id = '" . $row_check_checkout_products['product_id'] . "'");
                $stmt_select_product_sales->execute();
                $results_select_product_sales = $stmt_select_product_sales->get_result();
                $row_select_product_sales = $results_select_product_sales->fetch_assoc();
                $sales = $row_select_product_sales['sales_number'];

                //update sales number of product
                $new_sales = $sales + $quantity;
                $total_products_quantities = $total_products_quantities + $new_sales;
                $stmt_update_product_sales = $connection->prepare("UPDATE products SET sales_number=? WHERE product_id = '" . $row_check_checkout_products['product_id'] . "'");
                $stmt_update_product_sales->bind_param("i", $new_sales);
                $stmt_update_product_sales->execute();

                //update loyalty point for customer
                $stmt_get_customer = $connection->prepare("SELECT loyalty_points FROM customers WHERE customer_id = '" . $row_check_checkout_products['customer_id'] . "'");
                $stmt_get_customer->execute();
                $results_get_customer = $stmt_get_customer->get_result();
                $row_get_customer = $results_get_customer->fetch_assoc();

                $new_loyalty = $row_get_customer['loyalty_points'] + $quantity;
                $stmt_update_customer_loyalty_points = $connection->prepare("UPDATE products SET loyalty_points=? WHERE customer_id = '" . $row_check_checkout_products['customer_id'] . "'");
                $stmt_update_customer_loyalty_points->bind_param("i", $new_loyalty);
                $stmt_update_customer_loyalty_points->execute();
            }
            $query_settodone = $connection->prepare("UPDATE checkouts SET status=? WHERE checkout_id='" . $checkoutID . "'");
            $query_settodone->bind_param("s", $status);
            $query_settodone->execute();
            header("Location: checkout-admin-details.php");
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
    <link rel="stylesheet" href="../admin-main/admin-main.css">
    <link rel="stylesheet" href="checkout-admin-details.css">
    <title>Admin | Checkout Detail - Newbies Gamers</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>

    <!-- started popup message change status -->
    <div class="popup" id="done-checkout-confirmation">
        <img src="../images/question-mark.png" alt="">
        <h2>Done Checkout Confirmation</h2>
        <p>Are you sure that you want to set this checkout status to done? This action cannot be undone</p>
        <button type="button" onclick="<?php if (isset($_GET['checkout_id'])) { ?>
            SetCheckoutID(<?php echo $_GET['checkout_id']; ?>);" <?php } ?>>YES</button>
        <button type="button" onclick="CloseDoneCheckoutPopUp()">NO</button>
    </div>

    <!-- started popup message logout -->
    <div class="popup" id="logout-confirmation">
        <img src="../images/question-mark.png" alt="">
        <h2>Log Out Confirmation</h2>
        <p>Are you sure that you want to logout?</p>
        <button type="button" onclick="GoToLogIn()">YES</button>
        <button type="button" onclick="CloseLogOutPopUp()">NO</button>
    </div>


    <!-- started popup message checkout already done -->
    <div class="popup" id="checkout-error-alert">
        <img src="../images/info.png" alt="">
        <h2>Checkout Cannot Be Done</h2>
        <?php if (isset($_GET['checkout-error'])) { ?>
            <p>Checkout cannot be done. The product "<?php echo $_GET['product-name']; ?>" requires quantity of <?php echo $_GET['quantity']; ?> while only <?php echo $_GET['inventory']; ?> are present in stock!</p>
        <?php } ?>
        <button type="button" onclick="CloseCheckoutDoneAlert();">OK</button>
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
                Checkout Detail
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
                        <h1><?php echo $_GET['checkout_id']; ?></h1>
                        <span>Checkout No.</span>
                    </div>
                    <div>
                        <span class="las la-list-ol"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h2 id="checkout_status"><?php echo $row_get_checkout_status['status'] ?></h2>
                        <span>Status</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_product_quantities['total_product_quantities'] ?></h1>
                        <span>Total Products Quantities</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$<?php echo $row_total_profit['total_profit'] ?></h1>
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
                                        <h3 class="form-container-part-title">Personal Information</h3>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="text" name="first_name" id="first_name" value="<?php if (isset($row_checkout)) {
                                                                                                            echo $row_checkout['first_name'];
                                                                                                        } ?>" readonly class="is-valid">
                                            <label for="first_name">First Name</label>
                                        </div>

                                        <div class="input-container">

                                            <input type="text" name="last_name" id="last_name" value="<?php if (isset($row_checkout)) {
                                                                                                            echo $row_checkout['last_name'];
                                                                                                        } ?>" readonly class="is-valid">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="email" name="email" id="email" value="<?php if (isset($row_checkout)) {
                                                                                                    echo $row_checkout['email'];
                                                                                                } ?>" readonly class="is-valid">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="input-container">

                                            <input type="tel" name="phone_number" id="phone_number" value="<?php if (isset($row_checkout)) {
                                                                                                                echo $row_checkout['phone_number'];
                                                                                                            } ?>" readonly class="is-valid">
                                            <label for="phone_number">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-container-part">
                                    <div>
                                        <h3 class="form-container-part-title">Shipping Details</h3>
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

                                            <input type="text" name="shipping_country" id="shipping_country" value="<?php if (isset($row_checkout)) {
                                                                                                                        echo $row_checkout['shipping_country'];
                                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="shipping_country">Country</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container" style="width: 100%;">

                                            <input type="text" name="shipping_location" id="shipping_location" value="<?php if (isset($row_checkout)) {
                                                                                                                            echo $row_checkout['shipping_location'];
                                                                                                                        } ?>" readonly class="is-valid">
                                            <label for="shipping_location">Location (Town / City, Street, Home Address)</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">

                                            <input type="text" name="shipping_company" id="shipping_company" value="<?php if (isset($row_checkout)) {
                                                                                                                        echo $row_checkout['shipping_company'];
                                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="shipping_company">Company Name (if any)</label>
                                        </div>
                                        <div class="input-container">

                                            <input type="number" name="postcode" id="postcode" value="<?php if (isset($row_checkout)) {
                                                                                                            echo $row_checkout['postcode'];
                                                                                                        } ?>" readonly class="is-valid">
                                            <label for="postcode">Postcode / ZIP</label>
                                        </div>
                                    </div>
                                    <div class="form-container-part-inputs">
                                        <div class="input-container" style="width: 100%;">
                                            <input type="text" name="order_notes" id="order-notes" value="<?php if (isset($row_checkout)) {
                                                                                                                echo $row_checkout['order_notes'];
                                                                                                            } ?>" readonly class="is-valid">
                                            <label for="order_notes">Order Notes (Special notes related to the delivery,
                                                optional)</label>
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
                        <th>Inventory</th>
                        <th>Total Price</th>
                    </tr>
                    <?php
                    while ($row_get_checkout_products = $results_get_checkout_products->fetch_assoc()) {
                        $stmt_get_product = $connection->prepare("SELECT name, unit_price, inventory FROM products WHERE product_id = '" . $row_get_checkout_products["product_id"] . "' ");
                        $stmt_get_product->execute();
                        $results_get_product = $stmt_get_product->get_result();
                        $row_get_product = $results_get_product->fetch_assoc();
                        checkout_products_connection($row_get_product['name'], $row_get_checkout_products['quantity'], $row_get_product['inventory'], $row_get_checkout_products['total_price']);
                    }
                    ?>
                </table>
                <table id="order-totals">
                    <tr>
                        <th>Total Cost</th>
                        <td><?php echo $row_checkout['total_cost']; ?>$</td>
                    </tr>
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
            </div>
            <div class="checkout-details-buttons">
                <button class="btn_done_work_checkout" id="SetStatusCheckoutButton" onclick="window.location.href='checkout-admin-details.php?checkout_id=<?php echo $_GET['checkout_id']; ?>&change-status=1';">
                    <span class="las la-check"></span> Set Checkout To Done</button>

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
<script src="checkout-admin-details.js"></script>

</html>