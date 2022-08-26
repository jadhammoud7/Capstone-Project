
var profile_part = document.querySelector(".profile");
var basket_part = document.querySelector(".basket");
var favorites_part = document.querySelector(".favorites");
var appointments_part = document.querySelector(".appointments");

var profile_button = document.getElementById("profile-button");
var basket_button = document.getElementById("basket-button");
var favorites_button = document.getElementById("favorites-button");
var appointments_button = document.getElementById("appointments-button");


function ShowProfile() {
    profile_part.style.display = "block";
    profile_part.classList.add("reveal-by-y");
    basket_part.style.display = "none";
    favorites_part.style.display = "none";
    appointments_part.style.display = "none";
    profile_button.style.fontWeight = 800;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 500;
    appointments_button.style.fontWeight = 500;
}

function ShowBasket() {
    profile_part.style.display = "none";
    basket_part.style.display = "block";
    basket_part.classList.add("reveal-by-y");
    favorites_part.style.display = "none";
    appointments_part.style.display = "none";

    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 800;
    favorites_button.style.fontWeight = 500;
    appointments_button.style.fontWeight = 500;
}

function ShowFavorites() {
    profile_part.style.display = "none";
    basket_part.style.display = "none";
    appointments_part.style.display = "none";

    favorites_part.style.display = "block";
    favorites_part.classList.add("reveal-by-y");
    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 800;
    appointments_button.style.fontWeight = 500;
}

function ShowAppointments() {
    profile_part.style.display = "none";
    basket_part.style.display = "none";
    favorites_part.style.display = "none";
    appointments_part.style.display = "block";
    appointments_part.classList.add("reveal-by-y");
    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 500;
    appointments_button.style.fontWeight = 800;
}

const btn = document.querySelector(".edit_profile_btn");
const btn_div = document.querySelector(".edit_save_btn");

function ChangeProfile() {
    const firstname = document.querySelector(".first_name_editprofile");
    const lastname = document.querySelector(".last_name_editprofile");
    const email = document.querySelector(".email_editprofile");
    const phonenumber = document.querySelector(".phone_number_editprofile");
    const address = document.querySelector(".address_editprofile");


    console.log("edit profile btn clicked");

    if (firstname.style.display === 'none') {
        btn_div.innerHTML = " <button onclick=\"ChangeProfile()\" class=\"edit_profile_btn\" title=\"Back to your profile\" style=\"color: red \"><i class=\"fa fa-backward\"></i>Back</button><button type=\"submit\" class=\"save_profile_btn\" title = \"Save all your changes\" > <i class=\"fa fa-save\"></i><strong>Save</strong></button > ";
        // 👇️ this SHOWS the form
        firstname.style.display = 'block';
        lastname.style.display = 'block';
        email.style.display = 'block';
        phonenumber.style.display = 'block';
        address.style.display = 'block';
    } else {
        btn_div.innerHTML = " <button onclick=\"ChangeProfile()\" class=\"edit_profile_btn\" title=\"Edit your profile\" style=\"color: black; \"><i class=\"fa fa-edit\"></i>Edit Profile</button>";
        // 👇️ this HIDES the form
        firstname.style.display = 'none';
        lastname.style.display = 'none';
        email.style.display = 'none';
        phonenumber.style.display = 'none';
        address.style.display = 'none';
    }
}


var topButton = document.getElementById("TopBtn");

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topButton.style.display = "block";
    }
    else {
        topButton.style.display = "none";
    }
}

function ReturnToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function revealY() {
    var reveals = document.querySelectorAll(".reveal-by-y");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("on");
        }
        else {
            reveals[i].classList.remove("on");
        }
    }
}

function revealX() {
    var reveals = document.querySelectorAll(".reveal-by-x");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("on");
        }
        else {
            reveals[i].classList.remove("on");
        }
    }
}

window.addEventListener("scroll", revealX);
window.addEventListener("scroll", revealY);
window.addEventListener("pageshow", revealX);
window.addEventListener("pageshow", revealY);
window.addEventListener("animationstart", revealY);
window.addEventListener("animationstart", revealX);
window.addEventListener("pageshow", ShowProfile);