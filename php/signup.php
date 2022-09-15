<?php
session_start();

include("connection.php");

if (isset($_POST["first_name"]) && $_POST["first_name"] != "") {
    $first_name = $_POST["first_name"];
    $_SESSION['first_name'] = $first_name;
    for ($i = 0; $i < strlen($first_name); $i++) {
        if (is_numeric($first_name[$i])) {
            $_SESSION['first_name_error'] = "First Name should not contain numbers";
            header("Location: ../signup/signup.php");
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
            header("Location: ../signup/signup.php");
            die("WRONG last name");
        }
    }
}

if (isset($_POST["email"]) && $_POST["email"] != "") {
    $email = $_POST["email"];
    $_SESSION['email'] = $email;
    if (!str_contains($email, ".com") && !str_contains($email, "@")) {
        $_SESSION['email_error'] = "Email is invalid";
        header("Location: ../signup/signup.php");
        die("WRONG email");
    }
}
if (isset($_POST["date_of_birth"]) && $_POST["date_of_birth"] != "") {
    $date_of_birth = $_POST["date_of_birth"];
    $_SESSION['date_of_birth'] = $date_of_birth;
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

if (isset($_POST["address"]) && $_POST["address"] != "") {
    $address = $_POST["address"];
    $_SESSION['address'] = $address;
    if (is_numeric($address)) {
        $_SESSION['address_error'] = "Address should not be numeric";
        header("Location: ../signup/signup.php");
        die("WRONG address");
    }
    if (strlen($address) < 10) {
        $_SESSION['address_error'] = "Address should be of lenght 10 minimum";
        header("Location: ../signup/signup.php");
        die("WRONG address");
    }
}

if (isset($_POST["city"]) && $_POST["city"] != "") {
    $city = $_POST["city"];
    $city1="";
    $_SESSION['city'] = $city;
    $city1=strtolower($city);
    if (is_numeric($city)) {
        $_SESSION['city_error'] = "City should not be numeric";
        header("Location: ../signup/signup.php");
        die("WRONG city");
    }
}

if (isset($_POST["username"]) && $_POST["username"] != "") {
    $username = $_POST["username"];
    $_SESSION['username'] = $username;
    $query_check_username = "SELECT * FROM customers WHERE username = '" . $username . "'";
    $select_check_username = $connection->prepare($query_check_username);
    $select_check_username->execute();
    $results_check_username = $select_check_username->get_result();
    $data_check_username = $results_check_username->fetch_assoc();

    if (!empty($data_check_username)) {
        $_SESSION['username_error'] = "Username is already taken. Try another one.";
        header("Location: ../signup/signup.php");
        die("WRONG username");
    }
    if (strlen($username) < 5) {
        $_SESSION['username_error'] = "Username should be of length 5 minimum";
        header("Location: ../signup/signup.php");
        die("WRONG username");
    }
}

if (isset($_POST["password"]) && $_POST["password"] != "") {
    $password_text = $_POST["password"];
    $_SESSION['password'] = $password_text;
    if (strlen($password_text) < 8) {
        $_SESSION['password_error'] = "Password should be of length 8 minimum";
        header("Location: ../signup/signup.php");
        die("WRONG password");
    }
    if (is_numeric($password_text)) {
        $_SESSION['password_error'] = "Password should not be numeric, should contain characters";
        header("Location: ../signup/signup.php");
        die("WRONG password");
    }
    $password = hash("sha256", $password_text);
}

$mysql = $connection->prepare("INSERT INTO customers(first_name, last_name, email, date_of_birth, phone_number, address,city, username, password) VALUES (?,?,?,?,?,?,?,?,?)");
$mysql->bind_param("sssssssss", $first_name, $last_name, $email, $date_of_birth, $phone_number, $address,$city1, $username, $password);
$mysql->execute();
$mysql->close();
// header("Location:../home-page/home-page.php");

//getting the id of this user to that when he/she has signed up there id will be saved
$statement1 = $connection->prepare("SELECT customer_id FROM customers WHERE username = '" . $username . "' ");
$statement1->execute();
$statement_result1 = $statement1->get_result();
$data1 = $statement_result1->fetch_assoc();

$logged_id1 = $data1['customer_id'];
$_SESSION['logged_id'] = $logged_id1;
echo "<script>window.location='../signup/signup.php?account_created=true';</script>";

// echo "the id of the logged user is :", $_SESSION['logged_id'];
//saving which user is logged in
