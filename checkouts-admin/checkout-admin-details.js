const checkout_status = document.getElementById('checkout_status');

if (checkout_status.innerHTML == "Pending") {
    const set_status_button = document.getElementById('SetStatusCheckoutButton');
    set_status_button.style.visibility = 'visible';
}

else {
    const set_status_button = document.getElementById('SetStatusCheckoutButton');
    set_status_button.style.visibility = 'hidden';
}
var CheckoutID;

function SetCheckoutID(checkout_id) {
    CheckoutID = checkout_id;
    window.location.href = 'checkout-admin-details.php?getCheckoutID=' + checkout_id + '&set_to_done=true';
}

if (window.location.href.includes('change-status=1')) {
    OpenDoneCheckoutPopUp();
}

function OpenDoneCheckoutPopUp() {
    var done_checkout_popup = document.getElementById('done-checkout-confirmation');
    done_checkout_popup.classList.add('open-popup');
}

function CloseDoneCheckoutPopUp() {
    var done_checkout_popup = document.getElementById('done-checkout-confirmation');
    done_checkout_popup.classList.remove('open-popup');
}

if (window.location.href.includes('checkout-error')) {
    OpenCheckoutErrorAlert();
}

function OpenCheckoutErrorAlert() {
    var checkout_error_alert = document.getElementById('checkout-error-alert');
    checkout_error_alert.classList.add('open-popup');
}

function CloseCheckoutDoneAlert() {
    var checkout_error_alert = document.getElementById('checkout-error-alert');
    checkout_error_alert.classList.remove('open-popup');
}