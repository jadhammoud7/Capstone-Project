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
    <link rel="stylesheet" href="../home-page/home-page.css">
    <link rel="stylesheet" href="../main/main.css">
    <title>Home - Newbies Gamers</title>
</head>

<body onunload="myFunction()">
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

    <!-- started popup message login successful -->
    <div class="popup" id="login-confirmation">
        <img src="../images/tick.png" alt="successfully logged in">
        <h2>Login Successful</h2>
        <p>Welcome to Newbies Gamers</p>
        <button type="button" onclick="RemoveLogInPopUp()">OK</button>
    </div>

    <!-- start slideshow -->
    <div class="slideshow-container reveal-by-y">
        <div class="mySlides fade" title="Welcome to Newbies Gamers. We sell manu consoles and electronics for your games and more">
            <div class="numbertext">1 / 3</div>
            <img src="../images/game-store.jpg" class="home-img" title="Game Store Image">
            <div class="text">
                <h3>Welcome To Newbies Gamers</h3>
                <p>We sell many consoles and electronics for your games and more</p>
            </div>
            <div class="dot-div">
                <span class="dot-current"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>

        <div class="mySlides fade" title="We offer phones and many accessories related to them such as charges and more.">
            <div class="numbertext">2 / 3</div>
            <img src="../images/image2.jpg" class="home-img" title="Phone Accessories Image">
            <div class="text">
                <h3>What We Sell?</h3>
                <p>We offer phones and many accessories related to them such as chargers and more</p>
            </div>
            <div class="dot-div">
                <span class="dot"></span>
                <span class="dot-current"></span>
                <span class="dot"></span>
            </div>
        </div>

        <div class="mySlides fade" title="Enjoy playing your games by buying all online playing requirements such as PS Plus">
            <div class="numbertext">3 / 3</div>
            <img src="../images/image3.jpg" class="home-img" title="Online playing cards image">
            <div class="text">
                <h3>What we offer?</h3>
                <p>Enjoy playing your games by buying all online playing requirements such as PS Plus</p>
            </div>
            <div class="dot-div">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot-current"></span>
            </div>
        </div>
    </div>
    <br>

    <!-- end slideshow -->



    <!-- starting features here -->
    <div class="features-title" id="features">
        <h1>Our Specialists & Features</h1>
    </div>
    <div class="features">
        <div class="feature-part reveal-by-y">
            <img src="../images/console.png" class="feature-icon" id="feature_1" title="Want all kinds of console including gaming consoles and laptops, we offer the best qualities of these
            products">
            <div>
                <p>Want all kinds of console including gaming consoles and laptops, we offer the best qualities of these
                    products</p>
            </div>
        </div>
        <div class="feature-part reveal-by-y">
            <img src="../images/smartphone.png" class="feature-icon" id="feature_2" title="We sell good quality and prices of the newest phones including iphone, samsung and more">
            <div>
                <p>We sell good quality and prices of the newest phones including iphone, samsung and more</p>
            </div>
        </div>
        <div class="feature-part reveal-by-y" id="feature_3">
            <img src="../images/phone-charger.png" class="feature-icon" title="All accessories and materials needed for your phone, such as chargers and cards are found in here">
            <div>
                <p>All accessories and materials needed for your phone, such as chargers and cards are found in here</p>
            </div>
        </div>
        <div class="feature-part reveal-by-y" id="feature_4">
            <img src="../images/playstation.png" class="feature-icon" title="We have the latest PS consoles, CDs, and materials including PS Plus for online gaming and more to
            enjoy online gaming">
            <div>
                <p>We have the latest PS consoles, CDs, and materials including PS Plus for online gaming and more to
                    enjoy online gaming</p>
            </div>
        </div>
    </div>

    <!-- ended features here -->



    <!-- starting about us here -->
    <div class="about-us-title" id="about-us">
        <h1>Know More About Us</h1>
    </div>
    <div class="about-us">
        <div class="about-us-paragraph">
            <h3>Know More About Us</h3>
            <p class="about-par">We are a gaming store that sell all gaming essentials, from Playstations, to gaming
                computers and much more. We are one of the top gaming shops in Lebanon</p>
            <a href="../aboutus/about-us.php" class="about-us-button" title="Go To About Us Page to see more info about our shop">Go To About Us</a>
            <p class="about-us-location">Our Location:</p>
            <img src="../images/placeholder.png" alt="Location logo" class="location-logo">Beirut, Lebanon
        </div>
    </div>
    <div>
        <!-- ended about us here -->



        <!-- starting appointments here -->
        <div class="appointments-title" id="appointments">
            <h1>Book For Appointments</h1>
        </div>
        <div class="appointments">
            <div class="appointments-paragraph">
                <h3>Book For Appointments</h3>
                <p class="appointments-par">Newbies Gamers does not only sell your gaming and technological needs, but
                    we also offer many kinds of works and appointments that enhances our customers' trust with us, such
                    as maintenance and repair works for your laptops, consoles and more. All our works are done by
                    experts and specialists in their domain, that makes you feel well trusted and comforted.</p>
                <a href="../appointments/appointments.php" class="appointments-button" title="Go To Appointments to book for a service work with us">Book for appointments</a>
            </div>
        </div>
        <!-- ended appointments here -->


        <!-- starting contact us -->
        <div class="contact-us-title" id="contact-us">
            <h1>Contact Us</h1>
        </div>
        <div class="contact-us">
            <img src="../images/contact-us.jpg" alt="Contact Us Image" class="contact-us-img">
            <div class="contact_us_paragraphs">
                <p>If you have any concerns, thoughts or opinions you want to share, don't hesitate to contact us and
                    share your thoughts</p>
                <p>Visit our contact us page to write your comments:</p>
                <a href="../contactus/contactus.php" class="contact-us-button" title="Go To Our contact us page to share your thoughts. We will see your opinions and will take it into consideration">Go
                    To Contact Us</a>
                <p>You can also contact us on other platforms:</p>
                <div class="align-contact">
                    <img src="../images/email.png" alt="Email Logo" title="Contact us by this email" class="contact-us-images">
                    <p>Email: newbies_gamers@gmail.com</p>
                </div>
                <div class="align-contact">
                    <img src="../images/telephone.png" alt="Phone Logo" title="You can call us or chat from whatsapp by this number" class="contact-us-images">
                    <p>Phone Number: +961 01 111 111</p>
                </div>
            </div>
        </div>
        <!-- ended contact us -->



        <!-- starting products here -->
        <div class="shop-products-title" id="shop-products">
            <h1>Our Products</h1>
        </div>
        <div class="shop-products reveal-by-y">
            <?php
            while ($row_allproducts = $results_allproducts->fetch_assoc()) {
                shop_connection($row_allproducts["product_id"], $row_allproducts["name"], $row_allproducts["price"]);
            }


            while ($row_allproducts = $results_allproducts->fetch_assoc()) {
                shop_connection($row_allproducts["product_id"], $row_allproducts["name"], $row_allproducts["price"]);
            }
            ?>
            <button class="shop-page-button" title="Go to Shop Page to View all Our Products"><i class="fa fa-shopping-cart"></i>Go To Shop Page</button>
        </div>
        <!-- end of products -->



        <!-- start of testimonials -->
        <div class="testimonials-title" id="testimonials">
            <h1>Our Customers' Opinions</h3>
        </div>

        <div class="test-back">
            <img class="test" src="../images/right-quotation-mark.png" alt="Testimonial Logo">
            <?php
            while ($row = $results->fetch_assoc()) {
                comment_connection($row["username"], $row["comment"]);
            }
            ?>
        </div>
        <!-- end of testimonials -->



        <!-- started return to top button -->
        <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
        <!-- ended return to top button -->


        <!-- start of footer -->
        <footer>
            <ol class="footer-list">
                <li>
                    <div>
                        <ol class="footer-list-element">
                            <li>
                                <h3>Newbies Gamers Home</h3>
                            </li>
                            <li>
                                <a href="../home-page/home-page.php#features" title="View Our specialists and features">Our Specialists & Features</a>
                            </li>
                            <li>
                                <a href="../home-page/home-page.php#about-us" title="Know more about us">About Us</a>
                            </li>
                            <li>
                                <a href="../home-page/home-page.php#contact-us" title="Contact us for any enquiries or thoughts">Contact Us</a>
                            </li>
                            <li>
                                <a href="../home-page/home-page.php#shop-products" title="Take a look at our products">Our Products</a>
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
                                <a href="../contactus/contactus.php" title="Share your thoughts and concerns to us">Share your thoughts</a>
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
        <script src="../home-page/home-page.js"></script>
        <script src="../main/main.js"></script>
</body>

</html>
</php>