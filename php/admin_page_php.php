<?php
include("connection.php");

function get_appointment_in_admin_page_for_table_connection($appointment_id, $customer_name, $customer_id, $appointment_name, $appointment_type, $price_per_hour, $date, $hour, $status)
{
    include("connection.php");

    if ($appointment_type == 'Repair Service') {
        $stmt_select_repair = $connection->prepare("SELECT repair_id FROM repairs WHERE repair_type = '" . $appointment_name . "' ");
        $stmt_select_repair->execute();
        $result_repair = $stmt_select_repair->get_result();
        $row_repair = $result_repair->fetch_assoc();

        $repair_id = $row_repair['repair_id'];

        $element = "
        <tr>
            <td>
                <a href='../repairs-admin/repair-admin-details.php?repair-id=$repair_id' title=\"See info about repair '$appointment_name'\">
                    $appointment_type $appointment_name
                </a>
            </td>
            <td>
                <a href='../customer-admin/customer-details.php?customer_id=$customer_id' title=\"See info about customer '$customer_name'\">
                    $customer_name
                </a>
            </td>
            <td>$price_per_hour</td>
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
    } else {
        $stmt_select_product = $connection->prepare("SELECT product_id FROM products WHERE name = '" . $appointment_name . "' ");
        $stmt_select_product->execute();
        $result_product = $stmt_select_product->get_result();
        $row_product = $result_product->fetch_assoc();

        $product_id = $row_product['product_id'];

        $element = "
        <tr>
            <td>
                <a href='../product-admin/product-details.php?product_id=$product_id' title=\"See info about product '$appointment_name'\">
                    $appointment_name
                </a>
            </td>
            <td>
                <a href='../customer-admin/customer-details.php?customer_id=$customer_id' title=\"See info about customer '$customer_name'\">
                    $customer_name
                </a>
            </td>
            <td>$price_per_hour</td>
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
}

function get_appointments_in_customer_details($appointment_id, $appointment_name, $date, $hour, $status)
{
    $element = "
    <tr>
        <td>$appointment_name</td>
        <td>$date</td>
        <td>$hour</td>
        <td>
            <span class=\"status red\"></span>
            <a class=\"status_btn\">$status</a>
        </td>
        <td>
            <a>
                <button class=\"btn_done_work\" id=\"SetStatusButton\" onclick=\"SetAppointmentID($appointment_id)\"></button>
            </a>
        </td>
    </tr>";
    echo $element;
}


function latest_customers_connection($username, $email, $image)
{
    $element = "
    <div class=\"customer\">
        <div class=\"info\">
            <img src=\"../images/Customers/$username/$image\" alt=\"\" width=\"40px\" height=\"40px\">
            <div>
                <h4>$username</h4>
                <small>$email</small>
            </div>
        </div>
    </div>
    ";
    echo $element;
}

function latest_admins_connection($first_name, $last_name, $username, $email_address, $image)
{
    $element = "
    <div class=\"customer\">
        <div class=\"info\">
            <img src=\"../images/Admins/$username/$image\" alt=\"\" width=\"40px\" height=\"40px\">
            <div>
                <h4>$first_name $last_name</h4>
                <small>$email_address</small>
            </div>
        </div>
    </div>
    ";
    echo $element;
}

function get_comments_connection($customer_id, $username, $comment)
{
    $element = "
    <tr>
        <td>
            <a href='../customer-admin/customer-details.php?customer_id=$customer_id' title=\"See info about customer '$username'\">
                $username
            </a>
        </td>
        <td>$comment</td>
    </tr>
    ";
    echo $element;
}

function get_all_customer_connection($customer_id, $first_name, $last_name, $username, $email, $phone_number, $city, $loyalty_points, $date_of_birth)
{
    $element = "
    <tr>
        <td><a href='../customer-admin/customer-details.php?customer_id=$customer_id' class=\"customer_link\" title=\"See details about '$first_name $last_name'\">$first_name $last_name</a></td>
        <td title=\"$username\">$username</td>
        <td title=\"$email\">$email</td>
        <td title=\"$phone_number\">$phone_number</td>
        <td title=\"$city\">$city</td>
        <td title=\"$loyalty_points\">$loyalty_points</td>
        <td title=\"$date_of_birth\">$date_of_birth</td>
        <td>
        <a>
            <button class=\"remove_cust\" onclick=\"OpenRemoveCustomerPopUp($customer_id, `$first_name`, `$last_name`)\" title=\"Remove customer '$first_name $last_name'?\"><span class=\"las la-trash-alt\"></span> Remove</button>
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
                <button class=\"remove_cust\" onclick=\"OpenRemoveAdminPopUp($admin_id, `$admin_first_name`, `$admin_last_name`)\" title=\"Remove admin '$admin_first_name $admin_last_name'?\"><span class=\"las la-trash-alt\"></span> Remove</button>
            </a>
        </td>
    </tr>";

    echo $element;
}

function get_all_checkouts_connection($checkout_id, $customer_id, $first_name, $last_name, $email, $phone_number, $total_price, $total_price_including_tax, $date, $status)
{
    $element = "
    <tr>
        <td>
            <a href='../customer-admin/customer-details.php?customer_id=$customer_id' title=\"See info about customer '$first_name $last_name'\">
                $first_name $last_name
            </a>
        </td>
        <td>$email</td>
        <td>$phone_number</td>
        <td>$total_price</td>
        <td>$total_price_including_tax</td>
        <td>$date</td>
        <td>
            <span class=\"status_checkout red\"></span>
            <a class=\"status_btn_checkout\">$status</a>
        </td>
        <td>
            <a>
                <button class=\"btn_done_work_checkout\" id=\"SetStatusCheckoutButton\" onclick=\"window.location.href='checkouts-admin.php?checkout-id=$checkout_id&change-status=1';\"></button>
            </a>
        </td>
        <td>
            <a>
                <button class=\"btn_view_checkout_order\" onclick=\"window.location.href = '../checkouts-admin/checkout-admin-details.php?checkout_id=$checkout_id';\">View Order</button>
            </a>
        </td>
    </tr>    
    ";
    // onclick=\"SetCheckoutID($checkout_id);\"

    echo $element;
}

function get_slideshow_connection($slide1_image, $slide1_text, $slide2_image, $slide2_text, $slide3_image, $slide3_text)
{
    $element = "
    <tr>
        <td>
            <img src='../images/SlideShow/Slide1/$slide1_image' alt='Image of Slide1' width='100px'>
        </td>
        <td>$slide1_text</td>
        <td>
            <img src='../images/SlideShow/Slide2/$slide2_image' alt='Image of Slide2' width='100px'>
        </td>
        <td>$slide2_text</td>
        <td>
            <img src='../images/SlideShow/Slide3/$slide3_image' alt='Image of Slide3' width='100px'>
        </td>
        <td>$slide3_text</td>
    </tr>    
    ";

    echo $element;
}

function get_all_products($product_id, $name, $price, $type, $category, $inventory, $sales_number, $last_modified_by, $last_modified_on)
{
    $element = "
    <tr>
        <td>
            <a href='product-details.php?product_id=$product_id' title=\"See details about product '$name'\">
                $name
            </a>
        </td>
        <td>
            <a href='product-admin.php?product_id=$product_id&price_history=1' class=\"customer_link\" title=\"See price history about '$name'\">
                $price
            </a>
        </td>
        <td>$type</td>
        <td>$category</td>
        <td>
            <a href='product-admin.php?product_id=$product_id&inventory_history=1' class=\"customer_link\" title=\"See inventory history about '$name'\">
                $inventory
            </a>
        </td>
        <td>
            <a href='product-admin.php?product_id=$product_id&sales_history=1' class=\"customer_link\" title=\"See sales history about '$name'\">
                $sales_number
            </a>
        </td>
        <td>$last_modified_by</td>
        <td>$last_modified_on</td>
        <td>
            <a>
                <button class=\"btn_remove_product\" onclick=\"OpenRemoveProductPopUp('$name', $product_id);\" title=\"Remove product '$name'?\">
                    <span class=\"las la-trash\"></span> 
                    Remove Product
                </button>
            </a>
        </td>
    </tr>
    ";
    echo $element;
}

function get_all_products_customer_home($product_id, $name, $price, $type, $category, $inventory, $sales_number)
{
    $element = "
    <tr>
        <td>
            <a href='product-details.php?product_id=$product_id' title=\"See details about product '$name'\">
                $name
            </a>
        </td>
        <td>
            <a href='product-admin.php?product_id=$product_id&price_history=1' class=\"customer_link\" title=\"See price history about '$name'\">
                $price
            </a>
        </td>
        <td>$type</td>
        <td>$category</td>
        <td>
            <a href='product-admin.php?product_id=$product_id&inventory_history=1' class=\"customer_link\" title=\"See inventory history about '$name'\">
                $inventory
            </a>
        </td>
        <td>
            <a href='product-admin.php?product_id=$product_id&sales_history=1' class=\"customer_link\" title=\"See sales history about '$name'\">
                $sales_number
            </a>
        </td>
    </tr>
    ";
    echo $element;
}

function get_all_product_history_prices($price, $price_change, $modified_by, $modified_on)
{
    $element = "
    <tr>
        <td>$price</td>
        <td>$price_change</td>
        <td>$modified_by</td>
        <td>$modified_on</td>
    </tr>
    ";
    echo $element;
}

function get_all_product_history_inventory($inventory, $inventory_change, $modified_by, $modified_on)
{
    $element = "
    <tr>
        <td>$inventory</td>
        <td>$inventory_change</td>
        <td>$modified_by</td>
        <td>$modified_on</td>
    </tr>
    ";
    echo $element;
}

function get_all_product_history_sales($sales_number, $sales_change, $modified_by, $modified_on)
{
    $element = "
    <tr>
        <td>$sales_number</td>
        <td>$sales_change</td>
        <td>$modified_by</td>
        <td>$modified_on</td>
    </tr>
    ";
    echo $element;
}

function get_products_in_asc_desc($name, $inventory, $sales_number)
{
    $element = "
    <tr class=\"hello\">
        <td>$name</td>
        <td>$inventory</td>
        <td>$sales_number</td>
    </tr>

    ";
    echo $element;
}

function get_all_store_sales($store_sales_id, $customer_name, $email, $total_products, $total_quantity, $total_price, $loyalty_discount_percentage, $total_price_after_discount, $date)
{
    $element = "
        <tr class=\"hello\">
            <td title=\"$customer_name\">$customer_name</td>
            <td title=\"$email\">$email</td>
            <td title=\"$total_products\">$total_products</td>
            <td title=\"$total_quantity\">$total_quantity</td>
            <td title=\"$total_price\">$total_price</td>
            <td title=\"$loyalty_discount_percentage\">$loyalty_discount_percentage</td>
            <td title=\"$total_price_after_discount\">$total_price_after_discount</td>
            <td title=\"$date\">$date</td>
            <td>
                <a>
                    <button class=\"btn_view_store_sales_order\" onclick=\"window.location.href = 'store-sale-admin-details.php?store_sale_id=$store_sales_id';\" title=\"View Details Related to this store sale order\">View Order</button>
                </a>
            </td>
        </tr>
    ";
    echo $element;
}

function get_all_repairs($repair_id, $repair_type, $price_per_hour)
{
    $element = "
        <tr>
            <td title=\"$repair_type\">$repair_type</td>
            <td title=\"$price_per_hour\">$price_per_hour</td>
            <td>
                <a>
                    <button class=\"btn_view_repair\" onclick=\"window.location.href = 'repair-admin-details.php?repair-id=$repair_id';\" title=\"View details for '$repair_type'\"><span class=\"las la-info-circle\"></span>View Details</button>
                </a>
            </td>
            <td>
                <a>
                    <button class=\"btn_remove_repair\" onclick=\"OpenRemoveRepairPopUp($repair_id, '$repair_type');\" title=\"Remove repair '$repair_type'?\">
                        <span class=\"las la-trash\"></span> 
                        Remove Repair
                    </button>
                </a>
            </td>
        </tr>
    ";
    echo $element;
}

function get_all_product_types($product_type, $added_by, $modified_on)
{
    $element = "
    <tr>
        <td title=\"$product_type\">$product_type</td>
        <td title=\"$added_by\">$added_by</td>
        <td title=\"$modified_on\">$modified_on</td>
        <td>
            <a>
                <button class=\"btn_remove_type\" onclick=\"OpenRemoveTypePopUp('$product_type');\" title=\"Remove type '$product_type'?\">
                    <span class=\"las la-trash\"></span> 
                    Remove Type
                </button>
            </a>
        </td>
    </tr>
    ";

    echo $element;
}

function get_all_product_types_for_add_product_form($product_type)
{
    $element = "<option value='$product_type'>$product_type</option>";
    echo $element;
}

function get_all_products_names_for_add_product_offer_form($product_name)
{
    $element = "<option value='$product_name'>$product_name</option>";
    echo $element;
}

function get_all_product_categories($product_category, $added_by, $modified_on)
{
    $element = "
    <tr>
        <td title=\"$product_category\">$product_category</td>
        <td title=\"$added_by\">$added_by</td>
        <td title=\"$modified_on\">$modified_on</td>
        <td>
            <a>
                <button class=\"btn_remove_category\" onclick=\"OpenRemoveCategoryPopUp('$product_category');\" title=\"Remove category '$product_category'?\">
                    <span class=\"las la-trash\"></span> 
                    Remove Category
                </button>
            </a>
        </td>
    </tr>
    ";

    echo $element;
}

function get_all_product_categories_for_add_product_form($product_category)
{
    $element = "<option value='$product_category'>$product_category</option>";
    echo $element;
}

function get_loyalty_discount($loyalty_point_required, $discount_percentage, $benefitted_customers, $last_modified_by, $last_modified_on)
{
    $element = "
    <tr>
        <td>$loyalty_point_required</td>
        <td>$discount_percentage</td>
        <td>$benefitted_customers</td>
        <td>$last_modified_by</td>
        <td>$last_modified_on</td>
        <td>
            <a>
                <button class=\"btn_remove_product\" onclick=\"OpenRemoveLoyaltyDiscountPopUp();\" title=\"Remove loyalty discount?\">
                    <span class=\"las la-trash\"></span> 
                    Remove Loyalty Discount
                </button>
            </a>
        </td>";

    echo $element;
}

function get_all_products_offers($product_id, $name, $old_price, $new_price, $offer_percentage, $offer_begin_date, $offer_end_date, $last_modified_by, $last_modified_on)
{
    $element = "
    <tr>
        <td>
            <a href='../product-admin/product-details.php?product_id=$product_id' title=\"See details about product '$name'\">
                $name
            </a>
        </td>
        <td>$old_price</td>
        <td>$new_price</td>
        <td>$offer_percentage</td>
        <td>$offer_begin_date</td>
        <td>$offer_end_date</td>
        <td>$last_modified_by</td>
        <td>$last_modified_on</td>
        <td>
            <a>
                <button class=\"btn_remove_product\" onclick=\"OpenRemoveProductOfferPopUp('$name', $product_id);\" title=\"Remove offer on product '$name'?\">
                    <span class=\"las la-trash\"></span> 
                    Remove Product Offer
                </button>
            </a>
        </td>
    </tr>
    ";
    echo $element;
}

function get_all_products_offers_recommendations($product_id, $product_name, $product_price, $product_inventory_history, $product_sales_history, $product_inventory_sales_ration)
{
    $element = "
    <tr>
        <td>
            <a href='../product-admin/product-details.php?product_id=$product_id' title=\"See details about '$product_name'\">
                $product_name
            </a>
        </td>
        <td>$product_price</td>
        <td>$product_inventory_history</td>
        <td>$product_sales_history</td>
        <td>$product_inventory_sales_ration</td>
    </tr>";
    echo $element;
}
