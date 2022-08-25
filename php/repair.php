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
            <h3 id=\"repair_type\">$repair_type</h3>
            <p>1 hour | $price_per_hour$</p>
            <p>$description</p>
        </div>
    </div>
    <div>
        <button onclick=\"window.location.href='../calendar/calendar.php?repair_type=$repair_type';\" style=\"border-radius: 15px;color:black ;\"><strong>Book Now</strong></button>
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
    <h2>$repair_type</h2>
    <div class=\"appointment-item-info-schedule\">
        <img src=\"../images/ps_repair.jpg\" alt=\"\">
        <div class=\"appointment-item-info-schedule-part\">
        <input type=\"radio\" id=\"app1\" name=\"app1\" value=\"8:00-9:30 AM\">
        <label for=\"html\">8:00-9:30 AM</label><br>
        <input type=\"radio\" id=\"app2\" name=\"app2\" value=\"10:00-11:30 AM\">
        <label for=\"css\">10:00-11:30 AM</label><br>
        <input type=\"radio\" id=\"app3\" name=\"app3\" value=\"12:00-1:30 PM\">
        <label for=\"css\">10:00-11:30 AM</label><br>
        <input type=\"radio\" id=\"app4\" name=\"app4\" value=\"2:00-3:30 PM\">
        <label for=\"css\">10:00-11:30 AM</label><br>
        <input type=\"radio\" id=\"app5\" name=\"app5\" value=\"4:00-5:30 PM\">
        <label for=\"css\">10:00-11:30 AM</label><br>
        <input type=\"radio\" id=\"app6\" name=\"app6\" value=\"6:00-7:30 PM\">
        <label for=\"css\">10:00-11:30 AM</label><br>
        </div>
        <button style=\"border-radius:15px\">Schedule your Appointment</button>
    </div>
    ";
    echo $element;
}
?>
