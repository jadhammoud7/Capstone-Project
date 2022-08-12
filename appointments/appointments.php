<!DOCTYPE html>
<html lang="en">

<head>
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
            <a href="" class="nav-branding">Newbie Gamers.</a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="../home-page/home-page.php" class="home_menu nav-link" title="Home Page"> <i
                            class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../shop/shop.php" class="shop_menu nav-link" title="Shop Page"><i
                            class="fa fa-shopping-cart fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../appointments/appointments.php" class="appointments_menu nav-link"
                        title="Appointments"><i class="fa fa-wrench fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../contactus/contactus.php" class="contact_menu nav-link" title="Contact Us Page"><i
                            class="fa fa-phone fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../aboutus/aboutus.php" class="about_menu nav-link" title="About us Page"><i
                            class="fa fa-book fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../basket/basket.php" class="basket_menu nav-link" title="View my Shopping Basket"><i
                            class="fa fa-shopping-basket fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../profile/profile.php" class="myaccount_menu nav-link" title="View my account"><i
                            class="fa fa-user fa-lg" style="margin-bottom: 30px;"></i></a>
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

    <div id="id01" class="modal">
        <span onclick="CloseGift()" class="close" title="Close Modal">&times;</span>
        <div class="appointment-item appointment-free-game">
            <h2>Try Free Game</h2>
            <div class="appointment-item-info">
                <img src="../images/free-game.gif" alt="">
                <div class="appointment-item-info-part">
                    <h3>Try Free Game</h3>
                    <p>1 hour | free</p>
                    <p>You are invited to play a new game for free in our store. You can try any game of your own for up
                        to 1 hour. We care to our customers to be mostly convenient and satisfied with our services.
                        Don't hesitate to contact us for any enquiries and book your appointment now!</p>
                </div>
            </div>
            <div>
                <button onclick="OpenAppointmentBooking(this)" style="border-radius: 15px;color:black ;"><strong>Book Now</strong></button>
            </div>
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
            <div class="appointment-item-schedule">
                <h2>Ps Repair</h2>
                <div class="appointment-item-info-schedule">
                    <img src="../images/ps_repair.jpg" alt="">
                    <div class="appointment-item-info-schedule-part">
                        <h3>Ps consoles Repair including all types</h3>
                        <p>1 hour | 10$</p>
                        <p>Schedule now and bring your ps consoles for repair or maintanence. We require a total of 10$
                            for
                            a one
                            hour work. Don't hesitate to contact us for any concerns or information.</p>
                    </div>
                    <button>Schedule your Appointment</button>
                </div>
            </div>
        </div>

    </div>
    <!-- end calendar -->


    <!-- started with  appointment contents -->
    <div class="appointments-div fade">
        <div class="appointment-item" id="laptop-repair">
            <h2>Laptop Repair</h2>
            <div class="appointment-item-info">
                <img src="../images/laptop_repair.png" alt="">
                <div class="appointment-item-info-part">
                    <h3>Laptop Repair</h3>
                    <p>1 hour | 10$</p>
                    <p>Schedule now and bring your laptop for repair or maintanence. We require a total of 10$ for a one
                        hour work. Don't hesitate to contact us for any concerns or information.</p>
                </div>
            </div>
            <div>
                <button onclick="OpenAppointmentBooking(this)" style="border-radius: 15px;color:black ;"><strong>Book Now</strong></button>
            </div>
        </div>
        <hr size="8" width="100%" color="royalblue">
        <div class="appointment-item" id="laptop-cleaning">
            <h2>Laptop Cleaning</h2>
            <div class="appointment-item-info">
                <img src="../images/laptop_cleaning.gif" alt="">
                <div class="appointment-item-info-part">
                    <h3>Laptop Cleaning</h3>
                    <p>1 hour | 10$</p>
                    <p>Schedule now and bring your laptop for a special spa day. We require a total of 10$ for a one
                        hour work. Don't hesitate to contact us for any concerns or information.</p>
                </div>
            </div>
            <div>
                <button onclick="OpenAppointmentBooking(this)" style="border-radius: 15px;color:black ;"><strong>Book Now</strong></button>
            </div>
        </div>
        <hr size="8" width="100%" color="royalblue">

        <div class="appointment-item" id="cpu-repair">
            <h2>CPU Repair</h2>
            <div class="appointment-item-info">
                <img src="../images/cpu_repair.jpg" alt="">
                <div class="appointment-item-info-part">
                    <h3>CPU Repair including gaming and normal ones</h3>
                    <p>1 hour | 10$</p>
                    <p>Schedule now and bring your CPU for repair or maintanence for your CPU.This offer includes gaming
                        CPU and normal ones. We require a total of 10$ for a one
                        hour work. Don't hesitate to contact us for any concerns or information.</p>
                </div>
            </div>
            <div>
                <button onclick="OpenAppointmentBooking(this)" style="border-radius: 15px;color:black ;"><strong>Book Now</strong></button>
            </div>
        </div>
        <hr size="8" width="100%" color="royalblue">

        <div class="appointment-item" id="cpu-cleaning">
            <h2>CPU Cleaning</h2>
            <div class="appointment-item-info">
                <img src="../images/cpu_cleaning.jpg" alt="">
                <div class="appointment-item-info-part">
                    <h3>CPU Cleaning including gaming and normal ones</h3>
                    <p>1 hour | 10$</p>
                    <p>Schedule now and bring your CPU for a special spa day for your CPU.This offer includes gaming CPU
                        and normal ones. We require a total of 10$ for a one
                        hour work. Don't hesitate to contact us for any concerns or information.</p>
                </div>
            </div>
            <div>
                <button onclick="OpenAppointmentBooking(this)" style="border-radius: 15px;color:black ;"><strong>Book Now</strong></button>
            </div>
        </div>
        <hr size="8" width="100%" color="royalblue">

        <div class="appointment-item" id="phone-repair">
            <h2>Phone Repair</h2>
            <div class="appointment-item-info">
                <img src="../images/phone_repair.jpg" alt="">
                <div class="appointment-item-info-part">
                    <h3>Phone Repair</h3>
                    <p>1 hour | 10$</p>
                    <p>Schedule now and bring your Phones for repair or maintanence. We require a total of 10$ for a one
                        hour work. Don't hesitate to contact us for any concerns or information.</p>
                </div>
            </div>
            <div>
                <button onclick="OpenAppointmentBooking(this)" style="border-radius: 15px;color:black ;"><strong>Book Now</strong></button>
            </div>
        </div>
        <div class="appointment-item" id="ps-repair">
            <h2>Ps Repair</h2>
            <div class="appointment-item-info">
                <img src="../images/ps_repair.jpg" alt="">
                <div class="appointment-item-info-part">
                    <h3>Ps consoles Repair including all types</h3>
                    <p>1 hour | 10$</p>
                    <p>Schedule now and bring your ps consoles for repair or maintanence. We require a total of 10$ for
                        a one
                        hour work. Don't hesitate to contact us for any concerns or information.</p>
                </div>
            </div>
            <div>
                <button onclick="OpenAppointmentBooking(this)" style="border-radius: 15px;color:black ;"><strong>Book Now</strong></button>
            </div>
        </div>
        <hr size="8" width="100%" color="royalblue">
        <div class="appointment-item" id="controller-repair">
            <h2>Controller Repair</h2>
            <div class="appointment-item-info">
                <img src="../images/controller_repair.jpg" alt="">
                <div class="appointment-item-info-part">
                    <h3>Controller Repair including all type of consoles</h3>
                    <p>1 hour | 10$</p>
                    <p>Schedule now and bring your constrolers for repair or maintanence.Thos offer includes controllers
                        for all type
                        of consoles (ps2, ps3, ps4, ps5..). We require a total of 10$ for a one
                        hour work. Don't hesitate to contact us for any concerns or information.</p>
                </div>
            </div>
            <div>
                <button onclick="OpenAppointmentBooking(this)" style="border-radius: 15px;color:black ;"><strong>Book Now</strong></button>
            </div>
        </div>
        <hr size="8" width="100%" color="royalblue">
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
                            <a href="../home-page/home-page.php#contact-us"
                                title="Contact us for any enquiries or thoughts">Contact Us</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#shop-products" title="Take a look at our products">Our
                                Products</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#testimonials"
                                title="See what our customers said about our service">Our Customers' opinions</a>
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
                            <a href="https://www.facebook.com" title="Newbies Gamers facebook account link"><i
                                    class="fa fa-facebook"></i>Facebook</a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com" title="Newbies Gamers instagram account link"><i
                                    class="fa fa-instagram"></i>Instagram</a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com" title="Newbies Gamers twitter account link"><i
                                    class="fa fa-twitter"></i>Twitter</a>
                        </li>
                    </ol>
                </div>
            </li>
        </ol>
    </footer>
    <!-- ended with footer -->

    
    <script src="../appointments/appointments.js"></script>
</body>

</php>