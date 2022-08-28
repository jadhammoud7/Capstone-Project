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

function ShowFilters() {
    var filter = document.querySelector(".filters");
    var filter_btn = document.getElementById("filter-btn");

    if (filter.style.display == "flex") {
        filter.style.display = "none";
        filter_btn.style.display = "none";
    }
    else {
        filter.style.display = "flex";
        filter_btn.style.display = "block";
    }
}

function SendFilters() {
    var select = document.getElementById('sortby');
    var option = select.options[select.selectedIndex];

    var select_type = document.getElementById('type');
    var option_type = select_type.options[select_type.selectedIndex];

    var select_category = document.getElementById('category');
    var option_category = select_category.options[select_category.selectedIndex];

    window.location = '?type=' + option_type.value + '&category=' + option_category.value + '&sortby=' + option.value;
}

if (window.location.href.includes("?found_in_basket=true")) {
    OpenFoundInBasketPopUp();
}

function OpenFoundInBasketPopUp() {
    let found_in_basket_popup = document.getElementById('found-in-basket-confirmation');
    found_in_basket_popup.classList.add('open-popup');
}

function RemoveFoundInBasketPopUp() {
    window.location = '../shop/shop.php';
    let found_in_basket_popup = document.getElementById('found-in-basket-confirmation');
    found_in_basket_popup.classList.remove('open-popup');
}

function GoToBasket() {
    window.location = '../basket/basket.php';
    let found_in_basket_popup = document.getElementById('found-in-basket-confirmation');
    found_in_basket_popup.classList.remove('open-popup');
}

