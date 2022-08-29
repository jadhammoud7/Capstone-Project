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
                        <button class=\"btn\" onclick=\"OpenRemoveFavoritesPopUp($product_id)\" title=\"Remove this product from your favorites list\"><i class=\"fa fa-trash\"></i><strong>Remove From Favorites</strong></button>
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
                <button onclick=\"OpenDeleteAppointmentPopUp($appointment_id, $date, $hour)\" class=\"remove_app\"><i class=\"fa fa-remove\"></i><strong>Delete Appointment</strong></button>
            </div>
        </div>";
    echo $element;
}

// function checkouts_products_list_connection($checkout_id)
// {
//     include("../php/connection.php");
//     include("../php/checkout.php");

//         checkout_products_connection($row_get_product['name'], $row_get_checkout_products['quantity'], $row_get_checkout_products['price']);

// }

function checkouts_list_connection($checkout_id, $shipping_location, $status, $total_price, $tax_price, $total_price_including_tax)
{
    $element = "
        <div class=\"checkouts-list\">
            <div class=\"checkouts-div\">
                <div class=\"checkouts-part\">
                    <h3>Shipping Location</h3>
                    <h4>$shipping_location</h4> 
                </div> 
                <div class=\"checkouts-part\">
                    <h3>Status</h3>
                    <h4>$status</h4>
                </div>
            </div> 

            <div class=\"order-summary\">
                <h2>Order Payment Summary</h2>
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
            </div>     
            <div class=\"checkouts-div\">
                <button style=\"border-radius: 20px;\" onclick=\"window.location.href = '../checkout/checkout-details.php?checkout_id=$checkout_id';\" title=\"See your checkout info including billing details and products buyed\"><i class=\"fa fa-info-circle\"></i>See Checkout Details</button>
                <button style=\"margin-left: 10px; border-radius: 20px; background-color: red;\" onclick = \"if(confirm('Are you sure you want to delete your order?')){ window.location='../profile/profile.php?delete_checkout_id=$checkout_id'; }\" title=\"Delete your order\"><i class=\"fa fa-trash\"></i>Delete Order</button>
            </div>   
        </div>";
    echo $element;
}
