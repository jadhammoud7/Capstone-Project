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
    window.location.href = 'repairs-admin.php?getRepairIDtoRemove=' + repair_id;
    CloseRemoveRepairPopUp();
}

function OpenAddRepair() {
    window.location.href = window.location.href + '?open_add_repair=true';
}

if (window.location.href.includes('open_add_repair=true')) {
    const repair_form = document.getElementById('new_repair_form');
    repair_form.style.display = "block";
}

if (window.location.href.includes('repair-added=1')) {
    OpenRepairAddedPopUp();
}

function OpenRepairAddedPopUp() {
    const repair_added_popup = document.getElementById('repair-added-confirmation');
    repair_added_popup.classList.add('open-popup');
}

function CloseRepairAddedPopUp() {
    const repair_added_popup = document.getElementById('repair-added-confirmation');
    repair_added_popup.classList.remove('open-popup');
    window.location.href = 'repairs-admin.php';
}

function CloseAddRepair() {
    window.location.href = 'repairs-admin.php';
    const repair_form = document.getElementById("new_repair_form");
    repair_form.style.display = "none";
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

function FilterTable() {
    var input, filter, table, td, i, j, textValue;
    input = document.getElementById("SearchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("repairs_table");

    var tr = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (i = 0; i < tr.length; i++) {
        var td = [];
        var display = 'none';
        for (j = 0; j < tr[i].getElementsByTagName("td").length - 2; j++) {
            td[j] = tr[i].getElementsByTagName("td")[j];
            textValue = td[j].textContent;
            if (textValue.toUpperCase().indexOf(filter) > -1) {
                display = '';
            }
        }
        tr[i].style.display = display;
    }
}