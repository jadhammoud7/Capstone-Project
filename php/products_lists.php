<?php

//for favorites
function favorites_list_connection($product_id, $name, $category, $price)
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



function appointments_list_connection($appointment_id, $appointment_name, $date, $hour, $status)
{
    //dont forget to add thr image
    // $element =  "
    //     <div class=\"appointmentsss\">
    //         <img src=\"../images/console.png\" alt=\"\" style=\"width:50%\">
    //         <div class=\"app_info\">
    //             <h4><b>$appointment_name </b></h4>
    //             <p>Date: $date</p>
    //             <p>Hours: $hour</p>
    //             <button onclick=\"window.location=\"../profile/profile.php?deleteAPPid=$appointment_id;\"\" class=\"remove_app\"><strong>Remove Appointment</strong></button>
    //         </div>
    //     </div>
    // ";

    $element = "
        <div class=\"appointments-list\">
            <div class=\"appointments-div\">
                <div class=\"appointments-img\">
                    <img src=\"../images/console.png\" alt=\"basket product\" style=\"width: 50%;\">
                </div>
                <div class=\"appointments-part\">
                    <h3>Appointment Name</h3>
                    <h4>$appointment_name</h4>
                </div>
                <div class=\"appointments-part\">
                    <h3>Date</h3>
                    <h4>$date</h4>
                </div>
                <div class=\"appointments-part\">
                    <h3>Hour</h3>
                    <h4>$hour</h4>
                </div>
                <div class=\"appointments-part\">
                    <h3>Status</h3>
                    <h4>$status</h4>
                </div>
            </div>
            <div class=\"appointments-button\">
                <button onclick=\"if(confirm('Are you sure to delete this appointment?')){ window.location='../profile/profile.php?deleteAPPid=$appointment_id'; }\" class=\"remove_app\"><i class=\"fa fa-remove\"></i><strong>Delete Appointment</strong></button>
            </div>
        </div>";
    echo $element;
}

function checkouts_list_connection($checkout_id, $shipping_location, $total_price, $tax_price, $total_price_including_tax)
{
    include("../php/connection.php");
    include("../php/checkout.php");
    $query_checkout_products = "SELECT product_id, quantity, price FROM checkouts_customers_products WHERE checkout_id = '" . $checkout_id . "' ";
    $stmt_checkout_products = $connection->prepare($query_checkout_products);
    $stmt_checkout_products->execute();
    $results_checkout_products = $stmt_checkout_products->get_result();

    $element = "
        <div class=\"checkouts-list\">
            <h3>Shipping Location/h3>
            <h4>$shipping_location</h4>   
            <table id=\"order-product\">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
                <?php
                while ($row_get_checkout_products = $results_checkout_products->fetch_assoc()) {
                    $stmt_get_product = $connection->prepare(\"SELECT name FROM products WHERE product_id = '" . $row_get_basket_products["product_id"] . "' \");
                    $stmt_get_product->execute();
                    $results_get_product = $stmt_get_product->get_result();
                    $row_get_product = $results_get_product->fetch_assoc();
                    checkout_products_connection($row_get_product[name], $row_get_checkout_products[quantity], $row_get_checkout_products[price]);
                }
                ?>
            </table>
            <table id=\"order-totals\">
                <tr>
                    <th>Subtotal</th>
                    <td>$total_price$</td>
                </tr>
                <tr>
                    <th>Taxes</th>
                    <td>$tax_price$</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>$total_price_including_tax$</td>
                </tr>
            </table>            
        </div>";
    echo $element;
}
