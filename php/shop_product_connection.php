<?php

include("connection.php");

function shop_connection($product_id, $name, $price)
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

//for favorites
function add_to_favorites_connection($product_id, $name, $category, $price)
{

    $element = "<div class=\"favorites-products\">
                <div class=\"favorites-product-info\">
                    <div class=\"favorites-product-img\">
                        <img src=\"../images/console.png\" alt=\"favorites product\" style=\"width: 50%;\">
                    </div>
                    <div class=\"favorites-product-part\">
                        <h3>$name</h3>
                        <h4>$category</h4>
                    </div>
                    <div class=\"favorites-product-part\">
                        <h3>Price</h3>
                        <h4>$price$</h4>
                    </div>
                </div>
                <div class=\"favorites-product-buttons\">
                    <div>
                        <button class=\"btn\" onclick=\"window.location.href = '../product_info/product_info.php?productID=$product_id';\" title=\"Check more information about this product\"><i class=\"fa fa-info-circle\"></i><strong>Check Info</strong></button>
                    </div>
                    <div>
                        <button class=\"btn\" onclick=\"window.location.href = '../php/favorites.php?productRemoveID=$product_id';\" title=\"Remove this product from your favorites list\"><i class=\"fa fa-trash\"></i><strong>Remove From Favorites</strong></button>
                    </div>
                </div>
            </div>";

    echo $element;
}
