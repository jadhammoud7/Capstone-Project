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
        else {
            reveals[i].classList.remove("on");
        }
    }
}

window.addEventListener("scroll", revealY);
window.addEventListener("pageshow", revealY);