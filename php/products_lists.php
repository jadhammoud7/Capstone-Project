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
