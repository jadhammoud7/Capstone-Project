<?php

session_start();
include("../php/connection.php");

if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] != 'customer') {
    header("Location: ../home-admin/home-admin.php");
}
if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}

require_once('../php/shop_product_connection.php');

//for the search btn
if (isset($_POST['search'])) {
    $searchq = $_POST['search'];
    $search_stmt = $connection->prepare("SELECT * FROM products WHERE name LIKE '%$searchq%'");
    $search_stmt->execute();
    $results_search = $search_stmt->get_result();
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
    <link rel="stylesheet" href="../main/main.css">
    <link rel="stylesheet" href="../home-page/home-page.css">
    <link rel="stylesheet" href="../contactus/contactus.css">
    <link rel="stylesheet" href="../shop/shop.css">
    <link rel="stylesheet" href="../search/search.css">
    <title>Shop - Newbies Gamers</title>
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



    <!-- started with title page -->
    <div class="title">
        <h1 style="color: #333;">Search Results</h1>
        <h5 style="color:#b4c3da;">Home / Search Results</h5>
    </div>

    <div class="return-shop">
        <button onclick="window.location.href='../shop/shop.php';" title="Return to shop page"><i class="fa fa-arrow-left"></i>Return To Shop Page</button>
    </div>


    <div>
        <h2 class="shop-title">Search Result</h2>
        <h4 class="results-title">Showing <?php echo $results_search->num_rows; ?> results of products of name containing "<?php if (isset($_POST['search'])) {
                                                                                                                                echo $_POST['search'];
                                                                                                                            } ?>"</h4>
    </div>

    <!-- ended with title page -->
    <div class="shop-products reveal-by-y">
        <?php
        if (isset($results_search)) {
            while ($row_search = $results_search->fetch_assoc()) {
                shop_connection($row_search['product_id'], $row_search['name'], $row_search['price']);
            }
        }
        if ($results_search->num_rows == 0) {
            $not_found = "<div class=\"error-div\" >Data Not found</div>";
            echo $not_found;
        }
        ?>
    </div>


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


    <script src="../shop/shop.js"></script>
    <script src="../main/main.js"></script>
</body>

</php>