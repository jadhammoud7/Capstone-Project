<?php
include("connection.php");



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
                <a href=\"../php/basket.php?productRemoveID=$product_id\" title=\"Remove this product from your shopping basket\">Remove</a>
            </div>
        </div>
    </td>
    <form action = \"../php/basket.php?productBasketID=$product_id&customerBasketID=$_SESSION[logged_id]\" method = \"GET\">
        <td>
            <input type=\"number\" name=\"quantity\" min=\"0\" value=\"$quantity\" id=\"quantity_of_each_product\">
        </td>
 
    </form>
    <td id=\"get_price\">$price$</td>
    </tr>
    ";
    echo $element;
    //     <td>
    //     <input type=\"submit\" value=\"Update Quantity\">
    // </td>
}

//for basket empty
function basket_empty()
{
    $element = "
    <div class=\"empty-par\">
        <h2>Your shopping basket is empty</h2>
        <button onclick=\"window.location='../shop/shop.php';\" value=\"Return To Shop Page\"></button>
    </div>
    ";
}



//for basket profile

function basket_connection($product_id, $name, $category, $price, $quantity)
{

    $element =  "<div class=\"basket-product\">
                    <div class=\"basket-product-img\">
                        <img src=\"../images/console.png\" alt=\"basket product\" style=\"width: 50%;\">
                    </div>
                    <div class=\"basket-product-part\">
                        <h3>$name</h3>
                        <h4>$category</h4>
                    </div>
                    <div class=\"basket-product-part\">
                        <h3>Quantity</h3>
                        <h4>$quantity</h4>
                    </div>
                    <div class=\"basket-product-part\">
                        <h3>Price</h3>
                        <h4>$price$</h4>
                    </div>
                </div>";

    echo $element;
}


?>