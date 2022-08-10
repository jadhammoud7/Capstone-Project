<?php

session_start();

include("connection.php");

if(isset($_POST["username"]) && $_POST["username"] != ""){
    $username = $_POST["username"];
}
else{
    die("Alert username");
}
if(isset($_POST["password"]) && $_POST["password"] != ""){
    $password = hash("sha256", $_POST["password"]);
}
else{
    die("Alert password");
}

$statement = $connection->prepare("SELECT customer_id FROM customers WHERE username = '".$username."' ");
$statement->execute();
$statement_result = $statement->get_result();
$data = $statement_result->fetch_assoc();


$logged_id = $data['customer_id'];

//saving which user is logged in

$stmt = $connection->prepare("SELECT password FROM customers WHERE username='".$username."' ");
$stmt->execute();
$stmt_result = $stmt->get_result();
$stmt_data = $stmt_result->fetch_assoc();
if($stmt_data['password'] == hash("sha256", $password)){
    $_SESSION['logged_user'] = $logged_id;
    // echo "the id of the logged user is :",$_SESSION['logged_user'];
    $_SESSION['logged_bool'] = true;
    // header("Location:../profile/profile.php");
    echo "<script>alert('Login successful');</script>";
    echo "<script>document.getElementById('id01').style.display = 'none';</script>";
}
else{
    echo "<script>alert('Either username or password is invalid')</script>";
    header("Location:../profile/profile.php");
}

?>