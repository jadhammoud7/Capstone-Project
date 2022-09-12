//open logout popup
function OpenLogOutPopUp() {
    let logout_popup = document.getElementById('logout-confirmation');
    logout_popup.classList.add('open-popup');
}

//close logout popup
function CloseLogOutPopUp() {
    let logout_popup = document.getElementById('logout-confirmation');
    logout_popup.classList.remove('open-popup');
}

//go to login
function GoToLogIn() {
    window.location.href = '../php/logout.php';
    CloseLogOutPopUp();
}

var topButton = document.getElementById("TopBtn");

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topButton.style.display = "block";
    }
    else {
        topButton.style.display = "none";
    }
}

function ReturnToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

const dashboard_link = document.getElementById('dashboard-link');
const customers_link = document.getElementById('customers-link');
const appointments_link = document.getElementById('appointments-link');
const checkouts_link = document.getElementById('checkouts-link');
const products_link = document.getElementById('products-link');
const admins_link = document.getElementById('admins-link');

if (window.location.href.includes('home-admin')) {
    dashboard_link.style.backgroundColor = '#fff';
    dashboard_link.style.color = 'var(--main-color)';
    dashboard_link.style.borderRadius = '20px';
    dashboard_link.style.paddingTop = '10px';
    dashboard_link.style.paddingBottom = '10px';
}
else {
    dashboard_link.style.backgroundColor = 'var(--main-color)';
    dashboard_link.style.color = '#fff';
    dashboard_link.style.borderRadius = '0px';
    dashboard_link.style.paddingTop = '0px';
    dashboard_link.style.paddingBottom = '0px';
}


if (window.location.href.includes('customer-admin')) {
    customers_link.style.backgroundColor = '#fff';
    customers_link.style.color = 'var(--main-color)';
    customers_link.style.borderRadius = '20px';
    customers_link.style.paddingTop = '10px';
    customers_link.style.paddingBottom = '10px';
}
else {
    customers_link.style.backgroundColor = 'var(--main-color)';
    customers_link.style.color = '#fff';
    customers_link.style.borderRadius = '0px';
    customers_link.style.paddingTop = '0px';
    customers_link.style.paddingBottom = '0px';
}

if (window.location.href.includes('admin-admin')) {
    admins_link.style.backgroundColor = '#fff';
    admins_link.style.color = 'var(--main-color)';
    admins_link.style.borderRadius = '20px';
    admins_link.style.paddingTop = '10px';
    admins_link.style.paddingBottom = '10px';
}
else {
    admins_link.style.backgroundColor = 'var(--main-color)';
    admins_link.style.color = '#fff';
    admins_link.style.borderRadius = '0px';
    admins_link.style.paddingTop = '0px';
    admins_link.style.paddingBottom = '0px';
}

