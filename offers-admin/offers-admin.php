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

//form of adding new product offer
$product_name = "";
$product_old_price = 0;
$product_new_price = 0;
$offer_percentage = "";
$offer_begin_date = "";
$offer_end_date = "";

if (isset($_POST["product_name"])) {
    $product_name = $_POST["product_name"];

    $stmt_select_product_id = $connection->prepare("SELECT product_id FROM products WHERE name = '" . $product_name . "'");
    $stmt_select_product_id->execute();
    $result_product_id = $stmt_select_product_id->get_result();
    $row_product_id = $result_product_id->fetch_assoc();

    $product_id = $row_product_id['product_id'];

    $stmt_select_product_from_offers = $connection->prepare("SELECT * FROM products_offers WHERE product_id = '" . $product_id . "'");
    $stmt_select_product_from_offers->execute();
    $result_product_offers = $stmt_select_product_from_offers->get_result();
    $row_product_offers = $result_product_offers->fetch_assoc();

    if (!empty($row_product_offers)) {
        $_SESSION['product_name_error'] = "Product Name already has an offer!";
        header("Location: offers-admin.php?open_add_product_offer=true");
        exit("Product Name Error");
    }
}

if (isset($_POST["product_old_price"])) {
    $product_old_price = $_POST["product_old_price"];
}

if (isset($_POST["product_new_price"])) {
    $product_new_price = $_POST["product_new_price"];

    if ($product_new_price >= $product_old_price) {
        $_SESSION['new_price_error'] = "New price should be less than the old price";
        header("Location: offers-admin.php?open_add_product_offer=true");
        exit("New Price Error");
    }
}

if (isset($_POST["offer_percentage"])) {
    $offer_percentage = $_POST["offer_percentage"];
}

if (isset($_POST["offer_begin_date"])) {
    $offer_begin_date = $_POST["offer_begin_date"];
}

if (isset($_POST["offer_end_date"])) {
    $offer_end_date = $_POST["offer_end_date"];

    if ($offer_end_date < $offer_begin_date) {
        $_SESSION['end_date_error'] = "Offer end date should be after begin date";
        header("Location: offers-admin.php?open_add_product_offer=true");
        exit("End Date Error");
    }
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
                        <h1><?php
                            $stmt_select_total_products = $connection->prepare("SELECT COUNT(*) as total_products FROM products");
                            $stmt_select_total_products->execute();
                            $result_total_products = $stmt_select_total_products->get_result();
                            $row_total_products = $result_total_products->fetch_assoc();
                            echo $row_total_products['total_products'];
                            ?></h1>
                        <span>Total Products</span>
                    </div>
                    <div>
                        <span class="las la-boxes"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php
                            $stmt_select_total_products_offers = $connection->prepare("SELECT COUNT(*) as total_products_offers FROM products_offers");
                            $stmt_select_total_products_offers->execute();
                            $result_total_products_offers = $stmt_select_total_products_offers->get_result();
                            $row_total_products_offers = $result_total_products_offers->fetch_assoc();
                            echo $row_total_products_offers['total_products_offers'];
                            ?></h1>
                        <span>Total Products On Offers</span>
                    </div>
                    <div>
                        <span class="las la-tags"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php
                            $stmt_select_total_offer_percentage = $connection->prepare("SELECT SUM(offer_percentage) as total_offer_percentage FROM products_offers");
                            $stmt_select_total_offer_percentage->execute();
                            $result_total_offer_percentage = $stmt_select_total_offer_percentage->get_result();
                            $row_total_offer_percentage = $result_total_offer_percentage->fetch_assoc();
                            echo $row_total_offer_percentage['total_offer_percentage'];
                            ?></h1>
                        <span>Total Offers Percentage</span>
                    </div>
                    <div>
                        <span class="las la-percentage"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$<?php
                                $total_sales_during_offer = 0;
                                $stmt_select_products_offers = $connection->prepare("SELECT product_id, new_price, offer_begin_date, offer_end_date FROM products_offers");
                                $stmt_select_products_offers->execute();
                                $result_products_offers = $stmt_select_products_offers->get_result();
                                while ($row_products_offers = $result_products_offers->fetch_assoc()) {
                                    $stmt_select_sales_during_offer = $connection->prepare("SELECT SUM(sales_change) as total_sales FROM history_product_sales WHERE product_id = ? AND modified_on BETWEEN ? AND ?");
                                    $stmt_select_sales_during_offer->bind_param("idd", $row_products_offers['product_id'], $row_products_offers['offer_begin_date'], $row_products_offers['offer_end_date']);
                                    $stmt_select_sales_during_offer->execute();
                                    $result_sales_during_offer = $stmt_select_sales_during_offer->get_result();
                                    $row_sales_during_offer = $result_sales_during_offer->fetch_assoc();
                                    $total_sales_during_offer = $total_sales_during_offer + $row_sales_during_offer['total_sales'] * $row_products_offers['new_price'];
                                }
                                echo $total_sales_during_offer;
                                ?></h1>
                        <span>Total Offers Profits</span>
                    </div>
                    <div>
                        <span class="las la-wallet"></span>
                    </div>
                </div>
            </div>

            <!-- list of all products of recommended offers -->

            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">

                        <div class="card-header">
                            <h3>Recommended Products Offers List</h3>
                        </div>

                        <div class="card-header">
                            <h4>Products of Lowest Sales / Inventory Ratio</h4>
                        </div>

                        <div>
                            <canvas id="myChart" style="width:100%;max-width:600px;float:left"></canvas>
                            <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
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
                                    <input type="text" id="SearchInput2" onkeyup="FilterTableRecommendation()" placeholder="Search in table Products Offers Recommendations...">
                                </div>
                                <table width="100%" id="products_recommendation_offers_table">
                                    <thead>
                                        <tr>
                                            <td id="product-name-column" title="Product Name">Product Name</td>
                                            <td id="product-price-column" title="Product Price">Product Price</td>
                                            <td id="product-inventory-history-column" title="The all time inventory of the products">Inventory History</td>
                                            <td id="product-sales-history-column" title="The all time sales number of the product">Sales History</td>
                                            <td id="product-inventory-sales-ratio-column" title="The ratio of the sales history to the inventory history">Inventory Sales Ratio</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt_select_products_inventory_sales = $connection->prepare("SELECT * FROM products_inventory_sales ORDER BY inventory_sales_ratio DESC LIMIT 5");
                                        $stmt_select_products_inventory_sales->execute();
                                        $result_product_inventory_sales = $stmt_select_products_inventory_sales->get_result();

                                        while ($row_product_inventory_sales = $result_product_inventory_sales->fetch_assoc()) {
                                            $stmt_select_product = $connection->prepare("SELECT name, price FROM products WHERE product_id = '" . $row_product_inventory_sales['product_id'] . "'");
                                            $stmt_select_product->execute();
                                            $result_product = $stmt_select_product->get_result();
                                            $row_product = $result_product->fetch_assoc();

                                            get_all_products_offers_recommendations(
                                                $row_product_inventory_sales['product_id'],
                                                $row_product['name'],
                                                $row_product['price'],
                                                $row_product_inventory_sales['inventory_history'],
                                                $row_product_inventory_sales['sales_history'],
                                                $row_product_inventory_sales['inventory_sales_ratio']
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


            <!-- list of all products offers -->

            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">

                        <div class="card-header">
                            <h3>Products Offers List</h3>
                        </div>

                        <div>
                            <canvas id="myChart3" style="width:100%;max-width:600px;"></canvas>
                        </div>

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
                        <p class="error" id="product_name_error">
                            <?php if (isset($_SESSION['product_name_error'])) {
                                echo "<script>document.getElementById('product_name_error').style.display='block';</script>";
                                echo $_SESSION['product_name_error'];
                                unset($_SESSION['product_name_error']);
                            } ?>
                        </p>

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

                        <p class="error" id="new_price_error">
                            <?php if (isset($_SESSION['new_price_error'])) {
                                echo "<script>document.getElementById('new_price_error').style.display='block';</script>";
                                echo $_SESSION['new_price_error'];
                                unset($_SESSION['new_price_error']);
                            } ?>
                        </p>
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

                        <p class="error" id="end_date_error">
                            <?php if (isset($_SESSION['end_date_error'])) {
                                echo "<script>document.getElementById('end_date_error').style.display='block';</script>";
                                echo $_SESSION['end_date_error'];
                                unset($_SESSION['end_date_error']);
                            } ?>
                        </p>
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

    //for inventory history of products in products inventory sales table
    var array_products = [];
    var array_products_inventories = [];
    <?php
    $stmt_select_product_inventory_sales = $connection->prepare("SELECT product_id, inventory_history FROM products_inventory_sales ORDER BY inventory_sales_ratio DESC LIMIT 5");
    $stmt_select_product_inventory_sales->execute();
    $result_product_inventory_sales = $stmt_select_product_inventory_sales->get_result();

    while ($row_product_inventory_sales = $result_product_inventory_sales->fetch_assoc()) {
        //get product name
        $stmt_select_product_name = $connection->prepare("SELECT name FROM products WHERE product_id = '" . $row_product_inventory_sales['product_id'] . "'");
        $stmt_select_product_name->execute();
        $result_product_name = $stmt_select_product_name->get_result();
        $row_product_name = $result_product_name->fetch_assoc();
    ?>
        array_products.push("<?php
                                echo $row_product_name['name'];
                                ?>");

        array_products_inventories.push("<?php
                                            echo $row_product_inventory_sales['inventory_history'];
                                            ?>");
    <?php
    }
    ?>;
    var xValues = array_products;
    var yValues = array_products_inventories;
    var random_colors = [];

    var size = array_products.length;

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
                text: "Total Inventory History For Products"
            }
        }
    });

    //for sales history of products with less inventory sales ratio
    var array_products2 = [];
    var array_products_sales = [];
    <?php
    $stmt_select_product_inventory_sales = $connection->prepare("SELECT product_id, sales_history FROM products_inventory_sales ORDER BY inventory_sales_ratio DESC LIMIT 5");
    $stmt_select_product_inventory_sales->execute();
    $result_product_inventory_sales = $stmt_select_product_inventory_sales->get_result();

    while ($row_product_inventory_sales = $result_product_inventory_sales->fetch_assoc()) {
        //get product name
        $stmt_select_product_name = $connection->prepare("SELECT name FROM products WHERE product_id = '" . $row_product_inventory_sales['product_id'] . "'");
        $stmt_select_product_name->execute();
        $result_product_name = $stmt_select_product_name->get_result();
        $row_product_name = $result_product_name->fetch_assoc();
    ?>
        array_products2.push("<?php
                                echo $row_product_name['name'];
                                ?>");
        array_products_sales.push("<?php
                                    echo $row_product_inventory_sales['sales_history'];
                                    ?>");
    <?php
    }
    ?>;
    var xValues2 = array_products2;
    var yValues2 = array_products_sales;
    var random_colors2 = [];

    var size2 = array_products2.length;

    function getNewColor2(start) {
        for (var i = start; i < size; i++) {
            var random2 = "#" + Math.floor(Math.random() * (255 + 1));
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
        type: "bar",
        data: {
            labels: xValues2,
            datasets: [{
                backgroundColor: barColors2,
                data: yValues2
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Total Inventory Sales For Products"
            }
        }
    });

    var array_products3 = [];
    var array_products_sales_offers = [];

    <?php
    //select all products ids of offers
    $stmt_select_all_products_offers = $connection->prepare("SELECT product_id, offer_begin_date, offer_end_date FROM products_offers");
    $stmt_select_all_products_offers->execute();
    $result_products_offers = $stmt_select_all_products_offers->get_result();

    while ($row_products_offers = $result_products_offers->fetch_assoc()) {
        //get product name
        $stmt_select_product_name = $connection->prepare("SELECT name FROM products WHERE product_id = ?");
        $stmt_select_product_name->bind_param("i", $row_products_offers['product_id']);
        $stmt_select_product_name->execute();
        $result_product_name = $stmt_select_product_name->get_result();
        $row_product_name = $result_product_name->fetch_assoc();
    ?>
        array_products3.push("<?php
                                echo $row_product_name['name'];
                                ?>");

        <?php
        $stmt_select_product_sales_during_offer = $connection->prepare("SELECT SUM(sales_change) as total_sales FROM history_product_sales WHERE product_id = ? AND modified_on BETWEEN ? AND ?");
        $stmt_select_product_sales_during_offer->bind_param("idd", $row_products_offers['product_id'], $row_products_offers['offer_begin_date'], $row_products_offers['offer_end_date']);
        $stmt_select_product_sales_during_offer->execute();
        $result_product_sales = $stmt_select_product_sales_during_offer->get_result();
        $row_product_sales = $result_product_sales->fetch_assoc();
        ?>

        array_products_sales_offers.push("<?php
                                            echo $row_product_sales['total_sales'];
                                            ?>");
    <?php
    }
    ?>;

    var xValues3 = array_products3;
    var yValues3 = array_products_sales_offers;
    var random_colors3 = [];

    var size3 = array_products3.length;

    function getNewColor3(start) {
        for (var i = start; i < size; i++) {
            var random3 = "#" + Math.floor(Math.random() * (255 + 1));
            if (random_colors3.values != random3) {
                random_colors3.push(random3);
            } else {
                getNewColor3(i);
            }
        }
    }
    getNewColor3(0);

    var barColors3 = random_colors3;
    new Chart("myChart3", {
        type: "bar",
        data: {
            labels: xValues3,
            datasets: [{
                backgroundColor: barColors3,
                data: yValues3
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Total Sales Number of Products During Offer Time"
            }
        }
    });
</script>

</html>