var CheckoutID;

function SetCheckoutID(checkout_id) {
    CheckoutID = checkout_id;
    window.location.href = 'checkouts-admin.php?getCheckoutID=' + checkout_id + '&set_to_done=true';
}

if (window.location.href.includes('change-status')) {
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

if(window.location.href.includes('checkout-error')){
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

function SetButton(status, button, status_color) {
    if (status == "Pending")
        SetButtonToDone(button, status_color);

    if (status == "Done Work")
        SetButtonToPending(button, status_color);
}
function SetButtonToPending(button, status_color) {
    button.innerHTML = "Done Work";
    button.title = "Set the status of this appointment to Done";
    button.style.color = "black";
    button.style.background = "red";
    button.disabled = true;
    status_color.style.background = "green";
}

function SetButtonToDone(button, status_color) {
    button.innerHTML = "Done Work";
    button.title = "Set the status of this appointment to Done";
    button.style.color = "white";
    button.style.background = "royalblue";
    status_color.style.background = "red";
}

const btn_checkout = document.getElementsByClassName('btn_done_work_checkout');
const statusbtn_checkout = document.getElementsByClassName('status_btn_checkout');
const status_color_checkout = document.getElementsByClassName('status_checkout red');


for (let i = 0; i < btn_checkout.length; i++) {
    // btn_checkout[i].addEventListener('click', function handleClick() {
    //     if (btn_checkout[i].innerHTML.includes("Done Work")) {
    //         // SetButtonToPending(btn[i]);
    //         window.location = '../checkouts-admin/checkouts-admin.php?getCheckoutID=' + CheckoutID + '&set_to_done=true';
    //         //yaane heye pending w bade hawela la done
    //     } else {
    //         // SetButtonToDone(btn[i]);
    //         window.location = '../checkouts-admin/checkouts-admin.php?getCheckoutID=' + CheckoutID + '&set_to_done=false';
    //         //yane heye done w bade hawela la pending
    //     }
    // });
    SetButton(statusbtn_checkout[i].textContent, btn_checkout[i], status_color_checkout[i]);
}
