<?php
session_start();

include("connection.php");

if (isset($_POST["first_name"]) && $_POST["first_name"] != "") {
    $first_name = $_POST["first_name"];
    for ($i = 0; $i < strlen($first_name); $i++) {
        $_SESSION['first_name_error'] = "First Name should not contain numbers";
        die("WRONG first name");
    }
}

if (isset($_POST["last_name"]) && $_POST["last_name"] != "") {
    $last_name = $_POST["last_name"];
}

if (isset($_POST["email"]) && $_POST["email"] != "") {
    $email = $_POST["email"];
    if (!str_contains($email, ".com") && !str_contains($email, "@")) {
        header("Location: ../signup/signup.php?email_error=Email is invalid");
        die("WRONG email");
    }
}
if (isset($_POST["date_of_birth"]) && $_POST["date_of_birth"] != "") {
    $date_of_birth = $_POST["date_of_birth"];
}

if (isset($_POST["phone_number"]) && $_POST["phone_number"] != "") {
    $phone_number = $_POST["phone_number"];
}

if (isset($_POST["address"]) && $_POST["address"] != "") {
    $address = $_POST["address"];
    if (is_numeric($address)) {
        header("Location: ../signup/signup.php?address_error=Address should not be numeric");
        die("WRONG address");
    }
    if (strlen($address) < 10) {
        header("Location: ../signup/signup.php?address_error=Address should be of length 10 minimum");
        die("WRONG address");
    }
}

if (isset($_POST["username"]) && $_POST["username"] != "") {
    $username = $_POST["username"];
    if (is_numeric($username)) {
        header("Location: ../signup/signup.php?username_error=Username should not be numeric");
        die("WRONG username");
    }
    if (strlen($username) < 5) {
        header("Location: ../signup/signup.php?email_error=Username should be of length 5 minimum");
        die("WRONG username");
    }
}

if (isset($_POST["password"]) && $_POST["password"] != "") {
    $password_text = $_POST["password"];
    if (strlen($password_text) < 8) {
        header("Location: ../signup/signup.php?password_error=Password should be of length 8 minimum");
        die("WRONG password");
    }
    if (is_numeric($password_text)) {
        header("Location: ../signup/signup.php?password_error=Password should not be numeric, should contain characters.");
        die("WRONG password");
    }
    $password = hash("sha256", $password_text);
}

$mysql = $connection->prepare("INSERT INTO customers(first_name, last_name, email, date_of_birth, phone_number, address, username, password) VALUES (?,?,?,?,?,?,?,?)");
$mysql->bind_param("ssssssss", $first_name, $last_name, $email, $date_of_birth, $phone_number, $address, $username, $password);
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
echo "the id of the logged user is :", $_SESSION['logged_id'];
//saving which user is logged in
