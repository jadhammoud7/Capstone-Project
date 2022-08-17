<?php
session_start();

include("connection.php");

if (isset($_GET['productID']) && $_GET['productID'] != "") {
    $product_id = $_GET['productID'];
}
if (isset($_SESSION['logged_id'])) {
    $customer_id = $_SESSION['logged_id'];
}

if(isset($_GET['productRemoveID'])){
    $product_id = $_GET['productRemoveID'];
    $delete_stmt = $connection->prepare("DELETE FROM baskets_customer_product WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "'");
    $delete_stmt->execute();
    echo "<script>alert('The product was removed from your shopping basket'); window.location = '../basket/basket.php';</script>";
}

if(isset($_GET['productBasketID']) && isset($_GET['customerBasketID']) && isset($_GET['quantity'])){
    $product_basket_id = $_GET['productBasketID'];
    $customer_basket_id = $_GET['customerBasketID'];
    $stmt_update_quantity = $connection->prepare("UPDATE baskets_customer_product SET quantity = ? WHERE product_id = '" . $product_basket_id . "' and customer_id = '" . $customer_basket_id ."'");
    $stmt_update_quantity->bind_param("i", $_GET['quantity']);
    $stmt_update_quantity->execute();
    header("Location: '../basket/basket.php'");
}

$select_stmt = $connection->prepare("SELECT product_id FROM baskets_customer_product WHERE product_id = '". $product_id . "' and customer_id = '" . $customer_id . "' ");
$select_stmt->execute();
$select_results = $select_stmt->get_result();
$row_select = $select_results->fetch_assoc();

if(empty($row_select['product_id'])){
    $quantity = 1;
    $stmt = $connection->prepare("INSERT INTO baskets_customer_product(customer_id, product_id, quantity) VALUES (?,?,?)");
    $stmt->bind_param("iii", $customer_id, $product_id, $quantity);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Product added to basket'); window.location = '../shop/shop.php';</script>";
}
else{
    $stmt_select_quantity = $connection->prepare("SELECT quantity FROM baskets_customer_product WHERE product_id = '". $product_id . "' ");
    $stmt_select_quantity->execute();
    $select_quantity_results = $stmt_select_quantity->get_result();
    $row_select_quantity = $select_quantity_results->fetch_assoc();
    $quantity = $row_select_quantity['quantity'] + 1;
    $stmt_update_quantity = $connection->prepare("UPDATE baskets_customer_product SET quantity = ? WHERE product_id = '" . $product_id . "'");
    $stmt_update_quantity->bind_param("i", $quantity);
    $stmt_update_quantity->execute();
    echo "<script>alert('Product already in basket. Quantity added by 1.'); window.location = '../shop/shop.php';</script>";

}

?>
