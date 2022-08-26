<?php

include("connection.php");

//for basket
function basket_product_connection($product_id, $name, $price, $quantity)
{

    $element = "<tr class=\"product-container\">
                    <td>
                        <div class=\"cart-info\">
                            <img src=\"../images/Gaming-Wallpaper.png\" alt=\"\">
                            <div class=\"info_of_product\">
                                <p>$name</p>
                                <small >price: $price$</small>
                                <br> <br>
                                <a href=\"../php/remove_from_basket.php?productID=$product_id\" title=\"Remove this product from your shopping basket\">Remove</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type=\"number\" name=\"$product_id-quantity\" min=\"0\" value=\"$quantity\" id=\"quantity_of_each_product\"\">
                    </td>
                    <td id=\"get_price\">$price$</td>
                </tr>
    ";
    echo $element;
}

//for basket empty
function basket_empty()
{
    $element = "
    <div class=\"empty-par\">
        <h2>Your shopping basket is empty</h2>
        <button onclick=\"window.location='../shop/shop.php';\" title=\"Return to Shop to fill your shopping basket\" value=\"Return To Shop Page\">Return To Shop Page</button>
    </div>
    ";

    echo $element;
}



//for basket profile

function basket_connection($product_id, $name, $category, $price, $quantity)
{

    $element =  "<div class=\"basket-product\">
                    <div class=\"basket-product-img\">
                        <img src=\"../images/console.png\" alt=\"basket product\" style=\"width: 50%;\">
                    </div>
                    <div class=\"basket-product-part\">
                        <h3>Product Name</h3>
                        <h4>$name</h4>
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
