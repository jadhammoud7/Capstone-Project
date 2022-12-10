
var AppointmentID;

function SetAppointmentID(appointment_id) {
    AppointmentID = appointment_id;
}

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
    button.title = "Set the status to Pending";
    button.style.color = "black";
    button.style.background = "red";
    status_color.style.background = "green";
}

function SetButtonToDone(button, status_color) {
    button.innerHTML = "Done Work";
    button.title = "Set the status to Done";
    button.style.color = "white";
    button.style.background = "royalblue";
    status_color.style.background = "red";
}

const btn = document.getElementsByClassName('btn_done_work');
const statusbtn = document.getElementsByClassName('status_btn');
const status_color = document.getElementsByClassName('status red');

for (let i = 0; i < btn.length; i++) {
    btn[i].addEventListener('click', function handleClick() {
        if (btn[i].innerHTML.includes("Done Work")) {
            // SetButtonToPending(btn[i]);
            window.location = '../home-admin/home-admin.php?getAppointmentID=' + AppointmentID + '&set_to_done=true';
            //yaane heye pending w bade hawela la done
        } else {
            // SetButtonToDone(btn[i]);
            window.location = '../home-admin/home-admin.php?getAppointmentID=' + AppointmentID + '&set_to_done=false';
            //yane heye done w bade hawela la pending
        }
    });
    SetButton(statusbtn[i].textContent, btn[i], status_color[i]);
}

const btn_checkout = document.getElementsByClassName('btn_done_work_checkout');
const statusbtn_checkout = document.getElementsByClassName('status_btn_checkout');
const status_color_checkout = document.getElementsByClassName('status_checkout red');


for (let i = 0; i < btn_checkout.length; i++) {
    btn_checkout[i].addEventListener('click', function handleClick() {
        if (btn_checkout[i].innerHTML.includes("Done Work")) {
            // SetButtonToPending(btn[i]);
            window.location = '../home-admin/home-admin.php?getCheckoutID=' + CheckoutID + '&set_to_done=true';
            //yaane heye pending w bade hawela la done
        } else {
            // SetButtonToDone(btn[i]);
            window.location = '../home-admin/home-admin.php?getCheckoutID=' + CheckoutID + '&set_to_done=false';
            //yane heye done w bade hawela la pending
        }
    });
    SetButton(statusbtn_checkout[i].textContent, btn_checkout[i], status_color_checkout[i]);
}


if (window.location.href.includes("?login=true")) {
    OpenLogInPopUp();
}

function OpenLogInPopUp() {
    let login_popup = document.getElementById('login-confirmation');
    login_popup.classList.add('open-popup');
}

function RemoveLogInPopUp() {
    window.location = '../home-admin/home-admin.php';
    let login_popup = document.getElementById('login-confirmation');
    login_popup.classList.remove('open-popup');
}

function OpenAddModifySlideshow() {
    window.location = '?open_add_modify_slideshow=1';
}

if (window.location.href.includes('open_add_modify_slideshow=1')) {
    const add_modify_slideshow_form = document.getElementById('add_modify_slideshow_form');
    add_modify_slideshow_form.style.display = 'block';
}

function CloseAddModifySlideshow() {
    window.location = 'home-admin.php';
}

if (window.location.href.includes('slideshow_modified=1')) {
    const slideshow_confirmation = document.getElementById('slideshow-confirmation');
    slideshow_confirmation.classList.add('open-popup');
}

function RemoveSlideshowAddedPopUp() {
    window.location = 'home-admin.php';
}
