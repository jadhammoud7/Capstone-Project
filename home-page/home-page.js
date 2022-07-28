let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 4000); // Change image every 4 seconds
}

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

const about_us = document.querySelector(".about-us");
const contact_us = document.querySelector(".contact-us");
const testimonials = document.querySelector(".test-back");

function AddRevealX(){
    var windowHeight = window.innerHeight;
    var elementTopAbout = about_us.getBoundingClientRect().top;
    var elementTopContact = contact_us.getBoundingClientRect().top;
    var elementTopTestimonials = testimonials.getBoundingClientRect().top;
    var elementVisible = -200;
    if(elementTopAbout < windowHeight - elementVisible){
        about_us.classList.add("reveal-by-x");
        about_us.classList.add("fade");
    }
    if(elementTopContact < windowHeight - elementVisible){
        contact_us.classList.add("reveal-by-x2");
        contact_us.classList.add("fade");
    }
    if(elementTopTestimonials < windowHeight - elementVisible){
        testimonials.classList.add("reveal-by-x");
        testimonials.classList.add("fade");
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
window.addEventListener("scroll", AddRevealX);
window.addEventListener("pageshow", AddRevealX);

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


