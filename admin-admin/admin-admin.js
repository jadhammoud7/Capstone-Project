function OpenAddUser() {
    window.location.href = window.location.href + '?open_add_user=true';
}

if (window.location.href.includes('open_add_user=true')) {
    const gift_div = document.getElementById("id01");
    gift_div.style.display = "block";
}

function CloseAddUser() {
    window.location.href = 'admin-admin.php';
    const gift_div = document.getElementById("id01");
    gift_div.style.display = "none";
}

var admin_id;
var first_name;
var last_name;

var remove_confirmation_text = document.getElementById('remove-confirmation-text');

function OpenRemoveAdminPopUp(AdminID, FirstName, LastName) {
    var remove_admin_popup = document.getElementById('remove-confirmation');
    remove_admin_popup.classList.add('open-popup');
    admin_id = AdminID;
    first_name = FirstName;
    last_name = LastName;
    remove_confirmation_text.innerHTML = 'Remove "' + first_name + ' ' + last_name + '" from admins list?';
}

function CloseRemoveAdminPopUp() {
    var remove_admin_popup = document.getElementById('remove-confirmation');
    remove_admin_popup.classList.remove('open-popup');
}

function DeleteAdmin() {
    window.location.href = '../admin-admin/admin-admin.php?getAdminIDtoRemove=' + admin_id;
    CloseRemoveAdminPopUp();
}

function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('admins_table');
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

const name_column = document.getElementById('name-column');
name_column.addEventListener('click', function SetSorting() {
    var name_column_innerHTML = name_column.innerHTML;
    if (name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        name_column.innerHTML = "Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Name by descending';
        name_column.title = 'Sort Name by ascending';
    }
    if (name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        name_column.innerHTML = "Name <span class=\"las la-sort-down\"></span>";
        sortTable(0, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Name by ascending';
        name_column.title = 'Sort Name by descending';
    }
    if (name_column_innerHTML == "Name") {
        name_column.innerHTML = "Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Name by descending';
        name_column.title = 'Sort Name by ascending';
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
        email_column.innerHTML = "Email Address <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Email Address by descending';
        email_column.title = 'Sort Email Address by ascending';
    }
    if (email_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        email_column.innerHTML = "Email Address <span class=\"las la-sort-down\"></span>";
        sortTable(2, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Email Address by ascending';
        email_column.title = 'Sort Email Address by descending';
    }
    if (email_column_innerHTML == "Email Address") {
        email_column.innerHTML = "Email Address <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Email Address by descending';
        email_column.title = 'Sort Email Address by ascending';
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