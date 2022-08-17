<?php

session_start();

include("connection.php");

if(isset($_GET['customerID']) && $_GET['customerID'] != ""){
    $customer_id = $_GET['customerID'];
    $select_customer = $connection->prepare("SELECT first_name, last_name, email, phone_number FROM customers WHERE customer_id = '" . $customer_id . "'");
    $select_customer->execute();
    $select_customer_results = $select_customer->get_result();
    $row_customer = $select_customer_results->fetch_assoc();
    $_SESSION['first_name'] = $row_customer['first_name'];
    $_SESSION['last_name'] = $row_customer['last_name'];
    $_SESSION['email'] = $row_customer['email'];
    $_SESSION['phone_number'] = $row_customer['phone_number']; 
}

?>