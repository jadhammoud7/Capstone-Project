function OpenAddProduct() {
    window.location.href = window.location.href + '?open_add_product=true';
}

if (window.location.href.includes('open_add_product=true')) {
    const gift_div = document.getElementById("id01");
    gift_div.style.display = "block";
}

if (window.location.href.includes('product-added=1')) {
    OpenProductAddedPopUp();
}

function OpenProductAddedPopUp() {
    const product_added_popup = document.getElementById('product-added-confirmation');
    product_added_popup.classList.add('open-popup');
}

function CloseProductAddedPopUp() {
    const product_added_popup = document.getElementById('product-added-confirmation');
    product_added_popup.classList.remove('open-popup');
}

function CloseAddProduct() {
    window.location.href = 'product-admin.php';
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

// function DeleteAdmin(){
//     window.location.href = 'product-admin.php?getAdminIDtoRemove' + admin_id;
//     CloseRemoveAdminPopUp();
// }
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

const product_name_column = document.getElementById('product-name-column');
console.log(product_name_column.innerHTML);
product_name_column.addEventListener('click', function SetSorting() {
    var product_name_column_innerHTML = product_name_column.innerHTML;
    if (product_name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_name_column.innerHTML = "Product Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        product_name_column.title = 'Sort Product Name by ascending';
    }
    if (product_name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_name_column.innerHTML = "Product Name <span class=\"las la-sort-down\"></span>";
        sortTable(0, "asc");
        product_name_column.title = 'Sort Product Name by descending';
    }
    if (product_name_column_innerHTML == "Product Name") {
        product_name_column.innerHTML = "Product Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        product_name_column.title = 'Sort Product Name by ascending';
    }
});

function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('products_table');
    switching = true;
    while (switching) {
        switching = false;
        rows = table.tBodies[0].rows;
        console.log(rows);
        for (i = 0; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n].getElementsByTagName("a")[0];
            y = rows[i + 1].getElementsByTagName("td")[n].getElementsByTagName("a")[0];
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
