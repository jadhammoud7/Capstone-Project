if (window.location.href.includes("?remove_product=true")) {
    OpenRemovedFromBasketPopUp();
}

function OpenRemovedFromBasketPopUp() {
    let remove_from_basket_popup = document.getElementById('removed-from-basket-confirmation');
    remove_from_basket_popup.classList.add('open-popup');
}

function RemoveRemovedFromBasketPopUp() {
    window.location = '../basket/basket.php';
    let remove_from_basket_popup = document.getElementById('removed-from-basket-confirmation');
    remove_from_basket_popup.classList.remove('open-popup');
}