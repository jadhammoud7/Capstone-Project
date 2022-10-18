
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

function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('appointments_table');
    switching = true;
    while (switching) {
        switching = false;
        rows = table.tBodies[0].rows;
        for (i = 0; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            if (n == 4) {
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

const appointment_name_column = document.getElementById('appointment-name-column');
appointment_name_column.addEventListener('click', function SetSorting() {
    var appointment_name_column_innerHTML = appointment_name_column.innerHTML;
    if (appointment_name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        appointment_name_column.innerHTML = "Appointment Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointment Name by descending';
        appointment_name_column.title = 'Sort Appointment Name by ascending';
    }
    if (appointment_name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        appointment_name_column.innerHTML = "Appointment Name <span class=\"las la-sort-down\"></span>";
        sortTable(0, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointment Name by ascending';
        appointment_name_column.title = 'Sort Appointment Name by descending';
    }
    if (appointment_name_column_innerHTML == "Appointment Name") {
        appointment_name_column.innerHTML = "Appointment Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointment Name by descending';
        appointment_name_column.title = 'Sort Appointment Name by ascending';
    }
});

const customer_name_column = document.getElementById('customer-name-column');
customer_name_column.addEventListener('click', function SetSorting() {
    var customer_name_column_innerHTML = customer_name_column.innerHTML;
    if (customer_name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by descending';
        customer_name_column.title = 'Sort Customer Name by ascending';
    }
    if (customer_name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-down\"></span>";
        sortTable(1, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by ascending';
        customer_name_column.title = 'Sort Customer Name by descending';
    }
    if (customer_name_column_innerHTML == "Customer Name") {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Customer Name by descending';
        customer_name_column.title = 'Sort Customer Name by ascending';
    }
});

const price_per_hour_column = document.getElementById('price-per-hour-column');
price_per_hour_column.addEventListener('click', function SetSorting() {
    var price_per_hour_column_innerHTML = price_per_hour_column.innerHTML;
    if (price_per_hour_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        price_per_hour_column.innerHTML = "Price Per Hour <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments From highest to lowest price per hour';
        price_per_hour_column.title = 'Sort Price Per Hour by ascending';
    }
    if (price_per_hour_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        price_per_hour_column.innerHTML = "Price Per Hour <span class=\"las la-sort-down\"></span>";
        sortTable(2, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments From lowest to highest price per hour';
        price_per_hour_column.title = 'Sort Price Per Hour by descending';
    }
    if (price_per_hour_column_innerHTML == "Price Per Hour") {
        price_per_hour_column.innerHTML = "Price Per Hour <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments From highest to lowest price per hour';
        price_per_hour_column.title = 'Sort Price Per Hour by ascending';
    }
});


const date_column = document.getElementById('date-column');
date_column.addEventListener('click', function SetSorting() {
    var date_column_innerHTML = date_column.innerHTML;
    if (date_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        date_column.innerHTML = "Date <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments from newest to oldest';
        date_column.title = 'Sort Date by ascending';
    }
    if (date_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        date_column.innerHTML = "Date <span class=\"las la-sort-down\"></span>";
        sortTable(3, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments from oldest to newest';
        date_column.title = 'Sort Date by descending';
    }
    if (date_column_innerHTML == "Date") {
        date_column.innerHTML = "Date <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments from newest to oldest';
        date_column.title = 'Sort Date by ascending';
    }
});

const status_column = document.getElementById('status-column');
status_column.addEventListener('click', function SetSorting() {
    var status_column_innerHTML = status_column.innerHTML;
    if (status_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        status_column.innerHTML = "Status <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments Status from pending to done';
        status_column.title = 'Sort Status by ascending';
    }
    if (status_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        status_column.innerHTML = "Status <span class=\"las la-sort-down\"></span>";
        sortTable(5, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments Status from done to pending';
        status_column.title = 'Sort Status by descending';
    }
    if (status_column_innerHTML == "Status") {
        status_column.innerHTML = "Hour <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Appointments Status from pending to done';
        status_column.title = 'Sort Hour by ascending';
    }
});

function FilterTable() {
    var input, filter, table, td, i, j, textValue;
    input = document.getElementById("SearchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("appointments_table");

    var tr = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (i = 0; i < tr.length; i++) {
        var td = [];
        var display = 'none';
        for (j = 0; j < tr[i].getElementsByTagName("td").length - 1; j++) {
            if (j == 0 || j == 1 || j == 5) {
                td[j] = tr[i].getElementsByTagName("td")[j].getElementsByTagName("a")[0];
                textValue = td[j].textContent;
            }
            else {
                td[j] = tr[i].getElementsByTagName("td")[j];
                textValue = td[j].textContent;
            }
            if (textValue.toUpperCase().indexOf(filter) > -1) {
                display = '';
            }
        }
        tr[i].style.display = display;
    }
}