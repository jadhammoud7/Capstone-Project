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
$query = "SELECT first_name, last_name, username, image FROM admins WHERE admin_id = '" . $admin_id . "' ";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();

//sum of all customers
$query_total_admins = "SELECT COUNT(*) as total_admins FROM admins";
$stmt_total_admins = $connection->prepare($query_total_admins);
$stmt_total_admins->execute();
$results_total_admins = $stmt_total_admins->get_result();
$row_total_admins = $results_total_admins->fetch_assoc();

//count of all appointments
$query_total_appointments = "SELECT COUNT(appointment_id) as total_appointments FROM appointments";
$stmt_total_appointments = $connection->prepare($query_total_appointments);
$stmt_total_appointments->execute();
$results_total_appointments = $stmt_total_appointments->get_result();
$row_total_appointments = $results_total_appointments->fetch_assoc();

//sum of all checkouts
$query_total_price_checkouts = "SELECT SUM(total_price_including_tax) as total_price_checkouts FROM checkouts WHERE status = 'DONE WORK'";
$stmt_total_price_checkouts = $connection->prepare($query_total_price_checkouts);
$stmt_total_price_checkouts->execute();
$results_total_price_checkouts = $stmt_total_price_checkouts->get_result();
$row_total_price_checkouts = $results_total_price_checkouts->fetch_assoc();

$query_total_cost_checkouts = "SELECT SUM(total_cost) as total_cost_checkouts FROM checkouts WHERE status = 'DONE WORK'";
$stmt_total_cost_checkouts = $connection->prepare($query_total_cost_checkouts);
$stmt_total_cost_checkouts->execute();
$results_total_cost_checkouts = $stmt_total_cost_checkouts->get_result();
$row_total_cost_checkouts = $results_total_cost_checkouts->fetch_assoc();

$query_total_price_store_sales = "SELECT SUM(total_price_after_discount) as total_price_store_sales FROM store_sales";
$stmt_total_price_store_sales = $connection->prepare($query_total_price_store_sales);
$stmt_total_price_store_sales->execute();
$results_total_price_store_sales = $stmt_total_price_store_sales->get_result();
$row_total_price_store_sales = $results_total_price_store_sales->fetch_assoc();

$query_total_cost_store_sales = "SELECT SUM(total_cost) as total_cost_store_sales FROM store_sales";
$stmt_total_cost_store_sales = $connection->prepare($query_total_cost_store_sales);
$stmt_total_cost_store_sales->execute();
$results_total_cost_store_sales = $stmt_total_cost_store_sales->get_result();
$row_total_cost_store_sales = $results_total_cost_store_sales->fetch_assoc();

$total_profit = $row_total_price_checkouts['total_price_checkouts'] - $row_total_cost_checkouts['total_cost_checkouts'] + $row_total_price_store_sales['total_price_store_sales'] - $row_total_cost_store_sales['total_cost_store_sales'];

//get total checkouts made
$query_total_checkouts = "SELECT COUNT(checkout_id) as total_checkout FROM checkouts";
$stmt_total_checkouts = $connection->prepare($query_total_checkouts);
$stmt_total_checkouts->execute();
$results_total_checkouts = $stmt_total_checkouts->get_result();
$row_total_checkouts = $results_total_checkouts->fetch_assoc();

//get all customer
require_once("../php/admin_page_php.php");
$query_admins = "SELECT admin_id, first_name, last_name, email_address, phone_number, username, password FROM admins";
$stmt_admins = $connection->prepare($query_admins);
$stmt_admins->execute();
$results_admins = $stmt_admins->get_result();

if (isset($_POST["first_name"]) && $_POST["first_name"] != "") {
    $first_name = $_POST["first_name"];
    $_SESSION['first_name'] = $first_name;
    for ($i = 0; $i < strlen($first_name); $i++) {
        if (is_numeric($first_name[$i])) {
            $_SESSION['first_name_error'] = "First Name should not contain numbers";
            header("Location: admin-admin.php?open_add_user=true");
            die("WRONG first name");
        }
    }
}
if (isset($_POST["last_name"]) && $_POST["last_name"] != "") {
    $last_name = $_POST["last_name"];
    $_SESSION['last_name'] = $last_name;
    for ($i = 0; $i < strlen($last_name); $i++) {
        if (is_numeric($last_name[$i])) {
            $_SESSION['last_name_error'] = "Last Name should not contain numbers";
            header("Location: ../admin-admin/admin-admin.php?open_add_user=true");
            die("WRONG last name");
        }
    }
}

if (isset($_POST["email"]) && $_POST["email"] != "") {
    $email = $_POST["email"];
    $_SESSION['email'] = $email;
    if (!str_contains($email, ".com") && !str_contains($email, "@")) {
        $_SESSION['email_error'] = "Email is invalid";
        header("Location: admin-admin.php?open_add_user=true");
        die("WRONG email");
    }
}

if (isset($_POST["phone_number"]) && $_POST["phone_number"] != "") {
    $phone_number = $_POST["phone_number"];
    $_SESSION['phone_number'] = $phone_number;
    for ($j = 0; $j < strlen($phone_number); $j++) {
        //phone number should be fully numeric
        if (!is_numeric($phone_number[$j])) {
            $_SESSION['phone_number_error'] = "Phone number should not contain any characters other than numbers";
            header("Location: admin-admin.php?open_add_user=true");
            die("WRONG Phone Number");
        }
    }
}

if (isset($_POST["username"]) && $_POST["username"] != "") {
    $username = $_POST["username"];
    $_SESSION['username'] = $username;
    //select all admins of same username
    $select_check_username = $connection->prepare("SELECT * FROM admins WHERE username = '" . $username . "'");
    $select_check_username->execute();
    $results_check_username = $select_check_username->get_result();
    $data_check_username = $results_check_username->fetch_assoc();

    //if there is an admin of same username, then error
    if (!empty($data_check_username)) {
        $_SESSION['username_error'] = "Username is already taken. Try another one.";
        header("Location: admin-admin.php?open_add_user=true");
        die("WRONG username");
    }
    //if username has size less than 5, then error
    if (strlen($username) < 5) {
        $_SESSION['username_error'] = "Username should be of length 5 minimum";
        header("Location: admin-admin.php?open_add_user=true");
        die("WRONG username");
    }
}

if (isset($_POST["password"]) && $_POST["password"] != "") {
    $password_text = $_POST["password"];
    $_SESSION['password'] = $password_text;
    //password should have size of at least 8
    if (strlen($password_text) < 8) {
        $_SESSION['password_error'] = "Password should be of length 8 minimum";
        header("Location: admin-admin.php?open_add_user=true");
        die("WRONG password");
    }
    //password should not be fully numeric
    if (is_numeric($password_text)) {
        $_SESSION['password_error'] = "Password should not be numeric, should contain characters";
        header("Location: admin-admin.php?open_add_user=true");
        die("WRONG password");
    }
    //check if password has special characters
    if (!str_contains($password_text, '@') && !str_contains($password_text, '_') && !str_contains($password_text, "-") && !str_contains($password_text, ".")) {
        $_SESSION['password_error'] = 'Password should contain special characters such as "@", "_", "-", or "."';
        header("Location: admin-admin.php?open_add_user=true");
        die("WRONG password");
    }
    $password = hash("sha256", $password_text);
}

if ($first_name != "" && $last_name != "" && $email != "" && $phone_number != "" && $username != "" && $password != "") {
    mkdir('../images/Admins/' . $username);

    $target_dir = '../images/Admins/' . $username . '/';
    $filename = basename($_FILES['admin_image']['name']);
    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {

        //uploaded file will have same name as customer username
        if (move_uploaded_file($_FILES['admin_image']['tmp_name'], $target_file)) {
            $admin_image = $filename;
            //all inputs are valid and no errors, then insert new admin
            $stmt_add_new_admin = $connection->prepare("INSERT INTO admins(first_name, last_name, email_address, phone_number, username, password, image) VALUES (?,?,?,?,?,?,?)");
            $stmt_add_new_admin->bind_param("sssssss", $first_name, $last_name, $email, $phone_number, $username, $password, $admin_image);
            $stmt_add_new_admin->execute();
            $stmt_add_new_admin->close();

            echo "<script>window.location='../admin-admin/admin-admin.php';</script>";
        }
    }
}

//delete customer
if (isset($_GET['getAdminIDtoRemove'])) {
    $remove_admin_id = $_GET['getAdminIDtoRemove'];
    $stmt_delete_admin = $connection->prepare("DELETE FROM admins WHERE admin_id='" . $remove_admin_id . "' ");
    $stmt_delete_admin->execute();
    echo "<script>window.location='../admin-admin/admin-admin.php';</script>";
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
    <link rel="stylesheet" href="admin-admin.css">
    <link rel="stylesheet" href="../admin-main/admin-main.css">
    <title>Admin | Admin Accounts - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

    <!-- started popup message login successful -->
    <div class="popup" id="remove-confirmation">
        <img src="../images/question-mark.png" alt="remove confirmation">
        <h2>Delete Confirmation</h2>
        <p id="remove-confirmation-text"></p>
        <button type="button" onclick="DeleteAdmin()">YES</button>
        <button type="button" onclick="CloseRemoveAdminPopUp()">NO</button>
    </div>

    <!-- started popup message logout -->
    <div class="popup" id="logout-confirmation">
        <img src="../images/question-mark.png" alt="">
        <h2>Log Out Confirmation</h2>
        <p>Are you sure that you want to logout?</p>
        <button type="button" onclick="GoToLogIn()">YES</button>
        <button type="button" onclick="CloseLogOutPopUp()">NO</button>
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
                Admin Accounts
            </h2>

            <div class="user-wrapper">
                <img src="../images/Admins/<?php echo $row['username']; ?>/<?php echo $row['image']; ?>" width="40px" height="40px" alt="">
                <div>
                    <h4> <?php echo $row["first_name"], " ", $row['last_name']; ?></h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>

        <main>
            <div class="cards">
                <div class="card-single" title="This is the total number of admins">
                    <div>
                        <h1><?php echo  $row_total_admins['total_admins']; ?></h1>
                        <span>Admins</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total number of appointments scheduled by customers">
                    <div>
                        <h1><?php echo $row_total_appointments['total_appointments'] ?></h1>
                        <span>Appointments</span>
                    </div>
                    <div>
                        <span class="las la-clipboard"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total number of checkout orders sent by customers">
                    <div>
                        <h1><?php echo $row_total_checkouts['total_checkout'] ?></h1>
                        <span>Chekouts</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single" title="This is the total profits of the shop">
                    <div>
                        <h1>$<?php echo $total_profit; ?></h1>
                        <span>Profit</span>
                    </div>
                    <div>
                        <span class="las la-wallet"></span>
                    </div>
                </div>
            </div>

            <div class="card-single add_admin">
                <button class="add_user" id="add_user1" onclick="OpenAddUser()" title="Add new admin account, such as employee or owner account"><span class="las la-plus"></span>Add Admin Account</button>
            </div>
            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>List of Admin Accounts</h3>
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
                                    <input type="text" id="SearchInput" onkeyup="FilterTable()" placeholder="Search in table Admins...">
                                </div>
                                <table width="100%" id="admins_table">
                                    <thead>
                                        <tr>
                                            <td id="name-column" title="Sort Name by descending">Name</td>
                                            <td id="username-column" title="Sort Username by descending">Username</td>
                                            <td id="email-column" title="Sort Email Address by descending">Email Address</td>
                                            <td id="phone-number-column" title="Sort Phone Number by descending">Phone Number</td>
                                            <td>Remove Admin</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row_admin = $results_admins->fetch_assoc()) {
                                            get_all_admins_connection(
                                                $row_admin['admin_id'],
                                                $row_admin['first_name'],
                                                $row_admin['last_name'],
                                                $row_admin['username'],
                                                $row_admin['email_address'],
                                                $row_admin['phone_number']
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

            <div id="id01" class="modal">
                <span onclick="CloseAddUser()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content" action="../admin-admin/admin-admin.php" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <h1 class="title">Create New Admin Account</h1>
                        <p class="title">Please fill in this form to create a new admin account.</p>
                        <hr>
                        <p class="error" id="first_name_error">
                            <?php
                            session_start();
                            if (isset($_SESSION['first_name_error'])) {
                                echo "<script>document.getElementById('first_name_error').style.display='block';</script>";
                                echo $_SESSION['first_name_error'];
                                unset($_SESSION['first_name_error']);
                            } ?>
                        </p>
                        <label for="first_name"><b>First Name</b></label>
                        <input type="text" placeholder="Enter your first name" name="first_name" id="first_name" value="<?php if (isset($_SESSION['first_name'])) {
                                                                                                                            echo $_SESSION['first_name'];
                                                                                                                        } ?>" required />

                        <p class="error" id="last_name_error">
                            <?php
                            if (isset($_SESSION['last_name_error'])) {
                                echo "<script>document.getElementById('last_name_error').style.display='block';</script>";
                                echo $_SESSION['last_name_error'];
                                unset($_SESSION['last_name_error']);
                            } ?>
                        </p>
                        <label for="last_name"><b>Last Name</b></label>
                        <input type="text" placeholder="Enter your last name" name="last_name" id="last_name" value="<?php if (isset($_SESSION['last_name'])) {
                                                                                                                            echo $_SESSION['last_name'];
                                                                                                                        } ?>" required>

                        <p class="error" id="email_error">
                            <?php
                            if (isset($_SESSION['email_error'])) {
                                echo "<script>document.getElementById('email_error').style.display='block';</script>";
                                echo $_SESSION['email_error'];
                                unset($_SESSION['email_error']);
                            } ?>
                        </p>
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="Enter Email" name="email" id="email" value="<?php if (isset($_SESSION['email'])) {
                                                                                                        echo $_SESSION['email'];
                                                                                                    } ?>" required>

                        <p class="error" id="phone_number_error">
                            <?php
                            if (isset($_SESSION['phone_number_error'])) {
                                echo "<script>document.getElementById('phone_number_error').style.display='block';</script>";
                                echo $_SESSION['phone_number_error'];
                                unset($_SESSION['phone_number_error']);
                            } ?>
                        </p>
                        <label for="phone_number"><b>Phone Number</b></label>
                        <input type="text" placeholder="Enter your phone number" name="phone_number" id="phone_number" value="<?php if (isset($_SESSION['phone_number'])) {
                                                                                                                                    echo $_SESSION['phone_number'];
                                                                                                                                } ?>" required> <br> <br>

                        <p class="error" id="username_error">
                            <?php
                            if (isset($_SESSION['username_error'])) {
                                echo "<script>document.getElementById('username_error').style.display='block';</script>";
                                echo $_SESSION['username_error'];
                                unset($_SESSION['username_error']);
                            } ?>
                        </p>
                        <label for="username"><b>Username</b></label>
                        <input type="text" placeholder="Enter username of your own" name="username" id="username" value="<?php if (isset($_SESSION['username'])) {
                                                                                                                                echo $_SESSION['username'];
                                                                                                                            } ?>" required>

                        <label><b>Upload Profile Image:</b></label>
                        <br>
                        <input type="file" title="Choose from your files an image for your profile" name="admin_image" id="admin_image" value="" required>
                        <br>

                        <p class="error" id="password_error">
                            <?php
                            if (isset($_SESSION['password_error'])) {
                                echo "<script>document.getElementById('password_error').style.display='block';</script>";
                                echo $_SESSION['password_error'];
                                unset($_SESSION['password_error']);
                            } ?>
                        </p>
                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" id="password" value="<?php if (isset($_SESSION['password'])) {
                                                                                                                        echo $_SESSION['password'];
                                                                                                                    } ?>" required>


                        <div class="clearfix">
                            <button type="submit" class="signupbtn" title="Add new admin user"><strong><span class="las la-user-tie"></span> Add Admin User</strong></button>
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
<script src="../admin-admin/admin-admin.js"></script>
<script src="../admin-main/admin-main.js"></script>

</html>