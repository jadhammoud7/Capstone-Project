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
    <title>CheckOut - Newbies Gamers</title>
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
        <h1 style="color: #333;">Checkout</h1>
        <h5 style="color:#b4c3da;">My Basket / Checkout</h5>
    </div>
    <!-- ended with title page -->



    <!-- started with checkout form -->
    <div>
        <div class="login-part">
            <p class="login-part-par">Have you created an account before? </p>
            <button class="login-button"
                title="Click to login in order to proceed with the checkout with your account personal info" style="color: black;"><strong>Click Here
                to Login</strong></button>
        </div>
        <div class="login-part">
            <p class="login-part-par">Want to proceed to your checkout faster and you don't have an account? </p>
            <button class="login-button"
                title="Click to create and account to proceed with the checkout with your account personal info" style="color: black;"><strong>Create
                an account now </strong></button>
        </div>
        <div class="billing-details">
            <h2>Billing Details</h2>
            <div class="form-container">
                <form action="">
                    <div class="form-container-part">
                        <div>
                            <h3 class="form-container-part-title">Personal Information</h3>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="text" id="first-name" required>
                                <label for="first-name">First Name</label>
                            </div>
                            <div class="input-container">
                                <input type="text" id="last-name" required>
                                <label for="last-name">Last Name</label>
                            </div>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="email" id="email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-container">
                                <input type="tel" id="phone-number" required>
                                <label for="phone-number">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-container-part">
                        <div>
                            <h3 class="form-container-part-title">Shipping Details</h3>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="text" id="shipping-country" required>
                                <label for="shipping-country">Country</label>
                            </div>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container" style="width: 100%;">
                                <input type="text" id="shipping-location" required>
                                <label for="shipping-location">Location (Town / City, Street, Home Address)</label>
                            </div>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="text" id="shipping-company">
                                <label for="shipping-company">Company Name (if any)</label>
                            </div>
                            <div class="input-container">
                                <input type="number" id="postcode" required>
                                <label for="postcode">Postcode / ZIP</label>
                            </div>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container" style="width: 100%;">
                                <input type="text" id="order-notes">
                                <label for="order-notes">Order Notes (Special notes related to the delivery,
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
                <tr>
                    <td>PS3 Console</td>
                    <td>2</td>
                    <td>200$</td>
                </tr>
                <tr>
                    <td>PS4 CD game</td>
                    <td>5</td>
                    <td>500$</td>
                </tr>
            </table>
            <table id="order-totals">
                <tr>
                    <th>Subtotal</th>
                    <td>700$</td>
                </tr>
                <tr>
                    <th>Taxes</th>
                    <td>50$</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>750$</td>
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
            <button class="back_to_shoppingbasket" onclick="window.location.href='../basket/basket.php';"
                title="Return to your shopping basket to update your order"><i class="fa fa-arrow-left"></i>Return to
                Your Shopping Basket</button>
            <button title="Submit your order to the shop"><i class="fa fa-paper-plane"></i>Submit your order</button>
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

    
    <script src="../main/main.js"></script>
    <script src="../checkout/checkout.js"></script>
</body>

</php>