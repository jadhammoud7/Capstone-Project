<?php

session_start();

include("connection.php");

$username = "";
$password_text = "";

if (isset($_POST["username"])) {
    $username = $_POST["username"];
}

if (isset($_POST["password"])) {
    $password_text = $_POST['password'];

    //hash password using sha256
    $password = hash("sha256", $password_text);
}

//if username is empty
if ($username == "") {
    $_SESSION['login_error'] = 'Please enter a value for username';
    header("Location: ../login/login.php");
    die("EMPTY username");
} else if ($password == "") {
    $_SESSION['login_error'] = 'Please enter a value for password';
    header("Location: ../login/login.php");
    die("EMPTY password");
} else {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password_text;

    //select admin of same username enetered
    $stmt_admins = $connection->prepare("SELECT admin_id FROM admins WHERE username = '" . $username . "' ");
    $stmt_admins->execute();
    $stmt_admins_result = $stmt_admins->get_result();
    $row_admin = $stmt_admins_result->fetch_assoc();

    //select customer of same username entered
    $stmt_customers = $connection->prepare("SELECT customer_id FROM customers WHERE username = '" . $username . "' ");
    $stmt_customers->execute();
    $stmt_customers_result = $stmt_customers->get_result();
    $row_customer = $stmt_customers_result->fetch_assoc();

    if (empty($row_admin)) {
        //if no admin account found, try for customers
        if (empty($row_customer)) {
            $_SESSION['login_error'] = "Either username or password is invalid. Please try again.";
            header("Location: ../login/login.php");
            die("WRONG username");
        } else {
            $logged_id = $row_customer['customer_id'];
            $logged_type = 'customer';
            //saving which user is logged in
            $stmt = $connection->prepare("SELECT password FROM customers WHERE username='" . $username . "' ");
            $stmt->execute();
            $stmt_result = $stmt->get_result();
            $stmt_data = $stmt_result->fetch_assoc();
            //if password is correct
            if ($stmt_data['password'] == $password) {
                $_SESSION['logged_type'] = $logged_type;
                $_SESSION['logged_id'] = $logged_id;
                $_SESSION['logged_bool'] = true;
                echo "<script>window.location = '../home-page/home-page.php?login=true';</script>";
            } else {//password incorrect
                $_SESSION['login_error'] = "Either username or password is invalid. Please try again.";
                header("Location: ../login/login.php");
                die("WRONG password");
            }
        }
    } else {//if customer is admin
        $logged_id = $row_admin['admin_id'];
        $logged_type = 'admin';
        //saving which user is logged in
        $stmt = $connection->prepare("SELECT password FROM admins WHERE username='" . $username . "' ");
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        $stmt_data = $stmt_result->fetch_assoc();
        if ($stmt_data['password'] == $password) {
            $_SESSION['logged_type'] = $logged_type;
            $_SESSION['logged_id'] = $logged_id;
            $_SESSION['logged_bool'] = true;
            echo "<script>window.location = '../home-admin/home-admin.php?login=true';</script>";
        } else {
            $_SESSION['login_error'] = "Either username or password is invalid. Please try again.";
            header("Location: ../login/login.php");
            die("WRONG password");
        }
    }
}
