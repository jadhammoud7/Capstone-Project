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


//sum of all customers
$query_total_customers_in_checkouts = "SELECT DISTINCT customer_id FROM checkouts";
$stmt_total_customers_in_checkouts = $connection->prepare($query_total_customers_in_checkouts);
$stmt_total_customers_in_checkouts->execute();
$results_total_customers_in_checkouts = $stmt_total_customers_in_checkouts->get_result();

//count of all ordered products
$query_total_ordered_products = "SELECT DISTINCT product_id  FROM checkouts_customers_products";
$stmt_total_ordered_products = $connection->prepare($query_total_ordered_products);
$stmt_total_ordered_products->execute();
$results_total_ordered_products = $stmt_total_ordered_products->get_result();

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


//get all checkouts
require_once("../php/admin_page_php.php");
$query_checkouts = "SELECT * FROM checkouts";
$stmt_checkouts = $connection->prepare($query_checkouts);
$stmt_checkouts->execute();
$results_checkouts = $stmt_checkouts->get_result();

//get count of checkouts pending
$status = "Pending";
$query_get_pending_checkouts = "SELECT COUNT(*) as total_pending_checkouts FROM checkouts WHERE status=?";
$stmt_get_pending_checkouts = $connection->prepare($query_get_pending_checkouts);
$stmt_get_pending_checkouts->bind_param("s", $status);
$stmt_get_pending_checkouts->execute();
$results_get_pending_checkouts = $stmt_get_pending_checkouts->get_result();
$row_get_pending_checkouts = $results_get_pending_checkouts->fetch_assoc();

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
                header("Location: checkouts-admin.php?checkout-error=true&product-name=$product_name&quantity=$product_quantity&inventory=$product_inventory");
            }
        }
        //if all products were found in stock, so checkout can be done successfully
        if ($products_found_in_stock == true) {

            //check all products in checkout to see if there is enough inventory
            $stmt_check_checkout_products = $connection->prepare("SELECT product_id, quantity FROM checkouts_customers_products WHERE checkout_id = '" . $checkoutID . "'");
            $stmt_check_checkout_products->execute();
            $results_check_checkout_products = $stmt_check_checkout_products->get_result();
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
            header("Location: checkouts-admin.php");
        }
    }
}
//sum checkouts depending on privces
$query_condition_1 = "SELECT COUNT(total_price_including_tax) as total_price_including_tax FROM checkouts WHERE total_price_including_tax BETWEEN 0.0 AND 100.0";
$stmt_condition_1 = $connection->prepare($query_condition_1);
$stmt_condition_1->execute();
$results_condition_1 = $stmt_condition_1->get_result();
$row_condition_1 = $results_condition_1->fetch_assoc();

$query_condition_2 = "SELECT COUNT(total_price_including_tax) as total_price_including_tax FROM checkouts WHERE total_price_including_tax BETWEEN 101.0 AND 300.0";
$stmt_condition_2 = $connection->prepare($query_condition_2);
$stmt_condition_2->execute();
$results_condition_2 = $stmt_condition_2->get_result();
$row_condition_2 = $results_condition_2->fetch_assoc();

$query_condition_3 = "SELECT COUNT(total_price_including_tax) as total_price_including_tax FROM checkouts WHERE total_price_including_tax BETWEEN 301.0 AND 1000.0";
$stmt_condition_3 = $connection->prepare($query_condition_3);
$stmt_condition_3->execute();
$results_condition_3 = $stmt_condition_3->get_result();
$row_condition_3 = $results_condition_3->fetch_assoc();

$query_condition_4 = "SELECT COUNT(total_price_including_tax) as total_price_including_tax FROM checkouts WHERE total_price_including_tax >1001.0";
$stmt_condition_4 = $connection->prepare($query_condition_4);
$stmt_condition_4->execute();
$results_condition_4 = $stmt_condition_4->get_result();
$row_condition_4 = $results_condition_4->fetch_assoc();

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
    <link rel="stylesheet" href="../checkouts-admin/checkouts-admin.css">

    <title>Admin | Checkouts - Newbies Gamers</title>
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

    <!-- started popup message change status -->
    <div class="popup" id="done-checkout-confirmation">
        <img src="../images/question-mark.png" alt="">
        <h2>Done Checkout Confirmation</h2>
        <p>Are you sure that you want to set this checkout status to done? This action cannot be undone</p>
        <button type="button" onclick="<?php if (isset($_GET['checkout-id'])) { ?>
            SetCheckoutID(<?php echo $_GET['checkout-id']; ?>);" <?php } ?>>YES</button>
        <button type="button" onclick="CloseDoneCheckoutPopUp()">NO</button>
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
                Checkouts List
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
                <div class="card-single" title="This is the number of customers who have ordered checkouts">
                    <div>
                        <h1><?php echo $results_total_customers_in_checkouts->num_rows; ?></h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the number of different products that customers have ordered in their checkouts">
                    <div>
                        <h1><?php echo $results_total_ordered_products->num_rows; ?></h1>
                        <span>Ordered Products</span>
                    </div>
                    <div>
                        <span class="las la-box"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total number of checkouts that have been ordered by customers">
                    <div>
                        <h1><?php echo $row_total_checkouts['total_checkout']; ?></h1>
                        <span>Chekouts</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$<?php echo $row_total_profit['total_profit'] ?></h1>
                        <span>Total Checkouts Prices</span>
                    </div>
                    <div>
                        <span class="las la-wallet"></span>
                    </div>
                </div>
            </div>
            <div>
                <canvas id="myChart" style="width: 100%; max-width: 600px; float:left"></canvas>
                <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
            </div>
            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Checkouts List</h3>
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
                                <table width="100%" id="checkouts_table">
                                    <thead>
                                        <tr>
                                            <td id="customer-name-column" title="Sort Customer Name by descending">Customer Name</td>
                                            <td id="email-column" title="Sort Email by descending">Email</td>
                                            <td id="phone-number-column" title="Sort Phone Number by descending">Phone Number</td>
                                            <td id="total-price-column" title="Sort Total Price by descending">Total Price</td>
                                            <td id="total-price-inc-tax-column" title="Sort Total Price Inc. Tax by descending">Total Price Inc. Tax</td>
                                            <td id="checkout-date-column" title="Sort Date by descending">Date</td>
                                            <td id="status-column" title="Sort Status by descending">Status</td>
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
        </main>
    </div>


    <h1 class="sales_store">Add Customers Purchaces At Store</h1>
    <div class="wrapper">
        <div id="survey_options">
            <input type="text" name="survey_options" class="survey_options" size="50" placeholder="customer name..">
            <input type="text" name="survey_options" class="survey_options" size="50" placeholder="username if any..">
            <input type="text" name="survey_options" class="survey_options" size="50" placeholder="email..">
            <input type="text" name="survey_options[]" class="survey_options" size="50" placeholder="product name..">
            <input type="number" name="survey_options[]" class="survey_options" size="50" placeholder="quantity...">
        </div>
        <div class="controls">
            <a href="#survey_options" id="add_more_fields"><i class="fa fa-plus"></i>Add More Products</a>
            <a href="#survey_options" id="remove_fields"><i class="fa fa-plus"></i>Remove Products</a>
        </div>
        <center>
            <input class="btn btn-success" type="submit" name="save" id="save" value="Save Data">
        </center>
        <?php
        
        ?>
    </div>


    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->

</body>
<script src="../checkouts-admin/checkouts-admin.js"></script>
<script src="../admin-main/admin-main.js"></script>
<script>
    var xValues = ["Pending Checkouts", "Done Checkouts"];
    var yValues = [<?php echo $row_get_pending_checkouts['total_pending_checkouts']; ?>, <?php echo $row_get_done_checkouts['total_done_checkouts']; ?>]
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
                text: "Distribution of All Checkouts By Status"
            }
        }
    });
    //start of t=second chart
    const prices_count = [];
    <?php
    if (isset($results_condition_1)) {
    ?>
        prices_count.push("<?php
                            echo $row_condition_1['total_price_including_tax'];
                            ?>");
    <?php }
    ?>;
    <?php
    if (isset($results_condition_2)) {
    ?>
        prices_count.push("<?php
                            echo $row_condition_2['total_price_including_tax'];
                            ?>");
    <?php }
    ?>;
    <?php
    if (isset($results_condition_3)) {
    ?>
        prices_count.push("<?php
                            echo $row_condition_3['total_price_including_tax'];
                            ?>");
    <?php }
    ?>;
    <?php
    if (isset($results_condition_4)) {
    ?>
        prices_count.push("<?php
                            echo $row_condition_4['total_price_including_tax'];
                            ?>");
    <?php }
    ?>;

    var xValues = ["Between 0$ and 100$", "Between 100$ and 300$", "Between 300$ and 1000$", "Greater than 1000$"];
    console.log(xValues);
    var yValues = prices_count;
    console.log(yValues);
    var barColors = ["red", "green", "blue", "orange"];

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
                text: "Prices"
            }
        }
    });
</script>

</html>