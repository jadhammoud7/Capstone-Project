<?php
include("connection.php");

function get_appointment_in_admin_page_for_table_connection($appointment_id, $customer_name, $appointment_name, $date, $hour, $status)
{
    $element = "
    <tr class=\"hi\">
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

function latest_admins_connection($first_name, $last_name, $email_address)
{
    $element = "
    <div class=\"customer\">
        <div class=\"info\">
            <img src=\"../images/console.png\" alt=\"\" width=\"40px\" height=\"40px\">
            <div>
                <h4>$first_name $last_name</h4>
                <small>$email_address</small>
            </div>
        </div>
    </div>
    ";
    echo $element;
}

function get_comments_connection($username, $comment)
{
    $element = "
    <tr class=\"hello\">
    <td>$username</td>
    <td>$comment</td>
</tr>
    ";
    echo $element;
}

function get_all_customer_connection($customer_id, $first_name, $last_name, $username, $email, $phone_number, $address, $date_of_birth)
{
    $element = "
    <tr>
        <td>$first_name $last_name</td>
        <td>$username</td>
        <td>$email</td>
        <td>$phone_number</td>
        <td>$address</td>
        <td>$date_of_birth</td>
        <td>
        <a>
            <button class=\"remove_cust\" onclick=\"OpenRemoveCustomerPopUp($customer_id, `$first_name`, `$last_name`)\" title=\"Remove customer '$first_name $last_name'?\">Remove</button>
        </a>
    </tr>
    ";
    echo $element;
}

function get_all_admins_connection($admin_id, $admin_first_name, $admin_last_name, $admin_name, $email_address, $phone_number)
{
    $element = "
    <tr>
        <td>$admin_first_name $admin_last_name</td>
        <td>$admin_name</td>
        <td>$email_address</td>
        <td>$phone_number</td>
        <td>
            <a>
                <button class=\"remove_cust\" onclick=\"OpenRemoveAdminPopUp($admin_id, `$admin_first_name`, `$admin_last_name`)\" title=\"Remove admin '$admin_first_name $admin_last_name'?\">Remove</button>
            </a>
        </td>
    </tr>";

    echo $element;
}

function get_all_checkouts_connection($checkout_id, $customer_id, $first_name, $last_name, $email, $phone_number, $shipping_country, $shipping_location, $shipping_company, $postcode, $order_notes, $total_price, $tax_price, $total_price_including_tax, $date, $status)
{
    $element = "
    <tr>
        <td>$first_name $last_name</td>
        <td>$email</td>
        <td>$phone_number</td>
        <td>$shipping_country</td>
        <td>$shipping_location</td>
        <td>$shipping_company</td>
        <td>$postcode</td>
        <td>$order_notes</td>
        <td>$total_price</td>
        <td>$tax_price</td>
        <td>$total_price_including_tax</td>
        <td>$date</td>
        <td>
            <span class=\"status_checkout red\"></span>
            <a class=\"status_btn_checkout\">$status</a>
        </td>
        <td>
            <a>
                <button class=\"btn_done_work_checkout\" id=\"SetStatusCheckoutButton\" onclick=\"SetCheckoutID($checkout_id);\"></button>
            </a>
        </td>
    </tr>    
    ";

    echo $element;
}
function get_all_products($name, $price, $type, $category, $description)
{
    $element = "
    <tr class=\"hello\">
    <td>$name</td>
    <td>$price</td>
    <td>$type</td>
    <td>$category</td>
    <td>$description</td>
    </tr>
    ";
    echo $element;
}
