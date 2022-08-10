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
if($stmt_data['password'] == $password){
    $_SESSION['logged_user'] = $logged_id;
    echo "the id of the logged user is :",$_SESSION['logged_user'];
    


    // $_SESSION['logged_bool'] = true;
    // header("Location:../home-page/home-page.php");
}
else{
    header("Location:../profile/profile.php");
}

?>