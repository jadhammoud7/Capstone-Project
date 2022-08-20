<?php

session_start();
include("connection.php");


if (isset($_GET['productID']) && $_GET['productID'] != "") {
    $product_id = $_GET['productID'];
}
if(isset($_POST['quantity']) && $_POST['quantity'] != ""){
    $quantity = $_POST['quantity'];
}
if (isset($_SESSION['logged_id'])) {
    $customer_id = $_SESSION['logged_id'];
}

if(isset($product_id) && isset($quantity) && isset($customer_id)){
    $update_quantity_stmt = $connection->prepare("UPDATE baskets_customer_product SET quantity = ? WHERE product_id = '" . $product_id ."' AND customer_id = '" . $customer_id . "'");
    $update_quantity_stmt->bind_param("i", $quantity);
    $update_quantity_stmt->execute();
    header("Location: ../basket/basket.php");
}

?>