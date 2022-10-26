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

if (isset($_GET['product_id'])) {
    $stmt_get_product = $connection->prepare("SELECT * FROM products WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_get_product->execute();
    $result_product = $stmt_get_product->get_result();
    $row_product = $result_product->fetch_assoc();

    //select history prices for product
    $stmt_select_product_dates = $connection->prepare("SELECT * FROM history_product_prices WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_product_dates->execute();
    $result_product_dates = $stmt_select_product_dates->get_result();

    //select max history price for product
    $stmt_select_max_hist_price = $connection->prepare("SELECT MAX(price) as max_price FROM history_product_prices WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_max_hist_price->execute();
    $result_max_price = $stmt_select_max_hist_price->get_result();
    $row_max_price = $result_max_price->fetch_assoc();

    //select history sales for product
    $stmt_select_product_sales = $connection->prepare("SELECT * FROM history_product_sales WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_product_sales->execute();
    $result_product_sales = $stmt_select_product_sales->get_result();

    //select max history sales for product
    $stmt_select_max_hist_sales = $connection->prepare("SELECT MAX(sales_number) as max_sales FROM history_product_sales WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_max_hist_sales->execute();
    $result_max_sales = $stmt_select_max_hist_sales->get_result();
    $row_max_sales = $result_max_sales->fetch_assoc();

    //select history inventory for product
    $stmt_select_product_inventory = $connection->prepare("SELECT * FROM history_product_inventory WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_product_inventory->execute();
    $result_product_inventories = $stmt_select_product_inventory->get_result();

    //select max history inventory for product
    $stmt_select_max_hist_inventory = $connection->prepare("SELECT MAX(inventory) as max_inventory FROM history_product_inventory WHERE product_id = '" . $_GET['product_id'] . "'");
    $stmt_select_max_hist_inventory->execute();
    $result_max_inventory = $stmt_select_max_hist_inventory->get_result();
    $row_max_inventory = $result_max_inventory->fetch_assoc();
}

$product_id = 0;
$product_name = "";
$product_price = 0;
$product_type = "";
$product_category = "";
$product_description = "";
$product_age = "";
$product_inventory = 0;
$product_sales = 0;

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
}
if (isset($_POST['product_name'])) {
    $product_name = $_POST['product_name'];
}

if (isset($_POST['price'])) {
    $product_price = $_POST['price'];
}

if (isset($_POST['type'])) {
    $product_type = $_POST['type'];
}

if (isset($_POST['category'])) {
    $product_category = $_POST['category'];
}

if (isset($_POST['description'])) {
    $product_description = $_POST['description'];
}

if (isset($_POST['age'])) {
    $product_age = $_POST['age'];
}

if (isset($_POST['inventory'])) {
    $product_inventory = $_POST['inventory'];
}

if (isset($_POST['sales_number'])) {
    $product_sales = $_POST['sales_number'];
}

if ($product_id != 0 && $product_name != "" && $product_price != 0 && $product_type != "" && $product_category != "" && $product_description != "" && $product_age != "") {
    if (!empty($_FILES['product_image']['name'])) {
        rmdir('../images/Products/' + $product_name + '/');
        mkdir('../images/Products/' + $product_name + '/');
        $target_dir = "../images/Products/" . $product_name . '/';
        $filename = basename($_FILES['product_image']['name']);
        $target_file = $target_dir . $filename;
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
                $product_image = $filename;

                //get current time and name of admin modified
                date_default_timezone_set('Asia/Beirut');
                $modified_on = date('Y-m-d h:i:s');
                $modified_by = $row['first_name'] . ' ' . $row['last_name'];

                //select the current price of the product before updating
                $stmt_select_product_price = $connection->prepare("SELECT price FROM products WHERE product_id = '" . $product_id . "'");
                $stmt_select_product_price->execute();
                $result_product_price = $stmt_select_product_price->get_result();
                $row_product_price = $result_product_price->fetch_assoc();

                //insert into history prices of this product
                $prices_change = '';
                if ($row_product_price['price'] < $product_price) {
                    $price_change = $product_price - $row_product_price['price'];
                    $prices_change = '+ ' . $price_change;
                } else if ($row_product_price['price'] > $product_price) {
                    $price_change = $row_product_price['price'] - $product_price;
                    $prices_change = '- ' . $price_change;
                }
                if ($prices_change != '') {
                    $stmt_add_product_price_history = $connection->prepare("INSERT INTO history_product_prices(product_id, price, price_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
                    $stmt_add_product_price_history->bind_param("iisss", $product_id, $product_price, $prices_change, $modified_by, $modified_on);
                    $stmt_add_product_price_history->execute();
                    $stmt_add_product_price_history->close();
                }

                //select the current inventory of the product before updating
                $stmt_select_product_inventory = $connection->prepare("SELECT inventory FROM products WHERE product_id = '" . $product_id . "'");
                $stmt_select_product_inventory->execute();
                $result_product_inventory = $stmt_select_product_inventory->get_result();
                $row_product_inventory = $result_product_inventory->fetch_assoc();

                //insert into history inventory of this product
                $inventories_change = '';
                if ($row_product_inventory['inventory'] < $product_inventory) {
                    $inventory_change = $product_inventory - $row_product_inventory['inventory'];
                    $inventories_change = '+ ' . $inventory_change;
                } else if ($row_product_inventory['inventory'] > $product_inventory) {
                    $inventory_change = $row_product_inventory['inventory'] - $product_inventory;
                    $inventories_change = '- ' . $inventory_change;
                }
                if ($inventories_change != '') {
                    $stmt_add_product_inventory_history = $connection->prepare("INSERT INTO history_product_inventory(product_id, inventory, inventory_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
                    $stmt_add_product_inventory_history->bind_param("iisss", $product_id, $product_inventory, $inventories_change, $modified_by, $modified_on);
                    $stmt_add_product_inventory_history->execute();
                    $stmt_add_product_inventory_history->close();
                }

                //update products info
                $stmt_update_product = $connection->prepare("UPDATE products SET name = ?, price = ?, type= ?, category = ?, description = ?, age = ?, image = ?, inventory = ?, sales_number = ?, last_modified_by = ?, last_modified_on = ? WHERE product_id = '" . $product_id . "'");
                $stmt_update_product->bind_param("sisssssiiss", $product_name, $product_price, $product_type, $product_category, $product_description, $product_age, $product_image, $product_inventory, $product_sales, $modified_by, $modified_on);
                $stmt_update_product->execute();
                $stmt_update_product->close();
                header("Location: product-details.php?product-id=$product_id&product-updated=1");
            }
        }
    } else {
        //get current time and name of admin modified
        date_default_timezone_set('Asia/Beirut');
        $modified_on = date('Y-m-d h:i:s');
        $modified_by = $row['first_name'] . ' ' . $row['last_name'];

        //select the current price of the product before updating
        $stmt_select_product_price = $connection->prepare("SELECT price FROM products WHERE product_id = '" . $product_id . "'");
        $stmt_select_product_price->execute();
        $result_product_price = $stmt_select_product_price->get_result();
        $row_product_price = $result_product_price->fetch_assoc();

        //insert into history prices of this product
        $prices_change = '';
        if ($row_product_price['price'] < $product_price) {
            $price_change = $product_price - $row_product_price['price'];
            $prices_change = '+ ' . $price_change;
        } else if ($row_product_price['price'] > $product_price) {
            $price_change = $row_product_price['price'] - $product_price;
            $prices_change = '- ' . $price_change;
        }
        if ($prices_change != '') {
            $stmt_add_product_price_history = $connection->prepare("INSERT INTO history_product_prices(product_id, price, price_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
            $stmt_add_product_price_history->bind_param("iisss", $product_id, $product_price, $prices_change, $modified_by, $modified_on);
            $stmt_add_product_price_history->execute();
            $stmt_add_product_price_history->close();
        }

        //select the current inventory of the product before updating
        $stmt_select_product_inventory = $connection->prepare("SELECT inventory FROM products WHERE product_id = '" . $product_id . "'");
        $stmt_select_product_inventory->execute();
        $result_product_inventory = $stmt_select_product_inventory->get_result();
        $row_product_inventory = $result_product_inventory->fetch_assoc();

        //insert into history inventory of this product
        $inventories_change = '';
        if ($row_product_inventory['inventory'] < $product_inventory) {
            $inventory_change = $product_inventory - $row_product_inventory['inventory'];
            $inventories_change = '+ ' . $inventory_change;
        } else if ($row_product_inventory['inventory'] > $product_inventory) {
            $inventory_change = $row_product_inventory['inventory'] - $product_inventory;
            $inventories_change = '- ' . $inventory_change;
        }
        if ($inventories_change != '') {
            $stmt_add_product_inventory_history = $connection->prepare("INSERT INTO history_product_inventory(product_id, inventory, inventory_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
            $stmt_add_product_inventory_history->bind_param("iisss", $product_id, $product_inventory, $inventories_change, $modified_by, $modified_on);
            $stmt_add_product_inventory_history->execute();
            $stmt_add_product_inventory_history->close();
        }

        //select product image name
        $stmt_select_product_image = $connection->prepare("SELECT image FROM products WHERE product_id = '" . $product_id . "'");
        $stmt_select_product_image->execute();
        $result_product_image = $stmt_select_product_image->get_result();
        $row_product_image = $result_product_image->fetch_assoc();

        $product_image = $row_product_image['image'];

        $stmt_update_product = $connection->prepare("UPDATE products SET name = ?, price = ?, type= ?, category = ?, description = ?, age = ?, image = ?, inventory = ?, sales_number = ?, last_modified_by = ?, last_modified_on = ? WHERE product_id = '" . $product_id . "'");
        $stmt_update_product->bind_param("sisssssiiss", $product_name, $product_price, $product_type, $product_category, $product_description, $product_age, $product_image, $product_inventory, $product_sales, $modified_by, $modified_on);
        $stmt_update_product->execute();
        $stmt_update_product->close();

        header("Location: product-details.php?product-id=$product_id&product-updated=1");
    }
}

//delete product after pressing delete button
if (isset($_GET['ProductIDToRemove'])) {
    $stmt_delete_product = $connection->prepare("DELETE FROM products WHERE product_id = '" . $_GET['ProductIDToRemove'] . "'");
    $stmt_delete_product->execute();

    //delete history prices for product
    $stmt_delete_product_prices_history = $connection->prepare("DELETE FROM history_product_prices WHERE product_id = '" . $_GET['ProductIDToRemove'] . "'");
    $stmt_delete_product_prices_history->execute();

    //delete history inventory for product
    $stmt_delete_product_inventory_history = $connection->prepare("DELETE FROM history_product_inventory WHERE product_id = '" . $_GET['ProductIDToRemove'] . "'");
    $stmt_delete_product_inventory_history->execute();

    //delete history sales for product
    $stmt_delete_product_sales_history = $connection->prepare("DELETE FROM history_product_sales WHERE product_id = '" . $_GET['ProductIDToRemove'] . "'");
    $stmt_delete_product_sales_history->execute();

    header("Location: product-admin.php?product-deleted=1");
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
    <link rel="stylesheet" href="product-details.css">
    <title>Admin | Product Details - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

    <!-- started popup message product updated -->
    <div class="popup" id="product-updated-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Updated</h2>
        <p>The product of ID "<?php if (isset($_GET['product-id'])) {
                                    echo $_GET['product-id'];
                                } ?>" is updated successfully</p>
        <button type="button" onclick="CloseProductUpdatedPopUp()">OK</button>
    </div>

    <!-- started popup message product delete -->
    <div class="popup" id="product-delete-confirmation">
        <img src="../images/question-mark.png" alt="">
        <h2>Delete Product?</h2>
        <p>Are you sure that you want to delete product "<?php if (isset($_GET['product_id'])) {
                                                                echo $row_product['name'];
                                                            } ?>"?</p>
        <button type="button" onclick="DeleteProduct()">YES</button>
        <button type="button" onclick="CloseProductDeletePopUp()">NO</button>
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
                Product Details
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
            <div style="margin-top: 30px;">
                <canvas id="myLine" style="width:100%;max-width:700px;"></canvas>
                <canvas id="myLine2" style="width:100%;max-width:700px;"></canvas>
                <canvas id="myLine3" style="width:100%;max-width:700px;"></canvas>
            </div>
            <!-- started with checkout form -->
            <div>
                <div class="details">
                    <div class="card">
                        <div class="card-header">
                            <h2>Product Details</h2>
                        </div>
                        <div>

                            <button id="delete-product" title="Remove Product '<?php if (isset($row_product)) {
                                                                                    echo $row_product['name'];
                                                                                } ?>'?" onclick="ShowDeleteProductPopUp(<?php echo $_GET['product_id']; ?>)"><span class="las la-trash"></span> Delete Product</button>
                            <button id="edit-button" class="edit-button" title="Edit Product '<?php if (isset($row_product)) {
                                                                                                    echo $row_product['name'];
                                                                                                } ?>'" onclick="EditProduct()"><span class="las la-edit"></span> Edit Product</button>
                        </div>
                        <div class="form-container card-body">

                            <form action="product-details.php" method="POST" enctype="multipart/form-data">
                                <div class="form-container-part">

                                    <div>
                                        <h3 class="form-container-part-title">Product Information</h3>
                                    </div>


                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="product_id" id="product_id" value="<?php if (isset($row_product)) {
                                                                                                                echo $row_product['product_id'];
                                                                                                            } ?>" readonly class="is-valid">
                                            <label for="product_id">Product ID</label>
                                        </div>

                                        <div class="input-container">

                                            <input type="text" name="product_name" id="product_name" value="<?php if (isset($row_product)) {
                                                                                                                echo $row_product['name'];
                                                                                                            } ?>" readonly class="is-valid">
                                            <label for="product_name">Product Name</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="price" id="price" value="<?php if (isset($row_product)) {
                                                                                                    echo $row_product['price'];
                                                                                                } ?>" readonly class="is-valid">
                                            <label for="price">Price</label>
                                        </div>
                                        <div class="input-container">

                                            <input type="text" name="type" id="type" value="<?php if (isset($row_product)) {
                                                                                                echo $row_product['type'];
                                                                                            } ?>" readonly class="is-valid">
                                            <label for="type">Type</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="text" name="category" id="category" value="<?php if (isset($row_product)) {
                                                                                                        echo $row_product['category'];
                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="category">Category</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container description">
                                            <div class="description-body">
                                                <h3>Description</h3>
                                                <p id="description"><?php if (isset($row_product)) {
                                                                        echo $row_product['description'];
                                                                    } ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">

                                            <input type="text" name="age" id="age" value="<?php if (isset($row_product)) {
                                                                                                echo $row_product['age'];
                                                                                            } ?>" readonly class="is-valid">
                                            <label for="age">Age</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="inventory" id="inventory" value="<?php if (isset($row_product)) {
                                                                                                            echo $row_product['inventory'];
                                                                                                        } ?>" readonly class="is-valid">
                                            <label for="inventory">Inventory</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="sales_number" id="sales_number" value="<?php if (isset($row_product)) {
                                                                                                                    echo $row_product['sales_number'];
                                                                                                                } ?>" readonly class="is-valid">
                                            <label for="sales_number">Sales Number</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="text" name="last_modified_by" id="last_modified_by" value="<?php if (isset($row_product)) {
                                                                                                                        echo $row_product['last_modified_by'];
                                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="last_modified_by">Last Modified By</label>
                                        </div>
                                        <div class="input-container">
                                            <input type="text" name="last_modified_on" id="last_modified_on" value="<?php if (isset($row_product)) {
                                                                                                                        echo $row_product['last_modified_on'];
                                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="last_modified_on">Last Modified On</label>
                                        </div>
                                    </div>
                                    <!-- here to add upload file -->
                                    <div class="form-container-part-inputs">
                                        <div class="input-container product-image">
                                            <div class="image-body">
                                                <h3>Product Image</h3>
                                                <div id="product_image">
                                                    <img src='../images/Products/<?php if (isset($row_product)) {
                                                                            echo $row_product['name'];
                                                                        }; ?>/<?php if (isset($row_product)) {
                                                                                    echo $row_product['image'];
                                                                                } ?>'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" id="edit-product-submit" class="edit-product-submit" style="visibility: hidden;"><span class="las la-share-square"></span> Apply Changes</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="product-details-buttons">
                    <button class="back" onclick="history.back();" title="Return to Previous Page"><span class="las la-arrow-left" style="font-size: 1.4rem;"></span>Return to
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
<script src="product-details.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    <?php
    if (isset($_GET['product_id'])) {
    ?>
        var array_product_dates = [];
        var array_product_prices = [];
        const max_price = <?php echo $row_max_price['max_price']; ?>;
        <?php
        if (isset($result_product_dates)) {
            while ($row_product_dates = $result_product_dates->fetch_assoc()) {
        ?>
                array_product_dates.push("<?php
                                            echo $row_product_dates['modified_on'];
                                            ?>");
                array_product_prices.push("<?php
                                            echo $row_product_dates['price'];
                                            ?>");
        <?php
            }
        } ?>;

        var xArray = array_product_dates;
        var yArray = array_product_prices;

        new Chart("myLine", {
            type: "line",
            data: {
                labels: xArray,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yArray
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Price History of Product '<?php echo $row_product['name']; ?>'"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: max_price
                        }
                    }]
                }
            }
        });

        var array_product_sales_dates = [];
        var array_product_sales = [];
        const max_sales = <?php echo $row_max_sales['max_sales']; ?>;
        <?php
        if (isset($result_product_sales)) {
            while ($row_product_sales = $result_product_sales->fetch_assoc()) {
        ?>
                array_product_sales_dates.push("<?php
                                                echo $row_product_sales['modified_on'];
                                                ?>");
                array_product_sales.push("<?php
                                            echo $row_product_sales['sales_number'];
                                            ?>");
        <?php
            }
        }
        ?>;
        var xArray2 = array_product_sales_dates;
        var yArray2 = array_product_sales;

        new Chart("myLine2", {
            type: "line",
            data: {
                labels: xArray2,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yArray2
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Sales History of Product '<?php echo $row_product['name']; ?>'"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: max_sales
                        }
                    }]
                }
            }
        });

        var array_product_inventory_dates = [];
        var array_product_inventories = [];
        const max_inventory = <?php echo $row_max_inventory['max_inventory']; ?>;
        <?php
        if (isset($result_product_inventories)) {
            while ($row_product_inventories = $result_product_inventories->fetch_assoc()) {
        ?>
                array_product_inventory_dates.push("<?php
                                                    echo $row_product_inventories['modified_on'];
                                                    ?>");

                array_product_inventories.push("<?php
                                                echo $row_product_inventories['inventory'];
                                                ?>");
        <?php
            }
        } ?>;

        var xArray3 = array_product_inventory_dates;
        var yArray3 = array_product_inventories;

        new Chart("myLine3", {
            type: "line",
            data: {
                labels: xArray3,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yArray3
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Inventory History of Product '<?php echo $row_product['name']; ?>'"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: max_inventory
                        }
                    }]
                }
            }
        })


    <?php
    } ?>
</script>

</html>