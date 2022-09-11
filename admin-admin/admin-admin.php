<?php

session_start();

include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
$admin_id = $_SESSION['logged_id'];
$query = "SELECT first_name, last_name FROM admins WHERE admin_id = '" . $admin_id . "' ";
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
            header("Location: ../admin-admin/admin-admin.php?open_add_user=true");
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
        header("Location: ../admin-admin/admin-admin.php?open_add_user=true");
        die("WRONG email");
    }
}

if (isset($_POST["phone_number"]) && $_POST["phone_number"] != "") {
    $phone_number = $_POST["phone_number"];
    $_SESSION['phone_number'] = $phone_number;
    for ($j = 0; $j < strlen($phone_number); $j++) {
        if (!is_numeric($phone_number[$j])) {
            $_SESSION['phone_number_error'] = "Phone number should not contain any characters other than numbers";
            header("Location: ../signup/signup.php");
            die("WRONG Phone Number");
        }
    }
}

if (isset($_POST["username"]) && $_POST["username"] != "") {
    $username = $_POST["username"];
    $_SESSION['username'] = $username;
    $query_check_username = "SELECT * FROM admins WHERE username = '" . $username . "'";
    $select_check_username = $connection->prepare($query_check_username);
    $select_check_username->execute();
    $results_check_username = $select_check_username->get_result();
    $data_check_username = $results_check_username->fetch_assoc();

    if (!empty($data_check_username)) {
        $_SESSION['username_error'] = "Username is already taken. Try another one.";
        header("Location: ../admin-admin/admin-admin.php?open_add_user=true");
        die("WRONG username");
    }
    if (strlen($username) < 5) {
        $_SESSION['username_error'] = "Username should be of length 5 minimum";
        header("Location: ../admin-admin/admin-admin.php?open_add_user=true");
        die("WRONG username");
    }
}

if (isset($_POST["password"]) && $_POST["password"] != "") {
    $password_text = $_POST["password"];
    $_SESSION['password'] = $password_text;
    if (strlen($password_text) < 8) {
        $_SESSION['password_error'] = "Password should be of length 8 minimum";
        header("Location: ../admin-admin/admin-admin.php?open_add_user=true");
        die("WRONG password");
    }
    if (is_numeric($password_text)) {
        $_SESSION['password_error'] = "Password should not be numeric, should contain characters";
        header("Location: '../admin-admin/admin-admin.php?open_add_user=true");
        die("WRONG password");
    }
    $password = hash("sha256", $password_text);
}

$mysql = $connection->prepare("INSERT INTO admins(first_name, last_name, email_address, phone_number, username, password) VALUES (?,?,?,?,?,?)");
$mysql->bind_param("ssssss", $first_name, $last_name, $email, $phone_number, $username, $password);
$mysql->execute();
$mysql->close();

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
    <link rel="stylesheet" href="admin-admin.css">
    <link rel="stylesheet" href="../home-admin/home-admin.css">
    <title>Admin | Admin Accounts - Newbies Gamers</title>
</head>

<body onunload="myFunction()">

    <!-- started popup message login successful -->
    <!-- <div class="popup" id="login-confirmation">
        <img src="../images/tick.png" alt="successfully logged in">
        <h2>Login Successful</h2>
        <p>Welcome to Newbies Gamers</p>
        <button type="button" onclick="RemoveLogInPopUp()">OK</button>
    </div> -->

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
                    <a href="../home-admin/home-admin.php">
                        <span class="las la-igloo" class="active"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../customer-admin/customer-admin.php">
                        <span class="las la-users"></span>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-clipboard-list"></span>
                        <span>Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-receipt"></span>
                        <span>Checkouts</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-product-hunt"></span>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="../admin-admin/admin-admin.php">
                        <span class="las la-user-circle"></span>
                        <span> Admin Accounts</span>
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

            <div class="card-single add_admin">
                <button class="add_user" id="add_user1" onclick="OpenAddUser()" title="Add new admin account, such as employee or owner account"><span class="las la-plus"></span>Add Admin Account</button>
            </div>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>List of Admin Accounts</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Username</td>
                                            <td>Email Address</td>
                                            <td>Phone Number</td>
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
                <form class="modal-content" action="../admin-admin/admin-admin.php" method="POST">
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
                            <button type="submit" class="signupbtn" title="Add new admin user"><strong>Add User</strong></button>
                        </div>
                    </div>
                </form>
        </main>
    </div>

    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->

</body>
<script src="../admin-admin/admin-admin.js"></script>
<script>

</script>

</html>
</php>