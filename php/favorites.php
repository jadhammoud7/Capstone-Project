<?php

session_start();

include("connection.php");

if(isset($_SESSION['logged_id'])){
  $customer_id = $_SESSION['logged_id'];
}

if(isset($_GET['productID']) && $_GET['productID'] != ""){
  $product_id = $_GET['productID'];
  $select_stmt = $connection->prepare("SELECT product_id FROM favorites_customer_product WHERE product_id = '". $product_id . "' ");
  $select_stmt->execute();
  $select_results = $select_stmt->get_result();
  $row_select = $select_results->fetch_assoc();

  if(empty($row_select['product_id'])){
      $stmt = $connection->prepare("INSERT INTO favorites_customer_product(customer_id, product_id) VALUES (?,?)");
      $stmt->bind_param("ii", $customer_id, $product_id);
      $stmt->execute();
      $stmt->close();
      echo "<script>alert('The product has been added to your favorites list'); window.location = '../shop/shop.php';</script>";
  }
  else{
      echo "<script>alert('The product is already added to your favorites list'); window.location = '../shop/shop.php';</script>";
  }
}

?>
