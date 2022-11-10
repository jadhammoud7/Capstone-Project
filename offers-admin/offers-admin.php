<?php

session_start();
include("../php/connection.php");
require('../php/admin_page_php.php');

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


//sum of all customers
$query_total_customers = "SELECT COUNT(customer_id) as count FROM customers";
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

//form of adding new product offer
$product_name = "";
$product_old_price = 0;
$product_new_price = 0;
$offer_percentage = "";
$offer_begin_date = "";
$offer_end_date = "";

if (isset($_POST["product_name"])) {
    $product_name = $_POST["product_name"];
}

if (isset($_POST["product_old_price"])) {
    $product_old_price = $_POST["product_old_price"];
}

if (isset($_POST["product_new_price"])) {
    $product_new_price = $_POST["product_new_price"];
}

if (isset($_POST["offer_percentage"])) {
    $offer_percentage = $_POST["offer_percentage"];
}

if (isset($_POST["offer_begin_date"])) {
    $offer_begin_date = $_POST["offer_begin_date"];
}

if (isset($_POST["offer_end_date"])) {
    $offer_end_date = $_POST["offer_end_date"];
}

if ($product_name != "" && $product_old_price != 0 && $product_new_price != 0 && $offer_percentage != 0 && $offer_begin_date != "" && $offer_end_date != "") {
    //set timezone to beirut
    date_default_timezone_set('Asia/Beirut');
    $modified_on = date('Y-m-d h:i:s');
    $modified_by = $row['first_name'] . ' ' . $row['last_name'];

    $stmt_select_product_id = $connection->prepare("SELECT product_id FROM products WHERE name = '" . $product_name . "'");
    $stmt_select_product_id->execute();
    $result_product_id = $stmt_select_product_id->get_result();
    $row_product_id = $result_product_id->fetch_assoc();

    $product_id = $row_product_id['product_id'];

    //insert into table products offers
    $stmt_add_new_product_offer = $connection->prepare("INSERT INTO products_offers(product_id, old_price, new_price, offer_percentage, offer_begin_date, offer_end_date, last_modified_by, last_modified_on) VALUES (?,?,?,?,?,?,?,?)");
    $stmt_add_new_product_offer->bind_param("iiidssss", $product_id, $product_old_price, $product_new_price, $offer_percentage, $offer_begin_date, $offer_end_date, $modified_by, $modified_on);
    $stmt_add_new_product_offer->execute();
    $stmt_add_new_product_offer->close();

    //insert into table history products offers
    $stmt_add_product_offer_history = $connection->prepare("INSERT INTO history_product_offers(product_id, old_price, new_price, offer_percentage, offer_begin_date, offer_end_date, last_modified_by, last_modified_on) VALUES (?,?,?,?,?,?,?,?)");
    $stmt_add_product_offer_history->bind_param("iiiiddss", $product_id, $product_old_price, $product_new_price, $offer_percentage, $offer_begin_date, $offer_end_date, $modified_by, $modified_on);
    $stmt_add_product_offer_history->execute();
    $stmt_add_product_offer_history->close();

    header("Location: offers-admin.php?product_offer_added=1");
}

//remove product offer
if (isset($_GET['getProducttoRemove'])) {
    $product_id = $_GET['getProducttoRemove'];
    $stmt_delete_product_offer = $connection->prepare("DELETE FROM products_offers WHERE product_id = '" . $product_id . "'");
    $stmt_delete_product_offer->execute();
    header("Location: offers-admin.php?product_offer_deleted=1");
}

//get products in ascending 
$query_nbofsales = "SELECT name,inventory,sales_number FROM products ORDER BY sales_number ASC;";
$stmt_nbofsales = $connection->prepare($query_nbofsales);
$stmt_nbofsales->execute();
$results_nbofsales = $stmt_nbofsales->get_result();


//get top products 
$query_top_products = "SELECT name,sales_number FROM products ORDER BY sales_number DESC LIMIT 5;";
$stmt_top_products = $connection->prepare($query_top_products);
$stmt_top_products->execute();
$results_top_products = $stmt_top_products->get_result();

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
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <link rel="stylesheet" href="offers-admin.css">
    <title>Admin | Offers - Newbies Gamers</title>
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

    <!-- started popup message logout -->
    <div class="popup" id="product-offer-added-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Offer Added Confirmation</h2>
        <p>A new product offer was added successfully</p>
        <button type="button" onclick="CloseProductOfferAddedPopUp()">OK</button>
    </div>

    <!-- started popup product offer deleted -->
    <div class="popup" id="product-offer-deleted-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Offer Was Removed</h2>
        <p>The offer on the product was removed successfully</p>
        <button type="button" onclick="CloseProductOfferDeletedPopUp()">OK</button>
    </div>

    <!-- started popup message remove product -->
    <div class="popup" id="remove-product-offer-confirmation">
        <img src="../images/question-mark.png" alt="remove confirmation">
        <h2>Delete Confirmation</h2>
        <p id="remove-product-offer-confirmation-text"></p>
        <button type="button" onclick="DeleteProductOffer()">YES</button>
        <button type="button" onclick="CloseRemoveProductOfferDeletePopUp()">NO</button>
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
                <li>
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
                Offers List
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

            <!-- list of all products offers -->

            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">

                        <div class="card-header">
                            <h3>Products Offers List</h3>
                        </div>

                        <div id="myPlot" style="width:100%;max-width:700px;"></div>
                        <div id="myPlot2" style="width:100%;max-width:700px;"></div>

                        <div class="card-single add_product">
                            <button class="add_product_offer" id="add_product_offer" onclick="OpenAddProductOffer()" title="Add a new product offer">
                                <span class="las la-plus"></span>
                                Add Product Offer
                            </button>
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
                                    <input type="text" id="SearchInput" onkeyup="FilterTable()" placeholder="Search in table Products Offers...">
                                </div>
                                <table width="100%" id="products_offers_table">
                                    <thead>
                                        <tr>
                                            <td id="product-name-column" title="Sort Product Name by descending">Product Name</td>
                                            <td id="old-price-column" title="Sort Old Price by descending">Old Price</td>
                                            <td id="new-price-column" title="Sort New Price by descending">New Price</td>
                                            <td id="offer-percentage-column" title="Sort Offer Percentage by descending">Offer Percentage</td>
                                            <td id="offer-begin-date-column" title="Sort Offer Begin Date by descending">Offer Begin Date</td>
                                            <td id="offer-end-date-column" title="Sort Offer End Date by descending">Offer End Date</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Last Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Last Modified On</td>
                                            <td>Remove</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt_select_all_products_offers = $connection->prepare("SELECT * FROM products_offers");
                                        $stmt_select_all_products_offers->execute();
                                        $result_products_offers = $stmt_select_all_products_offers->get_result();
                                        while ($row_products_offers = $result_products_offers->fetch_assoc()) {
                                            $stmt_select_product_name = $connection->prepare("SELECT name FROM products WHERE product_id = '" . $row_products_offers['product_id'] . "'");
                                            $stmt_select_product_name->execute();
                                            $result_product_name = $stmt_select_product_name->get_result();
                                            $row_product_name = $result_product_name->fetch_assoc();

                                            get_all_products_offers(
                                                $row_products_offers['product_id'],
                                                $row_product_name['name'],
                                                $row_products_offers['old_price'],
                                                $row_products_offers['new_price'],
                                                $row_products_offers['offer_percentage'],
                                                $row_products_offers['offer_begin_date'],
                                                $row_products_offers['offer_end_date'],
                                                $row_products_offers['last_modified_by'],
                                                $row_products_offers['last_modified_on']
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

            <!-- adding new product offer form -->
            <div id="add_product_offer_form" class="modal">
                <span onclick="CloseAddProductOffer()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content" action="offers-admin.php" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <h1 class="title">Add New Product Offer</h1>
                        <br>
                        <p class="title">Please fill in this form to add a new product offer</p>
                        <br>

                        <label for="product_name">
                            <b>Product Name</b>
                        </label>
                        <br>
                        <select name="product_name" id="product_name" onchange="SetOldPrice()">
                            <?php
                            $stmt_select_products_names = $connection->prepare("SELECT name FROM products");
                            $stmt_select_products_names->execute();
                            $results_products_names = $stmt_select_products_names->get_result();
                            while ($row_products_names = $results_products_names->fetch_assoc()) {
                                get_all_products_names_for_add_product_offer_form($row_products_names['name']);
                            }
                            ?>
                        </select>
                        <br><br>

                        <label for="product_old_price">
                            <b>Product Old Price</b>
                        </label>
                        <br>
                        <input style="height: 35px;" type="number" name="product_old_price" id="product_old_price" value="">
                        <br><br>

                        <label for="product_new_price">
                            <b>Product New Price</b>
                        </label>
                        <br>
                        <input type="number" style="height: 35px;" name="product_new_price" id="product_new_price" value="" onchange="SetOfferPercentage()" required>

                        <br><br>

                        <label for="offer_percentage">
                            <b>Offer Percentage</b>
                        </label>
                        <br>
                        <input type="number" style="height: 35px;" name="offer_percentage" id="offer_percentage" value="" readonly class="is-valid">

                        <label for="offer_begin_date">
                            <b>Offer Begin Date</b>
                        </label>
                        <input type="date" title="Enter offer's begin date" placeholder="Enter offer's begin date" name="offer_begin_date" id="offer_begin_date" value="" required>
                        <br><br>
                        <label for="offer_end_date">
                            <b>Offer End Date</b>
                        </label>
                        <input type="date" title="Enter offer's end date" placeholder="Enter offer's end date" name="offer_end_date" id="offer_end_date" value="" required>
                        <br>
                        <div class="clearfix">
                            <button type="submit" class="addproductofferbtn" title="Add new product offer">
                                <strong>Add Product Offer</strong>
                            </button>
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

<script src="offers-admin.js"></script>
<script src="../admin-main/admin-main.js"></script>
<script>
    //fill old price
    function SetOldPrice() {
        const array_product_prices = [];

        <?php
        $stmt_get_product_price = $connection->prepare("SELECT price FROM products");
        $stmt_get_product_price->execute();
        $result_product_price = $stmt_get_product_price->get_result();
        while ($row_product_price = $result_product_price->fetch_assoc()) { ?>
            array_product_prices.push(<?php echo $row_product_price['price']; ?>);
        <?php }
        ?>
        var new_price = array_product_prices[document.getElementById('product_name').selectedIndex];
        document.getElementById('product_old_price').value = new_price;
    }
</script>

</html>