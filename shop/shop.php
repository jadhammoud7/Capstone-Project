<!DOCTYPE html>
<html lang="en">
<?php

session_start();
if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
require_once('../php/shop_product_connection.php');

//if no get request of type was sent meaning starter
if (!isset($_GET['type'])) {
    $type = 'cds'; //display cds as a starter
    $_SESSION['title'] = $type; //for the title of the div 
    if (!isset($_GET['category'])) {
        $query = "SELECT product_id,name, price FROM products WHERE type='" . $type . "' "; //check all products to type equals to cds
    } else {
        $category = $_GET['category'];
        $query = "SELECT product_id,name, price FROM products WHERE type='" . $type . "' AND category = '" . $category . "'"; //check all products to type equals to cds and category category
    }
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $results_shop = $stmt->get_result();
}
//if a get request of type was sent
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $_SESSION['title'] = $type;
    if ($type == "all") { //if type chosen is all then choose all products without conditions on products
        if (!isset($_GET['category'])) {
            $query = "SELECT product_id,name, price FROM products"; //check all products to type equals to cds
        } else {
            $category = $_GET['category'];
            $query = "SELECT product_id,name, price FROM products WHERE category = '" . $category . "'"; //check all products to type equals to cds and category category
        }
    } else { //chose products of type type
        if (!isset($_GET['category'])) {
            $query = "SELECT product_id,name, price FROM products WHERE type='" . $type . "' "; //check all products to type equals to cds
        } else {
            $category = $_GET['category'];
            $query = "SELECT product_id,name, price FROM products WHERE type='" . $type . "' AND category = '" . $category . "'"; //check all products to type equals to cds and category category
        }
    }
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $results_shop = $stmt->get_result();
}

function UpdateTypeSelect($type_current) //this function is called to keep the current filter selected in the dropdown select of type
{
    if (isset($_GET['type'])) {
        if ($_GET['type'] == $type_current) { //if the option in select is the same as the name of type sent, meaning this option was selected by user, then it should stay selected to be shown first in list
            $_SESSION[$_GET['type'] . '_selected'] = "selected";
        } else { //is this current option is not the option selected by the user
            unset($_SESSION[$type_current . '_selected']);
        }
    }
}


function UpdateCategorySelect($category_current) //this function is called to keep the current filter selected in the dropdown select of category
{
    if (isset($_GET['category'])) {
        if ($_GET['category'] == $category_current) { //if the option in select is the same as the name of type sent, meaning this option was selected by user, then it should stay selected to be shown first in list
            $_SESSION[$_GET['category'] . '_selected'] = "selected";
        } else { //is this current option is not the option selected by the user
            unset($_SESSION[$category_current . '_selected']);
        }
    }
}

//for the search btn
// if (isset($GET['search'])) {
//     $searchq = $_GET['search'];
//     $stmt_search = $connection->prepare("SELECT * FROM products WHERE name='$searchq'");
//     $stmt_search->execute();
//     $results_search = $stmt_search->get_result();

// }`

//for filters cd
$query_filter_cd = "SELECT product_id,name, price FROM products WHERE category='XBOX Cd' or category='PS3 Cd' or category='PS4 Cd' or category='PS5 Cd' ";
$stmt_filter_cd = $connection->prepare($query_filter_cd);
$stmt_filter_cd->execute();
$results_filter_cd = $stmt_filter_cd->get_result();
//for consoles filter
$query_console_filter = "SELECT product_id,name, price FROM products WHERE category='PS3' or category='PS4' or category='PS5'";
$stmt_console_filter = $connection->prepare($query_console_filter);
$stmt_console_filter->execute();
$results_console_filter = $stmt_console_filter->get_result();


?>

<head>
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
            <a href="" class="nav-branding">Newbie Gamers.</a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="../home-page/home-page.php" class="home_menu nav-link" title="Home Page"> <i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../shop/shop.php" class="shop_menu nav-link" title="Shop Page"><i class="fa fa-shopping-cart fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../appointments/appointments.php" class="appointments_menu nav-link" title="Appointments"><i class="fa fa-wrench fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../contactus/contactus.php" class="contact_menu nav-link" title="Contact Us Page"><i class="fa fa-phone fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../aboutus/aboutus.php" class="about_menu nav-link" title="About us Page"><i class="fa fa-book fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../basket/basket.php" class="basket_menu nav-link" title="View my Shopping Basket"><i class="fa fa-shopping-basket fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../profile/profile.php" class="myaccount_menu nav-link" title="View my account"><i class="fa fa-user fa-lg" style="margin-bottom: 30px;"></i></a>
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
        <h1 style="color: #333;">Shop</h1>
        <h5 style="color:#b4c3da;">Home / Shop</h5>
    </div>
    <!-- ended with title page -->

    <!-- started with products options -->
    <div class="tabs">
        <button class="active" data-cont=".cd" onclick="window.location = '?type=cds'">CD's</button>
        <button data-cont=".consoles" onclick="window.location = '?type=consoles';">consoles</button>
        <button data-cont=".cellphones" onclick="window.location = '?type=phones';">CellPhones</button>
        <button data-cont=".offers" onclick="window.location ='?type=offers';">Offers</button>
        <button data-cont=".others" onclick="window.location='?type=others';">Others</button>
    </div>

    <!-- start search button -->
    <form action="../shop/shop.php" method="GET">
        <div class="search-container">
            <input type="text" placeholder="Search for a product.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>

        </div>
    </form>
    <!-- end search button -->



    <!-- started filters -->
    <div class="tabs-filter">
        <button onclick="ShowFilters()"><i class="fa fa-filter"></i>Filter</button>
        <div class="filters" style="display: none;">
            <div>
                <h2>Type</h2>
                <button>
                    <label for="type">
                        <select name="type" id="type" onchange="
                            var select = document.getElementById('type');
                            var option = select.options[select.selectedIndex];

                            var current_url = window.location.href;
                            
                            window.location = '?type=' + option.value;

                            var select_category = document.getElementById('category');
                            var option_category = select_category.options[select_category.selectedIndex];

                            var current_url = window.location.href;

                            if(!current_url.includes('category')){
                                window.location = '?type=' + option.value;
                            }
                            else{
                                window.location = '?type=' + option.value + '&category=' + option_category.value;
                            }
                                                 
                        ">
                            <option value="all" <?php
                                                UpdateTypeSelect('all');
                                                if (isset($_SESSION['all_selected'])) {
                                                    echo $_SESSION['all_selected'];
                                                } ?>>All</option>
                            <option value="cds" <?php
                                                UpdateTypeSelect('cds');

                                                if (isset($_SESSION['cds_selected'])) {
                                                    echo $_SESSION['cds_selected'];
                                                } ?>>CDs</option>
                            <option value="consoles" <?php
                                                        UpdateTypeSelect('consoles');

                                                        if (isset($_SESSION['consoles_selected'])) {
                                                            echo $_SESSION['consoles_selected'];
                                                        } ?>>Consoles</option>
                            <option value="accessories" <?php
                                                        UpdateTypeSelect('accessories');

                                                        if (isset($_SESSION['accessories_selected'])) {
                                                            echo $_SESSION['accessories_selected'];
                                                        } ?>>Accessories</option>
                            <option value="phones" <?php
                                                    UpdateTypeSelect('phones');

                                                    if (isset($_SESSION['phones_selected'])) {
                                                        echo $_SESSION['phones_selected'];
                                                    } ?>>Phones</option>
                            <option value="cards" <?php
                                                    UpdateTypeSelect('cards');

                                                    if (isset($_SESSION['cards_selected'])) {
                                                        echo $_SESSION['cards_selected'];
                                                    } ?>>Online cards</option>
                            <option value="electronics" <?php
                                                        UpdateTypeSelect('electronics');

                                                        if (isset($_SESSION['electronics_selected'])) {
                                                            echo $_SESSION['electronics_selected'];
                                                        } ?>>Electronics</option>
                        </select>
                    </label>
                </button>
            </div>
            <div>
                <h2>Category</h2>
                <label for="category">
                    <button>
                        <select name="category" id="category" onchange="
                            var select = document.getElementById('category');
                            var option = select.options[select.selectedIndex];

                            var select_type = document.getElementById('type');
                            var option_type = select_type.options[select_type.selectedIndex];

                            var current_url = window.location.href;
                            
                            if(!current_url.includes('?type')){
                                window.location = '?category=' + option.value;
                            }
                            else{
                                window.location = '?type=' + option_type.value + '&category=' + option.value;
                            }
                        
                        ">
                            <option value="action" <?php
                                                    UpdateCategorySelect('action');
                                                    if (isset($_SESSION['action_selected'])) {
                                                        echo $_SESSION['action_selected'];
                                                    } ?>>Action</option>
                            <option value="gaming" <?php
                                                    UpdateCategorySelect('gaming');
                                                    if (isset($_SESSION['gaming_selected'])) {
                                                        echo $_SESSION['gaming_selected'];
                                                    } ?>>Gaming</option>
                            <option value="strategy" <?php
                                                        UpdateCategorySelect('strategy');
                                                        if (isset($_SESSION['strategy_selected'])) {
                                                            echo $_SESSION['strategy_selected'];
                                                        } ?>>Strategy</option>
                            <option value="PS2" <?php
                                                UpdateCategorySelect('PS2');
                                                if (isset($_SESSION['PS2_selected'])) {
                                                    echo $_SESSION['PS2_selected'];
                                                } ?>>PS2</option>
                            <option value="PS3" <?php
                                                UpdateCategorySelect('PS3');
                                                if (isset($_SESSION['PS3_selected'])) {
                                                    echo $_SESSION['PS3_selected'];
                                                } ?>>PS3</option>
                            <option value="PS4" <?php
                                                UpdateCategorySelect('PS4');
                                                if (isset($_SESSION['PS4_selected'])) {
                                                    echo $_SESSION['PS4_selected'];
                                                } ?>>PS4</option>
                            <option value="PS5" <?php
                                                UpdateCategorySelect('PS5');
                                                if (isset($_SESSION['PS5_selected'])) {
                                                    echo $_SESSION['PS5_selected'];
                                                } ?>>PS5</option>
                            <option value="XBox" <?php
                                                    UpdateCategorySelect('XBox');
                                                    if (isset($_SESSION['XBox_selected'])) {
                                                        echo $_SESSION['XBox_selected'];
                                                    } ?>>XBox</option>
                            <option value="iphone" <?php
                                                    UpdateCategorySelect('iphone');
                                                    if (isset($_SESSION['iphone_selected'])) {
                                                        echo $_SESSION['iphone_selected'];
                                                    } ?>>IPhone</option>
                            <option value="Samsung" <?php
                                                    UpdateCategorySelect('Samsung');
                                                    if (isset($_SESSION['Samsung_selected'])) {
                                                        echo $_SESSION['Samsung_selected'];
                                                    } ?>>Samsung</option>
                            <option value="PsPlus" <?php
                                                    UpdateCategorySelect('PsPlus');
                                                    if (isset($_SESSION['PsPlus_selected'])) {
                                                        echo $_SESSION['PsPlus_selected'];
                                                    } ?>>PS Plus</option>
                        </select>
                    </button>
                </label>
            </div>
            <div>
                <h2>Sort By Newness</h2>
                <label for="newness">
                    <button>
                        <select name="newness" id="newness">
                            <option value="none">None</option>
                            <option value="newest">By newest</option>
                            <option value="oldest">By oldest</option>
                        </select>
                    </button>
                </label>
            </div>
            <div>
                <h2>Sort By Popularity</h2>
                <label for="popularity">
                    <button>
                        <select name="popularity" id="popularity">
                            <option value="none">None</option>
                            <option value="highest">By Highest</option>
                            <option value="lowest">By Lowest</option>
                        </select>
                    </button>
                </label>
            </div>
            <div>
                <h2>Sort By Price</h2>
                <label for="price">
                    <button>
                        <select name="price" id="price">
                            <option value="none">None</option>
                            <option value="highest">By Highest</option>
                            <option value="lowest">By Lowest</option>
                        </select>
                    </button>
                </label>
            </div>
        </div>
    </div>
    <!-- ended filters -->

    <div>
        <h2 class="shop-title">Shop</h2>
        <h4 class="results-title">Showing results of products of type "<?php if (isset($_GET['type'])) {
                                                                            echo $_GET['type'];
                                                                        } ?>" and category "<?php if (isset($_GET['category'])) {
                                                                                                echo $_GET['category'];
                                                                                            } ?>"</h4>
    </div>

    <div class="content">
        <!-- start first tab -->
        <div class="cd reveal-by-x" style="display: block;">
            <div class="shop-products">
                <div class="shop-products-title" id="shop-products">
                    <h1><?php echo $_SESSION['title']; ?></h1>
                </div>
                <?php
                while ($row = $results_shop->fetch_assoc()) {
                    shop_connection($row["product_id"], $row["name"], $row["price"]);
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

</php>