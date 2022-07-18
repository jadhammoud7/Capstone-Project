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
    });
});

function revealY() {
    var reveals = document.querySelectorAll(".reveal-by-y");

    for (var i = 0; i < reveals.length; i++) {
        if (reveals.style.display = "block") {
            reveals[i].classList.add("on");
        }
        else {
            reveals[i].classList.remove("on");
        }
    }
}

window.addEventListener("pageshow", revealY);
window.addEventListener("load", revealY);