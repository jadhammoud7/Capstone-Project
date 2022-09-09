<?php
include("connection.php");



function get_appointment_in_admin_page_for_table_connection($customer_name, $appointment_name,$date,$status)
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
        <button class=\"btn_done_work\">Done Work</button>
    </td>
</tr>
    ";
    echo $element;
}

?>