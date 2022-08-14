<?php
include("connection.php");
 

 
function shop_cd_connection($name,$price){
    

    $element = "
    <div class=\"product1\" id=\"product\">
    <div class=\"product_info\">
        <div class=\"img_section\">
            <img src=\"../images/console.png\" alt=\"product 1\">
        </div>
        <div class=\"attributes_section\">
            <h1><i>$name</i></h1>
            <h3><i>$price$</i></h3>
            <a href=\"../product_info/product_info.php\">
                <img class=\"info\" src=\"../images/info.png\" title=\"read more\" alt=\"read more info\">
            </a>
            <a href=\"\">
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


function shop_cellphones_connection($name,$price){
    

    $element = "
    <div class=\"product1\" id=\"product\">
    <div class=\"product_info\">
        <div class=\"img_section\">
            <img src=\"../images/console.png\" alt=\"product 1\">
        </div>
        <div class=\"attributes_section\">
            <h1><i>$name</i></h1>
            <h3><i>$price$</i></h3>
            <a href=\"../product_info/product_info.php\">
                <img class=\"info\" src=\"../images/info.png\" title=\"read more\" alt=\"read more info\">
            </a>
            <a href=\"\">
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

?>