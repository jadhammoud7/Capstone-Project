<?php

session_start();
include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}

require_once('../php/comment_connection.php');


$query = "SELECT username, comment FROM comments ORDER BY RAND() LIMIT 3;";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();

//get all products(some of them )
require_once("../php/shop_product_connection.php");
$query_allproducts = "SELECT product_id,name, price FROM products ORDER BY RAND() LIMIT 8;";
$stmt_allproducts = $connection->prepare($query_allproducts);
$stmt_allproducts->execute();
$results_allproducts = $stmt_allproducts->get_result();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../home-admin/home-admin.css">
    <link rel="stylesheet" href="../home-page/home-page.css">
    <link rel="stylesheet" href="../main/main.css">
    <title>Home Admin - Newbies Gamers</title>
</head>

<body onunload="myFunction()">
    <!-- started with the menu bar -->
    <header>
        <nav class="nav-bar" id="hhh">
            <a href="" class="nav-branding">Newbie Gamers.</a>



        </nav>
    </header>
    <!-- ended with the menu bar -->

    <!-- started popup message login successful -->
    <div class="popup" id="login-confirmation">
        <img src="../images/tick.png" alt="successfully logged in">
        <h2>Login Successful</h2>
        <p>Welcome to Newbies Gamers</p>
        <button type="button" onclick="RemoveLogInPopUp()">OK</button>
    </div>


    <nav class="nav__cont">
        <ul class="nav">
            <li class="nav__items ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <use xlink:href="#home"></use>
                </svg>
                <a href="">Home</a>
            </li>

            <li class="nav__items ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                    <use xlink:href="#search"></use>
                </svg>
                <a href="">Search</a>
            </li>

            <li class="nav__items ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                    <use xlink:href="#map"></use>
                </svg>
                <a href="">Map</a>
            </li>

            <li class="nav__items ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 35.6">
                    <use xlink:href="#planner"></use>
                </svg>
                <a href="">Planner</a>
            </li>

        </ul>
    </nav>


    <div class="wrapper">
        <main>
            <h1>Fixed Side Drawer Hover Navigation </h1>
        </main>
    </div>



    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->



    <script src="../home-page/home-page.js"></script>
    <script src="../main/main.js"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>

</html>
</php>