<?php

session_start();

include("connection.php");

$username = "";
$password_text = "":

if(isset($_POST["username"]) && $_POST["username"] != ""){
    $username = $_POST["username"];
}
else{
    die("Alert username");
}
if(isset($_POST["password"]) && $_POST["password"] != ""){
    $password_text = $_POST['password'];
    $password = hash("sha256", $password_text);
}
else{
    die("Alert password");
}

$_SESSION['username'] = $username;
$_SESSION['password'] = $password_text;

$statement = $connection->prepare("SELECT customer_id FROM customers WHERE username = '".$username."' ");
$statement->execute();
$statement_result = $statement->get_result();
$data = $statement_result->fetch_assoc();

if(empty($data)){
     $_SESSION['username_error'] = "Username is not found. Please try another username.";
    header("Location: ../login/login.php");
    die("WRONG username");
}
else{
    $logged_id = $data['customer_id'];

    //saving which user is logged in

    $stmt = $connection->prepare("SELECT password FROM customers WHERE username='".$username."' ");
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    $stmt_data = $stmt_result->fetch_assoc();
    if($stmt_data['password'] == $password){
        $_SESSION['logged_id'] = $logged_id;
        $_SESSION['logged_bool'] = true;
        echo "<script>alert('Login successful. Welcome To Newbies Gamers.'); window.location = '../home-page/home-page.php';</script>";
    }
    else{
        $_SESSION['password_error'] = "Password is wrong. Try another password.";
        header("Location: ../login/login.php");
        dies("WRONG password");
    }
}

?>
