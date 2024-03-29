<?php

include("connection.php");

//for basket
function repair_products_connection($repair_type, $price_per_hour, $description, $image)
{

    $element = "
    <div class=\"appointment-item\">
        <h2>$repair_type</h2>
        <div class=\"appointment-item-info\">
            <img src=\"../images/Repairs/$repair_type/$image\" alt=\"\">
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
        <img src=\"../images/Repairs/free-game.gif\" alt=\"\">
        <div class=\"appointment-item-info-part\">
            <h3>Try Free Game</h3>
            <p>1 hour | $name</p>
            <p>You are invited to play a new game for free in our store. You can try any game of your own for up
                to 1 hour. We care to our customers to be mostly convenient and satisfied with our services.
                Don't hesitate to contact us for any enquiries and book your appointment now!</p>
        </div>
    </div>
    <div>
        <button onclick=\"window.location.href='../calendar/calendar.php?cd_name=$name';\" style=\"border-radius: 15px;\"><strong>Book Now</strong></button>
    </div>
    ";
    echo $element;
}


// book now for each one
function book_now_for_each_repair_connection($repair_type, $image)
{

    $element = "
        <h2 style=\"margin-top:50px;\">$repair_type</h2>
        <div class=\"appointment-item-info-schedule\">
            <img src=\"../images/Repairs/$repair_type/$image\" alt=\"\">
            <div class=\"appointment-item-info-schedule-part\">
            <input type=\"radio\" id=\"app1\" name=\"appointments_time\" value=\"8:00-9:30 AM\">
            <label for=\"app1\">8:00-9:30 AM</label><br>
            <input type=\"radio\" id=\"app2\" name=\"appointments_time\" value=\"10:00-11:30 AM\">
            <label for=\"app2\">10:00-11:30 AM</label><br>
            <input type=\"radio\" id=\"app3\" name=\"appointments_time\" value=\"12:00-1:30 PM\">
            <label for=\"app3\">12:00-1:30 PM</label><br>
            <input type=\"radio\" id=\"app4\" name=\"appointments_time\" value=\"2:00-3:30 PM\">
            <label for=\"app4\">2:00-3:30 PM</label><br>
            <input type=\"radio\" id=\"app5\" name=\"appointments_time\" value=\"4:00-5:30 PM\">
            <label for=\"app5\">4:00-5:30 PM</label><br>
            <input type=\"radio\" id=\"app6\" name=\"appointments_time\" value=\"6:00-7:30 PM\">
            <label for=\"app6\">6:00-7:30 PM</label><br>
            </div>
            <button onclick=\"SubmitAppointment()\" style=\"border-radius:15px;padding: 10px; background-color:royalblue; color:black;\"><strong>Schedule your Appointment</strong></button>
        </div>
    ";
    echo $element;
}

//book now for free game
function book_now_for_free_game_connection($cd_name, $image)
{

    $element = "
        <h2 style=\"margin-top:50px;\">$cd_name</h2>
        <div class=\"appointment-item-info-schedule\">
            <img src=\"../images/Products/$cd_name/$image\" alt=\"\">
            <div class=\"appointment-item-info-schedule-part\">
            <input type=\"radio\" id=\"app1\" name=\"appointments_time\" value=\"8:00-9:30 AM\">
            <label for=\"app1\">8:00-9:30 AM</label><br>
            <input type=\"radio\" id=\"app2\" name=\"appointments_time\" value=\"10:00-11:30 AM\">
            <label for=\"app2\">10:00-11:30 AM</label><br>
            <input type=\"radio\" id=\"app3\" name=\"appointments_time\" value=\"12:00-1:30 PM\">
            <label for=\"app3\">12:00-1:30 PM</label><br>
            <input type=\"radio\" id=\"app4\" name=\"appointments_time\" value=\"2:00-3:30 PM\">
            <label for=\"app4\">2:00-3:30 PM</label><br>
            <input type=\"radio\" id=\"app5\" name=\"appointments_time\" value=\"4:00-5:30 PM\">
            <label for=\"app5\">4:00-5:30 PM</label><br>
            <input type=\"radio\" id=\"app6\" name=\"appointments_time\" value=\"6:00-7:30 PM\">
            <label for=\"app6\">6:00-7:30 PM</label><br>
            </div>
            <button onclick=\"SubmitAppointment()\" style=\"border-radius:15px;padding: 10px; background-color:royalblue; color:black;\"><strong>Schedule your Appointment</strong></button>
        </div>
    ";
    echo $element;
}

function SelectHour($date, $hour)
{
    include("connection.php");
    $select_hour_stmt = $connection->prepare("SELECT * FROM appointments WHERE date = '" . $date . "' AND hour = '" . $hour . "'");
    $select_hour_stmt->execute();
    $select_hour_results = $select_hour_stmt->get_result();
    return $select_hour_results;
}
