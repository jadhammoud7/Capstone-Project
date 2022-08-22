<?php

include("connection.php");

//for basket
function repair_products_connection($repair_type, $price_per_hour, $description)
{

    $element = "
    <div class=\"appointment-item\">
    <h2>$repair_type</h2>
    <div class=\"appointment-item-info\">
        <img src=\"../images/laptop_repair.png\" alt=\"\">
        <div class=\"appointment-item-info-part\">
            <h3>$repair_type</h3>
            <p>1 hour | $price_per_hour$</p>
            <p>$description</p>
        </div>
    </div>
    <div>
        <button onclick=\"OpenAppointmentBooking(this)\" style=\"border-radius: 15px;color:black ;\"><strong>Book Now</strong></button>
    </div>
</div>
<hr size=\"8\" width=\"100%\" color=\"royalblue\">
    ";
    echo $element;
}
?>