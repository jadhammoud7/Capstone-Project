<?php
include("connection.php");



function get_appointment_in_admin_page_for_table_connection($customer_name, $appointment_name, $date, $status)
{


    $element = "
    <tr>
    <td>$appointment_name</td>
    <td>$customer_name</td>
    <td>$date</td>
    <td>
        <span class=\"status red\"></span>
        $status
    </td>
    <td>
        <button id=\"btn_done_work\"><strong>Done Work</strong></button>
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
