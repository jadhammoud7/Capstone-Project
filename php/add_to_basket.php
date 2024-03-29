<?php

session_start();
include("connection.php");

$total_price = 0;
$tax_price = 0;
$total_inc_tax = 0;

if (isset($_GET['productID'])) {
    $product_id = $_GET['productID'];
}
if (isset($_SESSION['logged_id'])) {
    $customer_id = $_SESSION['logged_id'];
}

if (isset($product_id)) {
    $select_stmt = $connection->prepare("SELECT product_id FROM baskets_customer_product WHERE product_id = '" . $product_id . "' and customer_id = '" . $customer_id . "' ");
    $select_stmt->execute();
    $select_results = $select_stmt->get_result();
    $row_select = $select_results->fetch_assoc();

    if (empty($row_select)) {
        $quantity = 1;
        //if selected quantity in product info
        if (isset($_GET['quantities'])) {
            $quantity = $_GET['quantities'];
        }
        //check if product is in offer
        $currentDate = (new DateTime())->format('Y-m-d');
        $stmt_select_product_offer = $connection->prepare("SELECT * FROM products_offers WHERE product_id = '" . $product_id . "' AND '" . $currentDate . "' BETWEEN offer_begin_date AND offer_end_date");
        $stmt_select_product_offer->execute();
        $result_select_product_offer = $stmt_select_product_offer->get_result();
        $row_select_product_offer = $result_select_product_offer->fetch_assoc();

        $price = 0;
        $cost = 0;

        //if product not in offer, then select current price
        if (empty($row_select_product_offer)) {
            $stmt_select_product_price = $connection->prepare("SELECT unit_cost, unit_price FROM products WHERE product_id = '" . $product_id . "' ");
            $stmt_select_product_price->execute();
            $result_select_product_price = $stmt_select_product_price->get_result();
            $row_select_product_price = $result_select_product_price->fetch_assoc();
            $price = $row_select_product_price['unit_price'] * $quantity;
            $cost = $row_select_product_price['unit_cost'] * $quantity;
        } else {
            //select new price in offer
            $price = $row_select_product_offer['new_price'] * $quantity;

            $stmt_select_product_price = $connection->prepare("SELECT unit_cost, unit_price FROM products WHERE product_id = '" . $product_id . "' ");
            $stmt_select_product_price->execute();
            $result_select_product_price = $stmt_select_product_price->get_result();
            $row_select_product_price = $result_select_product_price->fetch_assoc();
            $cost = $row_select_product_price['unit_cost'] * $quantity;
        }

        $stmt_insert_baskets_customer = $connection->prepare("INSERT INTO baskets_customer_product(customer_id, product_id, quantity, cost, price) VALUES (?,?,?,?,?)");
        $stmt_insert_baskets_customer->bind_param("iiiii", $customer_id, $product_id, $quantity, $cost, $price);
        $stmt_insert_baskets_customer->execute();
        $stmt_insert_baskets_customer->close();
        echo "<script>window.location = '../shop/shop.php?add_to_basket=true';</script>";
    } else {
        $stmt_select_quantity = $connection->prepare("SELECT quantity FROM baskets_customer_product WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "' ");
        $stmt_select_quantity->execute();
        $select_quantity_results = $stmt_select_quantity->get_result();
        $row_select_quantity = $select_quantity_results->fetch_assoc();
        $quantity = $row_select_quantity['quantity'] + 1;
        if (isset($_GET['quantities'])) {
            $quantity = $row_select_quantity['quantity'] + $_GET['quantities'];
        }
        $stmt_update_quantity = $connection->prepare("UPDATE baskets_customer_product SET quantity = ? WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "'");
        $stmt_update_quantity->bind_param("i", $quantity);
        $stmt_update_quantity->execute();

        $stmt_select_price = $connection->prepare("SELECT cost, price FROM baskets_customer_product WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "'");
        $stmt_select_price->execute();
        $select_price_results = $stmt_select_price->get_result();
        $row_select_price = $select_price_results->fetch_assoc();

        $price = $row_select_price['price'] * 2;
        $cost = $row_select_price['cost'] * 2;

        $stmt_update_price = $connection->prepare("UPDATE baskets_customer_product SET price = ?, cost = ? WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "'");
        $stmt_update_price->bind_param("ii", $price, $cost);
        $stmt_update_price->execute();

        echo "<script>window.location = '../shop/shop.php?found_in_basket=true';</script>";
    }
}
