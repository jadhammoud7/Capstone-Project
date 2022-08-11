<?php

include("connection.php");

function profileconnection($first_name, $last_name, $email, $phone_number, $address){
    $element = "<div class=\"profile fade\" style=\"display: none;\">
    <div class=\"profile-part\">
        <h3 id=\"attribute\">First Name: </h3>
        <h3>$first_name</h3>
    </div>
    <input type=\"text\" name=\"firstname_editprofile\" id=\"\" placeholder=\"new first name..\" class=\"first_name_editprofile\" style=\"display: none;\">
    <div class=\"profile-part\">
        <h3 id=\"attribute\">Last Name: </h3>
        <h3>$last_name</h3>
    </div>
    <input type=\"text\" name=\"lastname_editprofile\" id=\"\" placeholder=\"new last name..\" class=\"last_name_editprofile\" style=\"display: none;\">

    <div class=\"profile-part\">
        <h3 id=\"attribute\">Email Address: </h3>
        <h3>$email</h3>
    </div>
    <input type=\"text\" name=\"email_editprofile\" id=\"\" placeholder=\"new email..\" class=\"email_editprofile\" style=\"display: none;\">
    <div class=\"profile-part\">
        <h3 id=\"attribute\">Phone Number: </h3>
        <h3>$phone_number/h3>
    </div>
    <input type=\"text\" name=\"phonenumber_editprofile\" id=\"\" placeholder=\"new phone number..\" class=\"phone_number_editprofile\" style=\"display: none;\">
    <div class=\"profile-part\">
        <h3 id=\"attribute\">Home Address: </h3>
        <h3>$address</h3>
    </div>
    <input type=\"text\" name=\"address_editprofile\" id=\"\" placeholder=\"new address..\" class=\"address_editprofile\" style=\"display: none;\">


    <div class=\"edit_save_btn\">
        <button onclick=\"ChangeProfile()\" class=\"edit_profile_btn\" title=\"Edit your profile\"> <i class=\"fa fa-edit\"></i><strong>Edit
                Profile</strong></button>
    </div>
</div>";

echo $element;
}

?>