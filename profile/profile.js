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
var edit_part = document.querySelector(".edit");

function ShowProfile(){
    profile_part.style.display = "block";
    basket_part.style.display = "none";
    favorites_part.style.display = "none";
    edit_part.style.display = "none";
}

function ShowBasket(){
    profile_part.style.display = "none";
    basket_part.style.display = "block";
    favorites_part.style.display = "none";
    edit_part.style.display = "none";
}

function ShowFavorites(){
    profile_part.style.display = "none";
    basket_part.style.display = "none";
    favorites_part.style.display = "block";
    edit_part.style.display = "none";
}
