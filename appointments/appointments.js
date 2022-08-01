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

function OpenGift() {
    const gift_div = document.getElementById("id01");
    const gift = document.querySelector(".present");
    gift_div.style.display = "block";
    gift.style.display = "none";
}

function CloseGift() {
    const gift_div = document.getElementById("id01");
    const gift = document.querySelector(".present");
    gift_div.style.display = "none";
    gift.style.display = "block";
}





// trying calendar here
const date = new Date();

const renderCalender = () => {
    const monthDays = document.querySelector('.days');
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();
    const firstDayIndex = date.getDay();
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();
    const nextDays = 7 - lastDayIndex - 1;
    const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.querySelector('.date h1').innerHTML = month[date.getMonth()];


    document.querySelector('.date p').innerHTML = new Date().toDateString();


    let days = "";

    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }
    for (let i = 1; i <= lastDay; i++) {
        if (i === new Date().getDate() && date.getMonth() === new Date().getMonth()) {
            days += `<div class="today" onclick="SetToCurrentDay(this)"> ${i} </div>`;
        } else {
            days += `<div class="otherdays" onclick="SetToCurrentDay(this)"> ${i} </div>`;
        }

    }
    for (let j = 1; j <= nextDays; j++) {
        days += `<div class="next-date">${j}</div>`;
        monthDays.innerHTML = days;
    }
}

// document.querySelectorAll(".days").forEach(day => {
//     day.addEventListener("click", event => {
//         console.log(event.currentTarget);
//     })
// });

function SetToCurrentDay(element) {
    const currentDay = document.querySelector('.today');
    const thisDay = element;
    if (currentDay != null) {
        currentDay.classList.remove('today');
        currentDay.classList.add('otherdays');
    }
    thisDay.classList.remove('otherdays');
    thisDay.classList.add('today');
    var newDate = new Date();
    newDate.setMonth(date.getMonth());
    newDate.setDate(thisDay.innerHTML);
    console.log(newDate.toDateString());
    document.querySelector('.date p').innerHTML = newDate.toDateString();
}

document.querySelector('.prev').addEventListener('click', () => {
    date.setMonth(date.getMonth() - 1);
    renderCalender();
})

document.querySelector('.next').addEventListener('click', () => {
    date.setMonth(date.getMonth() + 1);
    renderCalender();
})
renderCalender();


