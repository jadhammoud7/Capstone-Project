
var AppointmentID;

function SetAppointmentID(appointment_id) {
    AppointmentID = appointment_id;
}

function SetButton(status, button) {
    if (status == "Pending")
        SetButtonToDone(button);

    if (status == "Done Work")
        SetButtonToPending(button);
}
function SetButtonToPending(button) {
    button.innerHTML = "Set to pending";
    button.style.color = "black";
    button.style.background = "red";
}

function SetButtonToDone(button) {
    button.innerHTML = "Set Work To Done";
    button.style.color = "white";
    button.style.background = "royalblue";
}

const btn = document.getElementsByClassName('btn_done_work');
const statusbtn = document.getElementsByClassName('status_btn');
for (let i = 0; i < btn.length; i++) {
    btn[i].addEventListener('click', function handleClick() {
        if (btn[i].innerHTML.includes("Work Done")) {
            // SetButtonToPending(btn[i]);
            window.location = '../home-admin/home-admin.php?getAppointmentID=' + AppointmentID + '&set_to_done=true';
            //yaane heye pending w bade hawela la done
        } else {
            // SetButtonToDone(btn[i]);
            window.location = '../home-admin/home-admin.php?getAppointmentID=' + AppointmentID + '&set_to_done=false';
            //yane heye done w bade hawela la pending
        }
    });
    SetButton(statusbtn[i].textContent, btn[i]);
}


