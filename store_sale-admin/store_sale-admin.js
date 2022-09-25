function OpenAddCheckout() {
    window.location.href = window.location.href + '?open_add_checkout=true';
}

if (window.location.href.includes('open_add_checkout=true')) {
    const gift_div = document.getElementById("id01");
    gift_div.style.display = "block";
}

if (window.location.href.includes('checkout-added=1')) {
    OpenCheckoutAddedPopUp();
}

function OpenCheckoutAddedPopUp() {
    const product_added_popup = document.getElementById('checkout-added-confirmation');
    product_added_popup.classList.add('open-popup');
}

function CloseCheckoutAddedPopUp() {
    const product_added_popup = document.getElementById('checkout-added-confirmation');
    product_added_popup.classList.remove('open-popup');
}

function CloseAddCheckout() {
    window.location.href = 'store_sale-admin.php';
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
// const asc_desc1 = document.getElementById("asc_desc");
// function asc_desc() {
//     if (asc_desc1.textContent == "Get In Descending") {
//         asc_desc1.innerHTML = "Get in ascending";
//         asc_desc1.style.backgroundColor = "red";
//         asc_desc1.style.color = "black";
//     } else if (asc_desc1.textContent == "Get in ascending") {
//         asc_desc1.innerHTML = "Get In Descending";
//         asc_desc1.style.backgroundColor = "royalblue";
//         asc_desc1.style.color = "white";
//     }
// }

// const table_sort = document.getElementById('table-sort');
// const filter_text = document.getElementById('filter-text');

// const product_name_column = document.getElementById('product-name-column');
// product_name_column.addEventListener('click', function SetSorting() {
//     var product_name_column_innerHTML = product_name_column.innerHTML;
//     if (product_name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
//         product_name_column.innerHTML = "Product Name <span class=\"las la-sort-up\"></span>";
//         sortTable(0, "desc");
//         table_sort.innerHTML = 'Product Name by descending order';
//         filter_text.innerHTML = 'Filter';
//         product_name_column.title = 'Sort Product Name by ascending';
//     }
//     if (product_name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
//         product_name_column.innerHTML = "Product Name <span class=\"las la-sort-down\"></span>";
//         sortTable(0, "asc");
//         table_sort.innerHTML = 'Product Name by ascending order';
//         filter_text.innerHTML = 'Filter';
//         product_name_column.title = 'Sort Product Name by descending';
//     }
//     if (product_name_column_innerHTML == "Product Name") {
//         product_name_column.innerHTML = "Product Name <span class=\"las la-sort-up\"></span>";
//         sortTable(0, "desc");
//         table_sort.innerHTML = 'Product Name by descending order';
//         filter_text.innerHTML = 'Filter';
//         product_name_column.title = 'Sort Product Name by ascending';
//     }
// });


// const product_price_column = document.getElementById('product-price-column');
// product_price_column.addEventListener('click', function SetSorting() {
//     var product_price_column_innerHTML = product_price_column.innerHTML;
//     if (product_price_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
//         product_price_column.innerHTML = "Price <span class=\"las la-sort-up\"></span>";
//         sortTable(1, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products of highest to lowest prices';
//         product_price_column.title = 'Sort Price by ascending';
//     }
//     if (product_price_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
//         product_price_column.innerHTML = "Price <span class=\"las la-sort-down\"></span>";
//         sortTable(1, "asc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products of lowest to highest prices';
//         product_price_column.title = 'Sort Price by descending';
//     }
//     if (product_price_column_innerHTML == "Price") {
//         product_price_column.innerHTML = "Price <span class=\"las la-sort-up\"></span>";
//         sortTable(1, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products of highest to lowest prices';
//         product_price_column.title = 'Sort Price by ascending';
//     }
// });

// const product_type_column = document.getElementById('product-type-column');
// product_type_column.addEventListener('click', function SetSorting() {
//     var product_type_column_innerHTML = product_type_column.innerHTML;
//     if (product_type_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
//         product_type_column.innerHTML = "Type <span class=\"las la-sort-up\"></span>";
//         sortTable(2, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Type by descending order';
//         product_type_column.title = 'Sort Type by ascending';
//     }
//     if (product_type_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
//         product_type_column.innerHTML = "Type <span class=\"las la-sort-down\"></span>";
//         sortTable(2, "asc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Type by ascending order';
//         product_type_column.title = 'Sort Type by descending';
//     }
//     if (product_type_column_innerHTML == "Type") {
//         product_type_column.innerHTML = "Type <span class=\"las la-sort-up\"></span>";
//         sortTable(2, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Type by descending order';
//         product_type_column.title = 'Sort Type by ascending';
//     }
// });


// const product_category_column = document.getElementById('product-category-column');
// product_category_column.addEventListener('click', function SetSorting() {
//     var product_category_column_innerHTML = product_category_column.innerHTML;
//     if (product_category_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
//         product_category_column.innerHTML = "Category <span class=\"las la-sort-up\"></span>";
//         sortTable(3, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Category by descending order';
//         product_category_column.title = 'Sort Category by ascending';
//     }
//     if (product_category_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
//         product_category_column.innerHTML = "Category <span class=\"las la-sort-down\"></span>";
//         sortTable(3, "asc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Category by ascending order';
//         product_category_column.title = 'Sort Category by descending';
//     }
//     if (product_category_column_innerHTML == "Category") {
//         product_category_column.innerHTML = "Category <span class=\"las la-sort-up\"></span>";
//         sortTable(3, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Category by descending order';
//         product_category_column.title = 'Sort Category by ascending';
//     }
// });

// const product_inventory_column = document.getElementById('product-inventory-column');
// product_inventory_column.addEventListener('click', function SetSorting() {
//     var product_inventory_column_innerHTML = product_inventory_column.innerHTML;
//     if (product_inventory_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
//         product_inventory_column.innerHTML = "Inventory <span class=\"las la-sort-up\"></span>";
//         sortTable(4, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products from most to least available in stock';
//         product_inventory_column.title = 'Sort Inventory by ascending';
//     }
//     if (product_inventory_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
//         product_inventory_column.innerHTML = "Inventory <span class=\"las la-sort-down\"></span>";
//         sortTable(4, "asc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products from least to most available in stock';
//         product_inventory_column.title = 'Sort Inventory by descending';
//     }
//     if (product_inventory_column_innerHTML == "Inventory") {
//         product_inventory_column.innerHTML = "Inventory <span class=\"las la-sort-up\"></span>";
//         sortTable(4, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products from most to least available in stock';
//         product_inventory_column.title = 'Sort Inventory by ascending';
//     }
// });


// const product_sales_column = document.getElementById('product-sales-column');
// product_sales_column.addEventListener('click', function SetSorting() {
//     var product_sales_column_innerHTML = product_sales_column.innerHTML;
//     if (product_sales_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
//         product_sales_column.innerHTML = "Sales Number <span class=\"las la-sort-up\"></span>";
//         sortTable(5, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products from most to least sold';
//         product_sales_column.title = 'Sort Sales Number by ascending';
//     }
//     if (product_sales_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
//         product_sales_column.innerHTML = "Sales Number <span class=\"las la-sort-down\"></span>";
//         sortTable(5, "asc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products from least to most sold';
//         product_sales_column.title = 'Sort Sales Number by descending';
//     }
//     if (product_sales_column_innerHTML == "Sales Number") {
//         product_sales_column.innerHTML = "Sales Number <span class=\"las la-sort-up\"></span>";
//         sortTable(5, "desc");
//         filter_text.innerHTML = 'Filter';
//         table_sort.innerHTML = 'Products from most to least sold';
//         product_sales_column.title = 'Sort Sales Number by ascending';
//     }
// });


// function sortTable(n, dir) {
//     var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
//     table = document.getElementById('products_table');
//     switching = true;
//     while (switching) {
//         switching = false;
//         rows = table.tBodies[0].rows;
//         for (i = 0; i < (rows.length - 1); i++) {
//             shouldSwitch = false;
//             if (n == 0) {
//                 x = rows[i].getElementsByTagName("td")[n].getElementsByTagName("a")[0];
//                 y = rows[i + 1].getElementsByTagName("td")[n].getElementsByTagName("a")[0];
//             }
//             else {
//                 x = rows[i].getElementsByTagName("td")[n];
//                 y = rows[i + 1].getElementsByTagName("td")[n];
//             }
//             if (dir == "asc") {
//                 if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
//                     shouldSwitch = true;
//                     break;
//                 }
//             }
//             else if (dir == "desc") {
//                 if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
//                     shouldSwitch = true;
//                     break;
//                 }
//             }
//         }
//         if (shouldSwitch) {
//             rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
//             switching = true;
//             switchcount++;
//         }
//         else {
//             if (switchcount == 0 && dir == "asc") {
//                 dir = "desc";
//                 switching = true;
//             }
//         }
//     }
// }

//sales table (form)
var survey_options = document.getElementById('survey_options');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');
var options = document.getElementById('products');
const clone=options.cloneNode(true);


add_more_fields.onclick = function () {
    var newField1 = document.createElement('input');
    var newField2 = document.createElement('input');
    var label1 = document.createElement('label');
    label1.setAttribute("for","products");
    label1.innerHTML="Choose a product";
    label1.appendChild(clone);
    label1.setAttribute('class', 'survey_options');
    label1.setAttribute('size', 50);
    survey_options.appendChild(label1);

    
    newField2.setAttribute('type', 'number');
    newField2.setAttribute('name', 'quantity[]');
    newField2.setAttribute('class', 'survey_options');
    newField2.setAttribute('size', 50);
    newField2.setAttribute('placeholder', 'quantity');
    newField2.required = "required";
    survey_options.appendChild(newField2);
}

remove_fields.onclick = function () {
    var input_tags = survey_options.getElementsByTagName('input');
    var label2=survey_options.getElementsByTagName('label');

    if (input_tags.length > 4 && label2.length>1) {
        survey_options.removeChild(input_tags[(input_tags.length) - 1]);
        survey_options.removeChild(label2[(label2.length) - 1]);

    }
}
