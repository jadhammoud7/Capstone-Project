<?php
include("connection.php");

function get_appointment_in_admin_page_for_table_connection($appointment_id, $customer_name, $appointment_name, $date, $hour, $status)
{
    $element = "
    <tr>
    <td>$appointment_name</td>
    <td>$customer_name</td>
    <td>$date</td>
    <td>$hour</td>
    <td>
        <span class=\"status red\"></span>
        <a class=\"status_btn\">$status</a>
    </td>
    <td>
        <a>
            <button class=\"btn_done_work\" id=\"SetStatusButton\" onclick=\"SetAppointmentID($appointment_id);\"></button>
        </a>
    </td>

</tr>
    ";
    echo $element;
}


function latest_customers_connection($username, $email)
{
    $element = "
    <div class=\"customer\">
    <div class=\"info\">
        <img src=\"../images/console.png\" alt=\"\" width=\"40px\" height=\"40px\">
        <div>
            <h4>$username</h4>
            <small>$email</small>
        </div>
    </div>
</div>
    ";
    echo $element;
}
