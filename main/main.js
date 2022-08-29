
const hamBurger = document.querySelector(".hamburger");
const nav_menu = document.querySelector(".nav-menu");

// const home_menu = document.querySelector(".home_menu");
// const works_menu = document.querySelector(".works_menu");
// const contact_menu = document.querySelector(".contact_menu");
// const about_menu = document.querySelector(".about_menu");
// const account_menu = document.querySelector(".account_menu");

// var home_menu_innerHTML = "";
// var works_menu_innerHTML = "";
// var contact_menu_innerHTML = "";
// var about_menu_innerHTML = "";
// var account_menu_innerHTML = "";
var nav_menu_innerHTML = "";
var clicks = 0;
hamBurger.addEventListener("click", () => {
    // home_menu_innerHTML = home_menu.innerHTML;
    // works_menu_innerHTML = works_menu.innerHTML;
    // contact_menu_innerHTML = contact_menu.innerHTML;
    // about_menu_innerHTML = about_menu.innerHTML;
    // account_menu_innerHTML = account_menu.innerHTML;

    hamBurger.classList.toggle("active");
    nav_menu.classList.toggle("active");

    // nav_menu.classList.remove("nav-menu");

    // home_menu.classList.remove("home_menu");
    // works_menu.classList.remove("works_menu");
    // contact_menu.classList.remove("contact_menu");
    // about_menu.classList.remove("about_menu");
    // account_menu.classList.remove("account_menu");
    if (clicks > 0) {
        nav_menu.innerHTML = nav_menu_innerHTML;
        console.log(nav_menu_innerHTML);
    }
    if (clicks == 0) {
        nav_menu_innerHTML = nav_menu.innerHTML;
        console.log(nav_menu_innerHTML);

        nav_menu.innerHTML = "<li>" +
            "<a href=\"../home-page/home-page.php\" class=\"nav-link\" title=\"Home Page\"><i class=\"fa fa-home fa-lg\"></i>Home</a>" +
            "</li>" +
            "<li><a href=\"../shop/shop.php\" class=\"nav-link\" title=\"Shop Page\"><i class=\"fa fa-shopping-cart fa-lg\"></i>Shop</a></li>" +
            "<li><a href=\"../appointments/appointments.php\" class=\"nav-link\" title=\"Appointments\"><i class=\"fa fa-wrench fa-lg\"></i>Appointments</a></li>" +
            " <li>" +
            "<a href=\"../contactus/contactus.php\" class=\"nav-link\" title=\"Contact Us Page\"><i class=\"fa fa-phone fa-lg\"></i>Contact</a>" +
            "</li>" +
            "<li>" +
            "<a href=\"../aboutus/aboutus.php\" class=\"nav-link\" title=\"About us Page\"><i class=\"fa fa-book fa-lg\"></i>About</a>" +
            "</li>" +
            "<li><a href=\"../profile/profile.php\" class=\"nav-link\" title=\"View my account\"><i class=\"fa fa-user fa-lg profile-nav\"></i>My Profile</a></li>" +
            "<li><a href=\"../basket/basket.php\" class=\"nav-link\" title=\"View my Shopping Basket\"><i class=\"fa fa-shopping-basket fa-lg\"></i>My Basket</a></li>";
        // home_menu.innerHTML = "<i class=\"fa fa-home fa-lg\"></i>Home";
        // works_menu.innerHTML = "<li><a href=\"../shop/shop.php\" class=\"shop_menu nav-link\" title=\"Shop Page\">Shop</a></li><li><a href=\"../appointments/appointments.php\" class=\"appointments_menu nav-link\" title=\"Appointments\">Appointments</a></li>";
        // // shop_menu.innerHTML += "<i class=\"fa fa-shopping-cart fa-lg\"></i>Shop";
        // // appointments_menu.innerHTML += "<i class=\"fa fa-wrench fa-lg\"></i>Appointments";
        // contact_menu.innerHTML = "<i class=\"fa fa-phone fa-lg\"></i>Contact Us";
        // about_menu.innerHTML = "<i class=\"fa fa-book fa-lg\"></i>About Us";
        // // basket_menu.innerHTML += "<i class=\"fa fa-shopping-basket fa-lg\"></i>My Basket";
        // account_menu.innerHTML = "<i class=\"fa fa-user fa-lg profile-nav\"></i>My Account";
    }

    clicks++;
})
document.querySelectorAll(".nav-menu").forEach(n => n.addEventListener("click", () => {
    hamBurger.classList.remove("active");
    nav_menu.classList.remove("active");
    // home_menu.classList.add("home_menu");
    // home_menu.innerHTML = home_menu_innerHTML;
    // works_menu.classList.add("works_menu");
    // works_menu.innerHTML = works_menu_innerHTML;
    // shop_menu.classList.add("shop_menu");
    // shop_menu.innerHTML = shop_menu_innerHTML;
    // appointments_menu.classList.add("appointments_menu");
    // appointments_menu.innerHTML = appointments_menu_innerHTML;
    // contact_menu.classList.add("contact_menu");
    // contact_menu.innerHTML = contact_menu_innerHTML;
    // about_menu.classList.add("about_menu");
    // about_menu.innerHTML = about_menu_innerHTML;
    // basket_menu.classList.add("basket_menu");
    // basket_menu.innerHTML = basket_menu_innerHTML;
    // account_menu.classList.add("myaccount_menu");
    // account_menu.innerHTML = account_menu_innerHTML;
    // nav_menu.classList.add("nav-menu");
    nav_menu.innerHTML = nav_menu_innerHTML;
    console.log(nav_menu_innerHTML);
}))


function revealY() {
    var reveals = document.querySelectorAll(".reveal-by-y");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("on");
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
    }
}

function revealX2() {
    var reveals = document.querySelectorAll(".reveal-by-x2");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("on");
        }
    }
}

window.addEventListener("scroll", revealX);
window.addEventListener("scroll", revealX2);
window.addEventListener("scroll", revealY);
window.addEventListener("pageshow", revealY);
window.addEventListener("pageshow", revealX);

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



//new menu
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
