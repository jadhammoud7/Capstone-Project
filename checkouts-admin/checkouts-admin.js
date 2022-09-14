var CheckoutID;

function SetCheckoutID(checkout_id) {
    CheckoutID = checkout_id;
}

function SetButton(status, button, status_color) {
    if (status == "Pending")
        SetButtonToDone(button, status_color);

    if (status == "Done Work")
        SetButtonToPending(button, status_color);
}
function SetButtonToPending(button, status_color) {
    button.innerHTML = "Pending";
    button.title = "Set the status of this appointment to Pending";
    button.style.color = "black";
    button.style.background = "red";
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
    btn_checkout[i].addEventListener('click', function handleClick() {
        if (btn_checkout[i].innerHTML.includes("Done Work")) {
            // SetButtonToPending(btn[i]);
            window.location = '../checkouts-admin/checkouts-admin.php?getCheckoutID=' + CheckoutID + '&set_to_done=true';
            //yaane heye pending w bade hawela la done
        } else {
            // SetButtonToDone(btn[i]);
            window.location = '../checkouts-admin/checkouts-admin.php?getCheckoutID=' + CheckoutID + '&set_to_done=false';
            //yane heye done w bade hawela la pending
        }
    });
    SetButton(statusbtn_checkout[i].textContent, btn_checkout[i], status_color_checkout[i]);
}
