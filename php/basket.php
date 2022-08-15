<?php
session_start();

include("connection.php");

if (isset($_GET['productID']) && $_GET['productID'] != "") {
    $product_id = $_GET['productID'];
}
if (isset($_SESSION['logged_id'])) {
    $customer_id = $_SESSION['logged_id'];
}
$stmt = $connection->prepare("INSERT INTO baskets_customer_product(customer_id, product_id) VALUES (?,?)");
$stmt->bind_param("ii", $customer_id, $product_id);
$stmt->execute();
$stmt->close();

echo "<script>alert('Product added to basket'); window.location = '../shop/shop.php';</script>";

?>