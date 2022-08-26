<?php

session_start();

include("../php/connection.php");

$customerid = $_SESSION['logged_id'];

$query = "SELECT first_name, last_name, email, phone_number, username, address from customers WHERE customer_id = $customerid";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();

include('../php/shop_product_connection.php');
include('../php/basket_product_connection.php');

$customer_id = $_SESSION['logged_id'];
$query_add_to_favorites = "SELECT product_id FROM favorites_customer_product WHERE customer_id = '" . $customer_id . "' ";
$stmt_add_to_favorites = $connection->prepare($query_add_to_favorites);
$stmt_add_to_favorites->execute();
$results_add_to_favorites = $stmt_add_to_favorites->get_result();

$query_basket = "SELECT product_id, quantity, price FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "' ";
$stmt_basket = $connection->prepare($query_basket);
$stmt_basket->execute();
$results_basket = $stmt_basket->get_result();

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
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
    <link rel="stylesheet" href="../main/main.css">
    <link rel="stylesheet" href="../profile/profile.css">
    <title>My Account - Newbies Gamers</title>
</head>

<body>


    <!-- started with the menu bar -->
    <header>
        <nav class="nav-bar">
            <a href="" class="nav-branding">Newbie Gamers.</a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="../home-page/home-page.php" class="home_menu nav-link" title="Home Page"> <i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../shop/shop.php" class="shop_menu nav-link" title="Shop Page"><i class="fa fa-shopping-cart fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../appointments/appointments.php" class="appointments_menu nav-link" title="Appointments"><i class="fa fa-wrench fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../contactus/contactus.php" class="contact_menu nav-link" title="Contact Us Page"><i class="fa fa-phone fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../aboutus/aboutus.php" class="about_menu nav-link" title="About us Page"><i class="fa fa-book fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../basket/basket.php" class="basket_menu nav-link" title="View my Shopping Basket"><i class="fa fa-shopping-basket fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../profile/profile.php" class="myaccount_menu nav-link" title="View my account"><i class="fa fa-user fa-lg" style="margin-bottom: 30px;"></i></a>
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
        <h1 style="color: #333;">Hello <?php echo $row["username"]; ?></h1>
        <h5 style="color:#b4c3da;">My Account</h5>
    </div>
    <!-- ended with title page -->



    <!-- started with profile body -->
    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="../images/info.png" alt="">
            <ol class="profile-sidebar-user">
                <li id="customer-name" title="My Username"><span><?php echo $row["username"]; ?></span></li>
                <li id="customer" title="My Status"><span>Customer</span></li>
            </ol>
            <ol class="profile-sidebar-list reveal-by-x">
                <li><a onclick="ShowProfile()" id="profile-button" title="View your own personal info">Profile</a></li>
                <li><a onclick="ShowBasket()" id="basket-button" title="View your current list of products added by you to basket">Shopping Basket</a></li>
                <li><a onclick="ShowFavorites()" id="favorites-button" title="View list of products added by you to your favorites">Favorites List</a></li>
                <li><a onclick="ShowAppointments()" id="appointments-button" title="View list of appointments added by you to your appointments section">Appoinments List</a></li>

                <form action="../php/logout.php" method="post">
                    <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to log out?');<?php unset($_SESSION['free_games']); ?>"><strong>Log out</strong></button>
                </form>
            </ol>
        </div>


        <!-- started profile -->
        <div class="profile fade" style="display: none;">
            <div class="profile-part">
                <h3 id="attribute">First Name: </h3>
                <h3><?php echo $row["first_name"] ?></h3>
            </div>
            <form action="../php/editprofile.php" method="post">
                <input type="text" name="firstname_editprofile" id="" placeholder="new first name.." class="first_name_editprofile" style="display: none;">
                <div class="profile-part">
                    <h3 id="attribute">Last Name: </h3>
                    <h3><?php echo $row["last_name"] ?></h3>
                </div>
                <input type="text" name="lastname_editprofile" id="" placeholder="new last name.." class="last_name_editprofile" style="display: none;">

                <div class="profile-part">
                    <h3 id="attribute">Email Address: </h3>
                    <h3><?php echo $row["email"] ?></h3>
                </div>
                <input type="text" name="email_editprofile" id="" placeholder="new email.." class="email_editprofile" style="display: none;">
                <div class="profile-part">
                    <h3 id="attribute">Phone Number: </h3>
                    <h3><?php echo $row["phone_number"] ?></h3>
                </div>
                <input type="text" name="phonenumber_editprofile" id="" placeholder="new phone number.." class="phone_number_editprofile" style="display: none;">
                <div class="profile-part">
                    <h3 id="attribute">Home Address: </h3>
                    <h3><?php echo $row["address"] ?></h3>
                </div>
                <input type="text" name="address_editprofile" id="" placeholder="new address.." class="address_editprofile" style="display: none;">

                <div class="edit_save_btn">
                    <button onclick="ChangeProfile()" class="edit_profile_btn" title="Edit your profile"> <i class="fa fa-edit"></i><strong>Edit
                            Profile</strong></button>
                </div>
            </form>
        </div>

        <!-- ended profile -->


        <!-- started shopping basket -->
        <div class="basket fade" style="display: none;">
            <div>
                <h2>Shopping Basket</h2>
                <h3>You have total of <?php echo $results_basket->num_rows; ?> items in your basket</h3>
            </div>
            <?php
            while ($row_basket = $results_basket->fetch_assoc()) {
                $stmt_get_product = $connection->prepare("SELECT product_id, category, name, price FROM products WHERE product_id = '" . $row_basket["product_id"] . "' ");
                $stmt_get_product->execute();
                $results_get_product = $stmt_get_product->get_result();
                $row_get_product = $results_get_product->fetch_assoc();
                basket_connection($row_get_product["product_id"], $row_get_product["name"], $row_get_product["category"], $row_basket["price"], $row_basket["quantity"]);
            }

            ?>


            <div>
                <h3>Total Price: <?php if (isset($_SESSION['total_price'])) {
                                        echo $_SESSION['total_price'];
                                    } ?>$</h3>
            </div>
            <div class="gotoshoppage_profile">
                <button title="Go to shopping basket to modify or submit your order" onclick="window.location.href='../basket/basket.php';"><strong>Go To Shopping
                        Basket</strong></button>
            </div>
        </div>
        <!-- ended shopping basket -->



        <!-- started favorites -->
        <div class="favorites fade" style="display: none;">
            <div>
                <h2>Favorites List</h2>
                <h3>You have a total of <?php echo mysqli_num_rows(mysqli_query($connection, "SELECT * FROM favorites_customer_product WHERE customer_id = '" . $customer_id . "' ")); ?> items in favorites list</h3>
            </div>
            <?php
            while ($row_add_to_favorites = $results_add_to_favorites->fetch_assoc()) {
                $stmt_get_product = $connection->prepare("SELECT product_id, name, category, price FROM products WHERE product_id = '" . $row_add_to_favorites["product_id"] . "' ");
                $stmt_get_product->execute();
                $results_get_product = $stmt_get_product->get_result();
                $row_get_product = $results_get_product->fetch_assoc();
                add_to_favorites_connection($row_get_product['product_id'], $row_get_product['name'], $row_get_product['category'], $row_get_product['price']);
            }
            ?>
            <div class="gotoshoppage_profile">
                <button title="Go to Shop Page"><strong>Go To Shop Page</strong></button>
            </div>
        </div>
        <!-- ended favorites -->




        <!-- started appointments -->
        <div class="appointments fade" style="display: none;">
            <div>
                <h2>Favorites List</h2>
                <h3>You have a total of items in favorites list</h3>
            </div>

            <div class="gotoshoppage_profile">
                <button title="Go to Shop Page"><strong>Go To Shop Page</strong></button>
            </div>
        </div>
        <!-- ended appointments -->

    </div>
    <!-- ended with profile body -->

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
                            <a href="../shop/shop.php" title="View all available products in Newbies Gamers and fill your basket to buy">Shop
                                Now</a>
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
<!-- ended footer -->

<script src="../profile/profile.js"></script>
<script src="../main/main.js"></script>

</php>