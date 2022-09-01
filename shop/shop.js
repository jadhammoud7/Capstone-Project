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

if (window.location.href.includes("add_to_basket=true")) {
    OpenAddedToBasketPopUp();
}

function OpenAddedToBasketPopUp() {
    let added_to_basket_popup = document.getElementById('added-to-basket-confirmation');
    added_to_basket_popup.classList.add('open-popup');
}

function RemoveAddToBasketPopUp() {
    window.location = '../shop/shop.php';
    let added_to_basket_popup = document.getElementById('added-to-basket-confirmation');
    added_to_basket_popup.classList.remove('open-popup');
}

if (window.location.href.includes("added_to_favorites=true")) {
    OpenAddedToFavoritesPopUp();
}

function OpenAddedToFavoritesPopUp() {
    let added_to_favorites_popup = document.getElementById('added-to-favorites-confirmation');
    added_to_favorites_popup.classList.add('open-popup');
}

function RemoveAddedToFavoritesPopUp() {
    window.location = '../shop/shop.php';
    let added_to_favorites_popup = document.getElementById('added-to-favorites-confirmation');
    added_to_favorites_popup.classList.remove('open-popup');
}

if (window.location.href.includes("found_in_favorites=true")) {
    OpenFoundInFavoritesPopUp();
}

function OpenFoundInFavoritesPopUp() {
    let found_in_favorites_popup = document.getElementById('found-in-favorites-confirmation');
    found_in_favorites_popup.classList.add('open-popup');
}

function RemoveFoundInFavoritesPopUp() {
    window.location = '../shop/shop.php';
    let found_in_favorites_popup = document.getElementById('found-in-favorites-confirmation');
    found_in_favorites_popup.classList.remove('open-popup');
}

var cds_button = document.getElementById('cds-btn');
var consoles_button = document.getElementById('consoles-btn');
var phones_button = document.getElementById('phones-btn');
var offers_button = document.getElementById('offers-btn');
var others_button = document.getElementById('others-btn');

if (window.location.href.includes("cds")) {
    cds_button.classList.add("active");
    consoles_button.classList.remove("active");
    phones_button.classList.remove("active");
    offers_button.classList.remove("active");
    others_button.classList.remove("active");
}

if (window.location.href.includes("consoles")) {
    cds_button.classList.remove("active");
    consoles_button.classList.add("active");
    phones_button.classList.remove("active");
    offers_button.classList.remove("active");
    others_button.classList.remove("active");
}


if (window.location.href.includes("phones")) {
    cds_button.classList.remove("active");
    consoles_button.classList.remove("active");
    phones_button.classList.add("active");
    offers_button.classList.remove("active");
    others_button.classList.remove("active");
}

if (window.location.href.includes("offers")) {
    cds_button.classList.remove("active");
    consoles_button.classList.remove("active");
    phones_button.classList.remove("active");
    offers_button.classList.add("active");
    others_button.classList.remove("active");
}

if (window.location.href.includes("others")) {
    cds_button.classList.remove("active");
    consoles_button.classList.remove("active");
    phones_button.classList.remove("active");
    offers_button.classList.remove("active");
    others_button.classList.add("active");
}

