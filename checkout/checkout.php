<?php

session_start();

include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
} else {
    $customer_id = $_SESSION['logged_id'];
}

$first_name = "";
$last_name = "";
$email = "";
$phone_number = "";
$shipping_country = "";
$shipping_location = "";
$shipping_company = "";
$postcode = "";
$order_notes = "";
$status = 'Pending';

//if button get user info pressed
if (isset($_GET['customerID']) && $_GET['customerID'] != "") {
    $customer_id = $_GET['customerID'];
    $select_customer = $connection->prepare("SELECT first_name, last_name, email, phone_number FROM customers WHERE customer_id = '" . $customer_id . "'");
    $select_customer->execute();
    $select_customer_results = $select_customer->get_result();
    $row_customer = $select_customer_results->fetch_assoc();
    $_SESSION['first_name'] = $row_customer['first_name'];
    $_SESSION['last_name'] = $row_customer['last_name'];
    $_SESSION['email'] = $row_customer['email'];
    $_SESSION['phone_number'] = $row_customer['phone_number'];
}

//check first name
if (isset($_POST['first_name']) && $_POST['first_name'] != "") {
    $first_name = $_POST['first_name'];
    $_SESSION['first_name'] = $first_name;
    for ($i = 0; $i < strlen($first_name); $i++) {
        if (is_numeric($first_name[$i])) {
            $_SESSION['first_name_error'] = "First Name should not contain numbers";
            header("Location: ../checkout/checkout.php");
            die("WRONG first name");
        }
    }
}

//check last name
if (isset($_POST['last_name']) && $_POST['last_name'] != "") {
    $last_name = $_POST['last_name'];
    $_SESSION['last_name'] = $last_name;
    for ($i = 0; $i < strlen($last_name); $i++) {
        if (is_numeric($last_name[$i])) {
            $_SESSION['last_name_error'] = "Last Name should not contain numbers";
            header("Location: ../checkout/checkout.php");
            die("WRONG last name");
        }
    }
}

//check email
if (isset($_POST['email']) && $_POST['email'] != "") {
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
    if (!str_contains($email, ".com") && !str_contains($email, "@")) {
        $_SESSION['email_error'] = "Email is invalid";
        header("Location: ../checkout/checkout.php");
        die("WRONG email");
    }
}

//check phone number
if (isset($_POST["phone_number"]) && $_POST["phone_number"] != "") {
    $phone_number = $_POST["phone_number"];
    $_SESSION['phone_number'] = $phone_number;
    for ($j = 0; $j < strlen($phone_number); $j++) {
        if (!is_numeric($phone_number[$j])) {
            $_SESSION['phone_number_error'] = "Phone number should not contain any characters other than numbers";
            header("Location: ../checkout/checkout.php");
            die("WRONG Phone Number");
        }
    }
}

//check shipping country
if (isset($_POST['shipping_country']) && $_POST['shipping_country'] != "") {
    $shipping_country = $_POST['shipping_country'];
    $_SESSION['shipping_country'] = $shipping_country;
    if (strlen($shipping_country) < 3 || strlen($shipping_country) > 30 || str_contains($shipping_country, ",")) {
        $_SESSION['shipping_country_error'] = "Country invalid";
        header("Location: ../checkout/checkout.php");
        die("WRONG shipping country");
    }
}

//check shipping location
if (isset($_POST['shipping_location']) && $_POST['shipping_location'] != "") {
    $shipping_location = $_POST['shipping_location'];
    $_SESSION['shipping_location'] = $shipping_location;
    if (strlen($shipping_location) < 10 && !str_contains($shipping_location, ",")) {
        $_SESSION['shipping_location_error'] = "Shipping Location should be brief, should be of size 10 minimum and contain \",\" ";
        header("Location: ../checkout/checkout.php");
        die("WRONG shipping location");
    }
}

//check shipping company
if (isset($_POST['shipping_company'])) {
    if ($_POST['shipping_company'] == '') {
        $shipping_company = "none";
    } else {
        $shipping_company = $_POST['shipping_company'];
        $_SESSION['shipping_company'] = $shipping_company;
    }
}

//check postcode
if (isset($_POST['postcode']) && $_POST['postcode'] != "") {
    $postcode = $_POST['postcode'];
    $_SESSION['postcode'] = $postcode;
    if (strlen($postcode) < 5 && strlen($postcode) > 7) {
        $_SESSION['postcode_error'] = "Postcode is invalid. Should be of lenght between 5 and 7.";
        header("Location: ../checkout/checkout.php");
        die("WRONG postcode");
    }
}

//check order notes
if (isset($_POST['order_notes'])) {
    $order_notes = "";
    if ($_POST['order_notes'] == '') {
        $order_notes = "none";
    } else {
        $order_notes = $_POST['order_notes'];
        $_SESSION['order_notes'] = $order_notes;
    }
}

//set success session to true
$_SESSION['success'] = 'true';

// if (!isset($_SESSION['first_name_error']) && !isset($_SESSION['last_name_error']) && !isset($_SESSION['email_error']) && !isset($_SESSION['phone_number_error']) && !isset($_SESSION['shipping_country_error']) && !isset($_SESSION['shipping_location_error']) && !isset($_SESSION['postcode_error'])) {
//     echo "<script>alert('Your form was submitted successfully. An email will be sent to you soon.'); window.location.href='../shop/shop.php';</script>";
// }


if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['date']) && isset($_POST['shipping_country']) && isset($_POST['shipping_location']) && isset($_POST['postcode']) && isset($_SESSION['total_price']) && isset($_SESSION['tax_price']) && isset($_SESSION['total_price_including_tax'])) {
    //add to table checkouts all checkout info
    $total_price = $_SESSION['total_price'];
    $tax_price = $_SESSION['tax_price'];
    $total_price_including_tax = $_SESSION['total_price_including_tax'];
    $date = $_POST['date'];
    $insert_checkouts = $connection->prepare("INSERT INTO checkouts(customer_id, first_name, last_name, email, phone_number, shipping_country, shipping_location, shipping_company, postcode, order_notes, total_price, tax_price, total_price_including_tax, status, date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $insert_checkouts->bind_param("isssssssssdddss", $customer_id, $first_name, $last_name, $email, $phone_number, $shipping_country, $shipping_location, $shipping_company, $postcode, $order_notes, $total_price, $tax_price, $total_price_including_tax, $status, $date);
    $insert_checkouts->execute();
    $insert_checkouts->close();

    //get last checkout id
    $stmt_get_checkout_id = $connection->prepare("SELECT checkout_id FROM checkouts ORDER BY checkout_id DESC LIMIT 1");
    $stmt_get_checkout_id->execute();
    $results_get_checkout_id = $stmt_get_checkout_id->get_result();

    if ($row_get_checkout_id = $results_get_checkout_id->fetch_assoc()) {
        $checkout_id = $row_get_checkout_id['checkout_id'];

        //get products in basket for current user
        $query_basket = $connection->prepare("SELECT product_id, quantity, price FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "' ");
        $query_basket->execute();
        $query_basket_result = $query_basket->get_result();


        while ($row_basket = $query_basket_result->fetch_assoc()) {
            //insert into table checkouts customers products
            $query_checkout = $connection->prepare("INSERT INTO checkouts_customers_products(checkout_id, product_id, quantity, total_price) VALUES (?,?,?,?)");
            $query_checkout->bind_param("iiii", $checkout_id, $row_basket['product_id'], $row_basket['quantity'], $row_basket['price']);
            $query_checkout->execute();
            $query_checkout->close();
        }
        //display alert successful
        echo "<script>window.location='../checkout/checkout.php?checkout_form_submitted=true';</script>";

        //delete all products from basket
        $delete_basket = $connection->prepare("DELETE FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "'");
        $delete_basket->execute();
    }
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

//to display products in table summary
$stmt_get_basket_products = $connection->prepare("SELECT product_id, quantity FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "' ");
$stmt_get_basket_products->execute();
$results_get_basket_products = $stmt_get_basket_products->get_result();
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
    <title>CheckOut - Newbies Gamers</title>
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


    <!-- started popup message checkout form received -->
    <div class="popup" id="checkout-received-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Checkout Received</h2>
        <p>Your checkout form is received. Stay in touch to receive an email from us, and keep updated with your order progress from your profile page</p>
        <button type="button" onclick="RemoveCheckoutReceivedPopUp()">OK</button>
    </div>

    <!-- started with title page -->
    <div class="title">
        <h1 style="color: #333;">Checkout</h1>
        <h5 style="color:#b4c3da;">My Basket / Checkout</h5>
    </div>
    <!-- ended with title page -->



    <!-- started with checkout form -->
    <div>
        <div class="login-part">
            <p class="login-part-par">Want to proceed with the checkout faster with your personal information? </p>
            <button class="login-button" title="Click in order to proceed with the checkout with your account personal info" style="color: black;" onclick="window.location='../checkout/checkout.php?customerID=<?php echo $customer_id ?>';"><strong>Use your personal information</strong></button>
        </div>
        <div class="billing-details">
            <h2>Billing Details</h2>
            <div class="form-container">
                <form action="../checkout/checkout.php" method="POST">

                    <div class="form-container-part">

                        <div>
                            <h3 class="form-container-part-title">Personal Information</h3>
                        </div>
                        <p class="error" id="first_name_error">
                            <?php
                            if (isset($_SESSION['first_name_error'])) {
                                echo "<script>document.getElementById('first_name_error').style.display='block';</script>";
                                echo $_SESSION['first_name_error'];
                                unset($_SESSION['first_name_error']);
                            }
                            ?>
                        </p>
                        <p class="error" id="last_name_error">
                            <?php
                            if (isset($_SESSION['last_name_error'])) {
                                echo "<script>document.getElementById('last_name_error').style.display='block';</script>";
                                echo $_SESSION['last_name_error'];
                                unset($_SESSION['last_name_error']);
                            }
                            ?>
                        </p>

                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="text" name="first_name" id="first_name" value="<?php if (isset($_SESSION['first_name'])) {
                                                                                                echo $_SESSION['first_name'];
                                                                                            } ?>" required>
                                <label for="first_name">First Name</label>
                            </div>

                            <div class="input-container">

                                <input type="text" name="last_name" id="last_name" value="<?php if (isset($_SESSION['last_name'])) {
                                                                                                echo $_SESSION['last_name'];
                                                                                            } ?>" required>
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>
                        <p class="error" id="email_error">
                            <?php
                            if (isset($_SESSION['email_error'])) {
                                echo "<script>document.getElementById('email_error').style.display='block';</script>";
                                echo $_SESSION['email_error'];
                                unset($_SESSION['email_error']);
                            }
                            ?>
                        </p>
                        <p class="error" id="phone_number_error">
                            <?php
                            if (isset($_SESSION['phone_number_error'])) {
                                echo "<script>document.getElementById('phone_number_error').style.display='block';</script>";
                                echo $_SESSION['phone_number_error'];
                                unset($_SESSION['phone_number_error']);
                            } ?>
                        </p>
                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="email" name="email" id="email" value="<?php if (isset($_SESSION['email'])) {
                                                                                        echo $_SESSION['email'];
                                                                                    } ?>" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-container">

                                <input type="tel" name="phone_number" id="phone_number" value="<?php if (isset($_SESSION['phone_number'])) {
                                                                                                    echo $_SESSION['phone_number'];
                                                                                                } ?>" required>
                                <label for="phone_number">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-container-part">
                        <div>
                            <h3 class="form-container-part-title">Shipping Details</h3>
                        </div>
                        <p class="error" id="shipping_country_error">
                            <?php
                            if (isset($_SESSION['shipping_country_error'])) {
                                echo "<script>document.getElementById('shipping_country_error').style.display='block';</script>";
                                echo $_SESSION['shipping_country_error'];
                                unset($_SESSION['shipping_country_error']);
                            }
                            ?>
                        </p>
                        <div class="form-container-part-inputs">
                            <div class="input-container">
                                <input type="text" name="date" value="" id="date" readonly>
                                <label for="date">Date</label>
                            </div>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container">

                                <input type="text" name="shipping_country" id="shipping_country" value="<?php if (isset($_SESSION['shipping_country'])) {
                                                                                                            echo $_SESSION['shipping_country'];
                                                                                                        } ?>" required>
                                <label for="shipping_country">Country</label>
                            </div>
                        </div>
                        <p class="error" id="shipping_location_error">
                            <?php
                            if (isset($_SESSION['shipping_location_error'])) {
                                echo "<script>document.getElementById('shipping_location_error').style.display='block';</script>";
                                echo $_SESSION['shipping_location_error'];
                                unset($_SESSION['shipping_location_error']);
                            }
                            ?>
                        </p>
                        <div class="form-container-part-inputs">
                            <div class="input-container" style="width: 100%;">

                                <input type="text" name="shipping_location" id="shipping_location" value="<?php if (isset($_SESSION['shipping_location'])) {
                                                                                                                echo $_SESSION['shipping_location'];
                                                                                                            } ?>" required>
                                <label for="shipping_location">Address (Town / City, Street, Building)</label>
                            </div>
                        </div>
                        <p class="error" id="shipping_company_error">
                            <?php
                            if (isset($_SESSION['shipping_company_error'])) {
                                echo "<script>document.getElementById('shipping_company_error').style.display='block';</script>";
                                echo $_SESSION['shipping_company_error'];
                                unset($_SESSION['shipping_company_error']);
                            }
                            ?>
                        </p>
                        <p class="error" id="postcode_error">
                            <?php
                            if (isset($_SESSION['postcode_error'])) {
                                echo "<script>document.getElementById('postcode_error').style.display='block';</script>";
                                echo $_SESSION['postcode_error'];
                                unset($_SESSION['postcode_error']);
                            }
                            ?>
                        </p>
                        <div class="form-container-part-inputs">
                            <div class="input-container">

                                <input type="text" name="shipping_company" id="shipping_company" value="<?php if (isset($_SESSION['shipping_company'])) {
                                                                                                            echo $_SESSION['shipping_company'];
                                                                                                        } ?>">
                                <label for="shipping_company">Company Name (if any)</label>
                            </div>
                            <div class="input-container">

                                <input type="number" name="postcode" id="postcode" value="<?php if (isset($_SESSION['postcode'])) {
                                                                                                echo $_SESSION['postcode'];
                                                                                            } ?>" required>
                                <label for="postcode">Postcode / ZIP</label>
                            </div>
                        </div>
                        <div class="form-container-part-inputs">
                            <div class="input-container" style="width: 100%;">
                                <input type="text" name="order_notes" id="order-notes" value="<?php if (isset($_SESSION['order_notes'])) {
                                                                                                    echo $_SESSION['order_notes'];
                                                                                                } ?>">
                                <label for="order_notes">Order Notes (Special notes related to the delivery,
                                    optional)</label>
                            </div>
                        </div>
                    </div>
                    <button title="Submit your order to the shop" type="submit"><i class="fa fa-paper-plane"></i>Submit your order</button>
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
                while ($row_get_basket_products = $results_get_basket_products->fetch_assoc()) {
                    $stmt_get_product = $connection->prepare("SELECT name, price FROM products WHERE product_id = '" . $row_get_basket_products["product_id"] . "' ");
                    $stmt_get_product->execute();
                    $results_get_product = $stmt_get_product->get_result();
                    $row_get_product = $results_get_product->fetch_assoc();
                    checkout_products_connection($row_get_product['name'], $row_get_basket_products['quantity'], $row_get_product['price']);
                }
                ?>
            </table>
            <table id="order-totals">
                <tr>
                    <th>Subtotal</th>
                    <td><?php echo $_SESSION['total_price']; ?>$</td>
                </tr>
                <tr>
                    <th>Taxes</th>
                    <td><?php echo $_SESSION['tax_price']; ?>$</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><?php echo $_SESSION['total_price_including_tax']; ?>$</td>
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
            <button class="back_to_shoppingbasket" onclick="window.location.href='../basket/basket.php';" title="Return to your shopping basket to update your order"><i class="fa fa-arrow-left"></i>Return to
                Your Shopping Basket</button>
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