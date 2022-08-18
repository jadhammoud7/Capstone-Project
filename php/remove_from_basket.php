<?php

session_start();
include("connection.php");

if(isset($_GET['productID']) && isset($_SESSION['logged_id'])){
    $customer_id = $_SESSION['logged_id'];
    $product_id = $_GET['productID'];
    $delete_stmt = $connection->prepare("DELETE FROM baskets_customer_product WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "' ");
    $delete_stmt->execute();
    echo "<script>alert('The product was removed from your shopping basket'); window.location.href = '../basket/basket.php';</script>";
}


?>