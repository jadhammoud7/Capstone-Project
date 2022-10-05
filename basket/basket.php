<?php

session_start();
include("../php/connection.php");


if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] != 'customer') {
    header("Location: ../home-admin/home-admin.php");
}
if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}

include("../php/basket_product_connection.php");

$customer_id = $_SESSION['logged_id'];

$query_basket = "SELECT product_id, quantity, price FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "' ";
$stmt_basket = $connection->prepare($query_basket);
$stmt_basket->execute();
$results_basket = $stmt_basket->get_result();

$stmt_select_all_prices = $connection->prepare("SELECT price FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "' ");
$stmt_select_all_prices->execute();
$select_prices_results = $stmt_select_all_prices->get_result();
$total_price = 0;
//sum all prices in basket
while ($row_select_prices = $select_prices_results->fetch_assoc()) {
    $total_price = $total_price + $row_select_prices['price'];
}
//tax is 10% total price
$tax_price = $total_price * 0.1;

$total_inc_tax = $total_price + $tax_price;

$_SESSION['total_price'] = $total_price;
$_SESSION['tax_price'] = $tax_price;
$_SESSION['total_price_including_tax'] = $total_inc_tax;
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
    <link rel="stylesheet" href="../main/main.css">
    <link rel="stylesheet" href="../profile/profile.css">
    <link rel="stylesheet" href="../basket/basket.css">
    <title>My Basket - Newbies Gamers</title>
</head>

<body>


    <!-- started with the menu bar -->
    <header>
        <nav class="nav-bar">
            <a href="" class="nav-branding">Newbie Gamers.</a>
            <ul class="nav-menu">
                <li>
                    <a href="../home-page/home-page.php" id="home-page-nav" class="home_menu nav-link" title="Home Page">Home</a>
                </li>
                <li>
                    <a class="nav-link" id="works-nav">Works<i class="fa fa-caret-down"></i></a>
                    <ul class="works_menu">
                        <li><a href="../shop/shop.php" id="shop-nav" class="shop_menu nav-link" title="Shop Page">Shop</a></li>
                        <li><a href="../appointments/appointments.php" id="appointments-nav" class="appointments_menu nav-link" title="Appointments">Appointments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../contactus/contactus.php" id="contact-us-nav" class="contact_menu nav-link" title="Contact Us Page">Contact</a>
                </li>
                <li>
                    <a href="../aboutus/aboutus.php" id="about-us-nav" class="about_menu nav-link" title="About us Page">About</a>
                </li>
                <li>
                    <a class="account_menu nav-link" id="account-nav">Account<i class="fa fa-caret-down"></i></a>
                    <ul class="account-dropdown">
                        <li><a href="../profile/profile.php" id="profile-nav" class="myaccount_menu nav-link" title="View my account">My Profile</a></li>
                        <li><a href="../basket/basket.php" id="basket-nav" class="basket_menu nav-link" title="View my Shopping Basket">My Basket</a></li>
                    </ul>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

        </nav>
    </header>
    <!-- ended with the menu bar -->


    <!-- started popup message removed from basket -->
    <div class="popup" id="removed-from-basket-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Removed From Basket</h2>
        <p>Product has been removed from your basket</p>
        <button type="button" onclick="RemoveRemovedFromBasketPopUp()">OK</button>
    </div>



    <!-- started with title page -->
    <div class="title">
        <h1 style="color: #333;">Shopping Basket</h1>
        <h5 style="color:#b4c3da;">Home / Basket</h5>
    </div>
    <!-- ended with title page -->

    <?php
    //if basket is empty

    if ($results_basket->num_rows == 0) {
        basket_empty();
        exit();
    }
    ?>
    <!--started basket items selected-->
    <div class="card small-container fade reveal-by-y" id="product123">
        <form action="../php/basket.php" method="POST">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php
                while ($row_add_to_basket = $results_basket->fetch_assoc()) {
                    $stmt_get_product = $connection->prepare("SELECT product_id, name FROM products WHERE product_id = '" . $row_add_to_basket["product_id"] . "' ");
                    $stmt_get_product->execute();
                    $results_get_product = $stmt_get_product->get_result();
                    $row_get_product = $results_get_product->fetch_assoc();
                    basket_product_connection($row_get_product["product_id"], $row_get_product["name"], $row_add_to_basket["price"], $row_add_to_basket["quantity"]);
                }

                ?>

            </table>
            <button type="submit" class="update-cart-btn" title="Update your shopping basket"><i class="fa fa-update"></i>Update Basket</button>
        </form>

        <!--start total price-->
        <div class="total-price">
            <table>
                <tr>
                    <td title="This is the total invoice of your shopping basket excluding tax value">Subtotal</td>
                    <td>$<?php echo $_SESSION['total_price']; ?></td>
                </tr>
                <tr>
                    <td title="This is the tax value to be added to the checkout">Tax</td>
                    <td>$<?php echo $_SESSION['tax_price']; ?></td>
                </tr>
                <tr>
                    <td title="This is the total checkout price of your shopping basket including tax value">Total</td>
                    <td>$<?php echo $_SESSION['total_price_including_tax']; ?></td>
                </tr>
                <tr>
                    <!-- started with bay button -->
                    <td>
                        <button onclick="window.location.href='../checkout/checkout.php';" class="checkout-button" title="Submit your shopping basket"><i class="fa fa-money"></i>Proceed To Checkout</button>
                    </td>
                </tr>
            </table>
        </div>
        <!--end of total price-->
    </div>

    <!--ended basket items selected-->


    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->


    <!-- started footer -->
    <footer>
        <ol class="footer-list">
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Newbies Gamers Home</h3>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#features" title="View Our specialists and features">Our
                                Specialists & Features</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#about-us" title="Know more about us">About Us</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#contact-us" title="Contact us for any enquiries or thoughts">Contact Us</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#shop-products" title="Take a look at our products">Our
                                Products</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#testimonials" title="See what our customers said about our service">Our Customers' opinions</a>
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Newbies Gamers Shop</h3>
                        </li>
                        <li>
                            <a href="../shop/shop.php" title="View all available products in Newbies Gamers and fill your basket to buy">Shop Now</a>
                        </li>
                        <li>
                            <a href="../basket/basket.php" title="View your shopping basket"><i class="fa fa-shopping-basket"></i>View your shopping basket</a>
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>About Newbies Gamers</h3>
                        </li>
                        <li>
                            <a href="../aboutus/aboutus.php#history" title="Know about our history">Our History</a>
                        </li>
                        <li>
                            <a href="../aboutus/aboutus.php#establishment" title="Know about our establishment">Our
                                Establishment</a>
                        </li>
                        <li>
                            <a href="../aboutus/aboutus.php#specials" title="See what makes us special">Our
                                Specials</a>
                        </li>
                        <li>
                            <i class="fa fa-location-arrow" title="Newbies Gamers shop location"></i>Beirut, Lebanon
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Book an Appointment</h3>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#laptop-repair">Laptop Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#laptop-cleaning">Laptop Cleaning</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#cpu-repair">CPU Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#cpu-cleaning">CPU Cleaning</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#phone-repair">Phone Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#ps-repair">PS Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#controller-repair">Controller Repair</a>
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Contact Us</h3>
                        </li>
                        <li>
                            <a href="../contactus/contactus.php" title="Share your thoughts and concerns to us">Share
                                your thoughts</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope" title="Our email to contact us"></i>newbies_gamers@gmail.com
                        </li>
                        <li>
                            <i class="fa fa-phone" title="Call us or chat by whatsapp with us"></i>+961 01 111 111
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Follow Us on Our Socials</h3>
                        </li>
                        <li>
                            <a href="https://www.facebook.com" title="Newbies Gamers facebook account link"><i class="fa fa-facebook"></i>Facebook</a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com" title="Newbies Gamers instagram account link"><i class="fa fa-instagram"></i>Instagram</a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com" title="Newbies Gamers twitter account link"><i class="fa fa-twitter"></i>Twitter</a>
                        </li>
                    </ol>
                </div>
            </li>
        </ol>
    </footer>
</body>
<!-- started footer -->


<script src="../main/main.js"></script>
<script src="../basket/basket.js"></script>

</php>