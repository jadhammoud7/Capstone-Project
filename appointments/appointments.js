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


const hamBurger = document.querySelector(".hamburger");
const nav_menu = document.querySelector(".nav-menu");
const home_menu = document.querySelector(".home_menu");
const shop_menu = document.querySelector(".shop_menu");
const appointments_menu = document.querySelector(".appointments_menu");
const contact_menu = document.querySelector(".contact_menu");
const about_menu = document.querySelector(".about_menu");
const basket_menu = document.querySelector(".basket_menu");
const myaccount_menu = document.querySelector(".myaccount_menu");

var home_menu_innerHTML = home_menu.innerHTML;
var shop_menu_innerHTML = shop_menu.innerHTML;
var appointments_menu_innerHTML = appointments_menu.innerHTML;
var contact_menu_innerHTML = contact_menu.innerHTML;
var about_menu_innerHTML = about_menu.innerHTML;
var basket_menu_innerHTML = basket_menu.innerHTML;
var myaccount_menu_innerHTML = myaccount_menu.innerHTML;

hamBurger.addEventListener("click", () => {
    hamBurger.classList.toggle("active");
    nav_menu.classList.toggle("active");
    home_menu.classList.remove("home_menu");
    home_menu.innerHTML += "Home";
    shop_menu.classList.remove("shop_menu");
    shop_menu.innerHTML += "Shop";
    appointments_menu.classList.remove("appointments_menu");
    appointments_menu.innerHTML += "Appointments";
    contact_menu.classList.remove("contact_menu");
    contact_menu.innerHTML += "Contact Us";
    about_menu.classList.remove("about_menu");
    about_menu.innerHTML += "About Us";
    basket_menu.classList.remove("basket_menu");
    basket_menu.innerHTML += "My Basket";
    myaccount_menu.classList.remove("myaccount_menu");
    myaccount_menu.innerHTML += "My Account";
})
document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
    hamBurger.classList.remove("active");
    nav_menu.classList.remove("active");
    home_menu.classList.remove("home_menu");

}))

function OpenGift(){
    const gift_div = document.getElementById("id01");
    const gift = document.querySelector(".present");
    gift_div.style.display = "block";
    gift.style.display = "none";
}

function CloseGift(){
    const gift_div = document.getElementById("id01");
    const gift = document.querySelector(".present");
    gift_div.style.display = "none";
    gift.style.display = "block";
}


