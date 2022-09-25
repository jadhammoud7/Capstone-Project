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


    //get all customer purchases from store
    require_once("../php/admin_page_php.php");
    $query_store_purchaces = "SELECT customer_name,email, product_name, quantity FROM store_sales";
    $stmt_store_purchaces = $connection->prepare($query_store_purchaces);
    $stmt_store_purchaces->execute();
    $results_store_purchaces = $stmt_store_purchaces->get_result();


    //get products in ascending 
    // $query_nbofsales = "SELECT name,inventory,sales_number FROM products ORDER BY sales_number ASC;";
    // $stmt_nbofsales = $connection->prepare($query_nbofsales);
    // $stmt_nbofsales->execute();
    // $results_nbofsales = $stmt_nbofsales->get_result();


    //get lowest products 
    // $query_lowest_products = "SELECT name,sales_number FROM products ORDER BY sales_number ASC LIMIT 5;";
    // $stmt_lowest_products = $connection->prepare($query_lowest_products);
    // $stmt_lowest_products->execute();
    // $results_lowest_products = $stmt_lowest_products->get_result();

    //get top products 
    // $query_top_products = "SELECT name,sales_number FROM products ORDER BY sales_number DESC LIMIT 5;";
    // $stmt_top_products = $connection->prepare($query_top_products);
    // $stmt_top_products->execute();
    // $results_top_products = $stmt_top_products->get_result();


    // echo "<script>window.location='../product-admin/product-admin.php';</script>";

    //the add sales form

    if (isset($_POST['save'])) {
        $stmt_select_all_store_sales = $connection->prepare("SELECT * FROM store_sales");
        $stmt_select_all_store_sales->execute();
        $results_all_store_sales = $stmt_select_all_store_sales->get_result();

        $store_sales_id = 1;
        if ($results_all_store_sales->num_rows == 0) {
            $store_sales_id = 1;
        } else {
            $stmt_select_last_sales_id = $connection->prepare("SELECT store_sales_id FROM store_sales ORDER BY store_sales_id DESC LIMIT 1");
            $stmt_select_last_sales_id->execute();
            $results_select_last_sales_id = $stmt_select_last_sales_id->get_result();
            $row_last_sales_id = $results_select_last_sales_id->fetch_assoc();
            $store_sales_id = $row_last_sales_id['store_sales_id'] + 1;
        }
        $product_name = [];
        $quantity = [];
        if (isset($_POST['customer_name']) && $_POST["customer_name"] != "") {
            $customer_name = $_POST['customer_name'];
        }
        if (isset($_POST['username']) && $_POST["username"] != "") {
            $username = $_POST['username'];
        }
        if (isset($_POST['email']) && $_POST["email"] != "") {
            $email = $_POST['email'];
        }
        if (isset($_POST['product_name']) && $_POST["product_name"] != "") {
            $product_name = $_POST['product_name'];
        }
        if (isset($_POST['quantity']) && $_POST["quantity"] != "") {
            $quantity = $_POST['quantity'];
        }

        for ($x = 0; $x < count($product_name); $x++) {
            if (empty($username)) {
                $stmt_insert_store_sales = $connection->prepare("INSERT INTO store_sales(store_sales_id, customer_name, username, email, product_name, quantity) VALUES (?,?,?,?,?,?)");
                $stmt_insert_store_sales->bind_param("issssi", $store_sales_id, $customer_name, $username, $email, $product_name[$x], $quantity[$x]);
                $stmt_insert_store_sales->execute();
                $stmt_insert_store_sales->close();
            } else {
                $query_check_username = "SELECT customer_id,loyalty_points from customers WHERE username='" . $username . "'";
                $stmt_check_username = $connection->prepare($query_check_username);
                $stmt_check_username->execute();
                $results_check_username = $stmt_check_username->get_result();
                $row_check_username = $results_check_username->fetch_assoc();

                if (empty($row_check_username)) {
                    $stmt_insert_store_sales = $connection->prepare("INSERT INTO store_sales(store_sales_id, customer_name, username, email, product_name, quantity) VALUES (?,?,?,?,?,?)");
                    $stmt_insert_store_sales->bind_param("issssi", $store_sales_id, $customer_name, $username, $email, $product_name[$x], $quantity[$x]);
                    $stmt_insert_store_sales->execute();
                    $stmt_insert_store_sales->close();
                } else {
                    //addinf quantity of all products needed

                    $add_result = $row_check_username['loyalty_points'] + $quantity[$x];
                    $stmt_insert_loyalty = $connection->prepare("UPDATE customers SET loyalty_points=? WHERE customer_id='" . $row_check_username['customer_id'] . "'");
                    $stmt_insert_loyalty->bind_param("i", $add_result);
                    $stmt_insert_loyalty->execute();
                    $stmt_insert_loyalty->close();
                    $stmt_insert_store_sales = $connection->prepare("INSERT INTO store_sales(store_sales_id, customer_name, username, email, product_name, quantity) VALUES (?,?,?,?,?,?)");
                    $stmt_insert_store_sales->bind_param("issssi", $store_sales_id, $customer_name, $username, $email, $product_name[$x], $quantity[$x]);
                    $stmt_insert_store_sales->execute();
                    $stmt_insert_store_sales->close();
                }
            }
        }
    }

    require_once("../php/checkout-store_sales.php");
    $query_get_all_products = "SELECT name FROM products";
    $stmt_get_all_products = $connection->prepare($query_get_all_products);
    $stmt_get_all_products->execute();
    $results_get_all_products = $stmt_get_all_products->get_result();

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
        <link rel="stylesheet" href="../store_sale-admin/store_sale-admin.css">
        <title>Admin | Store Sales - Newbies Gamers</title>
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
        <div class="popup" id="checkout-added-confirmation">
            <img src="../images/tick.png" alt="">
            <h2>Product Added Confirmation</h2>
            <p>A new product was added successfully</p>
            <button type="button" onclick="CloseCheckoutAddedPopUp()">OK</button>
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
                    Store Sales List
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
                    <button class="add_checkout" id="add_user1" onclick="OpenAddCheckout()" title="Add a new product"><span class="las la-plus"></span>Add Customer Purchaces Via Store</button>
                </div>

                <div class="recent-grid" style="display: block !important;">
                    <div class="projects">
                        <div class="card">
                            <div class="card-header">
                                <h3>Sales Via Store List</h3>
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
                                                <td>Customer Name</td>
                                                <td>Email</td>
                                                <td>Product Name</td>
                                                <td>Quantity</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row_store_purchaces = $results_store_purchaces->fetch_assoc()) {
                                                get_all_purchaces_store(
                                                    $row_store_purchaces['customer_name'],
                                                    $row_store_purchaces['email'],
                                                    $row_store_purchaces['product_name'],
                                                    $row_store_purchaces['quantity']
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
                    <span onclick="CloseAddCheckout()" class="close" title="Close Modal">&times;</span>
                    <form class="modal-content" action="../store_sale-admin/store_sale-admin.php" method="POST" enctype="multipart/form-data">
                        <div id="survey_options">
                            <h1 class="title">Add customer sales via store</h1>
                            <p class="title">Please fill in this form to add a new Sales.</p>
                            <br>

                            <input type="text" name="customer_name" class="survey_options" size="50" placeholder="customer name.." required>
                            <input type="text" name="username" class="survey_options" size="50" placeholder="username if any..">
                            <input type="text" name="email" class="survey_options" size="50" placeholder="email.." required>
                            <label for="products" id="choose-product">Choose a product:
                                <select id="products" name="product_name[]" size="5" required>
                                    <?php
                                    while ($row_get_all_products = $results_get_all_products->fetch_assoc()) {
                                        store_sales_connection($row_get_all_products['name']);
                                    }
                                    ?>
                                </select>
                            </label>

                            <input type="number" name="quantity[]" class="survey_options" size="50" placeholder="quantity..." required>
                        </div>
                        <div class="controls">
                            <a href="#survey_options" id="add_more_fields">
                                <button id="add-button">
                                    <span class="las la-plus"></span> Add More Products
                                </button>
                            </a>
                            <a href="#survey_options" id="remove_fields">
                                <button id="remove-button">
                                    <span class="las la-minus"></span> Remove Products
                                </button>
                            </a>
                        </div>
                        <center>
                            <input class="btn btn-success" type="submit" name="save" id="save" value="Save Data">
                        </center>
                    </form>
                </div>
            </main>
        </div>

        <!-- started return to top button -->
        <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
        <!-- ended return to top button -->

    </body>
    <script src="../store_sale-admin/store_sale-admin.js"></script>

    <script src="../admin-main/admin-main.js"></script>


    </html>