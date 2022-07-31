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

const slideshow = document.querySelector(".slideshow-container");
const feature = document.querySelector(".feature-part");

const about_us = document.querySelector(".about-us");
const contact_us = document.querySelector(".contact-us");
const testimonials = document.querySelector(".test-back");
const appointments_paragraph = document.querySelector(".appointments");

function AddRevealX() {
    var windowHeight = window.innerHeight;
    var elementTopAbout = about_us.getBoundingClientRect().top;
    var elementTopContact = contact_us.getBoundingClientRect().top;
    var elementTopTestimonials = testimonials.getBoundingClientRect().top;
    var elementTopAppointments = appointments_paragraph.getBoundingClientRect().top;
    var elementVisible = -200;
    if (elementTopAbout < windowHeight - elementVisible) {
        about_us.classList.add("reveal-by-x");
        about_us.classList.add("fade");
    }
    if (elementTopContact < windowHeight - elementVisible) {
        contact_us.classList.add("reveal-by-x2");
        contact_us.classList.add("fade");
    }
    if (elementTopTestimonials < windowHeight - elementVisible) {
        testimonials.classList.add("reveal-by-x");
        testimonials.classList.add("fade");
    }
    if(elementTopAppointments < windowHeight - elementVisible){
        appointments_paragraph.classList.add("reveal-by-x");
        appointments_paragraph.classList.add("fade");
    }
}

window.addEventListener("scroll", AddRevealX);
window.addEventListener("pageshow", AddRevealX);


