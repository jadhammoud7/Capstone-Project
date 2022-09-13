
var AppointmentID;

function SetAppointmentID(appointment_id) {
    AppointmentID = appointment_id;
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

const btn = document.getElementsByClassName('btn_done_work');
const statusbtn = document.getElementsByClassName('status_btn');
const status_color = document.getElementsByClassName('status red');

for (let i = 0; i < btn.length; i++) {
    btn[i].addEventListener('click', function handleClick() {
        if (btn[i].innerHTML.includes("Done Work")) {
            // SetButtonToPending(btn[i]);
            window.location = '../appointments-admin/appointments-admin.php?getAppointmentID=' + AppointmentID + '&set_to_done=true';
            //yaane heye pending w bade hawela la done
        } else {
            // SetButtonToDone(btn[i]);
            window.location = '../appointments-admin/appointments-admin.php?getAppointmentID=' + AppointmentID + '&set_to_done=false';
            //yane heye done w bade hawela la pending
        }
    });
    SetButton(statusbtn[i].textContent, btn[i], status_color[i]);
}