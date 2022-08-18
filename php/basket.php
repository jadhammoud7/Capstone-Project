<?php
session_start();

include("connection.php");

$total_price = 0;
$tax_price = 0;
$total_inc_tax = 0;

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
    $stmt_select_product_price = $connection->prepare("SELECT price FROM products WHERE product_id = '" . $product_basket_id . "'");
    $stmt_select_product_price->execute();
    $result_select_product_price = $stmt_select_product_price->get_result();
    $row_select_product_price = $result_select_product_price->fetch_assoc();
    $price = $row_select_product_price['price'];
    $stmt_update_price = $connection->prepare("UPDATE baskets_customer_product SET price = ? WHERE product_id = '" . $product_basket_id . "' AND customer_id = '" . $customer_basket_id . "' ");
    $stmt_update_price->bind_param("i", $price * $_GET['quantity']);
    $stmt_update_price->execute();
    header("Location: '../basket/basket.php'");
}

$select_stmt = $connection->prepare("SELECT product_id FROM baskets_customer_product WHERE product_id = '". $product_id . "' and customer_id = '" . $customer_id . "' ");
$select_stmt->execute();
$select_results = $select_stmt->get_result();
$row_select = $select_results->fetch_assoc();

if(empty($row_select['product_id'])){
    $quantity = 1;
    $stmt_select_product_price = $connection->prepare("SELECT price FROM products WHERE product_id = '" . $product_id . "' ");
    $stmt_select_product_price->execute();
    $result_select_product_price = $stmt_select_product_price->get_result();
    $row_select_product_price = $result_select_product_price->fetch_assoc();
    $stmt = $connection->prepare("INSERT INTO baskets_customer_product(customer_id, product_id, quantity, price) VALUES (?,?,?,?)");
    $stmt->bind_param("iiii", $customer_id, $product_id, $quantity, $row_select_product_price['price']);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Product added to basket'); window.location = '../shop/shop.php';</script>";
}
else{
    $stmt_select_quantity = $connection->prepare("SELECT quantity FROM baskets_customer_product WHERE product_id = '". $product_id . "' AND customer_id = '" . $customer_id ."' ");
    $stmt_select_quantity->execute();
    $select_quantity_results = $stmt_select_quantity->get_result();
    $row_select_quantity = $select_quantity_results->fetch_assoc();
    $quantity = $row_select_quantity['quantity'] + 1;
    $stmt_update_quantity = $connection->prepare("UPDATE baskets_customer_product SET quantity = ? WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id ."'");
    $stmt_update_quantity->bind_param("i", $quantity);
    $stmt_update_quantity->execute();

    $stmt_select_price = $connection->prepare("SELECT price FROM baskets_customer_product WHERE product_id = '". $product_id . "' AND customer_id = '" . $customer_id ."'");
    $stmt_select_price->execute();
    $select_price_results = $stmt_select_price->get_result();
    $row_select_price = $select_price_results->fetch_assoc();
    $price = $row_select_price['price'] * 2;
    $stmt_update_price = $connection->prepare("UPDATE baskets_customer_product SET price = ? WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id ."'");
    $stmt_update_price->bind_param("i", $price);
    $stmt_update_price->execute();

    echo "<script>alert('Product already in basket. Quantity added by 1.'); window.location = '../shop/shop.php';</script>";

}
$stmt_select_all_prices = $connection->prepare("SELECT price FROM baskets_customer_product WHERE customer_id = '" . $customer_id ."' ");
$stmt_select_all_prices->execute();
$select_prices_results = $stmt_select_all_prices->get_result();
//sum all prices in basket
while($row_select_prices = $select_prices_results->fetch_assoc()){
    $total_price = $total_price + $row_select_prices['price'];
}
//tax is 10% total price
$tax_price = $total_price * 0.1;

$total_inc_tax = $total_price + $tax_price;

$_SESSION['total_price'] = $total_price;
$_SESSION['tax_price'] = $tax_price;
$_SESSION['total_price_including_tax'] = $total_inc_tax;


?>
