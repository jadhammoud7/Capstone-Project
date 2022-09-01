
const hamBurger = document.querySelector(".hamburger");
const nav_menu = document.querySelector(".nav-menu");

var nav_menu_innerHTML = nav_menu.innerHTML;
var clicks = 0;
hamBurger.addEventListener("click", () => {

    hamBurger.classList.toggle("active");
    nav_menu.classList.toggle("active");
    if (clicks % 2 == 0) {
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

    }
    if (clicks % 2 != 0) {
        nav_menu.innerHTML = nav_menu_innerHTML;
    }
    clicks++;

})
document.querySelectorAll(".nav-menu").forEach(n => n.addEventListener("click", () => {
    hamBurger.classList.remove("active");
    nav_menu.classList.remove("active");

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

const home_page_nav = document.getElementById('home-page-nav');
const works_nav = document.getElementById('works-nav');
const shop_nav = document.getElementById('shop-nav');
const appointments_nav = document.getElementById('appointments-nav');
const contact_us_nav = document.getElementById('contact-us-nav');
const about_us_nav = document.getElementById('about-us-nav');
const account_nav = document.getElementById('account-nav');
const profile_nav = document.getElementById('profile-nav');
const basket_nav = document.getElementById('basket-nav');

if (window.location.href.includes('home-page.php')) {
    home_page_nav.classList.add('nav-active');
    works_nav.classList.remove('nav-active');
    shop_nav.classList.remove('nav-active');
    appointments_nav.classList.remove('nav-active');
    contact_us_nav.classList.remove('nav-active');
    about_us_nav.classList.remove('nav-active');
    account_nav.classList.remove('nav-active');
    profile_nav.classList.remove('nav-active');
    basket_nav.classList.remove('nav-active');
}

if (window.location.href.includes('shop.php')) {
    home_page_nav.classList.remove('nav-active');
    works_nav.classList.add('nav-active');
    shop_nav.classList.add('nav-active');
    appointments_nav.classList.remove('nav-active');
    contact_us_nav.classList.remove('nav-active');
    about_us_nav.classList.remove('nav-active');
    account_nav.classList.remove('nav-active');
    profile_nav.classList.remove('nav-active');
    basket_nav.classList.remove('nav-active');
}
if (window.location.href.includes('appointments.php')) {
    home_page_nav.classList.remove('nav-active');
    works_nav.classList.add('nav-active');
    shop_nav.classList.remove('nav-active');
    appointments_nav.classList.add('nav-active');
    contact_us_nav.classList.remove('nav-active');
    about_us_nav.classList.remove('nav-active');
    account_nav.classList.remove('nav-active');
    profile_nav.classList.remove('nav-active');
    basket_nav.classList.remove('nav-active');
}
if (window.location.href.includes('contactus.php')) {
    home_page_nav.classList.remove('nav-active');
    works_nav.classList.remove('nav-active');
    shop_nav.classList.remove('nav-active');
    appointments_nav.classList.remove('nav-active');
    contact_us_nav.classList.add('nav-active');
    about_us_nav.classList.remove('nav-active');
    account_nav.classList.remove('nav-active');
    profile_nav.classList.remove('nav-active');
    basket_nav.classList.remove('nav-active');
}

if (window.location.href.includes('aboutus.php')) {
    home_page_nav.classList.remove('nav-active');
    works_nav.classList.remove('nav-active');
    shop_nav.classList.remove('nav-active');
    appointments_nav.classList.remove('nav-active');
    contact_us_nav.classList.remove('nav-active');
    about_us_nav.classList.add('nav-active');
    account_nav.classList.remove('nav-active');
    profile_nav.classList.remove('nav-active');
    basket_nav.classList.remove('nav-active');
}
if (window.location.href.includes('profile.php')) {
    home_page_nav.classList.remove('nav-active');
    works_nav.classList.remove('nav-active');
    shop_nav.classList.remove('nav-active');
    appointments_nav.classList.remove('nav-active');
    contact_us_nav.classList.remove('nav-active');
    about_us_nav.classList.remove('nav-active');
    account_nav.classList.add('nav-active');
    profile_nav.classList.add('nav-active');
    basket_nav.classList.remove('nav-active');
}
if (window.location.href.includes('basket.php')) {
    home_page_nav.classList.remove('nav-active');
    works_nav.classList.remove('nav-active');
    shop_nav.classList.remove('nav-active');
    appointments_nav.classList.remove('nav-active');
    contact_us_nav.classList.remove('nav-active');
    about_us_nav.classList.remove('nav-active');
    account_nav.classList.add('nav-active');
    profile_nav.classList.remove('nav-active');
    basket_nav.classList.add('nav-active');
}


