<?php

include("connection.php");

//for basket
function store_sales_connection($name)
{

    $element = "
        <option value=\"$name\">$name</option>


    ";
    echo $element;
}