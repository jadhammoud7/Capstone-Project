const hamBurger = document.querySelector(".hamburger");
const nav_menu = document.querySelector(".nav-menu");

hamBurger.addEventListener("click", () => {
    hamBurger.classList.toggle("active");
    nav_menu.classList.toggle("active");
})
document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {

    hamBurger.classList.remove("active");
    nav_menu.classList.remove("active");
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

//edit profile button down
const btn = document.querySelector(".edit_profile_btn");
const btn_div = document.querySelector(".edit_save_btn");

btn.addEventListener('click', () => {
    const firstname = document.querySelector(".first_name_editprofile");
    const lastname = document.querySelector(".last_name_editprofile");
    const email = document.querySelector(".email_editprofile");
    const phonenumber = document.querySelector(".phone_number_editprofile");
    const address = document.querySelector(".address_editprofile");


    console.log("edit profile btn clicked");

    if (firstname.style.display === 'none') {
        btn.innerHTML = "<i class=\"fa fa-backward\"></i>Back";
        btn.style.color = "red";
        btn_div.innerHTML += "<button class=\"save_profile_btn\" title=\"Save all your changes\"> <i class=\"fa fa-save\"></i><strong>Save</strong></button>"

        // 👇️ this SHOWS the form
        firstname.style.display = 'block';
        lastname.style.display = 'block';
        email.style.display = 'block';
        phonenumber.style.display = 'block';
        address.style.display = 'block';
    } else {
        btn.innerHTML = "<strong><i class=\"fa fa-edit\"></i>Edit Profile</strong>";
        btn.style.color = "black";
        // 👇️ this HIDES the form
        firstname.style.display = 'none';
        lastname.style.display = 'none';
        email.style.display = 'none';
        phonenumber.style.display = 'none';
        address.style.display = 'none';
    }
});

var closebtn = document.querySelector(".close_form");
var closeprofile = document.querySelector(".profile");

closebtn.addEventListener("click", () => {
    console.log("btn closed clicked");
    closeprofile.style.display = "none";
})


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