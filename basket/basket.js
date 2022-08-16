function ReturnToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
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

window.addEventListener("scroll", revealY);
window.addEventListener("pageshow", revealY);


//start with the calculations of every product(quantity)
// const product_container=document.querySelector(".product-container");
const get_price=document.getElementById("get_price");
// const get_value=document.getElementById("quantity_of_each_product");
var price=get_price.innerHTML;
// var value=get_value.innerHTML;
// get_price.innerHTML=value*price;
console.log(price)
// console.log(value);

