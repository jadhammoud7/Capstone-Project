<?php

function product_info_connection($product_id, $name, $price, $category, $description, $age, $stock_available, $date, $image)
{
    $element = "
    <title>$name - Newbies Gamers</title>
    <!-- started with title page -->
    <div class=\"title\">
        <h1 style=\"color: #333;\">$name</h1>
        <h5 style=\"color:#b4c3da;\">Shop / Product Info</h5>
    </div>
    <!-- ended with title page -->
    <div class=\"product_info_page\">
        <img src=\"../images/Products/$name/$image\" alt=\"Product Name\" class=\"product_image reveal-by-x\">
        <div class=\"product_right_part reveal-by-y\">
            <h1><i>$name</i>
            </h1>
            <p class=\"product_description\">
            <h3 style=\"color: royalblue;\"><i>Description:</i></h3>
            <i>$description</i></p>

            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Price:</i></h3>
                <h3>$price$</h3>
            </div>
            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Category: </i></h3>
                <h3>$category</h3>
            </div>
            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Age Group:</i></h3>
                <h3>$age</h3>
            </div>
            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Available In Stock:</i></h3>
                <h3>$stock_available</h3>
            </div>
            <div class=\"product-info-part\">
                <h3 style=\"color: royalblue;\"><i>Release Date:</i></h3>
                <h3>$date</h3>
            </div>
            <!-- <label for=\"points\">Quantity:</label> -->
            <form action=\"../php/add_to_basket.php\" method=\"GET\">
            <input type=\"hidden\" name=\"productID\" value=\"$product_id\">
            <input type=\"number\" id=\"points\" name=\"quantities\" title=\"Quantity to add to basket\"> <br> <br>
            <button class=\"product_info_addtobasket\" title=\"Add this product to your shopping basket\"><i
                    class=\"fa fa-shopping-basket\" type=\"Submit\"></i>Add to Basket</button>
            <button class=\"product_info_addtofavorites\" title=\"Add this product to your favorites list\"><i
                    class=\"fa fa-heart\" onclick=\"window.location.href = '../php/product_info_connection.php?productID=$product_id';\"></i>Add to Favorites</button>
            </form>
                    
        </div>
    </div>
    ";
    echo $element;
}
