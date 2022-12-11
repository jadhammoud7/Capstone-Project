<?php

session_start();
include('../php/connection.php');

if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] != 'customer') {
    header("Location: ../home-admin/home-admin.php");
}
if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
require_once('../php/shop_product_connection.php');

//if no get request of type was sent meaning starter
if (!isset($_GET['type'])) {
    $query = "SELECT * FROM products";
    date_default_timezone_set('Asia/Beirut');
    $currentDate = (new DateTime())->format('Y-m-d');
    $stmt_select_products_offers = $connection->prepare("SELECT * FROM products_offers WHERE '" . $currentDate . "' BETWEEN offer_begin_date AND offer_end_date");
    $stmt_select_products_offers->execute();
    $result_products_offers = $stmt_select_products_offers->get_result();

    $_SESSION['title'] = 'All'; //for the title of the div 
    if (!isset($_GET['category'])) { //if no category filter was set
        if (!isset($_GET['newness'])) {
            $query = $query . " WHERE has_offer = 'NO' "; //check all products to type equals to cds
        } else {
            $newness = $_GET['newness'];
            $query = $query . " WHERE has_offer = 'NO' AND category = '" . $newness . "'"; //check all products to type equals to cds and category category
        }
    } else { //if a category filter was sent while no filter for type was sent
        $category = $_GET['category'];
        $query = $query . " WHERE has_offer = 'NO' AND category = '" . $category . "'"; //check all products to type equals to cds and category category
    }
    $stmt_select_products = $connection->prepare($query);
    $stmt_select_products->execute();
    $results_shop = $stmt_select_products->get_result();
}

//if selected button to view products by type only not filter
if (isset($_GET['type']) && !isset($_GET['category']) && !isset($_GET['sortby'])) {
    $type = $_GET['type']; //display cds as a starter
    $_SESSION['title'] = $type; //for the title of the div 

    date_default_timezone_set('Asia/Beirut');
    $currentDate = (new DateTime())->format('Y-m-d');
    //select all offers of type and category
    $query_select_products = "SELECT * FROM products WHERE has_offer='NO' AND type = '" . $type . "'";
    $query_select_products_offers = "SELECT * FROM products_offers WHERE type = '" . $type . "' AND '" . $currentDate . "' BETWEEN offer_begin_date AND offer_end_date";

    $stmt_select_products_offers = $connection->prepare($query_select_products_offers);
    $stmt_select_products_offers->execute();
    $result_products_offers = $stmt_select_products_offers->get_result();

    $stmt_select_products = $connection->prepare($query_select_products);
    $stmt_select_products->execute();
    $results_shop = $stmt_select_products->get_result();
}
//if a get request of type was sent
if (isset($_GET['type']) && isset($_GET['category']) && isset($_GET['sortby'])) {
    $type = $_GET['type'];
    $category = $_GET['category'];
    $sortby = $_GET['sortby'];
    $_SESSION['title'] = $type;
    //if offers button is selected

    date_default_timezone_set('Asia/Beirut');
    $currentDate = (new DateTime())->format('Y-m-d');
    //select all offers of type and category
    $query_select_products = "SELECT * FROM products WHERE has_offer='NO'";
    $query_select_products_offers = "SELECT * FROM products_offers";
    if ($category == 'any') {
        $query_select_products = $query_select_products . " AND type= '" . $type . "' ";
        $query_select_products_offers = $query_select_products_offers . " WHERE type='" . $type . "'  AND '" . $currentDate . "' BETWEEN offer_begin_date AND offer_end_date"; //check all products to type equals to cds
    } else {
        $query_select_products = $query_select_products . " AND type='" . $type . "' AND category = '" . $category . "'"; //check all products to type equals to cds and category category
        $query_select_products_offers = $query_select_products_offers . " AND type='" . $type . "' AND category = '" . $category . "'  AND '" . $currentDate . "' BETWEEN offer_begin_date AND offer_end_date"; //check all products to type equals to cds and category category
    }
    $stmt_select_products_offers = $connection->prepare($query_select_products_offers);
    $stmt_select_products_offers->execute();
    $result_products_offers = $stmt_select_products_offers->get_result();

    //now select all products without offers of type and category
    if ($sortby == 'newest') {
        $query_select_products = $query_select_products . " ORDER BY date_added DESC";
    }
    if ($sortby == 'highest-price') {
        $query_select_products = $query_select_products . " ORDER BY price DESC";
    }
    if ($sortby == 'lowest-price') {
        $query_select_products = $query_select_products . " ORDER BY price ASC";
    }
    if ($sortby == 'popularity') {
        $query_select_products = $query_select_products . " ORDER BY sales DESC";
    }

    $stmt_select_products = $connection->prepare($query_select_products);
    $stmt_select_products->execute();
    $results_shop = $stmt_select_products->get_result();
}

function UpdateTypeSelect($type_current) //this function is called to keep the current filter selected in the dropdown select of type
{
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        if ($type == $type_current) { //if the option in select is the same as the name of type sent, meaning this option was selected by user, then it should stay selected to be shown first in list
            $_SESSION[$type . '_selected'] = "selected";
        } else { //is this current option is not the option selected by the user
            unset($_SESSION[$type_current . '_selected']);
        }
    }
}


function UpdateCategorySelect($category_current) //this function is called to keep the current filter selected in the dropdown select of category
{
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        if ($category == $category_current) { //if the option in select is the same as the name of type sent, meaning this option was selected by user, then it should stay selected to be shown first in list
            $_SESSION[$category . '_selected'] = "selected";
        } else { //is this current option is not the option selected by the user
            unset($_SESSION[$category_current . '_selected']);
        }
    }
}

function UpdateSortSelect($sort_current)
{
    if (isset($_GET['sortby'])) {
        $sortby = $_GET['sortby'];
        if ($sortby == $sort_current) {
            $_SESSION[$sortby . '_selected'] = "selected";
        } else {
            unset($_SESSION[$sort_current . '_selected']);
        }
    }
}

//for filters cd
$query_filter_cd = "SELECT * FROM products WHERE category='XBOX Cd' or category='PS3 Cd' or category='PS4 Cd' or category='PS5 Cd' ";
$stmt_filter_cd = $connection->prepare($query_filter_cd);
$stmt_filter_cd->execute();
$results_filter_cd = $stmt_filter_cd->get_result();

//for consoles filter
$query_console_filter = "SELECT * FROM products WHERE category='PS3' or category='PS4' or category='PS5'";
$stmt_console_filter = $connection->prepare($query_console_filter);
$stmt_console_filter->execute();
$results_console_filter = $stmt_console_filter->get_result();

//adding loyalty points to customers table
$query_customers = "SELECT customer_id FROM customers";
$stmt_customers = $connection->prepare($query_customers);
$stmt_customers->execute();
$results_customers = $stmt_customers->get_result();

while ($row_customers = $results_customers->fetch_assoc()) {
    $query_get_customer_checkouts = "SELECT checkout_id FROM checkouts WHERE customer_id = '" . $row_customers['customer_id'] . "'";
    $stmt_get_customer_checkouts = $connection->prepare($query_get_customer_checkouts);
    $stmt_get_customer_checkouts->execute();
    $results_get_customer_checkouts = $stmt_get_customer_checkouts->get_result();

    $loyalty_points = 0;

    while ($row_checkouts = $results_get_customer_checkouts->fetch_assoc()) {
        $query_loyalty_baught_products = "SELECT SUM(quantity) as sum_products_of_single_customer FROM checkouts_customers_products WHERE checkout_id = '" . $row_checkouts['checkout_id'] . "'";
        $stmt_loyalty_baught_products = $connection->prepare($query_loyalty_baught_products);
        $stmt_loyalty_baught_products->execute();
        $results_loyalty_baught_products = $stmt_loyalty_baught_products->get_result();

        while ($row_loyalty_baught_products = $results_loyalty_baught_products->fetch_assoc()) {
            $loyalty_points = $loyalty_points + $row_loyalty_baught_products['sum_products_of_single_customer'];
        }

        // updating loyalty points of customers in db     
        $stmt_update_loyalty = $connection->prepare("UPDATE customers SET loyalty_points = ? WHERE customer_id = '" . $row_customers['customer_id'] . "'");
        $stmt_update_loyalty->bind_param("i", $loyalty_points);
        $stmt_update_loyalty->execute();
        $stmt_update_loyalty->close();
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
    <link rel="stylesheet" href="../main/main.css">
    <link rel="stylesheet" href="../home-page/home-page.css">
    <link rel="stylesheet" href="../contactus/contactus.css">
    <link rel="stylesheet" href="../shop/shop.css">
    <title>Shop - Newbies Gamers</title>
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


    <!-- started popup message found in basket -->
    <div class="popup" id="found-in-basket-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Added To Basket</h2>
        <p>Product already added to basket. Quantity added.</p>
        <button type="button" onclick="RemoveFoundInBasketPopUp()">OK</button>
        <button type="button" onclick="GoToBasket()">Go To Shopping Basket</button>
    </div>

    <!-- started popup message added to basket -->
    <div class="popup" id="added-to-basket-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Added To Basket</h2>
        <p>Product has been added to your basket</p>
        <button type="button" onclick="RemoveAddToBasketPopUp()">OK</button>
        <button type="button" onclick="GoToBasket()">Go To Shopping Basket</button>
    </div>

    <!-- started popup message added to favorites -->
    <div class="popup" id="added-to-favorites-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Added To Favorites</h2>
        <p>Product has been added to your favorites list</p>
        <button type="button" onclick="RemoveAddedToFavoritesPopUp()">OK</button>
    </div>

    <!-- started popup message added to basket -->
    <div class="popup" id="found-in-favorites-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Found In Favorites</h2>
        <p>Product is already found in your favorites list</p>
        <button type="button" onclick="RemoveFoundInFavoritesPopUp()">OK</button>
    </div>


    <!-- started with title page -->
    <div class="title">
        <h1 style="color: #333;">Shop</h1>
        <h5 style="color:#b4c3da;">Home / Shop</h5>
    </div>
    <!-- ended with title page -->

    <!-- started with products options -->
    <div class="tabs">
        <?php
        $stmt_select_types = $connection->prepare("SELECT type FROM product_types LIMIT 3");
        $stmt_select_types->execute();
        $result_types = $stmt_select_types->get_result();
        while ($row_types = $result_types->fetch_assoc()) {
            $type = $row_types['type']; ?>
            <button id="<?php echo $type; ?>-btn" data-cont=".<?php echo $type; ?>" onclick="window.location = '?type=<?php echo $type; ?>';" title="Select all <?php echo $type; ?> products"><?php echo $type; ?></button>
        <?php
        } ?>
        <button id="offers-btn" data-cont=".offers" onclick="window.location ='?type=offers';" title="Select all offers">Offers</button>
        <button id="others-btn" data-cont=".others" onclick="window.location='?type=others';" title="Select other products">Others</button>
    </div>

    <!-- start search button -->
    <form action="../search/search.php" method="POST">
        <div class="search-container">
            <input type="text" placeholder="Search for a product.." name="search">
            <button type="submit" name="submit_search" title="Search for products that have name matching the one entered"><i class="fa fa-search"></i></button>
        </div>
    </form>
    <!-- end search button -->



    <!-- started filters -->
    <div class="tabs-filter">
        <button onclick="ShowFilters()" title="Open Filters Options to search products according to specific criteria you chose"><i class="fa fa-filter"></i>Filter</button>
        <div class="filters" style="display: none;">
            <div>
                <h2>Type</h2>
                <button>
                    <label for="type">
                        <select name="type" id="type">
                            <option value="all" <?php
                                                UpdateTypeSelect('all');
                                                if (isset($_SESSION['all_selected'])) { //check for session all selected, if isset then value is selected, so that the option value for that remains first in the dropdown list so user can know the last filter used
                                                    echo $_SESSION['all_selected'];
                                                } ?>>All</option>
                            <?php
                            $stmt_select_types = $connection->prepare("SELECT type FROM product_types");
                            $stmt_select_types->execute();
                            $result_types = $stmt_select_types->get_result();
                            while ($row_types = $result_types->fetch_assoc()) {
                                $type = $row_types['type']; ?>
                                <option value="<?php echo $type; ?>" <?php
                                                                        UpdateTypeSelect('"' . $type . '"');

                                                                        if (isset($_SESSION[$type . '_selected'])) {
                                                                            echo $_SESSION[$type . '_selected'];
                                                                        } ?>>
                                    <?php echo $type; ?>
                                </option>
                            <?php
                            } ?>
                        </select>
                    </label>
                </button>
            </div>
            <div>
                <h2>Category</h2>
                <label for="category">
                    <button>
                        <select name="category" id="category">
                            <option value="any" <?php
                                                UpdateCategorySelect('any');
                                                if (isset($_SESSION['any_selected'])) { //check for session all selected, if isset then value is selected, so that the option value for that remains first in the dropdown list so user can know the last filter used
                                                    echo $_SESSION['any_selected'];
                                                } ?>>All</option>
                            <?php
                            $stmt_select_product_categories = $connection->prepare("SELECT category FROM product_categories LIMIT 3");
                            $stmt_select_product_categories->execute();
                            $result_product_categories = $stmt_select_product_categories->get_result();
                            while ($row_product_categories = $result_product_categories->fetch_assoc()) {
                                $category = $row_product_categories['category'];
                            ?>
                                <option value="<?php echo $category; ?>" <?php
                                                                            UpdateCategorySelect('"' . $category . '"');

                                                                            if (isset($_SESSION[$category . '_selected'])) {
                                                                                echo $_SESSION[$category . '_selected'];
                                                                            } ?>>
                                    <?php echo $category; ?>
                                </option>
                            <?php
                            } ?>
                        </select>
                    </button>
                </label>
            </div>
            <div>
                <h2>Sort By</h2>
                <label for="newness">
                    <button>
                        <select name="sortby" id="sortby">
                            <option value="none" <?php
                                                    UpdateSortSelect('none');
                                                    if (isset($_SESSION['none_selected'])) {
                                                        echo $_SESSION['none_selected'];
                                                    } ?>>None</option>
                            <option value="newest" <?php
                                                    UpdateSortSelect('newest');
                                                    if (isset($_SESSION['newest_selected'])) {
                                                        echo $_SESSION['newest_selected'];
                                                    } ?>>Newness</option>
                            <option value="highest-price" <?php
                                                            UpdateSortSelect('highest-price');
                                                            if (isset($_SESSION['highest-price_selected'])) {
                                                                echo $_SESSION['highest-price_selected'];
                                                            } ?>>Price-highest</option>
                            <option value="lowest-price" <?php
                                                            UpdateSortSelect('lowest-price');
                                                            if (isset($_SESSION['lowest-price_selected'])) {
                                                                echo $_SESSION['lowest-price_selected'];
                                                            } ?>>Price-lowest</option>
                            <option value="popularity" <?php
                                                        UpdateSortSelect('popular');
                                                        if (isset($_SESSION['popular_selected'])) {
                                                            echo $_SESSION['popular_selected'];
                                                        } ?>>Popularity</option>
                        </select>
                    </button>
                </label>
            </div>
        </div>
        <div id="filter-btn" style="display: none;">
            <button onclick="SendFilters()"><i class="fa fa-check"></i>Apply Filters</button>
        </div>
    </div>
    <!-- ended filters -->

    <div>
        <h2 class="shop-title">Shop</h2>
        <h4 class="results-title" id="filter-result">Showing results of products of type "<?php if (isset($_GET['type'])) {
                                                                                                echo $_GET['type'];
                                                                                            }
                                                                                            ?>" and category "<?php if (isset($_GET['category'])) {
                                                                                                                    echo $_GET['category'];
                                                                                                                }
                                                                                                                ?>"</h4>

        <?php if (!isset($_GET['category'])) {
            echo "<script>document.getElementById('filter-result').style.display = 'none';</script>";
        } ?>

    </div>

    <div class="content">
        <!-- start first tab -->
        <div class="cd reveal-by-x" style="display: block;">
            <div class="shop-products">
                <div class="shop-products-title" id="shop-products">
                    <h1><?php echo $_SESSION['title']; ?></h1>
                </div>
                <?php
                if (!empty($result_products_offers)) {
                    while ($row_offers = $result_products_offers->fetch_assoc()) {
                        $select_product = $connection->prepare("SELECT name, image FROM products WHERE product_id = '" . $row_offers['product_id'] . "'");
                        $select_product->execute();
                        $result_product = $select_product->get_result();
                        $row_product = $result_product->fetch_assoc();
                        shop_offers_connection(
                            $row_offers['product_id'],
                            $row_product['name'],
                            $row_offers['old_price'],
                            $row_offers['new_price'],
                            $row_product['image']
                        );
                    }
                }
                if (!empty($results_shop)) {
                    while ($row = $results_shop->fetch_assoc()) {
                        shop_connection(
                            $row['product_id'],
                            $row['name'],
                            $row['unit_price'],
                            $row['image']
                        );
                    }
                }
                ?>
            </div>
        </div>
        <!-- end first tab -->
    </div>
    <!-- ended with products -->

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

<script>
    <?php
    $stmt_select_product_types = $connection->prepare("SELECT type FROM product_types LIMIT 3");
    $stmt_select_product_types->execute();
    $result_product_types = $stmt_select_product_types->get_result();
    ?>
    var first_type = '<?php if ($row_product_types = $result_product_types->fetch_assoc()) {
                            echo $row_product_types['type'];
                        } ?>';
    var second_type = '<?php if ($row_product_types = $result_product_types->fetch_assoc()) {
                            echo $row_product_types['type'];
                        } ?>';
    var third_type = '<?php if ($row_product_types = $result_product_types->fetch_assoc()) {
                            echo $row_product_types['type'];
                        } ?>';

    var first_type_button = document.getElementById(first_type + '-btn');
    var second_type_button = document.getElementById(second_type + '-btn');
    var third_type_button = document.getElementById(third_type + '-btn');
    var offers_button = document.getElementById('offers-btn');
    var others_button = document.getElementById('others-btn');

    if (window.location.href.includes(first_type)) {
        first_type_button.classList.add('active');
        second_type_button.classList.remove('active');
        third_type_button.classList.remove('active');
        offers_button.classList.remove('active');
        others_button.classList.remove('active');
    }
    if (window.location.href.includes(second_type)) {
        first_type_button.classList.remove('active');
        second_type_button.classList.add('active');
        third_type_button.classList.remove('active');
        offers_button.classList.remove('active');
        others_button.classList.remove('active');
    }
    if (window.location.href.includes(third_type)) {
        first_type_button.classList.remove('active');
        second_type_button.classList.remove('active');
        third_type_button.classList.add('active');
        offers_button.classList.remove('active');
        others_button.classList.remove('active');
    }
    if (window.location.href.includes('offers')) {
        first_type_button.classList.remove('active');
        second_type_button.classList.remove('active');
        third_type_button.classList.remove('active');
        offers_button.classList.add('active');
        others_button.classList.remove('active');
    }
    if (window.location.href.includes('others')) {
        first_type_button.classList.remove('active');
        second_type_button.classList.remove('active');
        third_type_button.classList.remove('active');
        offers_button.classList.remove('active');
        others_button.classList.add('active');
    }
</script>

</php>