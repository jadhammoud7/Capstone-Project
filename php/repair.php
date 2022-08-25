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
        <button onclick=\"window.location='?name=$repair_type'; OpenAppointmentBooking(this);\" style=\"border-radius: 15px;color:black ;\"><strong>Book Now</strong></button>
    </div>
</div>
<hr size=\"8\" width=\"100%\" color=\"royalblue\">
    ";
    echo $element;
}
// free gift
function free_gift_connection($name)
{

    $element = "
    <div class=\"appointment-item-info\">
    <img src=\"../images/free-game.gif\" alt=\"\">
    <div class=\"appointment-item-info-part\">
        <h3>Try Free Game</h3>
        <p>1 hour | $name</p>
        <p>You are invited to play a new game for free in our store. You can try any game of your own for up
            to 1 hour. We care to our customers to be mostly convenient and satisfied with our services.
            Don't hesitate to contact us for any enquiries and book your appointment now!</p>
    </div>
</div>
<div>
    <button onclick=\"OpenAppointmentBooking(this)\" style=\"border-radius: 15px;color:black ;\"><strong>Book Now</strong></button>
</div>
    ";
    echo $element;
}


// book now for each one
function book_now_for_each_repair_connection($repair_type,$price_per_hour,$description)
{

    $element = "
    
    ";
    echo $element;
}
?>
