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
$product_desciption = "";
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
    $product_desciption = $_POST["product_desciption"];
}

if (isset($_POST["product_age"])) {
    $product_age = $_POST["product_age"];
}

if (isset($_POST['product_inventory'])) {
    $product_inventory = $_POST['product_inventory'];
}

if ($product_name != "" && $product_price != 0 && $product_type != "" && $product_category != "" && $product_desciption != "" && $product_age != "" && $product_inventory != 0) {
    $target_dir = "../images/";
    $filename = basename($_FILES['product_image']['name']);
    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $sales_number = 0;
            $product_image = $filename;
            $stmt_add_new_product = $connection->prepare("INSERT INTO products(name, price, type, category, description, age, image, inventory, sales_number) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt_add_new_product->bind_param("sisssssii", $product_name, $product_price, $product_type, $product_category, $product_desciption, $product_age, $product_image, $product_inventory, $sales_number);
            $stmt_add_new_product->execute();
            $stmt_add_new_product->close();
            header("Location: product-admin.php?product-added=1");
        }
    }
}

//get products in ascending 
$query_nbofsales = "SELECT name,inventory,sales_number FROM products ORDER BY sales_number ASC;";
$stmt_nbofsales = $connection->prepare($query_nbofsales);
$stmt_nbofsales->execute();
$results_nbofsales = $stmt_nbofsales->get_result();


//get lowest products 
$query_lowest_products = "SELECT name,sales_number FROM products ORDER BY sales_number ASC LIMIT 5;";
$stmt_lowest_products = $connection->prepare($query_lowest_products);
$stmt_lowest_products->execute();
$results_lowest_products = $stmt_lowest_products->get_result();

//get top products 
$query_top_products = "SELECT name,sales_number FROM products ORDER BY sales_number DESC LIMIT 5;";
$stmt_top_products = $connection->prepare($query_top_products);
$stmt_top_products->execute();
$results_top_products = $stmt_top_products->get_result();


// echo "<script>window.location='../product-admin/product-admin.php';</script>";

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
            <div style="margin-top: 30px;">
                <div id="myPlot" style="width:100%;max-width:700px;float:right"></div>
                <div id="myPlot1" style="width:100%;max-width:700px"></div>

            </div>

            <div class="card-single add_admin">
                <button class="add_product" id="add_user1" onclick="OpenAddProduct()" title="Add a new product"><span class="las la-plus"></span>Add Product</button>
            </div>
            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Products List</h3>
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

            <!-- adding form -->
            <div id="id01" class="modal">
                <span onclick="CloseAddProduct()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content" action="product-admin.php" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <h1 class="title">Add New Product</h1>
                        <p class="title">Please fill in this form to add a new product.</p>
                        <br>

                        <label for="product_name"><b>Product Name</b></label>
                        <input type="text" placeholder="Enter product's name" name="product_name" id="product_name" value="" required />


                        <label for="product_price"><b>Product Price</b></label><br>
                        <input style="height: 35px;" type="number" placeholder="Enter product's price" name="product_price" id="product_price" value="" required>
                        <br><br>

                        <label for="product_type"><b>Product Type</b><br>
                            <select name="product_type" id="product_type">
                                <option value="cds">CDs</option>
                                <option value="consoles">Consoles</option>
                                <option value="accessories">Accessories</option>
                                <option value="phones">Phones</option>
                                <option value="cards">Online cards</option>
                                <option value="electronics">Electronics</option>
                            </select>
                        </label>
                        <br><br>

                        <label for="product_category"><b>Product Category</b><br>
                            <select name="product_category" id="product_category">
                                <option value="action">Action</option>
                                <option value="gaming">Gaming</option>
                                <option value="strategy">Strategy</option>
                                <option value="PS2">PS2</option>
                                <option value="PS3">PS3</option>
                                <option value="PS4">PS4</option>
                                <option value="PS5">PS5</option>
                                <option value="XBox">XBox</option>
                                <option value="iphone">IPhone</option>
                                <option value="Samsung">Samsung</option>
                                <option value="PsPlus">PS Plus</option>
                            </select>
                        </label>
                        <br><br>

                        <label for="product_desciption"><b>Desciption</b></label>
                        <input type="text" placeholder="Enter product's desciption" name="product_desciption" id="product_desciption" value="" required>

                        <label for="product_age"><b>Age Restriction</b></label>
                        <input type="text" placeholder="Enter product's age restriction" name="product_age" id="product_age" value="" required>

                        <label for="product_inventory"><b>Current Inventory:</b></label><br>
                        <input type="number" placeholder="Enter product's current inventory in stock" name="product_inventory" id="product_inventory" style="height: 35px;" value="" required>

                        <br><br>

                        <label><b>Upload Product Image:</b></label>
                        <input type="file" name="product_image" id="product_image" value="" required>
                        <br>

                        <div class="clearfix">
                            <button type="submit" class="addproductbtn" title="Add new product"><strong>Add Product</strong></button>
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
<script src="../product-admin/product-admin.js"></script>

<script src="../admin-main/admin-main.js"></script>
<script>
    const array_products = [];
    const array_products_count = [];
    <?php
    if (isset($results_lowest_products)) {
        while ($row_lowest_products = $results_lowest_products->fetch_assoc()) {
    ?>
            array_products.push("<?php
                                    echo $row_lowest_products['name'];
                                    ?>");
            array_products_count.push("<?php
                                        echo $row_lowest_products['sales_number'];
                                        ?>");
    <?php }
    }
    ?>;
    var xArray = array_products_count;
    var yArray = array_products;

    var data = [{
        x: xArray,
        y: yArray,
        type: "bar",
        orientation: "h",
        marker: {
            color: "red"
        }
    }];

    var layout = {
        title: "Lowest products being sold"
    };

    Plotly.newPlot("myPlot", data, layout);

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

    Plotly.newPlot("myPlot1", data, layout);



    //second chart which is the lowest
</script>

</html>