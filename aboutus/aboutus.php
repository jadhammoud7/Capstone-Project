<!DOCTYPE html>
<html lang="en">
<?php

session_start();
if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../main/main.css">
    <link rel="stylesheet" href="../contactus/contactus.css">
    <link rel="stylesheet" href="../aboutus/aboutus.css">
    <title>About Us - Newbies Gamers</title>
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
        <h1 style="color: #333;">About Us</h1>
        <h5 style="color:#b4c3da;">Home / About us</h5>
    </div>
    <!-- ended with title page -->


    <!-- started with the counter -->

    <div class="row">
        <div class="nb_cutsomers_section reveal-by-x">
            <i class="fa fa-car"></i>
            <div class="counter" data-target="6000">0</div>
            <h4>Happy Customers</h4>
        </div>
        <div class="nb_items_sold reveal-by-x">
            <i class="fa fa-car"></i>
            <div class="counter" data-target="12000">0</div>
            <h4>Items Sold</h4>
        </div>
        <div class="nb_history reveal-by-x">
            <i class="fa fa-car"></i>
            <div class="counter" data-target="15">0</div>
            <h4>Years</h4>
        </div>
    </div>
    <!-- ended with the counter -->


    <!-- started our history -->
    <div class="about-us-par reveal-by-y" id="history">
        <h3>Newbies Gamers History</h3>
        <p>Newbies Gamers started first with a small shop, selling all sorts of games, from cds to game consoles and
            more, back in 2005. Our shop was opened in our current location in Beirut, Lebanon. As it is said, "After
            every will, there is a way", and that what happened with Newbies Gamers. Our shop struggled many times to
            reach popularity, and after many years of hard work, we were able to reach fame and more.</p>
    </div>
    <img src="../images/gaming.jpg" alt="" style="width: 100%; height: 700px;" class="about-us-par reveal-by-y">

    <div class="about-us-par reveal-by-y" id="establishment">
        <h3>Newbies Gamers Establishment</h3>
        <p>Newbies Gamers was established in June 6, 2005 in Beirut, Lebanon by a good owner names Mr. X. While Mr. X
            started his journey alone, he turned out to form not only a small shop of employees, but a group of family
            members who made the posibility of fame and success. Now, and with the help of Newbies Gamers Family, we are
            a big gaming shop that offers best quality of our customers' needs with our heart and love.</p>
    </div>
    <img src="../images/game-store.jpg" alt="" style="width: 100%; height: 700px;" class="about-us-par reveal-by-y">

    <div class="about-us-par reveal-by-y" id="specials">
        <h3>Newbies Gamers Specials</h3>
        <p>Ofcourse any new customer will ask one question, "What is special about that shop?". The answer is simple, we
            offer the best quality of trusted and original gaming needs, such as Playstation, Xbox, and Nintendo
            consoles and their original cds of all game types. Not only were we stick to gaming needs, Newbies Gamers
            have expanded their selling in the past years to offer Lebanese people other technological needs, such as
            phones and all their related accessories, ofcourse their original quality. To add more, Newbies Gamers have
            offered all other sorts of gaming needs for their customers, such as online cards for playstation, nintendo,
            and xbox, for our customers to enjoy. When buying from Newbies Gamers, be sure that you are buying the
            original and best needs.</p>
    </div>
    <!-- ended our history -->



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


    <script src="../aboutus/aboutus.js"></script>
    <script src="../main/main.js"></script>
</body>

</html>