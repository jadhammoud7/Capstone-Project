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

if (window.location.href.includes('checkout-error')) {
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

const table_sort = document.getElementById('table-sort');
const filter_text = document.getElementById('filter-text');

const customer_name_column = document.getElementById('customer-name-column');
customer_name_column.addEventListener('click', function SetSorting() {
    var customer_name_column_innerHTML = customer_name_column.innerHTML;
    if (customer_name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by descending order';
        customer_name_column.title = 'Sort Customer Name by ascending';
    }
    if (customer_name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-down\"></span>";
        sortTable(0, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by ascending order';
        customer_name_column.title = 'Sort Customer Name by descending';
    }
    if (customer_name_column_innerHTML == "Customer Name") {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by descending order';
        customer_name_column.title = 'Sort Customer Name by ascending';
    }
});

const email_column = document.getElementById('email-column');
email_column.addEventListener('click', function SetSorting() {
    var email_column_innerHTML = email_column.innerHTML;
    if (email_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        email_column.innerHTML = "Email <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Email by descending order';
        email_column.title = 'Sort Email by ascending';
    }
    if (email_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        email_column.innerHTML = "Email <span class=\"las la-sort-down\"></span>";
        sortTable(1, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort = 'Email by ascending order';
        email_column.title = 'Sort Email by descending';
    }
    if (email_column_innerHTML == "Email") {
        email_column.innerHTML = "Email <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Email by descending order';
        email_column.title = 'Sort Email by ascending';
    }
});


const phone_number_column = document.getElementById('phone-number-column');
phone_number_column.addEventListener('click', function SetSorting() {
    var phone_number_column_innerHTML = phone_number_column.innerHTML;
    if (phone_number_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        phone_number_column.innerHTML = "Phone Number <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Phone Number by descending order';
        phone_number_column.title = 'Sort Phone Number by ascending';
    }
    if (phone_number_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        phone_number_column.innerHTML = "Phone Number <span class=\"las la-sort-down\"></span>";
        sortTable(2, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Phone Number by ascending order';
        phone_number_column.title = 'Sort Phone Number by descending';
    }
    if (phone_number_column_innerHTML == "Phone Number") {
        phone_number_column.innerHTML = "Phone Number <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Phone Number by descending order';
        phone_number_column.title = 'Sort Phone Number by ascending';
    }
});

const total_price_column = document.getElementById('total-price-column');
total_price_column.addEventListener('click', function SetSorting() {
    var total_price_column_innerHTML = total_price_column.innerHTML;
    if (total_price_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        total_price_column.innerHTML = "Total Price <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from highest to lowest total price';
        total_price_column.title = 'Sort Total Price by ascending';
    }
    if (total_price_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        total_price_column.innerHTML = "Total Price <span class=\"las la-sort-down\"></span>";
        sortTable(3, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from lowest to highest total price';
        total_price_column.title = 'Sort Total Price by descending';
    }
    if (total_price_column_innerHTML == "Total Price") {
        total_price_column.innerHTML = "Total Price <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from highest to lowest total price';
        total_price_column.title = 'Sort Total Price by ascending';
    }
});

const total_price_inc_tax_column = document.getElementById('total-price-inc-tax-column');
total_price_inc_tax_column.addEventListener('click', function SetSorting() {
    var total_price_inc_tax_column_innerHTML = total_price_inc_tax_column.innerHTML;
    if (total_price_inc_tax_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        total_price_inc_tax_column.innerHTML = "Total Price Inc. Tax <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from highest to lowest total price including tax';
        total_price_inc_tax_column.title = 'Sort Total Price Inc. Tax by ascending';
    }
    if (total_price_inc_tax_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        total_price_inc_tax_column.innerHTML = "Total Price Inc. Tax <span class=\"las la-sort-down\"></span>";
        sortTable(4, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from lowest to highest total price including tax';
        total_price_inc_tax_column.title = 'Sort Total Price by descending';
    }
    if (total_price_inc_tax_column_innerHTML == "Total Price Inc. Tax") {
        total_price_inc_tax_column.innerHTML = "Total Price Inc. Tax <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from highest to lowest total price including tax';
        total_price_inc_tax_column.title = 'Sort Total Price Inc. Tax by ascending';
    }
});

const checkout_date_column = document.getElementById('checkout-date-column');
checkout_date_column.addEventListener('click', function SetSorting() {
    var checkout_date_column_innerHTML = checkout_date_column.innerHTML;
    if (checkout_date_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        checkout_date_column.innerHTML = "Date <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from newest to oldest';
        checkout_date_column.title = 'Sort Date by ascending';
    }
    if (checkout_date_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        checkout_date_column.innerHTML = "Date <span class=\"las la-sort-down\"></span>";
        sortTable(5, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from oldest to newest';
        checkout_date_column.title = 'Sort Date by descending';
    }
    if (checkout_date_column_innerHTML == "Date") {
        checkout_date_column.innerHTML = "Date <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts from newest to oldest';
        checkout_date_column.title = 'Sort Date by ascending';
    }
});


const status_column = document.getElementById('status-column');
status_column.addEventListener('click', function SetSorting() {
    var status_column_innerHTML = status_column.innerHTML;
    if (status_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        status_column.innerHTML = "Status <span class=\"las la-sort-up\"></span>";
        sortTable(6, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts with Status from done to pending';
        status_column.title = 'Sort Status by ascending';
    }
    if (status_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        status_column.innerHTML = "Status <span class=\"las la-sort-down\"></span>";
        sortTable(6, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts with Status from pending to done';
        status_column.title = 'Sort Status by descending';
    }
    if (status_column_innerHTML == "Status") {
        status_column.innerHTML = "Status <span class=\"las la-sort-up\"></span>";
        sortTable(6, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Checkouts with Status from done to pending';
        status_column.title = 'Sort Status by ascending';
    }
});

function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('checkouts_table');
    switching = true;
    while (switching) {
        switching = false;
        rows = table.tBodies[0].rows;
        for (i = 0; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            if (n == 6) {
                x = rows[i].getElementsByTagName("td")[n].getElementsByTagName("a")[0];
                y = rows[i + 1].getElementsByTagName("td")[n].getElementsByTagName("a")[0];
            }
            else {
                x = rows[i].getElementsByTagName("td")[n];
                y = rows[i + 1].getElementsByTagName("td")[n];
            }
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }

            }
            else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
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

