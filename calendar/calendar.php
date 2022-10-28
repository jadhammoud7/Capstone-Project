<?php

session_start();
include("../php/connection.php");

if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] != 'customer') {
    header("Location: ../home-admin/home-admin.php");
}
if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
} else {
    $customer_id = $_SESSION['logged_id'];
}
require_once('../php/repair.php');

$type = "";
if (isset($_GET['repair_type'])) {
    $type = $_GET['repair_type'];
}
$cd_name = "";
if (isset($_GET['cd_name'])) {
    $cd_name = "Try a free game " . $_GET['cd_name'];
}


if (isset($_GET["appointments_time"]) && isset($_GET['date'])) {
    $appointment_time = $_GET["appointments_time"];
    $date = $_GET['date'];
    $status = "Pending";
    if ($type != "") {
        //select appointment price
        $stmt_select_repair_price = $connection->prepare("SELECT price_per_hour FROM repair WHERE repair_type ='" . $type . "'");
        $stmt_select_repair_price->execute();
        $results_select_repair_price = $stmt_select_repair_price->get_result();
        $row_select_repair_price = $results_select_repair_price->fetch_assoc();

        $appointment_price_per_hour = $row_select_repair_price['price_per_hour'];
        //inserting into table appointments
        $appointments_insert = $connection->prepare("INSERT INTO appointments(customer_id, appointment_name, price_per_hour, date, hour, status) VALUES (?,?,?,?,?,?)");
        $appointments_insert->bind_param("isisss", $customer_id, $type, $appointment_price_per_hour, $date, $appointment_time, $status);
        $appointments_insert->execute();
        $appointments_insert->close();
        echo "<script>window.location='../calendar/calendar.php?appointment_submitted=true';</script>";
    }
    if ($cd_name != "") {
        $appointment_price_per_hour = 0;
        //inserting into table appointments
        $appointments_insert = $connection->prepare("INSERT INTO appointments(customer_id, appointment_name, price_per_hour, date, hour, status) VALUES (?,?,?,?,?,?)");
        $appointments_insert->bind_param("isisss", $customer_id, $type, $appointment_price_per_hour, $date, $appointment_time, $status);
        $appointments_insert->execute();
        $appointments_insert->close();
        echo "<script>window.location='../calendar/calendar.php?appointment_submitted=true';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

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

    <!-- started popup message appointment submitted -->
    <div class="popup" id="appointment-submitted-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Appointment Submitted</h2>
        <p>Your appointment is submitted. Stay in touch to receive an email from us.</p>
        <button type="button" onclick="RemoveAppointmentSubmittedPopUp()">OK</button>
    </div>

    <!-- started with title page -->
    <div class="title">
        <h1 style="color: #333;">Appointments</h1>
        <h5 style="color:#b4c3da;">Home / Appointments</h5>
    </div>
    <!-- ended with title page -->

    <!-- starting calendar -->
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
        <div class="appointment-item-schedule">
            <?php
            if (isset($_GET['repair_type'])) {
                $stmt_select_repair_image = $connection->prepare("SELECT image FROM repairs WHERE repair_type = '" . $_GET['repair_type'] . "'");
                $stmt_select_repair_image->execute();
                $result_repair_image = $stmt_select_repair_image->get_result();
                $row_repair_image = $result_repair_image->fetch_assoc();
                book_now_for_each_repair_connection($_GET['repair_type'], $row_repair_image['image']);
            }
            if (isset($_GET['cd_name'])) {
                $stmt_select_repair_image = $connection->prepare("SELECT image FROM repairs WHERE repair_type = '" . $_GET['repair_type'] . "'");
                $stmt_select_repair_image->execute();
                $result_repair_image = $stmt_select_repair_image->get_result();
                $row_repair_image = $result_repair_image->fetch_assoc();
                book_now_for_each_repair_connection($_GET['cd_name'], $row_repair_image['image']);
            }
            ?>
        </div>
    </div>
    <!-- end calendar -->

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