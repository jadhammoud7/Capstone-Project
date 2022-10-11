var customer_id;
var first_name;
var last_name;

var remove_confirmation_text = document.getElementById('remove-confirmation-text');
function OpenRemoveCustomerPopUp(CustomerID, FirstName, LastName) {
    var remove_customer_popup = document.getElementById('remove-confirmation');
    remove_customer_popup.classList.add('open-popup');
    customer_id = CustomerID;
    first_name = FirstName;
    last_name = LastName;
    remove_confirmation_text.innerHTML = 'Remove "' + first_name + ' ' + last_name + '" from customers list?';
}

function CloseRemoveCustomerPopUp() {
    var remove_customer_popup = document.getElementById('remove-confirmation');
    remove_customer_popup.classList.remove('open-popup');
}

function DeleteCustomer() {
    window.location.href = 'customer-admin.php?getCustomerIDtoRemove=' + customer_id;
    CloseRemoveCustomerPopUp();
}


function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('customers_table');
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

const table_sort = document.getElementById('table-sort');
const filter_text = document.getElementById('filter-text');

const customer_name_column = document.getElementById('customer-name-column');
customer_name_column.addEventListener('click', function SetSorting() {
    var customer_name_column_innerHTML = customer_name_column.innerHTML;
    if (customer_name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by descending';
        customer_name_column.title = 'Sort Customer Name by ascending';
    }
    if (customer_name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-down\"></span>";
        sortTable(0, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by ascending';
        customer_name_column.title = 'Sort Customer Name by descending';
    }
    if (customer_name_column_innerHTML == "Customer Name") {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by descending';
        customer_name_column.title = 'Sort Customer Name by ascending';
    }
});

const username_column = document.getElementById('username-column');
username_column.addEventListener('click', function SetSorting() {
    var username_column_innerHTML = username_column.innerHTML;
    if (username_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        username_column.innerHTML = "Username <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Username by descending';
        username_column.title = 'Sort Username by ascending';
    }
    if (username_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        username_column.innerHTML = "Username <span class=\"las la-sort-down\"></span>";
        sortTable(1, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Username by ascending';
        username_column.title = 'Sort Username by descending';
    }
    if (username_column_innerHTML == "Username") {
        username_column.innerHTML = "Username <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Username by descending';
        username_column.title = 'Sort Username by ascending';
    }
});



const email_column = document.getElementById('email-column');
email_column.addEventListener('click', function SetSorting() {
    var email_column_innerHTML = email_column.innerHTML;
    if (email_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        email_column.innerHTML = "Email <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Email by descending';
        email_column.title = 'Sort Email by ascending';
    }
    if (email_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        email_column.innerHTML = "Email <span class=\"las la-sort-down\"></span>";
        sortTable(2, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Email by ascending';
        email_column.title = 'Sort Email by descending';
    }
    if (email_column_innerHTML == "Email") {
        email_column.innerHTML = "Email <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Email by descending';
        email_column.title = 'Sort Email by ascending';
    }
});

const phone_number_column = document.getElementById('phone-number-column');
phone_number_column.addEventListener('click', function SetSorting() {
    var phone_number_column_innerHTML = phone_number_column.innerHTML;
    if (phone_number_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        phone_number_column.innerHTML = "Phone Number <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Phone Number by descending';
        phone_number_column.title = 'Sort Phone Number by ascending';
    }
    if (phone_number_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        phone_number_column.innerHTML = "Phone Number <span class=\"las la-sort-down\"></span>";
        sortTable(3, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Phone Number by ascending';
        phone_number_column.title = 'Sort Phone Number by descending';
    }
    if (phone_number_column_innerHTML == "Phone Number") {
        phone_number_column.innerHTML = "Phone Number <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Phone Number by descending';
        phone_number_column.title = 'Sort Phone Number by ascending';
    }
});


const city_column = document.getElementById('city-column');
city_column.addEventListener('click', function SetSorting() {
    var city_column_innerHTML = city_column.innerHTML;
    if (city_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        city_column.innerHTML = "City <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'City by descending';
        city_column.title = 'Sort City by ascending';
    }
    if (city_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        city_column.innerHTML = "City <span class=\"las la-sort-down\"></span>";
        sortTable(4, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'City by ascending';
        city_column.title = 'Sort City by descending';
    }
    if (city_column_innerHTML == "City") {
        city_column.innerHTML = "City <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'City by descending';
        city_column.title = 'Sort City by ascending';
    }
});

const loyalty_points_column = document.getElementById('loyalty-points-column');
loyalty_points_column.addEventListener('click', function SetSorting() {
    var loyalty_points_column_innerHTML = loyalty_points_column.innerHTML;
    if (loyalty_points_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        loyalty_points_column.innerHTML = "Loyalty Points <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customers by most to least loyal';
        loyalty_points_column.title = 'Sort Loyalty Points by ascending';
    }
    if (loyalty_points_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        loyalty_points_column.innerHTML = "Loyalty Points <span class=\"las la-sort-down\"></span>";
        sortTable(5, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customers by least to most loyal';
        loyalty_points_column.title = 'Sort Loyalty Points by descending';
    }
    if (loyalty_points_column_innerHTML == "Loyalty Points") {
        loyalty_points_column.innerHTML = "Loyalty Points <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customers by most to least loyal';
        loyalty_points_column.title = 'Sort Loyalty Points by ascending';
    }
});

const date_of_birth_column = document.getElementById('date-of-birth-column');
date_of_birth_column.addEventListener('click', function SetSorting() {
    var date_of_birth_column_innerHTML = date_of_birth_column.innerHTML;
    if (date_of_birth_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        date_of_birth_column.innerHTML = "Date of Birth <span class=\"las la-sort-up\"></span>";
        sortTable(6, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Date of Birth by descending';
        date_of_birth_column.title = 'Sort Date of Birth by ascending';
    }
    if (date_of_birth_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        date_of_birth_column.innerHTML = "Date of Birth <span class=\"las la-sort-down\"></span>";
        sortTable(6, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Date of Birth by ascending';
        date_of_birth_column.title = 'Sort Date of Birth by descending';
    }
    if (date_of_birth_column_innerHTML == "Date of Birth") {
        date_of_birth_column.innerHTML = "Date of Birth <span class=\"las la-sort-up\"></span>";
        sortTable(6, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Date of Birth by descending';
        date_of_birth_column.title = 'Sort Date of Birth by ascending';
    }
});
