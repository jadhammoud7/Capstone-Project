var repair_id;
var repair_type;

var remove_confirmation_text = document.getElementById('remove-confirmation-text');
function OpenRemoveRepairPopUp(RepairID, RepairType) {
    var remove_repair_popup = document.getElementById('remove-repair-confirmation');
    remove_repair_popup.classList.add('open-popup');
    repair_id = RepairID;
    repair_type = RepairType;
    remove_confirmation_text.innerHTML = 'Remove "' + repair_type + '" from repairs list?';
}

function CloseRemoveRepairPopUp() {
    var remove_repair_popup = document.getElementById('remove-repair-confirmation');
    remove_repair_popup.classList.remove('open-popup');
}

function DeleteRepair() {
    window.location.href = 'repairs_admin.php?getRepairIDtoRemove=' + repair_id;
    CloseRemoveRepairPopUp();
}


function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('repairs_table');
    switching = true;
    while (switching) {
        switching = false;
        rows = table.tBodies[0].rows;
        for (i = 0; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByTagName("td")[n];

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

const repair_type_column = document.getElementById('repair-type-column');
repair_type_column.addEventListener('click', function SetSorting() {
    var repair_type_column_innerHTML = repair_type_column.innerHTML;
    if (repair_type_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        repair_type_column.innerHTML = "Repair Type <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Repair Type by descending';
        repair_type_column.title = 'Sort Repair Type by ascending';
    }
    if (repair_type_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        repair_type_column.innerHTML = "Repair Type <span class=\"las la-sort-down\"></span>";
        sortTable(0, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Repair Type by ascending';
        repair_type_column.title = 'Sort Repair Type by descending';
    }
    if (repair_type_column_innerHTML == "Repair Type") {
        repair_type_column.innerHTML = "Repair Type <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Repair Type by descending';
        repair_type_column.title = 'Sort Repair Type by ascending';
    }
});

const price_per_hour_column = document.getElementById('price-per-hour-column');
price_per_hour_column.addEventListener('click', function SetSorting() {
    var price_per_hour_column_innerHTML = price_per_hour_column.innerHTML;
    if (price_per_hour_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        price_per_hour_column.innerHTML = "Price Per Hour <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Repairs From highest to lowest cost';
        price_per_hour_column.title = 'Sort Price Per Hour by ascending';
    }
    if (price_per_hour_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        price_per_hour_column.innerHTML = "Price Per Hour <span class=\"las la-sort-down\"></span>";
        sortTable(1, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Repairs From lowest to highest cost';
        price_per_hour_column.title = 'Sort Price Per Hour by descending';
    }
    if (price_per_hour_column_innerHTML == "Price Per Hour") {
        price_per_hour_column.innerHTML = "Price Per Hour <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Repairs From highest to lowest cost';
        price_per_hour_column.title = 'Sort Price Per Hour by ascending';
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

const address_column = document.getElementById('address-column');
address_column.addEventListener('click', function SetSorting() {
    var address_column_innerHTML = address_column.innerHTML;
    if (address_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        address_column.innerHTML = "Address <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Address by descending';
        address_column.title = 'Sort Address by ascending';
    }
    if (address_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        address_column.innerHTML = "Address <span class=\"las la-sort-down\"></span>";
        sortTable(5, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Address by ascending';
        address_column.title = 'Sort Address by descending';
    }
    if (address_column_innerHTML == "Address") {
        address_column.innerHTML = "Address <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Address by descending';
        address_column.title = 'Sort Address by ascending';
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
