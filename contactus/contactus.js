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

function revealY(){
    var reveals = document.querySelectorAll(".reveal-by-y");

    for(var i = 0; i <  reveals.length; i++){
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if(elementTop < windowHeight - elementVisible){
            reveals[i].classList.add("on");
        }
        else{
            reveals[i].classList.remove("on");
        }
    }
}

function revealX(){
    var reveals = document.querySelectorAll(".reveal-by-x");

    for(var i = 0; i <  reveals.length; i++){
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if(elementTop < windowHeight - elementVisible){
            reveals[i].classList.add("on");
        }
        else{
            reveals[i].classList.remove("on");
        }
    }
}

window.addEventListener("pageshow", revealX);
window.addEventListener("pageshow", revealY);
window.addEventListener("scroll", revealX);