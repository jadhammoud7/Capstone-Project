<!DOCTYPE html>
<html lang="en">
<?php
session_reset();
?>
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
                    <a href="../home-page/home-page.html" class="home_menu nav-link" title="Home Page"> <i
                            class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../shop/shop.html" class="shop_menu nav-link" title="Shop Page"><i
                            class="fa fa-shopping-cart fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../appointments/appointments.html" class="appointments_menu nav-link"
                        title="Appointments"><i class="fa fa-wrench fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../contactus/contactus.php" class="contact_menu nav-link" title="Contact Us Page"><i
                            class="fa fa-phone fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../aboutus/aboutus.html" class="about_menu nav-link" title="About us Page"><i
                            class="fa fa-book fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../basket/basket.html" class="basket_menu nav-link" title="View my Shopping Basket"><i
                            class="fa fa-shopping-basket fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../profile/profile.html" class="myaccount_menu nav-link" title="View my account"><i
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
        <h1 style="color: #333;">Hello Mr. X</h1>
        <h5 style="color:#b4c3da;">My Account</h5>
    </div>
    <!-- ended with title page -->
    <?php if(session_status() == 0) { echo "<script>document.getElementById('id01').style.display = 'block';</script>";}?>
    <!-- start login -->
    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close"
            title="Close Modal">&times;</span>
        <form class="modal-content animate" action="../php/login.php" method="post">
            <div class="imgcontainer">
                <!-- <img src="../images/console.png" alt="Avatar" class="avatar"> -->
                <br> <br>
                <h1 class="join_our_family"><i>Join Our Family</i></h1>
            </div>

            <div class="container">
                <label for="user_name"><b>Username</b></label>
                <input class="username_login" id="username" type="text" placeholder="Enter Username" name="username" required
                    title="Enter your username">

                <label for="password"><b>Password</b></label>
                <input class="password_login" id="password" type="password" placeholder="Enter Password" name="password" required
                    title="Enter your password">
                <span>Dont have an account?<a href="../signup/signup.php" title="Sign Up for a new account">Sign
                        up</a></span>
                <br> <br>
                <span class="psw"><b>Forgot</b> <a href=""><b>password?</b></a></span>
                <button class="submit-button" type="submit" title="Log In" style="color: black;"><strong>Login</strong></button>
            </div>
            <div id="canceling" class="container">
                <button type="button" onclick="document.getElementById('id01').style.display='none'"
                    class="cancelbtn" style="color: black; background-color: #F44336;">Back</button>
            </div>
        </form>
    </div>
    <!-- end login -->

    <!-- started with profile body -->
    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="../images/info.png" alt="">
            <ol class="profile-sidebar-user">
                <li id="customer-name" title="My Username"><span>Mr.X</span></li>
                <li id="customer" title="My Status"><span>Customer</span></li>
            </ol>
            <ol class="profile-sidebar-list reveal-by-x">
                <li><a onclick="ShowProfile()" id="profile-button" title="View your own personal info">Profile</a></li>
                <li><a onclick="ShowBasket()" id="basket-button"
                        title="View your current list of products added by you to basket">Shopping Basket</a></li>
                <li><a onclick="ShowFavorites()" id="favorites-button"
                        title="View list of products added by you to your favorites">Favorites List</a></li>
            </ol>
        </div>


        <!-- started profile -->
        <div class="profile fade" style="display: none;">
            <div class="profile-part">
                <h3 id="attribute">First Name: </h3>
                <h3>Mohamad</h3>
            </div>
            <input type="text" name="firstname_editprofile" id="" placeholder="new first name.."
                class="first_name_editprofile" style="display: none;">
            <div class="profile-part">
                <h3 id="attribute">Last Name: </h3>
                <h3>Nabaa</h3>
            </div>
            <input type="text" name="lastname_editprofile" id="" placeholder="new last name.."
                class="last_name_editprofile" style="display: none;">

            <div class="profile-part">
                <h3 id="attribute">Email Address: </h3>
                <h3>mnabaa53@gmail.com</h3>
            </div>
            <input type="text" name="email_editprofile" id="" placeholder="new email.." class="email_editprofile"
                style="display: none;">
            <div class="profile-part">
                <h3 id="attribute">Phone Number: </h3>
                <h3>961 71 123 805</h3>
            </div>
            <input type="text" name="phonenumber_editprofile" id="" placeholder="new phone number.."
                class="phone_number_editprofile" style="display: none;">
            <div class="profile-part">
                <h3 id="attribute">Home Address: </h3>
                <h3>Aramoun, Lebanon</h3>
            </div>
            <input type="text" name="address_editprofile" id="" placeholder="new address.." class="address_editprofile"
                style="display: none;">


            <div class="edit_save_btn">
                <button onclick="ChangeProfile()" class="edit_profile_btn" title="Edit your profile"> <i
                        class="fa fa-edit"></i><strong>Edit
                        Profile</strong></button>
            </div>
        </div>
        <!-- ended profile -->


        <!-- started shopping basket -->
        <div class="basket fade" style="display: none;">
            <div>
                <h2>Shopping Basket</h2>
                <h3>You have total of 4 items in your basket</h3>
            </div>
            <div class="basket-products">
                <div class="basket-product">
                    <div class="basket-product-img">
                        <img src="../images/console.png" alt="basket product" style="width: 50%;">
                    </div>
                    <div class="basket-product-part">
                        <h3>Product Name X</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Quantity</h3>
                        <h4>2</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Price</h3>
                        <h4>200$</h4>
                    </div>
                </div>
                <div class="basket-product">
                    <div class="basket-product-img">
                        <img src="../images/console.png" alt="basket product" style="width: 50%;">
                    </div>
                    <div class="basket-product-part">
                        <h3>Product Name X</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Quantity</h3>
                        <h4>2</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Price</h3>
                        <h4>200$</h4>
                    </div>
                </div>
                <div class="basket-product">
                    <div class="basket-product-img">
                        <img src="../images/console.png" alt="basket product" style="width: 50%;">
                    </div>
                    <div class="basket-product-part">
                        <h3>Product Name X</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Quantity</h3>
                        <h4>2</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Price</h3>
                        <h4>200$</h4>
                    </div>
                </div>
                <div class="basket-product">
                    <div class="basket-product-img">
                        <img src="../images/console.png" alt="basket product" style="width: 50%;">
                    </div>
                    <div class="basket-product-part">
                        <h3>Product Name X</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Quantity</h3>
                        <h4>2</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Price</h3>
                        <h4>200$</h4>
                    </div>
                </div>
                <div>
                    <h3>Total Price: 800$</h3>
                </div>
                <div class="gotoshoppage_profile">
                    <button title="Go to shopping basket to modify or submit your order"><strong>Go To Shopping
                            Basket</strong></button>
                </div>
            </div>
        </div>
        <!-- ended shopping basket -->



        <!-- started favorites -->
        <div class="favorites fade" style="display: none;">
            <div>
                <h2>Favorites List</h2>
                <h3>You have a total of 4 items in favorites list</h3>
            </div>
            <div class="favorites-products">
                <div class="favorites-product-info">
                    <div class="favorites-product-img">
                        <img src="../images/console.png" alt="favorites product" style="width: 50%;">
                    </div>
                    <div class="favorites-product-part">
                        <h3>Product Name X</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class="favorites-product-part">
                        <h3>Price</h3>
                        <h4>200$</h4>
                    </div>
                </div>
                <div class="favorites-product-buttons">
                    <div>
                        <button class="btn" title="Check more information about this product"><i
                                class="fa fa-info-circle"></i><strong>Check Info</strong></button>
                    </div>
                    <div>
                        <button class="btn" title="Remove this product from your favorites list"><i
                                class="fa fa-trash"></i><strong>Remove From Favorites</strong></button>
                    </div>
                </div>
            </div>
            <div class="favorites-products">
                <div class="favorites-product-info">
                    <div class="favorites-product-img">
                        <img src="../images/console.png" alt="favorites product" style="width: 50%;">
                    </div>
                    <div class="favorites-product-part">
                        <h3>Product Name X</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class="favorites-product-part">
                        <h3>Price</h3>
                        <h4>200$</h4>
                    </div>
                </div>
                <div class="favorites-product-buttons">
                    <div>
                        <button class="btn" title="Check more information about this product"><i
                                class="fa fa-info-circle"></i><strong>Check Info</strong></button>
                    </div>
                    <div>
                        <button class="btn" title="Remove this product from your favorites list"><i
                                class="fa fa-trash"></i><strong>Remove From Favorites</strong></button>
                    </div>
                </div>
            </div>
            <div class="favorites-products">
                <div class="favorites-product-info">
                    <div class="favorites-product-img">
                        <img src="../images/console.png" alt="favorites product" style="width: 50%;">
                    </div>
                    <div class="favorites-product-part">
                        <h3>Product Name X</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class="favorites-product-part">
                        <h3>Price</h3>
                        <h4>200$</h4>
                    </div>
                </div>
                <div class="favorites-product-buttons">
                    <div>
                        <button class="btn" title="Check more information about this product"><i
                                class="fa fa-info-circle"></i><strong>Check Info</strong></button>
                    </div>
                    <div>
                        <button class="btn" title="Remove this product from your favorites list"><i
                                class="fa fa-trash"></i><strong>Remove From Favorites</strong></button>
                    </div>
                </div>
            </div>
            <div class="favorites-products">
                <div class="favorites-product-info">
                    <div class="favorites-product-img">
                        <img src="../images/console.png" alt="favorites product" style="width: 50%;">
                    </div>
                    <div class="favorites-product-part">
                        <h3>Product Name X</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class="favorites-product-part">
                        <h3>Price</h3>
                        <h4>200$</h4>
                    </div>
                </div>
                <div class="favorites-product-buttons">
                    <div>
                        <button class="btn" title="Check more information about this product"><i
                                class="fa fa-info-circle"></i><strong> Check Info</strong></button>
                    </div>
                    <div>
                        <button class="btn" title="Remove this product from your favorites list"><i
                                class="fa fa-trash"></i><strong>Remove From Favorites</strong></button>
                    </div>
                </div>
            </div>
            <div class="gotoshoppage_profile">
                <button title="Go to Shop Page"><strong>Go To Shop Page</strong></button>
            </div>
        </div>
        <!-- ended favorites -->

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
                            <a href="../home-page/home-page.html#features" title="View Our specialists and features">Our
                                Specialists & Features</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.html#about-us" title="Know more about us">About Us</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.html#contact-us"
                                title="Contact us for any enquiries or thoughts">Contact Us</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.html#shop-products" title="Take a look at our products">Our
                                Products</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.html#testimonials"
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
                            <a href="../shop/shop.html"
                                title="View all available products in Newbies Gamers and fill your basket to buy">Shop
                                Now</a>
                        </li>
                        <li>
                            <a href="../basket/basket.html" title="View your shopping basket"><i
                                    class="fa fa-shopping-basket"></i>View your shopping basket</a>
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
                            <a href="../aboutus/aboutus.html#history" title="Know about our history">Our History</a>
                        </li>
                        <li>
                            <a href="../aboutus/aboutus.html#establishment" title="Know about our establishment">Our
                                Establishment</a>
                        </li>
                        <li>
                            <a href="../aboutus/aboutus.html#specials" title="See what makes us special">Our
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
                            <a href="../appointments/appointments.html#laptop-repair">Laptop Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.html#laptop-cleaning">Laptop Cleaning</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.html#cpu-repair">CPU Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.html#cpu-cleaning">CPU Cleaning</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.html#phone-repair">Phone Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.html#ps-repair">PS Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.html#controller-repair">Controller Repair</a>
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
                            <a href="../contactus/contactus.html" title="Share your thoughts and concerns to us">Share
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
</body>
<!-- ended footer -->



<script src="../profile/profile.js"></script>

</html>