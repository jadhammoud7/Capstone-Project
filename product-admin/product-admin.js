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


const product_price_column = document.getElementById('product-price-column');
product_price_column.addEventListener('click', function SetSorting() {
    var product_price_column_innerHTML = product_price_column.innerHTML;
    if (product_price_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_price_column.innerHTML = "Price <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        product_price_column.title = 'Sort Price by ascending';
    }
    if (product_price_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_price_column.innerHTML = "Price <span class=\"las la-sort-down\"></span>";
        sortTable(1, "asc");
        product_price_column.title = 'Sort Price by descending';
    }
    if (product_price_column_innerHTML == "Price") {
        product_price_column.innerHTML = "Price <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        product_price_column.title = 'Sort Price by ascending';
    }
});

const product_type_column = document.getElementById('product-type-column');
product_type_column.addEventListener('click', function SetSorting() {
    var product_type_column_innerHTML = product_type_column.innerHTML;
    if (product_type_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_type_column.innerHTML = "Type <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        product_type_column.title = 'Sort Type by ascending';
    }
    if (product_type_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_type_column.innerHTML = "Type <span class=\"las la-sort-down\"></span>";
        sortTable(2, "asc");
        product_type_column.title = 'Sort Type by descending';
    }
    if (product_type_column_innerHTML == "Type") {
        product_type_column.innerHTML = "Type <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        product_type_column.title = 'Sort Type by ascending';
    }
});


const product_category_column = document.getElementById('product-category-column');
product_category_column.addEventListener('click', function SetSorting() {
    var product_category_column_innerHTML = product_category_column.innerHTML;
    if (product_category_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_category_column.innerHTML = "Category <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        product_category_column.title = 'Sort Category by ascending';
    }
    if (product_category_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_category_column.innerHTML = "Category <span class=\"las la-sort-down\"></span>";
        sortTable(3, "asc");
        product_category_column.title = 'Sort Category by descending';
    }
    if (product_category_column_innerHTML == "Category") {
        product_category_column.innerHTML = "Category <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        product_category_column.title = 'Sort Category by ascending';
    }
});

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
