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

if (isset($_GET['repair-id'])) {
    $stmt_get_repair = $connection->prepare("SELECT * FROM repairs WHERE repair_id = '" . $_GET['repair-id'] . "'");
    $stmt_get_repair->execute();
    $result_repair = $stmt_get_repair->get_result();
    $row_repair = $result_repair->fetch_assoc();
}

$repair_id = 0;
$repair_type = "";
$price_per_hour = 0;
$description = "";

if (isset($_POST['repair_id'])) {
    $repair_id = $_POST['repair_id'];
}

if (isset($_POST['repair_type'])) {
    $repair_type = $_POST['repair_type'];
}

if (isset($_POST['price_per_hour'])) {
    $price_per_hour = $_POST['price_per_hour'];
}

if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

if ($repair_id != 0 && $repair_type != "" && $price_per_hour != 0 && $description != "") {
    if (!empty($_FILES['repair_image']['name'])) {
        $target_dir = "../images/";
        $filename = basename($_FILES['repair_image']['name']);
        $target_file = $target_dir . $filename;
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['repair_image']['tmp_name'], $target_file)) {
                $repair_image = $filename;
                $stmt_update_repair = $connection->prepare("UPDATE repairs SET repair_type = '" . $repair_type . "', price_per_hour = '" . $price_per_hour . "', description = '" . $description . "', image = '" . $repair_image . "' WHERE repair_id = '" . $repair_id . "'");
                $stmt_update_repair->execute();
                $stmt_update_repair->close();
                header("Location: repair-admin-details.php?repair-id=$repair_id&repair-updated=1");
            }
        }
    } else {
        $stmt_update_repair = $connection->prepare("UPDATE repairs SET repair_type = '" . $repair_type . "', price_per_hour = '" . $price_per_hour . "', description = '" . $description . "' WHERE repair_id = '" . $repair_id . "'");
        $stmt_update_repair->execute();
        $stmt_update_repair->close();
        header("Location: repair-admin-details.php?repair-id=$repair_id&repair-updated=1");
    }
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
    <link rel="stylesheet" href="repair-admin-details.css">
    <title>Admin | Repair Details - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

    <!-- started popup message repair updated -->
    <div class="popup" id="repair-updated-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Repair Updated</h2>
        <p>The repair of ID "<?php if (isset($_GET['repair-id'])) {
                                    echo $_GET['repair-id'];
                                } ?>" is updated successfully</p>
        <button type="button" onclick="CloseRepairUpdatedPopUp()">OK</button>
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
                Repair Details
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
            <!-- started with checkout form -->
            <div>
                <div class="details">
                    <div class="card">
                        <div class="card-header">
                            <h2>Repair Details</h2>
                        </div>
                        <div>
                            <button id="edit-button" class="edit-button" title="Edit Repair '<?php if (isset($row_repair)) {
                                                                                                    echo $row_repair['repair_type'];
                                                                                                } ?>'" onclick="EditRepair()"><span class="las la-edit"></span> Edit Repair</button>
                        </div>
                        <div class="form-container card-body">

                            <form action="repair-admin-details.php" method="POST" enctype="multipart/form-data">
                                <div class="form-container-part">

                                    <div>
                                        <h3 class="form-container-part-title">Repair Information</h3>
                                    </div>


                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="repair_id" id="repair_id" value="<?php if (isset($row_repair)) {
                                                                                                            echo $row_repair['repair_id'];
                                                                                                        } ?>" readonly class="is-valid">
                                            <label for="repair_id">Repair ID</label>
                                        </div>

                                        <div class="input-container">

                                            <input type="text" name="repair_type" id="repair_type" value="<?php if (isset($row_repair)) {
                                                                                                                echo $row_repair['repair_type'];
                                                                                                            } ?>" readonly class="is-valid">
                                            <label for="repair_type">Repair Type</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container">
                                            <input type="number" name="price_per_hour" id="price_per_hour" value="<?php if (isset($row_repair)) {
                                                                                                                        echo $row_repair['price_per_hour'];
                                                                                                                    } ?>" readonly class="is-valid">
                                            <label for="price_per_hour">Price Per Hour</label>
                                        </div>
                                    </div>

                                    <div class="form-container-part-inputs">
                                        <div class="input-container description">
                                            <div class="description-body">
                                                <h3>Description</h3>
                                                <p id="description"><?php if (isset($row_repair)) {
                                                                        echo $row_repair['description'];
                                                                    } ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- here to add upload file -->
                                    <div class="form-container-part-inputs">
                                        <div class="input-container product-image">
                                            <div class="image-body">
                                                <h3>Repair Image</h3>
                                                <div id="repair_image">
                                                    <img src='../images/<?php if (isset($row_repair)) {
                                                                            echo $row_repair['image'];
                                                                        } ?>'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" id="edit-repair-submit" class="edit-product-submit" style="visibility: hidden;"><span class="las la-share-square"></span> Apply Changes</button>
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
<script src="repair-admin-details.js"></script>

</html>