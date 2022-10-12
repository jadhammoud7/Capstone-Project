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


    //get all customer purchases from store
    require_once("../php/admin_page_php.php");
    $query_store_sales = "SELECT * FROM store_sales";
    $stmt_store_sales = $connection->prepare($query_store_sales);
    $stmt_store_sales->execute();
    $results_store_sales = $stmt_store_sales->get_result();

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
        if (isset($_POST['customer_name'])) {
            $customer_name = $_POST['customer_name'];
        }
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
        }
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if (isset($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
        }
        if (isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
        }

        $total_sales_products = 0;
        $total_sales_price = 0;
        $total_sales_quantity = 0;

        for ($x = 0; $x < count($product_name); $x++) {
            if (!empty($username)) {
                $query_check_username = "SELECT customer_id, loyalty_points FROM customers WHERE username='" . $username . "'";
                $stmt_check_username = $connection->prepare($query_check_username);
                $stmt_check_username->execute();
                $results_check_username = $stmt_check_username->get_result();
                $row_check_username = $results_check_username->fetch_assoc();

                //if the customer does not exist in table customers
                if (empty($row_check_username)) {
                    //select product price
                    $stmt_select_product_price = $connection->prepare("SELECT price FROM products WHERE name = '" . $product_name[$x] . "'");
                    $stmt_select_product_price->execute();
                    $result_product_price = $stmt_select_product_price->get_result();
                    $row_product_price = $result_product_price->fetch_assoc();

                    //let product price be unit price * quantity
                    $total_product_price = $row_product_price['price'] * $quantity[$x];
                    //update product sales by 1
                    $total_sales_products = $total_sales_products + 1;
                    //update sales price by increasing total product price
                    $total_sales_price = $total_sales_price + $total_product_price;
                    //update sales quantity by increasing product quantity
                    $total_sales_quantity = $total_sales_quantity + $quantity[$x];

                    //insert product info to table sales_products
                    $stmt_insert_store_sales = $connection->prepare("INSERT INTO sales_products(sales_id, product_name, quantity, price) VALUES (?,?,?,?)");
                    $stmt_insert_store_sales->bind_param("issi", $store_sales_id, $product_name[$x], $quantity[$x], $total_product_price);
                    $stmt_insert_store_sales->execute();
                    $stmt_insert_store_sales->close();
                } else {
                    //if customer exists in table customers
                    //addinf quantity of all products needed

                    //update customer loyalty points
                    $add_result = $row_check_username['loyalty_points'] + $quantity[$x];
                    $stmt_update_loyalty = $connection->prepare("UPDATE customers SET loyalty_points=? WHERE customer_id='" . $row_check_username['customer_id'] . "'");
                    $stmt_update_loyalty->bind_param("i", $add_result);
                    $stmt_update_loyalty->execute();
                    $stmt_update_loyalty->close();

                    //select price and add to sales products, same as above condition
                    $stmt_select_product_price = $connection->prepare("SELECT price FROM products WHERE name = '" . $product_name[$x] . "'");
                    $stmt_select_product_price->execute();
                    $result_product_price = $stmt_select_product_price->get_result();
                    $row_product_price = $result_product_price->fetch_assoc();

                    $total_product_price = $row_product_price['price'] * $quantity[$x];
                    $total_sales_products = $total_sales_products + 1;
                    $total_sales_price = $total_sales_price + $total_product_price;
                    $total_sales_quantity = $total_sales_quantity + $quantity[$x];
                    $stmt_insert_store_sales = $connection->prepare("INSERT INTO sales_products(sales_id, product_name, quantity, price) VALUES (?,?,?,?)");
                    $stmt_insert_store_sales->bind_param("issi", $store_sales_id, $product_name[$x], $quantity[$x], $total_product_price);
                    $stmt_insert_store_sales->execute();
                    $stmt_insert_store_sales->close();

                    $stmt_select_product = $connection->prepare("SELECT product_id FROM products WHERE name = '" . $product_name[$x] . "'");
                    $stmt_select_product->execute();
                    $result_product_id = $stmt_select_product->get_result();
                    $row_product_id = $result_product_id->fetch_assoc();

                    $product_id = $row_product_id['product_id'];
                    date_default_timezone_set('Asia/Beirut');
                    $date = date('Y-m-d h:i:s');
                    $stmt_insert_product_sales_history = $connection->prepare("INSERT INTO history_product_sales(product_id, sales_number, date) VALUES (?,?,?)");
                    $stmt_insert_product_sales_history->bind_param("iis", $product_id, $quantity, $date);
                    $stmt_insert_product_sales_history->execute();
                }
            }
        }
        date_default_timezone_set('Asia/Beirut');
        $date = date('Y-m-d h:i:s');
        $stmt_insert_store_sales = $connection->prepare("INSERT INTO store_sales(store_sales_id, customer_name, username, email, total_products, total_quantity, total_price, date) VALUES (?,?,?,?,?,?,?,?)");
        $stmt_insert_store_sales->bind_param("isssiiis", $store_sales_id, $customer_name, $username, $email, $total_sales_products, $total_sales_quantity, $total_sales_price, $date);
        $stmt_insert_store_sales->execute();
        $stmt_insert_store_sales->close();
        header("Location: store_sale-admin.php");
    }

    require_once("../php/checkout-store_sales.php");
    $query_get_all_products = "SELECT name FROM products";
    $stmt_get_all_products = $connection->prepare($query_get_all_products);
    $stmt_get_all_products->execute();
    $results_get_all_products = $stmt_get_all_products->get_result();

    //select count of all customers purchasing via website
    $query_count_website = "SELECT COUNT(*) as website FROM checkouts";
    $stmt_count_website = $connection->prepare($query_count_website);
    $stmt_count_website->execute();
    $results_count_website = $stmt_count_website->get_result();
    $row_count_website = $results_count_website->fetch_assoc();

    //select count of all customers purchasing via store
    $query_count_store = "SELECT COUNT(*) as store FROM store_sales";
    $stmt_count_store = $connection->prepare($query_count_store);
    $stmt_count_store->execute();
    $results_count_store = $stmt_count_store->get_result();
    $row_count_store = $results_count_store->fetch_assoc();

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
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
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
                    <!--add chart-->
                    <div id="myPlot" style="width:100%;max-width:700px"></div>
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
                                    <table width="100%" id="store_sales_table">
                                        <thead>
                                            <tr>
                                                <td id="customer-name-column" title="Sort Customer Name by descending">Customer Name</td>
                                                <td id="email-column" title="Sort Email by descending">Email</td>
                                                <td id="total-products-column" title="Sort Store Sales from most to least products containing">Total Products</td>
                                                <td id="total-quantity-column" title="Sort Store Sales from most to least quantities containing">Total Quantity</td>
                                                <td id="total-price-column" title="Sort Store Sales from most to least money gained">Total Price</td>
                                                <td id="date-column" title="Sort Store Sales from most to least recent">Date</td>
                                                <td>View Order</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row_store_sales = $results_store_sales->fetch_assoc()) {
                                                get_all_store_sales(
                                                    $row_store_sales['store_sales_id'],
                                                    $row_store_sales['customer_name'],
                                                    $row_store_sales['email'],
                                                    $row_store_sales['total_products'],
                                                    $row_store_sales['total_quantity'],
                                                    $row_store_sales['total_price'],
                                                    $row_store_sales['date']
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
                    <form class="modal-content" action="store_sale-admin.php" method="POST" enctype="multipart/form-data">
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
    <script>
        const array_count = [];

        var xArray = ["purchases via website", "purchases via store"];
        var yArray = [<?php echo $row_count_website['website']; ?>, <?php echo $row_count_store['store']; ?>];

        var layout = {
            title: "Percentage of  how products are being purchasesd"
        };

        var data = [{
            labels: xArray,
            values: yArray,
            type: "pie"
        }];

        Plotly.newPlot("myPlot", data, layout);
    </script>


    </html>