<?php
include("connection.php");
 

 
function product_info_connection($name,$price,$category,$description){
    

    $element = "
    <div class=\"product_info_page\">
        <img src=\"../images/Gaming-Wallpaper.png\" alt=\"Product Name\" class=\"product_image reveal-by-x\">
        <div class=\"product_right_part reveal-by-y\">
            <h1><i> Product Name x</i>
            </h1>
            <p class=\"product_description\">
            <h3 style=\"color: royalblue;\"><i>Description:</i></h3>
            <i>Lorem ipsum dolor sit amet consectetur, adipisicing elit.<br> Eligendi architecto neque voluptatum
                molestiae
                odio nostrum provident<br> id inventore, incidunt et temporibus re</i></p>

            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Price:</i></h3>
                <h3>65$</h3>
            </div>
            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Type: </i></h3>
                <h3>Console</h3>
            </div>
            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Category: </i></h3>
                <h3>PS4</h3>
            </div>
            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Age Group:</i></h3>
                <h3>age 12+</h3>
            </div>
            <!-- <label for=\"points\">Quantity:</label> -->
            <input type=\"number\" id=\"points\" name=\"points\" title=\"Quantity to add to basket\"> <br> <br>
            <button class=\"product_info_addtobasket\" title=\"Add this product to your shopping basket\"><i
                    class=\"fa fa-shopping-basket\"></i>Add to Basket</button>
            <button class=\"product_info_addtofavorites\" title=\"Add this product to your favorites list\"><i
                    class=\"fa fa-heart\"></i>Add to Favorites</button>

        </div>
    </div>
    ";
    echo $element;
}

?>