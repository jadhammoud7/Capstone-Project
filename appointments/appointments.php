<!DOCTYPE html>
<html lang="en">
<?php

session_start();
include("../php/connection.php");

if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] != 'customer') {
    header("Location: ../home-admin/home-admin.php");
}
if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
$customer_id = $_SESSION['logged_id'];
require_once('../php/repair.php');

?>

<head>
    <link rel="icon" href="../images/Newbie Gamers-logos.jpeg">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../main/main.css">
    <link rel="stylesheet" href="../appointments/appointments.css">
    <title>Appointments - Newbies Gamers</title>
</head>

<body>
    <!-- started with the menu bar -->
    <header>
        <nav class="nav-bar">
            <!-- <a href="" class="nav-branding">Newbie Gamers.</a> -->
            <div class="content">
                <!-- <h2>Newbie Gamers.</h2> -->
                <h2>Newbie Gamers.</h2>
            </div>
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

    <!-- started with title page -->
    <div class="title">
        <h1 style="color: #333;">Appointments</h1>
        <h5 style="color:#b4c3da;">Home / Appointments</h5>
    </div>
    <!-- ended with title page -->

    <!-- started with present -->
    <?php
    $free_game = 'Free Game Trial';
    $stmt_check_free_game_appointment = $connection->prepare("SELECT * FROM appointments WHERE customer_id = $customer_id AND appointment_type = '" . $free_game . "'");
    $stmt_check_free_game_appointment->execute();
    $result_free_game_appointment = $stmt_check_free_game_appointment->get_result();
    $row_free_game_appointment = $result_free_game_appointment->fetch_assoc();

    if (empty($row_free_game_appointment)) {
    ?>
        <div class="present" onclick="OpenGift()">
            <div class="lid">
                <span></span>
            </div>
            <div class="promo">
                <p>Try a new game for free</p>
                <h2>Congratulations</h2>
            </div>
            <div class="box">
                <span></span>
                <span></span>
            </div>
        </div>
    <?php
    }
    ?>

    <div id="id01" class="modal">
        <span onclick="CloseGift()" class="close" title="Close Modal">&times;</span>
        <div class="appointment-item appointment-free-game">
            <h2>Try Free Game</h2>
            <?php
            //select random cd game for free gift appointment
            $query_gift = "SELECT name, description FROM products WHERE type='cds' ORDER BY RAND() LIMIT 1;";
            $stmt_gift = $connection->prepare($query_gift);
            $stmt_gift->execute();
            $results_gift = $stmt_gift->get_result();

            if (!isset($_SESSION['free_games'])) {
                while ($row_gift = $results_gift->fetch_assoc()) {
                    $_SESSION['free_games'] = $row_gift["name"];
                    free_gift_connection($row_gift["name"]);
                }
            } else {
                free_gift_connection($_SESSION['free_games']);
            }

            ?>
        </div>
    </div>
    <!-- ended with gift -->



    <!-- starting calendar -->
    <div id="appointment-schedule" class="modal">
        <span onclick="CloseAppointmentBooking()" class="close" title="Close Modal">&times;</span>
        <div class="container">
            <div class="calendar">
                <div class="month">
                    <i class="fas fa-angle-left prev"></i>
                    <div class="date">
                        <h1></h1>
                        <p></p>
                    </div>
                    <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thurs</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="days">
                </div>
            </div>
        </div>

    </div>
    <!-- end calendar -->


    <!-- started with  appointment contents -->
    <div class="appointments-div fade">
        <?php
        //select all repair services
        $stmt_select_all_repairs = $connection->prepare("SELECT * FROM repairs");
        $stmt_select_all_repairs->execute();
        $results_all_repairs = $stmt_select_all_repairs->get_result();

        while ($row_repairs = $results_all_repairs->fetch_assoc()) {
            repair_products_connection(
                $row_repairs['repair_type'],
                $row_repairs['price_per_hour'],
                $row_repairs['description'],
                $row_repairs['image']
            );
        }
        ?>
    </div>
    <!-- ended with  appointment contents -->


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


    <script src="../appointments/appointments.js"></script>
    <script src="../main/main.js"></script>
</body>

</php>