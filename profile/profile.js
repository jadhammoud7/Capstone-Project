const hamBurger = document.querySelector(".hamburger");
const nav_menu = document.querySelector(".nav-menu");

const home_menu = document.querySelector(".home_menu");
const shop_menu = document.querySelector(".shop_menu");
const appointments_menu = document.querySelector(".appointments_menu");
const contact_menu = document.querySelector(".contact_menu");
const about_menu = document.querySelector(".about_menu");
const basket_menu = document.querySelector(".basket_menu");
const myaccount_menu = document.querySelector(".myaccount_menu");

var home_menu_innerHTML = "";
var shop_menu_innerHTML = "";
var appointments_menu_innerHTML = "";
var contact_menu_innerHTML = "";
var about_menu_innerHTML = "";
var basket_menu_innerHTML = "";
var myaccount_menu_innerHTML = "";
var clicks = 0;
hamBurger.addEventListener("click", () => {
    home_menu_innerHTML = home_menu.innerHTML;
    shop_menu_innerHTML = shop_menu.innerHTML;
    appointments_menu_innerHTML = appointments_menu.innerHTML;
    contact_menu_innerHTML = contact_menu.innerHTML;
    about_menu_innerHTML = about_menu.innerHTML;
    basket_menu_innerHTML = basket_menu.innerHTML;
    myaccount_menu_innerHTML = myaccount_menu.innerHTML;

    hamBurger.classList.toggle("active");
    nav_menu.classList.toggle("active");


    home_menu.classList.remove("home_menu");
    shop_menu.classList.remove("shop_menu");
    appointments_menu.classList.remove("appointments_menu");
    contact_menu.classList.remove("contact_menu");
    about_menu.classList.remove("about_menu");
    basket_menu.classList.remove("basket_menu");
    myaccount_menu.classList.remove("myaccount_menu");
    if (clicks == 0) {
        home_menu.innerHTML += "Home";
        shop_menu.innerHTML += "Shop";
        appointments_menu.innerHTML += "Appointments";
        contact_menu.innerHTML += "Contact Us";
        about_menu.innerHTML += "About Us";
        basket_menu.innerHTML += "My Basket";
        myaccount_menu.innerHTML += "My Account";
    }

    clicks++;
})
document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
    hamBurger.classList.remove("active");
    nav_menu.classList.remove("active");
    home_menu.classList.add("home_menu");
    home_menu.innerHTML = home_menu_innerHTML;
    shop_menu.classList.add("shop_menu");
    shop_menu.innerHTML = shop_menu_innerHTML;
    appointments_menu.classList.add("appointments_menu");
    appointments_menu.innerHTML = appointments_menu_innerHTML;
    contact_menu.classList.add("contact_menu");
    contact_menu.innerHTML = contact_menu_innerHTML;
    about_menu.classList.add("about_menu");
    about_menu.innerHTML = about_menu_innerHTML;
    basket_menu.classList.add("basket_menu");
    basket_menu.innerHTML = basket_menu_innerHTML;
    myaccount_menu.classList.add("myaccount_menu");
    myaccount_menu.innerHTML = myaccount_menu_innerHTML;
}))


var profile_part = document.querySelector(".profile");
var basket_part = document.querySelector(".basket");
var favorites_part = document.querySelector(".favorites");
var profile_button = document.getElementById("profile-button");
var basket_button = document.getElementById("basket-button");
var favorites_button = document.getElementById("favorites-button");

function ShowProfile() {
    profile_part.style.display = "block";
    profile_part.classList.add("reveal-by-y");
    basket_part.style.display = "none";
    favorites_part.style.display = "none";
    profile_button.style.fontWeight = 800;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 500;
}

function ShowBasket() {
    profile_part.style.display = "none";
    basket_part.style.display = "block";
    basket_part.classList.add("reveal-by-y");
    favorites_part.style.display = "none";
    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 800;
    favorites_button.style.fontWeight = 500;
}

function ShowFavorites() {
    profile_part.style.display = "none";
    basket_part.style.display = "none";
    favorites_part.style.display = "block";
    favorites_part.classList.add("reveal-by-y");
    profile_button.style.fontWeight = 500;
    basket_button.style.fontWeight = 500;
    favorites_button.style.fontWeight = 800;
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