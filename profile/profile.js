
var profile_part = document.querySelector(".profile");
var basket_part = document.querySelector(".basket");
var favorites_part = document.querySelector(".favorites");
var appointments_part = document.querySelector(".appointments");
var checkouts_part = document.querySelector(".checkouts");

var profile_button = document.getElementById("profile-button");
var basket_button = document.getElementById("basket-button");
var favorites_button = document.getElementById("favorites-button");
var appointments_button = document.getElementById("appointments-button");
var checkouts_button = document.getElementById("checkouts-button");

function ShowProfile() {
    profile_part.style.display = "block";
    // profile_part.classList.add("reveal-by-y");
    basket_part.style.display = "none";
    favorites_part.style.display = "none";
    checkouts_part.style.display = "none";
    appointments_part.style.display = "none";
    profile_button.style.fontWeight = 800;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 500;
    appointments_button.style.fontWeight = 500;
    checkouts_button.style.fontWeight = 500;
}

function ShowBasket() {
    profile_part.style.display = "none";
    basket_part.style.display = "block";
    // basket_part.classList.add("reveal-by-y");
    favorites_part.style.display = "none";
    appointments_part.style.display = "none";
    checkouts_part.style.display = "none";

    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 800;
    favorites_button.style.fontWeight = 500;
    appointments_button.style.fontWeight = 500;
    checkouts_button.style.fontWeight = 500;
}

function ShowFavorites() {
    profile_part.style.display = "none";
    basket_part.style.display = "none";
    appointments_part.style.display = "none";
    checkouts_part.style.display = "none";

    favorites_part.style.display = "block";
    // favorites_part.classList.add("reveal-by-y");
    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 800;
    appointments_button.style.fontWeight = 500;
    checkouts_button.style.fontWeight = 500;
}

function ShowAppointments() {
    profile_part.style.display = "none";
    basket_part.style.display = "none";
    favorites_part.style.display = "none";
    appointments_part.style.display = "block";
    checkouts_part.style.display = "none";
    // appointments_part.classList.add("reveal-by-y");
    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 500;
    appointments_button.style.fontWeight = 800;
    checkouts_button.style.fontWeight = 500;
}

function ShowCheckouts() {
    profile_part.style.display = "none";
    basket_part.style.display = "none";
    favorites_part.style.display = "none";
    appointments_part.style.display = "none";
    checkouts_part.style.display = "block";
    // appointments_part.classList.add("reveal-by-y");
    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 500;
    appointments_button.style.fontWeight = 500;
    checkouts_button.style.fontWeight = 800;
}

const edit_btn = document.querySelector(".edit_profile_btn");
const btn_div = document.querySelector(".edit_save_btn");

function ChangeProfile() {
    const firstname = document.querySelector(".first_name_editprofile");
    const lastname = document.querySelector(".last_name_editprofile");
    const email = document.querySelector(".email_editprofile");
    const phonenumber = document.querySelector(".phone_number_editprofile");
    const address = document.querySelector(".address_editprofile");
    const city = document.querySelector(".city_editprofile");

    console.log("edit profile btn clicked");

    if (firstname.style.display === 'none') {
        btn_div.innerHTML = " <button onclick=\"ChangeProfile()\" class=\"edit_profile_btn\" title=\"Back to your profile\" style=\"color: red \"><i class=\"fa fa-backward\"></i>Back</button><button type=\"submit\" class=\"save_profile_btn\" title = \"Save all your changes\" > <i class=\"fa fa-save\"></i><strong>Save</strong></button > ";
        // 👇️ this SHOWS the form
        firstname.style.display = 'block';
        lastname.style.display = 'block';
        email.style.display = 'block';
        phonenumber.style.display = 'block';
        address.style.display = 'block';
        city.style.display = 'block';
    } else {
        btn_div.innerHTML = " <button onclick=\"ChangeProfile()\" class=\"edit_profile_btn\" title=\"Edit your profile\" style=\"color: black; \"><i class=\"fa fa-edit\"></i>Edit Profile</button>";
        // 👇️ this HIDES the form
        firstname.style.display = 'none';
        lastname.style.display = 'none';
        email.style.display = 'none';
        phonenumber.style.display = 'none';
        address.style.display = 'none';
        city.style.display = 'none';
    }
}

//open logout popup
function OpenLogOutPopUp() {
    let logout_popup = document.getElementById('logout-confirmation');
    logout_popup.classList.add('open-popup');
}

//close logout popup
function CloseLogOutPopUp() {
    let logout_popup = document.getElementById('logout-confirmation');
    logout_popup.classList.remove('open-popup');
}

//go to login
function GoToLogIn() {
    window.location.href = '../php/logout.php';
    CloseLogOutPopUp();
}

var APPid;
var APPdate;
var APPhour;
//open delete appointment pop up
function OpenDeleteAppointmentPopUp(appointment_id, date, hour) {
    let appointment_popup = document.getElementById('delete-appointment-confirmation');
    appointment_popup.classList.add('open-popup');
    APPid = appointment_id;
    APPdate = date;
    APPhour = hour;
}
//delete appointment
function DeleteAppointment() {
    console.log(APPdate + " " + APPhour);
    localStorage.setItem(APPdate + " " + APPhour, "false");
    CloseDeleteAppointmentPopUp();
    window.location = '../profile/profile.php?deleteAPPid=' + APPid;
}

//close delete appointment popup
function CloseDeleteAppointmentPopUp() {
    let appointment_popup = document.getElementById('delete-appointment-confirmation');
    appointment_popup.classList.remove('open-popup');
}

var productRemoveID;
function OpenRemoveFavoritesPopUp(product_remove_id) {
    let remove_favorites_popup = document.getElementById('remove-favorites-confirmation');
    remove_favorites_popup.classList.add('open-popup');
    productRemoveID = product_remove_id;
}

function RemoveFavorites() {
    window.location = '../php/favorites.php?productRemoveID=' + productRemoveID;
    CloseRemoveFavoritesPopUp();
}

function CloseRemoveFavoritesPopUp() {
    let remove_favorites_popup = document.getElementById('remove-favorites-confirmation');
    remove_favorites_popup.classList.remove('open-popup');
}
if (window.location.href.includes("?edit_profile=true")) {
    OpenEditProfilePopUp();
}
function OpenEditProfilePopUp() {
    let edit_profile_popup = document.getElementById('edit-profile-confirmation');
    edit_profile_popup.classList.add('open-popup');
}

function RemoveEditProfilePopUp() {
    window.location = '../profile/profile.php';
    let edit_profile_popup = document.getElementById('edit-profile-confirmation');
    edit_profile_popup.classList.remove('open-popup');
}
var checkoutID;
function OpenRemoveCheckoutPopUp(checkout_id) {
    let checkout_delete_popup = document.getElementById('delete-checkout-confirmation');
    checkoutID = checkout_id; 
    checkout_delete_popup.classList.add('open-popup');
}

function CloseRemoveCheckoutPopUp() {
    let checkout_delete_popup = document.getElementById('delete-checkout-confirmation');
    checkout_delete_popup.classList.remove('open-popup');
}

function RemoveCheckout() {
    window.location = '../profile/profile.php?delete_checkout_id=' + checkoutID; 
    CloseRemoveCheckoutPopUp();
}

window.addEventListener("pageshow", ShowProfile);
