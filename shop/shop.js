let tabs = document.querySelectorAll(".tabs button");
let tabsArray = Array.from(tabs);


let divs = document.querySelectorAll(".content> div ");
let divArray = Array.from(divs);

tabsArray.forEach((element) => {
    element.addEventListener("click", function (e) {
        tabsArray.forEach((element) => {
            element.classList.remove("active");
        });
        e.currentTarget.classList.add("active");
        divArray.forEach((divs) => {
            divs.style.display = "none";
        });
        document.querySelector(e.currentTarget.dataset.cont).style.display = "block";
        revealX();
    });
});

const hamBurger = document.querySelector(".hamburger");
const nav_menu = document.querySelector(".nav-menu");
const slideshow = document.querySelector(".slideshow-container");
const feature = document.querySelector(".feature-part");

hamBurger.addEventListener("click", () => {
    hamBurger.classList.toggle("active");
    nav_menu.classList.toggle("active");
})
document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {

    hamBurger.classList.remove("active");
    nav_menu.classList.remove("active");
}))

function revealX() {
    var reveals = document.querySelectorAll(".reveal-by-x");

    for (var i = 0; i < reveals.length; i++) {
        if (reveals[i].style.display == "block") {
            reveals[i].classList.add("on");
        }
        else {
            reveals[i].classList.remove("on");
        }
    }
}

function ShowFilters() {
    var filter = document.querySelector(".filters");

    if (filter.style.display == "block")
        filter.style.display = "none";
    else
        filter.style.display = "block";
}

window.addEventListener("pageshow", revealX);

