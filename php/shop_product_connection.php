<?php

include("connection.php");

function shop_connection($product_id, $name, $price, $image)
{

    $element = "
    <div class=\"product1\" id=\"product\">
        <div class=\"product_info\" onclick=\"document.getElementById('attributes_section').style.transform = 'rotateY(180deg);'\">
            <div class=\"img_section\">
                <img src=\"../images/$image\" alt=\"product image\">
            </div>
            <div class=\"attributes_section\" id=\"attributes_section\">
                <h1><i>$name</i></h1>
                <h3><i>$price$</i></h3>
                <a href=\"../product_info/product_info.php?productID=$product_id\">
                    <img class=\"info\" src=\"../images/info.png\" title=\"Read More Information\" alt=\"read more info\">
                </a>
                <a href=\"../php/add_to_basket.php?productID=$product_id\">
                    <img class=\"add_to_basket\" src=\"../images/shopping_cart.png\" title=\"Add To Basket\"
                        alt=\"Add To Basket\">
                </a>

                <a href=\"../php/favorites.php?productID=$product_id\">
                    <img class=\"add_to_fav\" src=\"../images/addfav.png\" title=\"Add To Favorites\"
                        alt=\"Add To Favorites\">
                </a>
            </div>
        </div>
    </div>
    ";
    echo $element;
}
