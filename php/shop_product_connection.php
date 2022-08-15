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
function add_to_basket_connection($name, $price)
{

    $element = "
    <tr>
    <td>
        <div class=\"cart-info\">
            <img src=\"../images/Gaming-Wallpaper.png\" alt=\"\">
            <div class=\"info_of_product\">
                <p>$name</p>
                <small>price: $price$</small>
                <br> <br>
                <a href=\"\" title=\"Remove this product from your shopping basket\">Remove</a>
            </div>
        </div>
    </td>
    <td><input type=\"number\" name=\"\" id=\"\" value=\"1\"></td>
    <td>$55.00</td>
</tr>
    ";
    echo $element;
}
