let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 4000); // Change image every 4 seconds
}

const slideshow = document.querySelector(".slideshow-container");
const feature = document.querySelector(".feature-part");

const about_us = document.querySelector(".about-us");
const contact_us = document.querySelector(".contact-us");
const testimonials = document.querySelector(".test-back");
const appointments_paragraph = document.querySelector(".appointments");

function AddRevealX() {
    var windowHeight = window.innerHeight;
    var elementTopAbout = about_us.getBoundingClientRect().top;
    var elementTopContact = contact_us.getBoundingClientRect().top;
    var elementTopTestimonials = testimonials.getBoundingClientRect().top;
    var elementTopAppointments = appointments_paragraph.getBoundingClientRect().top;
    var elementVisible = -200;
    if (elementTopAbout < windowHeight - elementVisible) {
        about_us.classList.add("reveal-by-x");
        about_us.classList.add("fade");
    }
    if (elementTopContact < windowHeight - elementVisible) {
        contact_us.classList.add("reveal-by-x2");
        contact_us.classList.add("fade");
    }
    if (elementTopTestimonials < windowHeight - elementVisible) {
        testimonials.classList.add("reveal-by-x");
        testimonials.classList.add("fade");
    }
    if (elementTopAppointments < windowHeight - elementVisible) {
        appointments_paragraph.classList.add("reveal-by-x");
        appointments_paragraph.classList.add("fade");
    }
}

if (window.location.href.includes("?login=true")) {
    OpenLogInPopUp();
}

function OpenLogInPopUp() {
    let login_popup = document.getElementById('login-confirmation');
    login_popup.classList.add('open-popup');
}

function RemoveLogInPopUp() {
    window.location = '../home-page/home-page.php';
    let login_popup = document.getElementById('login-confirmation');
    login_popup.classList.remove('open-popup');
}

window.addEventListener("scroll", AddRevealX);
window.addEventListener("pageshow", AddRevealX);

//js of table asc and desc

const asc_desc1 = document.getElementById("asc_desc");
function asc_desc() {
    if (asc_desc1.textContent == "Get In Descending") {
        asc_desc1.innerHTML = "Get in ascending";
        asc_desc1.style.backgroundColor = "red";
        asc_desc1.style.color = "black";
    } else if (asc_desc1.textContent == "Get in ascending") {
        asc_desc1.innerHTML = "Get In Descending";
        asc_desc1.style.backgroundColor = "royalblue";
        asc_desc1.style.color = "white";
    }
}


const product_inventory_column = document.getElementById('product-inventory-column');
product_inventory_column.addEventListener('click', function SetSorting() {
    var product_inventory_column_innerHTML = product_inventory_column.innerHTML;
    if (product_inventory_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_inventory_column.innerHTML = "Inventory <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        product_inventory_column.title = 'Sort Inventory by ascending';
    }
    if (product_inventory_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_inventory_column.innerHTML = "Inventory <span class=\"las la-sort-down\"></span>";
        sortTable(4, "asc");
        product_inventory_column.title = 'Sort Inventory by descending';
    }
    if (product_inventory_column_innerHTML == "Inventory") {
        product_inventory_column.innerHTML = "Inventory <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        product_inventory_column.title = 'Sort Inventory by ascending';
    }
});


const product_sales_column = document.getElementById('product-sales-column');
product_sales_column.addEventListener('click', function SetSorting() {
    var product_sales_column_innerHTML = product_sales_column.innerHTML;
    if (product_sales_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_sales_column.innerHTML = "Sales Number <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        product_sales_column.title = 'Sort Sales Number by ascending';
    }
    if (product_sales_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_sales_column.innerHTML = "Sales Number <span class=\"las la-sort-down\"></span>";
        sortTable(5, "asc");
        product_sales_column.title = 'Sort Sales Number by descending';
    }
    if (product_sales_column_innerHTML == "Sales Number") {
        product_sales_column.innerHTML = "Sales Number <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        product_sales_column.title = 'Sort Sales Number by ascending';
    }
});


function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('products_table');
    switching = true;
    while (switching) {
        switching = false;
        rows = table.tBodies[0].rows;
        for (i = 0; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            if (n == 0) {
                x = rows[i].getElementsByTagName("td")[n].getElementsByTagName("a")[0];
                y = rows[i + 1].getElementsByTagName("td")[n].getElementsByTagName("a")[0];
            }
            else {
                x = rows[i].getElementsByTagName("td")[n];
                y = rows[i + 1].getElementsByTagName("td")[n];
            }
            if (dir == "asc") {
                if (!isNaN(x) && !isNaN(y)) {
                    if (x > y) {
                        shouldSwitch = true;
                        break;
                    }
                }
                else {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            else if (dir == "desc") {
                if (!isNaN(x) && !isNaN(y)) {
                    if (x < y) {
                        shouldSwitch = true;
                        break;
                    }
                }
                else {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        }
        else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}








