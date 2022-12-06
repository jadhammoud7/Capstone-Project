
function OpenGift() {
    const gift_div = document.getElementById("id01");
    const gift = document.querySelector(".present");
    gift_div.style.display = "block";
    gift.style.display = "none";
}

function CloseGift() {
    const gift_div = document.getElementById("id01");
    const gift = document.querySelector(".present");
    gift_div.style.display = "none";
    gift.style.display = "block";
}

function OpenAppointmentBooking(button) {
    const appointment_book_div = document.getElementById("appointment-schedule");
    const book_button = button;
    appointment_book_div.style.display = "block";
}

function CloseAppointmentBooking() {
    const appointment_book_div = document.getElementById("appointment-schedule");
    appointment_book_div.style.display = "none";
}

if (window.location.href.includes("?appointment_submitted=true")) {
    OpenAppointmentSubmittedPopUp();
}

function OpenAppointmentSubmittedPopUp() {
    let appointment_submitted_popup = document.getElementById('appointment-submitted-confirmation');
    appointment_submitted_popup.classList.add('open-popup');
}

function RemoveAppointmentSubmittedPopUp() {
    window.location = '../appointments/appointments.php';
    let appointment_submitted_popup = document.getElementById('appointment-submitted-confirmation');
    appointment_submitted_popup.classList.remove('open-popup');
}

// trying calendar here
const date = new Date();
var newDate = new Date();
var currentDate;
var Month;
var Day;

const renderCalender = () => {
    date.setDate(1);
    const monthDays = document.querySelector('.days');
    var lastDay;
    if (date.getMonth() == 12) {
        lastDay = new Date(date.getFullYear() + 1, 1, 0).getDate();
    }
    else {
        lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    }
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();
    const firstDayIndex = date.getDay();
    var lastDayIndex;
    if (date.getMonth() == 12) {
        lastDayIndex = new Date(date.getFullYear() + 1, 1, 0).getDay();
    }
    else {
        lastDayIndex = new Date(date.getFullYear(), date.getMonth(), 0).getDay();
    }
    const nextDays = 7 - lastDayIndex - 1;
    const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.querySelector('.date h1').innerHTML = month[date.getMonth()];


    document.querySelector('.date p').innerHTML = new Date().toDateString();


    let days = "";

    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }
    for (let i = 1; i <= lastDay; i++) {
        if (i == new Date().getDate() && date.getMonth() == new Date().getMonth()) {
            days += `<div class="today" onclick="SetToCurrentDay(this)"> ${i} </div>`;
            newDate.setMonth((new Date().getMonth() + 1) % 13);
            newDate.setDate(new Date().getDate());

            if (newDate.getMonth() < 10) {
                Month = "0" + newDate.getMonth();
            }
            else {
                Month = newDate.getMonth();
            }
            if (newDate.getDate() < 10) {
                Day = "0" + newDate.getDate();
            }
            else {
                Day = newDate.getDate();
            }
            currentDate = newDate.getFullYear() + "-" + Month + "-" + Day;
            var hours = document.getElementsByName('appointments_time');
            for (let hour of hours) {
                if (localStorage.getItem(currentDate + " " + hour.value) != null) {
                    console.log(currentDate + " " + hour.value);
                    if (localStorage.getItem(currentDate + " " + hour.value) === 'true')
                        hour.setAttribute('disabled', 'true');
                    else
                        if (hour.getAttribute('disabled') != null)
                            hour.attributes.setNamedItem('disabled', '');
                }
                else {
                    hour.disabled = false;
                }
            }
        }
        if ((i < new Date().getDate() && date.getMonth() == new Date().getMonth()) || date.getMonth() < new Date().getMonth()) {
            days += `<div class="prev-date">${i}</div>`;
        }
        if (i > new Date().getDate() && date.getMonth() == new Date().getMonth() || date.getMonth() > new Date().getMonth()) {
            days += `<div class="otherdays" onclick="SetToCurrentDay(this)"> ${i} </div>`;
        }

    }
    for (let j = 1; j <= nextDays; j++) {
        days += `<div class="next-date">${j}</div>`;
        monthDays.innerHTML = days;
    }
}
function SetToCurrentDay(element) {
    const currentDay = document.querySelector('.today');
    const thisDay = element;
    if (currentDay != null) {
        currentDay.classList.remove('today');
        currentDay.classList.add('otherdays');
    }
    thisDay.classList.remove('otherdays');
    thisDay.classList.add('today');
    newDate.setMonth((date.getMonth() + 1) % 13);
    newDate.setDate(thisDay.innerHTML);
    // const array = newDate.toDateString().split(" ");
    // const day = array[2];
    // const month = array[1];
    // const year = array[3];
    if (newDate.getMonth() < 10) {
        Month = "0" + newDate.getMonth();
    }
    else {
        Month = newDate.getMonth();
    }
    if (newDate.getDate() < 10) {
        Day = "0" + newDate.getDate();
    }
    else {
        Day = newDate.getDate();
    }
    currentDate = newDate.getFullYear() + "-" + Month + "-" + Day;
    var hours = document.getElementsByName('appointments_time');
    for (let hour of hours) {
        if (localStorage.getItem(currentDate + " " + hour.value) != null) {
            hour.disabled = localStorage.getItem(currentDate + " " + hour.value);
        }
        else {
            hour.disabled = false;
        }
    }
    // console.log(day);
    // console.log(month);
    // console.log(year);
    // window.location="../calendar/calendar.php?getday=day&getmonth=month&getyear=year";
    document.querySelector('.date p').innerHTML = newDate.toDateString();
}

function SubmitAppointment() {
    var hours = document.getElementsByName('appointments_time');
    for (let hour of hours) {
        if (hour.checked) {
            localStorage.setItem(currentDate + " " + hour.value, "true");
            window.location = window.location.href + "&appointments_time=" + hour.value + "&date=" + currentDate;
        }
    }
}

document.querySelector('.prev').addEventListener('click', () => {
    date.setMonth(date.getMonth() - 1);
    renderCalender();
})

document.querySelector('.next').addEventListener('click', () => {
    date.setMonth(date.getMonth() + 1);
    renderCalender();
})
renderCalender();
