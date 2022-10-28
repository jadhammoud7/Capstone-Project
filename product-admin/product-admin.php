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


//get all products
require_once("../php/admin_page_php.php");
$query_products = "SELECT * FROM products";
$stmt_products = $connection->prepare($query_products);
$stmt_products->execute();
$results_products = $stmt_products->get_result();

//form of adding new product
$product_name = "";
$product_price = 0;
$product_type = "";
$product_category = "";
$product_description = "";
$product_age = "";
$product_image = "";
$product_inventory = 0;
$product_sales_number = 0;

if (isset($_POST["product_name"])) {
    $product_name = $_POST["product_name"];
}

if (isset($_POST["product_price"])) {
    $product_price = $_POST["product_price"];
}

if (isset($_POST["product_type"])) {
    $product_type = $_POST["product_type"];
}

if (isset($_POST["product_category"])) {
    $product_category = $_POST["product_category"];
}

if (isset($_POST["product_desciption"])) {
    $product_description = $_POST["product_desciption"];
}

if (isset($_POST["product_age"])) {
    $product_age = $_POST["product_age"];
}

if (isset($_POST['product_inventory'])) {
    $product_inventory = $_POST['product_inventory'];
}

if (isset($_POST['product_sales'])) {
    $product_sales_number = $_POST['product_sales'];
}

if ($product_name != "" && $product_price != 0 && $product_type != "" && $product_category != "" && $product_description != "" && $product_age != "" && $product_inventory != 0) {
    //make directory in images/Products that have same name as product
    mkdir('../images/Products/' . $product_name);
    $target_dir = "../images/Products/$product_name/";
    $filename = basename($_FILES['product_image']['name']);
    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $product_image = $filename;
            //set timezone to beirut
            date_default_timezone_set('Asia/Beirut');
            $modified_on = date('Y-m-d h:i:s');
            $modified_by = $row['first_name'] . ' ' . $row['last_name'];

            //insert into table products
            $stmt_add_new_product = $connection->prepare("INSERT INTO products(name, price, type, category, description, age, image, inventory, sales_number, last_modified_by, last_modified_on) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt_add_new_product->bind_param("sisssssiiss", $product_name, $product_price, $product_type, $product_category, $product_description, $product_age, $product_image, $product_inventory, $product_sales_number, $modified_by, $modified_on);
            $stmt_add_new_product->execute();
            $stmt_add_new_product->close();

            //select last product id
            $select_last_product_id = $connection->prepare("SELECT product_id FROM products ORDER BY product_id DESC LIMIT 1");
            $select_last_product_id->execute();
            $result_last_product_id = $select_last_product_id->get_result();
            $row_last_product_id = $result_last_product_id->fetch_assoc();
            $product_id = $row_last_product_id['product_id'];

            //insert into history prices current price
            $price_change = '0';
            $stmt_add_product_price_history = $connection->prepare("INSERT INTO history_product_prices(product_id, price, price_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
            $stmt_add_product_price_history->bind_param("iisss", $product_id, $product_price, $price_change, $modified_by, $modified_on);
            $stmt_add_product_price_history->execute();
            $stmt_add_product_price_history->close();

            //insert into history inventory current inventory
            $inventory_change = '0';
            $stmt_add_product_inventory_history = $connection->prepare("INSERT INTO history_product_inventory(product_id, inventory, inventory_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
            $stmt_add_product_inventory_history->bind_param("iisss", $product_id, $product_inventory, $inventory_change, $modified_by, $modified_on);
            $stmt_add_product_inventory_history->execute();
            $stmt_add_product_inventory_history->close();

            //insert into histoy sales current sales 0
            $sales_change = '0';
            $stmt_add_product_sales_history = $connection->prepare("INSERT INTO history_product_sales(product_id, sales_number, sales_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
            $stmt_add_product_sales_history->bind_param("iisss", $product_id, $product_sales_number, $sales_change, $modified_by, $modified_on);
            $stmt_add_product_sales_history->execute();
            $stmt_add_product_sales_history->close();

            header("Location: product-admin.php?product-added=1");
        }
    }
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

//display history price for chosen product
if (isset($_GET['product_id']) && isset($_GET['price_history'])) {
    $stmt_select_product_prices_history = $connection->prepare("SELECT * FROM history_product_prices WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_product_prices_history->execute();
    $result_history_product_prices = $stmt_select_product_prices_history->get_result();

    $stmt_get_product = $connection->prepare("SELECT * FROM products WHERE product_id = '" . $_GET['product_id'] . "' ");
    $stmt_get_product->execute();
    $result_get_product = $stmt_get_product->get_result();
    $row_get_product = $result_get_product->fetch_assoc();
}

//display history inventory for chosen product
if (isset($_GET['product_id']) && isset($_GET['inventory_history'])) {
    $stmt_select_product_inventory_history = $connection->prepare("SELECT * FROM history_product_inventory WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_product_inventory_history->execute();
    $result_product_history_inventory = $stmt_select_product_inventory_history->get_result();

    $stmt_get_product = $connection->prepare("SELECT * FROM products WHERE product_id = '" . $_GET['product_id'] . "' ");
    $stmt_get_product->execute();
    $result_get_product = $stmt_get_product->get_result();
    $row_get_product = $result_get_product->fetch_assoc();
}

//display history sales for chosen product
if (isset($_GET['product_id']) && isset($_GET['sales_history'])) {
    $stmt_select_product_sales_history = $connection->prepare("SELECT * FROM history_product_sales WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_product_sales_history->execute();
    $result_product_history_sales = $stmt_select_product_sales_history->get_result();

    $stmt_get_product = $connection->prepare("SELECT * FROM products WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_get_product->execute();
    $result_get_product = $stmt_get_product->get_result();
    $row_get_product = $result_get_product->fetch_assoc();
}

//if received input to add new product type
if (isset($_POST['type'])) {
    $type = $_POST['type'];

    //check if this type is found
    $stmt_get_product_type = $connection->prepare("SELECT * FROM product_types WHERE type = '" .  $type . "' ");
    $stmt_get_product_type->execute();
    $result_product_type = $stmt_get_product_type->get_result();
    $row_product_type = $result_product_type->fetch_assoc();

    if (!empty($row_product_type)) {
        $_SESSION['type'] = $type;
        $_SESSION['type_error'] = "This type is already found";
        header("Location: product-admin.php?open_add_type=true");
        die("WRONG product type");
    } else {
        //set timezone to beirut
        date_default_timezone_set('Asia/Beirut');
        $modified_on = date('Y-m-d h:i:s');
        $added_by = $row['first_name'] . ' ' . $row['last_name'];

        $stmt_add_product_type = $connection->prepare("INSERT INTO product_types(type, added_by, modified_on) VALUES (?,?,?)");
        $stmt_add_product_type->bind_param("sss", $type, $added_by, $modified_on);
        $stmt_add_product_type->execute();
        header("Location: product-admin.php?product-type-added=1");
    }
}
//if received input to add new product category
if (isset($_POST['category'])) {
    $category = $_POST['category'];

    //check if this category is found
    $stmt_get_product_category = $connection->prepare("SELECT * FROM product_categories WHERE category = '" . $category . "'");
    $stmt_get_product_category->execute();
    $result_product_category = $stmt_get_product_category->get_result();
    $row_product_category = $result_product_category->fetch_assoc();

    if (!empty($row_product_category)) {
        $_SESSION['category'] = $category;
        $_SESSION['category_error'] = "This category is already found";
        header("Location: product-admin.php?open_add_category=true");
        die("WRONG product category");
    } else {
        //set timezone to beirut
        date_default_timezone_set('Asia/Beirut');
        $modified_on = date('Y-m-d h:i:s');
        $added_by = $row['first_name'] . ' ' . $row['last_name'];

        $stmt_add_product_category = $connection->prepare("INSERT INTO product_categories(category, added_by, modified_on) VALUES (?,?,?)");
        $stmt_add_product_category->bind_param("sss", $category, $added_by, $modified_on);
        $stmt_add_product_category->execute();
        header("Location: product-admin.php?product-category-added=1");
    }
}

//delete category 
if (isset($_GET['getCategorytoRemove'])) {
    //remove category
    $stmt_delete_category = $connection->prepare("DELETE FROM product_categories WHERE category = '" . $_GET['getCategorytoRemove'] . "'");
    $stmt_delete_category->execute();

    //remove all products of this category
    $stmt_delete_products_of_category = $connection->prepare("DELETE FROM products WHERE category = '" . $_GET['getCategorytoRemove'] . "'");
    $stmt_delete_products_of_category->execute();

    header("Location: product-admin.php");
}

//delete type
if (isset($_GET['getTypetoRemove'])) {
    //remove type
    $stmt_delete_type = $connection->prepare("DELETE FROM product_types WHERE type = '" . $_GET['getTypetoRemove'] . "'");
    $stmt_delete_type->execute();

    //remove all products of this category
    $stmt_delete_products_of_type = $connection->prepare("DELETE FROM products WHERE type = '" . $_GET['getTypetoRemove'] . "'");
    $stmt_delete_products_of_type->execute();

    header("Location: product-admin.php");
}

if (isset($_GET['getProducttoRemove'])) {
    //remove product
    $stmt_delete_product = $connection->prepare("DELETE FROM products WHERE product_id = '" . $_GET['getProducttoRemove'] . "'");
    $stmt_delete_product->execute();

    //remove history inventory for product
    $stmt_delete_product_history_inventory = $connection->prepare("DELETE FROM history_product_inventory WHERE product_id = '" . $_GET['getProducttoRemove'] . "'");
    $stmt_delete_product_history_inventory->execute();

    //remove history prices for product
    $stmt_delete_product_history_prices = $connection->prepare("DELETE FROM history_product_prices WHERE product_id = '" . $_GET['getProducttoRemove'] . "'");
    $stmt_delete_product_history_prices->execute();

    //remove history sales for product
    $stmt_delete_product_history_sales = $connection->prepare("DELETE FROM history_product_sales WHERE product_id = '" . $_GET['getProducttoRemove'] . "'");
    $stmt_delete_product_history_sales->execute();

    //remove product in favorites lists
    $stmt_delete_product_favorites = $connection->prepare("DELETE FROM favorites_customer_product WHERE product_id = '" . $_GET['getProducttoRemove'] . "'");
    $stmt_delete_product_favorites->execute();

    header("Location: product-admin.php");
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
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <link rel="stylesheet" href="product-admin.css">
    <title>Admin | Products - Newbies Gamers</title>
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
    <div class="popup" id="product-added-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Added Confirmation</h2>
        <p>A new product was added successfully</p>
        <button type="button" onclick="CloseProductAddedPopUp()">OK</button>
    </div>

    <!-- started popup message logout type added -->
    <div class="popup" id="product-type-added-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Type Added Confirmation</h2>
        <p>A new product type was added successfully</p>
        <button type="button" onclick="CloseProductTypeAddedPopUp()">OK</button>
    </div>

    <!-- started popup message logout category added -->
    <div class="popup" id="product-category-added-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Category Added Confirmation</h2>
        <p>A new product category was added successfully</p>
        <button type="button" onclick="CloseProductCategoryAddedPopUp()">OK</button>
    </div>


    <!-- started popup product deleted -->
    <div class="popup" id="product-deleted-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Was Removed</h2>
        <p>The product was removed successfully</p>
        <button type="button" onclick="CloseProductRemovedPopUp()">OK</button>
    </div>

    <!-- started popup message remove category -->
    <div class="popup" id="remove-category-confirmation">
        <img src="../images/question-mark.png" alt="remove confirmation">
        <h2>Delete Confirmation</h2>
        <p id="remove-category-confirmation-text"></p>
        <button type="button" onclick="DeleteCategory()">YES</button>
        <button type="button" onclick="CloseRemoveCategoryPopUp()">NO</button>
    </div>


    <!-- started popup message remove type -->
    <div class="popup" id="remove-type-confirmation">
        <img src="../images/question-mark.png" alt="remove confirmation">
        <h2>Delete Confirmation</h2>
        <p id="remove-type-confirmation-text"></p>
        <button type="button" onclick="DeleteType()">YES</button>
        <button type="button" onclick="CloseRemoveTypePopUp()">NO</button>
    </div>

    <!-- started popup message remove product -->
    <div class="popup" id="remove-product-confirmation">
        <img src="../images/question-mark.png" alt="remove confirmation">
        <h2>Delete Confirmation</h2>
        <p id="remove-product-confirmation-text"></p>
        <button type="button" onclick="DeleteProduct()">YES</button>
        <button type="button" onclick="CloseRemoveProductPopUp()">NO</button>
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
                Products List
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

            <!-- list of all product types -->

            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Product Types List</h3>
                        </div>

                        <canvas id="TypeChart" style="width:100%;max-width:600px"></canvas>
                        <div class="card-single add_type">
                            <button class="add_type" id="add_type" onclick="OpenAddType()" title="Add a new product type">
                                <span class="las la-plus">
                                </span>
                                Add Product Type
                            </button>
                        </div>
                        <div class="card-header">
                            <h3>
                                <p style="text-decoration: underline; color: royalblue;" id="type-filter-text"></p>
                                <br>
                                <p id="type-table-sort"></p>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="div-search">
                                    <span class="las la-search" style="font-size: 1.8rem; color: royalblue;"></span>
                                    <input type="text" id="SearchInputType" onkeyup="FilterTableTypes()" placeholder="Search in table Product Types...">
                                </div>
                                <table width="100%" id="product_types_table">
                                    <thead>
                                        <tr>
                                            <td id="type-column" title="Sort Product Type by descending">Product Type</td>
                                            <td id="type-added-by-column" title="Sort Added By by descending">Added By</td>
                                            <td id="type-modified-on-column" title="Sort Modified On by descending">Modified On</td>
                                            <td>Remove</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt_select_product_types = $connection->prepare("SELECT * FROM product_types");
                                        $stmt_select_product_types->execute();
                                        $result_product_types = $stmt_select_product_types->get_result();

                                        while ($row_product_types = $result_product_types->fetch_assoc()) {
                                            get_all_product_types(
                                                $row_product_types['type'],
                                                $row_product_types['added_by'],
                                                $row_product_types['modified_on']
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

            <!-- list of all product categories -->

            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Product Categories List</h3>
                        </div>

                        <canvas id="CategoryChart" style="width:100%;max-width:600px"></canvas>

                        <div class="card-single add_category">
                            <button class="add_category" id="add_category" onclick="OpenAddCategory()" title="Add a new product category">
                                <span class="las la-plus">
                                </span>
                                Add Product Category
                            </button>
                        </div>

                        <div class="card-header">
                            <h3>
                                <p style="text-decoration: underline; color: royalblue;" id="category-filter-text"></p>
                                <br>
                                <p id="category-table-sort"></p>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="div-search">
                                    <span class="las la-search" style="font-size: 1.8rem; color: royalblue;"></span>
                                    <input type="text" id="SearchInputCategory" onkeyup="FilterTableCategories()" placeholder="Search in table Product Categories...">
                                </div>
                                <table width="100%" id="product_categories_table">
                                    <thead>
                                        <tr>
                                            <td id="category-column" title="Sort Product Category by descending">Product Category</td>
                                            <td id="category-added-by-column" title="Sort Added By by descending">Added By</td>
                                            <td id="category-modified-on-column" title="Sort Modified On by descending">Modified On</td>
                                            <td>Remove</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt_select_product_categories = $connection->prepare("SELECT * FROM product_categories");
                                        $stmt_select_product_categories->execute();
                                        $result_product_categories = $stmt_select_product_categories->get_result();

                                        while ($row_product_categories = $result_product_categories->fetch_assoc()) {
                                            get_all_product_categories(
                                                $row_product_categories['category'],
                                                $row_product_categories['added_by'],
                                                $row_product_categories['modified_on']
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

            <!-- list of all products -->

            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">

                        <div class="card-header">
                            <h3>Products List</h3>
                        </div>

                        <div id="myPlot" style="width:100%;max-width:700px;"></div>
                        <div id="myPlot2" style="width:100%;max-width:700px;"></div>

                        <div class="card-single add_product">
                            <button class="add_product" id="add_user1" onclick="OpenAddProduct()" title="Add a new product"><span class="las la-plus"></span>Add Product</button>
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
                                    <input type="text" id="SearchInput" onkeyup="FilterTable()" placeholder="Search in table Products...">
                                </div>
                                <table width="100%" id="products_table">
                                    <thead>
                                        <tr>
                                            <td id="product-name-column" title="Sort Product Name by descending">Product Name</td>
                                            <td id="product-price-column" title="Sort Price by descending">Price</td>
                                            <td id="product-type-column" title="Sort Type by descending">Type</td>
                                            <td id="product-category-column" title="Sort Category by descending">Category</td>
                                            <td id="product-inventory-column" title="Sort Inventory by descending">Inventory</td>
                                            <td id="product-sales-column" title="Sort Sales Number by descending">Sales Number</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Last Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Last Modified On</td>
                                            <td>Remove</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row_products = $results_products->fetch_assoc()) {
                                            get_all_products(
                                                $row_products['product_id'],
                                                $row_products['name'],
                                                $row_products['price'],
                                                $row_products['category'],
                                                $row_products['type'],
                                                $row_products['inventory'],
                                                $row_products['sales_number'],
                                                $row_products['last_modified_by'],
                                                $row_products['last_modified_on']
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

            <!-- adding new product type form -->
            <div id="add_type_form" class="modal">
                <span onclick="CloseAddType()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content" action="product-admin.php" method="POST">
                    <div class="container">
                        <h1 class="title">Add New Type</h1>
                        <br>
                        <p class="title">Please fill in this form to add a new product type</p>
                        <br>
                        <p class="error" id="type_error">
                            <?php
                            if (isset($_SESSION['type_error'])) {
                                echo "<script>document.getElementById('type_error').style.display='block';</script>";
                                echo $_SESSION['type_error'];
                                unset($_SESSION['type_error']);
                            } ?>
                        </p>
                        <label for="type">
                            <b>Product Type</b>
                        </label>
                        <input type="text" placeholder="Enter new product type" name="type" id="type" value="<?php if (isset($_SESSION['type'])) {
                                                                                                                    echo $_SESSION['type'];
                                                                                                                } ?>" required />
                        <br>

                        <div class="clearfix">
                            <button type="submit" class="addtypebtn" title="Add new product type">
                                <strong>Add Product Type</strong>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- adding new product category form -->
            <div id="add_category_form" class="modal">
                <span onclick="CloseAddCategory()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content" action="product-admin.php" method="POST">
                    <div class="container">
                        <h1 class="title">Add New Category</h1>
                        <br>
                        <p class="title">Please fill in this form to add a new product category</p>
                        <br>
                        <p class="error" id="category_error">
                            <?php
                            if (isset($_SESSION['category_error'])) {
                                echo "<script>document.getElementById('category_error').style.display='block';</script>";
                                echo $_SESSION['category_error'];
                                unset($_SESSION['category_error']);
                            } ?>
                        </p>
                        <label for="category">
                            <b>Product Category</b>
                        </label>
                        <input type="text" placeholder="Enter new product category" name="category" id="category" value="<?php if (isset($_SESSION['category'])) {
                                                                                                                                echo $_SESSION['category'];
                                                                                                                            } ?>" required />
                        <br>

                        <div class="clearfix">
                            <button type="submit" class="addcategorybtn" title="Add new product category">
                                <strong>Add Product Category</strong>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- adding new product form -->
            <div id="add_product_form" class="modal">
                <span onclick="CloseAddProduct()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content" action="product-admin.php" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <h1 class="title">Add New Product</h1>
                        <br>
                        <p class="title">Please fill in this form to add a new product</p>
                        <br>

                        <label for="product_name"><b>Product Name</b></label>
                        <input type="text" placeholder="Enter product's name" name="product_name" id="product_name" value="" required />


                        <label for="product_price">
                            <b>Product Price</b>
                        </label>
                        <br>
                        <input style="height: 35px;" type="number" placeholder="Enter product's price" name="product_price" id="product_price" value="" required>
                        <br><br>

                        <label for="product_type">
                            <b>Product Type</b>
                        </label>
                        <br>

                        <select name="product_type" id="product_type">
                            <?php
                            $stmt_select_product_types = $connection->prepare("SELECT * FROM product_types");
                            $stmt_select_product_types->execute();
                            $result_product_types = $stmt_select_product_types->get_result();

                            while ($row_product_types = $result_product_types->fetch_assoc()) {
                                get_all_product_types_for_add_product_form($row_product_types['type']);
                            }
                            ?>
                        </select>

                        <br>
                        <br>

                        <label for="product_category">
                            <b>Product Category</b>
                        </label>
                        <br>

                        <select name="product_category" id="product_category">
                            <?php
                            $stmt_select_product_categories = $connection->prepare("SELECT * FROM product_categories");
                            $stmt_select_product_categories->execute();
                            $result_product_categories = $stmt_select_product_categories->get_result();

                            while ($row_product_categories = $result_product_categories->fetch_assoc()) {
                                get_all_product_categories_for_add_product_form($row_product_categories['category']);
                            }
                            ?>
                        </select>

                        <br>
                        <br>

                        <label for="product_desciption">
                            <b>Desciption</b>
                        </label>
                        <input type="text" title="Enter product's desciption" placeholder="Enter product's desciption" name="product_desciption" id="product_desciption" value="" required>

                        <label for="product_age">
                            <b>Age Restriction</b>
                        </label>
                        <input type="text" title="Enter product's age restriction" placeholder="Enter product's age restriction" name="product_age" id="product_age" value="" required>

                        <label for="product_inventory">
                            <b>Current Inventory:</b>
                        </label>
                        <br>
                        <input type="number" title="Enter product's current inventory in stock" placeholder="Enter product's current inventory in stock" name="product_inventory" id="product_inventory" style="height: 35px;" value="" required>

                        <br>
                        <br>

                        <label for="product_sales">
                            <b>Current Sales Number:</b>
                        </label>
                        <br>

                        <input type="number" title="Enter product's current sales number (if any, else 0)" placeholder="Enter product's current sales number (if any, else 0)" name="product_sales" id="product_sales" style="height: 35px;" value="" required>

                        <br>
                        <br>

                        <label>
                            <b>Upload Product Image:</b>
                        </label>
                        <input type="file" title="Choose from your files an image for the product" name="product_image" id="product_image" value="" required>
                        <br>

                        <div class="clearfix">
                            <button type="submit" class="addproductbtn" title="Add new product">
                                <strong>Add Product</strong>
                            </button>
                        </div>
                    </div>
                </form>
            </div>



            <!-- form of price history for product -->
            <div id="price-history" class="modal">
                <span onclick="CloseProductHistoryPrices()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content">
                    <div class="container">
                        <h1 class="title">Product Prices History</h1>
                        <p class="title">Showing Prices History for product <?php echo $row_get_product['name']; ?></p>
                        <br>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" id="product_prices_history_table">
                                    <thead>
                                        <tr>
                                            <td id="product-price-column" title="Sort Price by descending">Price</td>
                                            <td id="product-price-change-column" title="Sort Price Change by descending">Price Change</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Modified On</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['product_id']) && isset($_GET['price_history'])) {
                                            while ($row_product_prices_history = $result_history_product_prices->fetch_assoc()) {
                                                get_all_product_history_prices(
                                                    $row_product_prices_history['price'],
                                                    $row_product_prices_history['price_change'],
                                                    $row_product_prices_history['modified_by'],
                                                    $row_product_prices_history['modified_on']
                                                );
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <!-- form of inventory history for product -->
            <div id="inventory-history" class="modal">
                <span onclick="CloseProductHistoryInventory()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content">
                    <div class="container">
                        <h1 class="title">Product Inventory History</h1>
                        <p class="title">Showing Inventory History for product <?php echo $row_get_product['name']; ?></p>
                        <br>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" id="product_inventory_history_table">
                                    <thead>
                                        <tr>
                                            <td id="product-inventory-column" title="Sort Inventory by descending">Inventory</td>
                                            <td id="product-inventory-change-column" title="Sort Inventory Change by descending">Inventory Change</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Modified On</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['product_id']) && isset($_GET['inventory_history'])) {
                                            while ($row_product_inventory_history = $result_product_history_inventory->fetch_assoc()) {
                                                get_all_product_history_inventory(
                                                    $row_product_inventory_history['inventory'],
                                                    $row_product_inventory_history['inventory_change'],
                                                    $row_product_inventory_history['modified_by'],
                                                    $row_product_inventory_history['modified_on']
                                                );
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <!-- form of sales history for product -->
            <div id="sales-history" class="modal">
                <span onclick="CloseProductHistorySales()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content">
                    <div class="container">
                        <h1 class="title">Product Sales History</h1>
                        <p class="title">Showing Sales History for product <?php echo $row_get_product['name']; ?></p>
                        <br>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" id="product_sales_history_table">
                                    <thead>
                                        <tr>
                                            <td id="product-sales-column" title="Sort Sales by descending">Sales</td>
                                            <td id="product-sales-change-column" title="Sort Sales Change by descending">Sales Change</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Modified On</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['product_id']) && isset($_GET['sales_history'])) {
                                            while ($row_product_sales_history = $result_product_history_sales->fetch_assoc()) {
                                                get_all_product_history_sales(
                                                    $row_product_sales_history['sales_number'],
                                                    $row_product_sales_history['sales_change'],
                                                    $row_product_sales_history['modified_by'],
                                                    $row_product_sales_history['modified_on']
                                                );
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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

<script src="product-admin.js"></script>
<script src="../admin-main/admin-main.js"></script>
<script>
    const array_products = [];
    const array_products_count = [];
    <?php
    //get lowest products 
    $query_lowest_selling_products = "SELECT name, sales_number FROM products ORDER BY sales_number ASC LIMIT 5;";
    $stmt_lowest_selling_products = $connection->prepare($query_lowest_selling_products);
    $stmt_lowest_selling_products->execute();
    $results_lowest_selling_products = $stmt_lowest_selling_products->get_result();
    while ($row_lowest_selling_products = $results_lowest_selling_products->fetch_assoc()) {
    ?>
        array_products.push("<?php
                                echo $row_lowest_selling_products['name'];
                                ?>");
        array_products_count.push("<?php
                                    echo $row_lowest_selling_products['sales_number'];
                                    ?>");
    <?php }
    ?>;
    var xArray = array_products;
    var yArray = array_products_count;

    var data = [{
        x: xArray,
        y: yArray,
        type: "bar"
    }];

    var layout = {
        title: "Lowest Selling Products"
    };

    Plotly.newPlot("myPlot", data, layout);

    const array_products2 = [];
    const array_products_count2 = [];
    <?php
    //get lowest products 
    $query_highest_selling_products = "SELECT name, sales_number FROM products ORDER BY sales_number DESC LIMIT 5";
    $stmt_highest_selling_products = $connection->prepare($query_highest_selling_products);
    $stmt_highest_selling_products->execute();
    $results_highest_selling_products = $stmt_highest_selling_products->get_result();
    while ($row_highest_selling_products = $results_highest_selling_products->fetch_assoc()) {
    ?>
        array_products2.push("<?php
                                echo $row_highest_selling_products['name'];
                                ?>");
        array_products_count2.push("<?php
                                    echo $row_highest_selling_products['sales_number'];
                                    ?>");
    <?php }
    ?>;
    var xArray2 = array_products2;
    var yArray2 = array_products_count2;

    var data2 = [{
        x: xArray2,
        y: yArray2,
        type: "bar"
    }];

    var layout2 = {
        title: "Highest Selling Products"
    };

    Plotly.newPlot("myPlot2", data2, layout2);

    //for type bar chart

    const array_products_top = [];
    const array_products_count_top = [];
    <?php
    if (isset($results_top_products)) {
        while ($row_top_products = $results_top_products->fetch_assoc()) {
    ?>
            array_products_top.push("<?php
                                        echo $row_top_products['name'];
                                        ?>");
            array_products_count_top.push("<?php
                                            echo $row_top_products['sales_number'];
                                            ?>");
    <?php }
    }
    ?>;
    var xArray = array_products_count_top;
    var yArray = array_products_top;

    var data = [{
        x: xArray,
        y: yArray,
        type: "bar",
        orientation: "h",
        marker: {
            color: "green"
        }
    }];

    var layout = {
        title: "Top products being sold"
    };

    //second chart which is the lowest

    //pie chart of Type
    const array_types = [];
    const array_types_count = [];
    <?php
    //get all product types
    $stmt_get_all_product_types = $connection->prepare("SELECT * FROM product_types");
    $stmt_get_all_product_types->execute();
    $result_product_types = $stmt_get_all_product_types->get_result();
    while ($row_product_types = $result_product_types->fetch_assoc()) {
    ?>
        array_types.push("<?php
                            echo $row_product_types['type'];
                            ?>");
        <?php
        //check all products who have type "type"
        $query_product_types_count = "SELECT COUNT(*) as products_same_type_count FROM products WHERE type = '" . $row_product_types['type'] . "'";
        $stmt_product_types_count = $connection->prepare($query_product_types_count);
        $stmt_product_types_count->execute();
        $results_product_types_count = $stmt_product_types_count->get_result();
        $row_product_types_count = $results_product_types_count->fetch_assoc();

        ?>;
        array_types_count.push("<?php
                                echo $row_product_types_count['products_same_type_count'];
                                ?>");
    <?php }
    ?>;
    var xValues = array_types;
    var yValues = array_types_count;
    var random_colors = [];

    const size = array_types.length;

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
    new Chart("TypeChart", {
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
                text: "Distribution of Products by Type"
            }
        }
    });

    //pie chart of Category
    const array_categories = [];
    const array_categories_count = [];
    <?php
    //get all product types
    $stmt_get_all_product_categories = $connection->prepare("SELECT * FROM product_categories");
    $stmt_get_all_product_categories->execute();
    $result_product_categories = $stmt_get_all_product_categories->get_result();
    while ($row_product_categories = $result_product_categories->fetch_assoc()) {
    ?>
        array_categories.push("<?php
                                echo $row_product_categories['category'];
                                ?>");
        <?php
        //check all products who have category "category"
        $query_product_categories_count = "SELECT COUNT(*) as products_same_category_count FROM products WHERE category = '" . $row_product_categories['category'] . "'";
        $stmt_product_categories_count = $connection->prepare($query_product_categories_count);
        $stmt_product_categories_count->execute();
        $results_product_categories_count = $stmt_product_categories_count->get_result();
        $row_product_categories_count = $results_product_categories_count->fetch_assoc();

        ?>;
        array_categories_count.push("<?php
                                        echo $row_product_categories_count['products_same_category_count'];
                                        ?>");
    <?php }
    ?>;
    var xValues2 = array_categories;
    var yValues2 = array_categories_count;
    var random_colors = [];

    const size2 = array_categories.length;

    function getNewColor2(start) {
        for (var i = start; i < size2; i++) {
            const random = "#" + Math.floor(Math.random() * (255 + 1));
            if (random_colors.values != random) {
                random_colors.push(random);
            } else {
                getNewColor2(i);
            }
        }
    }
    getNewColor2(0);

    var barColors = random_colors;
    new Chart("CategoryChart", {
        type: "bar",
        data: {
            labels: xValues2,
            datasets: [{
                backgroundColor: barColors,
                data: yValues2
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Distribution of Products by Category"
            }
        }
    });
</script>

</html>