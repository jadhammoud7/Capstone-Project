<?php
include("connection.php");



function get_appointment_in_admin_page_for_table_connection($customer_id, $appointment_name,$date,$status)
{


    $element = "
    <tr>
    <td>$appointment_name</td>
    <td>$customer_id</td>
    <td>$date</td>
    <td>
        <span class=\"status red\"></span>
        $status
    </td>
    <td>
        <button>Done Work</button>
    </td>
</tr>

<tr>
    <button>hello</button>
</tr>
    ";
    echo $element;
}

?>