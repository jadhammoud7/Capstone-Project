<?php
include("connection.php");

function shop_allproducts_connection($product_id, $name, $price)
{

    $element = "
    <div class=\"product1\" id=\"product\">
        <div class=\"product_info\">
            <div class=\"img_section\">
                <img src=\"../images/console.png\" alt=\"product 1\">
            </div>
            <div class=\"attributes_section\">
                <h1><i>$name</i></h1>
                <h3><i>$price$</i></h3>
                <a href=\"../product_info/product_info.php?productID=$product_id\">
                    <img class=\"info\" src=\"../images/info.png\" title=\"read more\" alt=\"read more info\">
                </a>
                <a href=\"../php/../php/basket.php?productID=$product_id\">
                    <img class=\"add_to_basket\" src=\"../images/shopping_cart.png\" title=\"Add To Basket\"
                        alt=\"Add To Basket\">
                </a>

                <a href=\"\">
                    <img class=\"add_to_fav\" src=\"../images/addfav.png\" title=\"Add To Favorites\"
                        alt=\"Add To Favorites\">
                </a>
            </div>
        </div>
    </div>
    ";
    echo $element;
}





function shop_cd_connection($product_id, $name, $price)
{



    $element = "
    <div class=\"product1\" id=\"product\">
    <div class=\"product_info\">
        <div class=\"img_section\">
            <img src=\"../images/console.png\" alt=\"product 1\">
        </div>
        <div class=\"attributes_section\">
            <h1><i>$name</i></h1>
            <h3><i>$price$</i></h3>
            <a href=\"../product_info/product_info.php?productID=$product_id\">
                <img class=\"info\" src=\"../images/info.png\" title=\"read more\" alt=\"read more info\">
            </a>
            <a href=\"../php/basket.php?productID=$product_id\">
                <img class=\"add_to_basket\" src=\"../images/shopping_cart.png\" title=\"Add To Basket\"
                    alt=\"Add To Basket\">
            </a>

            <a href=\"\">
                <img class=\"add_to_fav\" src=\"../images/addfav.png\" title=\"Add To Favorites\"
                    alt=\"Add To Favorites\">
            </a>
        </div>
    </div>
</div>
    ";
    echo $element;
}


function shop_cellphone_connection($product_id, $name, $price)
{


    $element = "
    <div class=\"product1\" id=\"product\">
    <div class=\"product_info\">
        <div class=\"img_section\">
            <img src=\"../images/console.png\" alt=\"product 1\">
        </div>
        <div class=\"attributes_section\">
            <h1><i>$name</i></h1>
            <h3><i>$price$</i></h3>
            <a href=\"../product_info/product_info.php?productID=$product_id\">
                <img class=\"info\" src=\"../images/info.png\" title=\"read more\" alt=\"read more info\">
            </a>
            <a href=\"../php/basket.php?productID=$product_id\">
                <img class=\"add_to_basket\" src=\"../images/shopping_cart.png\" title=\"Add To Basket\"
                    alt=\"Add To Basket\">
            </a>

            <a href=\"\">
                <img class=\"add_to_fav\" src=\"../images/addfav.png\" title=\"Add To Favorites\"
                    alt=\"Add To Favorites\">
            </a>
        </div>
    </div>
</div>
    ";
    echo $element;
}


function shop_console_connection($product_id, $name, $price)
{



    $element = "
    <div class=\"product1\" id=\"product\">
    <div class=\"product_info\">
        <div class=\"img_section\">
            <img src=\"../images/console.png\" alt=\"product 1\">
        </div>
        <div class=\"attributes_section\">
            <h1><i>$name</i></h1>
            <h3><i>$price$</i></h3>
            <a href=\"../product_info/product_info.php?productID=$product_id\">
                <img class=\"info\" src=\"../images/info.png\" title=\"read more\" alt=\"read more info\">
            </a>
            <a href=\"../php/basket.php?productID=$product_id\">
                <img class=\"add_to_basket\" src=\"../images/shopping_cart.png\" title=\"Add To Basket\"
                    alt=\"Add To Basket\">
            </a>

            <a href=\"\">
                <img class=\"add_to_fav\" src=\"../images/addfav.png\" title=\"Add To Favorites\"
                    alt=\"Add To Favorites\">
            </a>
        </div>
    </div>
</div>
    ";
    echo $element;
}

function shop_offers_connection($product_id, $name, $price)
{



    $element = "
    <div class=\"product1\" id=\"product\">
    <div class=\"product_info\">
        <div class=\"img_section\">
            <img src=\"../images/console.png\" alt=\"product 1\">
        </div>
        <div class=\"attributes_section\">
            <h1><i>$name</i></h1>
            <h3><i>$price$</i></h3>
            <a href=\"../product_info/product_info.php?productID=$product_id\">
                <img class=\"info\" src=\"../images/info.png\" title=\"read more\" alt=\"read more info\">
            </a>
            <a href=\"../php/basket.php?productID=$product_id\">
                <img class=\"add_to_basket\" src=\"../images/shopping_cart.png\" title=\"Add To Basket\"
                    alt=\"Add To Basket\">
            </a>

            <a href=\"\">
                <img class=\"add_to_fav\" src=\"../images/addfav.png\" title=\"Add To Favorites\"
                    alt=\"Add To Favorites\">
            </a>
        </div>
    </div>
</div>
    ";
    echo $element;
}


function shop_others_connection($product_id, $name, $price)
{

    $element = "
    <div class=\"product1\" id=\"product\">
    <div class=\"product_info\">
        <div class=\"img_section\">
            <img src=\"../images/console.png\" alt=\"product 1\">
        </div>
        <div class=\"attributes_section\">
            <h1><i>$name</i></h1>
            <h3><i>$price$</i></h3>
            <a href=\"../product_info/product_info.php?productID=$product_id\">
                <img class=\"info\" src=\"../images/info.png\" title=\"read more\" alt=\"read more info\">
            </a>
            <a href=\"../php/basket.php?productID=$product_id\">
                <img class=\"add_to_basket\" src=\"../images/shopping_cart.png\" title=\"Add To Basket\"
                    alt=\"Add To Basket\">
            </a>

            <a href=\"\">
                <img class=\"add_to_fav\" src=\"../images/addfav.png\" title=\"Add To Favorites\"
                    alt=\"Add To Favorites\">
            </a>
        </div>
    </div>
</div>
    ";
    echo $element;
}




//for basket
function add_to_basket_connection($product_id, $name, $price, $quantity)
{

    $element = "
    <tr class=\"product-container\">
    <td>
        <div class=\"cart-info\">
            <img src=\"../images/Gaming-Wallpaper.png\" alt=\"\">
            <div class=\"info_of_product\">
                <p>$name</p>
                <small >price: $price$</small>
                <br> <br>
                <a href=\"\" title=\"Remove this product from your shopping basket\">Remove</a>
            </div>
        </div>
    </td>
    <form action = "../php/basket.php?productBasketID=$product_id&customerBasketID=$_SESSION['logged_id']" method = "GET">
        <td>
            <input type=\"number\" name=\"quantity\" value=\"$quantity\" id=\"quantity_of_each_product\">
        </td>
    </form>
    <td id=\"get_price\">$price$</td>
    </tr>
    ";
    echo $element;
}

//for basket profile

function basket_connection($product_id, $name, $category, $price, $quantity){ 

   $element =  "<div class="basket-product">
                    <div class="basket-product-img">
                        <img src="../images/console.png" alt="basket product" style="width: 50%;">
                    </div>
                    <div class="basket-product-part">
                        <h3>$name</h3>
                        <h4>$category</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Quantity</h3>
                        <h4>$quantity</h4>
                    </div>
                    <div class="basket-product-part">
                        <h3>Price</h3>
                        <h4>$price$</h4>
                    </div>
                </div>";
    
    echo $element;
}

//for favorites
function add_to_favorites_connection($name, $price){

    $element = "<div class=\"favorites-products\">
                <div class=\"favorites-product-info\">
                    <div class=\"favorites-product-img\">
                        <img src=\"../images/console.png\" alt=\"favorites product\" style=\"width: 50%;\">
                    </div>
                    <div class=\"favorites-product-part\">
                        <h3>$name</h3>
                        <h4>Console PS3</h4>
                    </div>
                    <div class=\"favorites-product-part\">
                        <h3>Price</h3>
                        <h4>$price$</h4>
                    </div>
                </div>
                <div class=\"favorites-product-buttons\">
                    <div>
                        <button class=\"btn\" title=\"Check more information about this product\"><i class=\"fa fa-info-circle\"></i><strong>Check Info</strong></button>
                    </div>
                    <div>
                        <button class=\"btn\" title=\"Remove this product from your favorites list\"><i class=\"fa fa-trash\"></i><strong>Remove From Favorites</strong></button>
                    </div>
                </div>
            </div>";
    
    echo $element;
}
