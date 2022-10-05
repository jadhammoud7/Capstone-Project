<?php

session_start();

include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
} else {
    $customer_id = $_SESSION['logged_id'];
}

if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] != 'customer') {
    header("Location: ../home-admin/home-admin.php");
}
if (isset($_GET['checkout_id'])) {
    $stmt_get_checkout = $connection->prepare("SELECT * FROM checkouts WHERE checkout_id = '" . $_GET['checkout_id'] . "'");
    $stmt_get_checkout->execute();
    $result_checkout = $stmt_get_checkout->get_result();
    $row_checkout = $result_checkout->fetch_assoc();

    //to display products in table summary
    $stmt_get_checkout_products = $connection->prepare("SELECT product_id, quantity, total_price FROM checkouts_customers_products WHERE checkout_id = '" . $_GET['checkout_id'] . "' ");
    $stmt_get_checkout_products->execute();
    $results_get_checkout_products = $stmt_get_checkout_products->get_result();
}

//for product summary in checkout
function checkout_products_connection($name, $quantity, $price)
{
    $element = "
    <tr>
        <td>$name</td>
        <td>$quantity</td>
        <td>$price$</td>
    </tr>";

    echo $element;
}

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
    <link rel="stylesheet" href="../checkout/checkout.css">
    <link rel="stylesheet" href="../main/main.css">
    <title>CheckOut Details - Newbies Gamers</title>
</head>

<body>


    <!-- started with the menu bar -->
    <header>
        <nav class="nav-bar">
            <a href="" class="nav-branding">Newbie Gamers.</a>
            <ul class="nav-menu">
                <li>
                    <a href="../home-page/home-page.php" class="home_menu nav-link" title="Home Page">Home</a>
                </li>
                <li>
                    <a class="nav-link">Works<i class="fa fa-caret-down"></i></a>
                    <ul class="works_menu">
                        <li><a href="../shop/shop.php" class="shop_menu nav-link" title="Shop Page">Shop</a></li>
                        <li><a href="../appointments/appointments.php" class="appointments_menu nav-link" title="Appointments">Appointments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../contactus/contactus.php" class="contact_menu nav-link" title="Contact Us Page">Contact</a>
                </li>
                <li>
                    <a href="../aboutus/aboutus.php" class="about_menu nav-link" title="About us Page">About</a>
                </li>
                <li>
                    <a class="account_menu nav-link">Account<i class="fa fa-caret-down"></i></a>
                    <ul class="account-dropdown">
                        <li><a href="../profile/profile.php" class="myaccount_menu nav-link" title="View my account">My Profile</a></li>
                        <li><a href="../basket/basket.php" class="basket_menu nav-link" title="View my Shopping Basket">My Basket</a></li>
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



    <!-- started with title page -->
    <div class="title">
        <h1 style="color: #333;">Checkout Details</h1>
        <h5 style="color:#b4c3da;">Profile / Checkout Details</h5>
    </div>
    <!-- ended with title page -->



    <!-- started with checkout form -->
    <div>

        <div class="billing-details">
            <h2>Billing Details</h2>
            <div class="form-container">
                <form>

                    <div class="form-container-part">

                        <div>
                            <h3 class="form-container-part-title">Personal Information</h3>
                        </div>

                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="text" name="first_name" id="first_name" value="<?php if (isset($row_checkout)) {
                                                                                                echo $row_checkout['first_name'];
                                                                                            } ?>" readonly class="is-valid">
                                <label for="first_name">First Name</label>
                            </div>

                            <div class="input-container">

                                <input type="text" name="last_name" id="last_name" value="<?php if (isset($row_checkout)) {
                                                                                                echo $row_checkout['last_name'];
                                                                                            } ?>" readonly class="is-valid">
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>

                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="email" name="email" id="email" value="<?php if (isset($row_checkout)) {
                                                                                        echo $row_checkout['email'];
                                                                                    } ?>" readonly class="is-valid">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-container">

                                <input type="tel" name="phone_number" id="phone_number" value="<?php if (isset($row_checkout)) {
                                                                                                    echo $row_checkout['phone_number'];
                                                                                                } ?>" readonly class="is-valid">
                                <label for="phone_number">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-container-part">
                        <div>
                            <h3 class="form-container-part-title">Shipping Details</h3>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="text" name="date" value="<?php if (isset($row_checkout)) {
                                                                            echo $row_checkout['date'];
                                                                        } ?>" readonly class="is-valid">
                                <label for="date">Date</label>
                            </div>
                        </div>

                        <div class="form-container-part-inputs">
                            <div class="input-container">

                                <input type="text" name="shipping_country" id="shipping_country" value="<?php if (isset($row_checkout)) {
                                                                                                            echo $row_checkout['shipping_country'];
                                                                                                        } ?>" readonly class="is-valid">
                                <label for="shipping_country">Country</label>
                            </div>
                        </div>

                        <div class="form-container-part-inputs">
                            <div class="input-container" style="width: 100%;">

                                <input type="text" name="shipping_location" id="shipping_location" value="<?php if (isset($row_checkout)) {
                                                                                                                echo $row_checkout['shipping_location'];
                                                                                                            } ?>" readonly class="is-valid">
                                <label for="shipping_location">Location (Town / City, Street, Home Address)</label>
                            </div>
                        </div>

                        <div class="form-container-part-inputs">
                            <div class="input-container">

                                <input type="text" name="shipping_company" id="shipping_company" value="<?php if (isset($row_checkout)) {
                                                                                                            echo $row_checkout['shipping_company'];
                                                                                                        } ?>" readonly class="is-valid">
                                <label for="shipping_company">Company Name (if any)</label>
                            </div>
                            <div class="input-container">

                                <input type="number" name="postcode" id="postcode" value="<?php if (isset($row_checkout)) {
                                                                                                echo $row_checkout['postcode'];
                                                                                            } ?>" readonly class="is-valid">
                                <label for="postcode">Postcode / ZIP</label>
                            </div>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container" style="width: 100%;">
                                <input type="text" name="order_notes" id="order-notes" value="<?php if (isset($row_checkout)) {
                                                                                                    echo $row_checkout['order_notes'];
                                                                                                } ?>" readonly class="is-valid">
                                <label for="order_notes">Order Notes (Special notes related to the delivery,
                                    optional)</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="order-summary">
            <h2>Order Summary</h2>
            <table id="order-products">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
                <?php
                while ($row_get_checkout_products = $results_get_checkout_products->fetch_assoc()) {
                    $stmt_get_product = $connection->prepare("SELECT name, price FROM products WHERE product_id = '" . $row_get_checkout_products["product_id"] . "' ");
                    $stmt_get_product->execute();
                    $results_get_product = $stmt_get_product->get_result();
                    $row_get_product = $results_get_product->fetch_assoc();
                    checkout_products_connection($row_get_product['name'], $row_get_checkout_products['quantity'], $row_get_checkout_products['total_price']);
                }
                ?>
            </table>
            <table id="order-totals">
                <tr>
                    <th>Subtotal</th>
                    <td><?php echo $row_checkout['total_price']; ?>$</td>
                </tr>
                <tr>
                    <th>Taxes</th>
                    <td><?php echo $row_checkout['tax_price']; ?>$</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><?php echo $row_checkout['total_price_including_tax']; ?>$</td>
                </tr>
            </table>
        </div>
        <div class="payment">
            <h2>Payment Details</h2>
            <div class="payment-container">
                <h3>Pay cash on delivery</h3>
                <div class="cash-delivery">
                    <p>Pay your order bill by cash right after receiving your goods</p>
                </div>
            </div>
        </div>
        <div class="checkout-buttons">
            <button class="back_to_shoppingbasket" onclick="window.location.href='../profile/profile.php';" title="Return to your profile"><i class="fa fa-arrow-left"></i>Return to
                Your Profile</button>
        </div>
    </div>
    <!-- ended with checkout form -->


    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->



    <!-- started with footer -->
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
    <!-- ended with footer -->


    <script src="../main/main.js"></script>
    <script src="../checkout/checkout.js"></script>
</body>

</php>