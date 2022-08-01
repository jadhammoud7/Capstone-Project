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



