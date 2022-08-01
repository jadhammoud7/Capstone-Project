const inputs = document.querySelectorAll("input");

inputs.forEach((input) => {
    input.addEventListener("blur", (event) => {
        if (event.target.value) {
            input.classList.add("is-valid");
        } else {
            input.classList.remove("is-valid");
        }
    });
});

const billing_details = document.querySelector(".billing-details");
const order_summary = document.querySelector(".order-summary");
const payment = document.querySelector(".payment");
const checkout_buttons = document.querySelector(".checkout-buttons");

function AddRevealX() {
    var windowHeight = window.innerHeight;
    var elementTopBillingDetails = billing_details.getBoundingClientRect().top;
    var elementTopOrderSummary = order_summary.getBoundingClientRect().top;
    var elementTopPayment = payment.getBoundingClientRect().top;
    var elementTopCheckoutButtons = checkout_buttons.getBoundingClientRect().top;
    var elementVisible = -200;
    if (elementTopBillingDetails < windowHeight - elementVisible) {
        billing_details.classList.add("reveal-by-x");
        billing_details.classList.add("fade");
    }
    if (elementTopOrderSummary < windowHeight - elementVisible) {
        order_summary.classList.add("reveal-by-x2");
        order_summary.classList.add("fade");
    }
    if (elementTopPayment < windowHeight - elementVisible) {
        payment.classList.add("reveal-by-x");
        payment.classList.add("fade");
    }
    if (elementTopCheckoutButtons < windowHeight - elementVisible) {
        checkout_buttons.classList.add("reveal-by-x");
        checkout_buttons.classList.add("fade");
    }
}

window.addEventListener("scroll", AddRevealX);
window.addEventListener("pageshow", AddRevealX);





// trying calendar here
const date = new Date();

const renderCalender = () => {
    const monthDays = document.querySelector('.days');
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();
    const firstDayIndex = date.getDay();
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();
    const nextDays = 7 - lastDayIndex - 1;
    const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.querySelector('.date h1').innerHTML = month[date.getMonth()];


    document.querySelector('.date p').innerHTML = new Date().toDateString();


    let days = "";

    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }
    for (let i = 1; i <= lastDay; i++) {
        if (i === new Date().getDate() && date.getMonth() === new Date().getMonth()) {
            days += `<div class="today"> ${i} </div>`;
        } else {
            days += `<div class="otherdays" onclick="GetDay()"> ${i} </div>`;
        }

    }
    for (let j = 1; j <= nextDays; j++) {
        days += `<div class="next-date">${j}</div>`;
        monthDays.innerHTML = days;
    }

}

// document.querySelectorAll(".days").forEach(day => {
//     day.addEventListener("click", event => {
//         console.log(event.currentTarget);
//     })
// });

function GetDay(){
    console.log(document.querySelector('.date p').innerHTML);
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

