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

const table_sort = document.getElementById('table-sort');
const filter_text = document.getElementById('filter-text');

const customer_name_column = document.getElementById('customer-name-column');
customer_name_column.addEventListener('click', function SetSorting() {
    var customer_name_column_innerHTML = customer_name_column.innerHTML;
    if (customer_name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        table_sort.innerHTML = 'Customer Name by descending order';
        filter_text.innerHTML = 'Filter';
        customer_name_column.title = 'Sort Customer Name by ascending';
    }
    if (customer_name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-down\"></span>";
        sortTable(0, "asc");
        table_sort.innerHTML = 'Customer Name by ascending order';
        filter_text.innerHTML = 'Filter';
        customer_name_column.title = 'Sort Customer Name by descending';
    }
    if (customer_name_column_innerHTML == "Customer Name") {
        customer_name_column.innerHTML = "Customer Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        table_sort.innerHTML = 'Customer Name by descending order';
        filter_text.innerHTML = 'Filter';
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
        table_sort.innerHTML = 'Email by ascending order';
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

const total_products_column = document.getElementById('total-products-column');
total_products_column.addEventListener('click', function SetSorting() {
    var total_products_column_innerHTML = total_products_column.innerHTML;
    if (total_products_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        total_products_column.innerHTML = "Total Products <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from most to least products containing';
        total_products_column.title = 'Sort Store Sales from least to most products containing';
    }
    if (total_products_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        total_products_column.innerHTML = "Total Products <span class=\"las la-sort-down\"></span>";
        sortTable(2, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from least to most products containing';
        total_products_column.title = 'Sort Store Sales from most to least products containing';
    }
    if (total_products_column_innerHTML == "Total Products") {
        total_products_column.innerHTML = "Total Products <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from most to least products containing';
        total_products_column.title = 'Sort Store Sales from least to most products containing';
    }
});


const total_quantity_column = document.getElementById('total-quantity-column');
total_quantity_column.addEventListener('click', function SetSorting() {
    var total_quantity_column_innerHTML = total_quantity_column.innerHTML;
    if (total_quantity_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        total_quantity_column.innerHTML = "Total Quantity <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from most to least quantities containing';
        total_quantity_column.title = 'Sort Store Sales from least to most quantities containing';
    }
    if (total_quantity_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        total_quantity_column.innerHTML = "Total Quantity <span class=\"las la-sort-down\"></span>";
        sortTable(3, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from least to most quantities containing';
        total_quantity_column.title = 'Sort Store Sales from most to least quantities containing';
    }
    if (total_quantity_column_innerHTML == "Total Quantity") {
        total_quantity_column.innerHTML = "Total Quantity <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from most to least quantities containing';
        total_quantity_column.title = 'Sort Store Sales from least to most quantities containing';
    }
});

const total_price_column = document.getElementById('total-price-column');
total_price_column.addEventListener('click', function SetSorting() {
    var total_price_column_innerHTML = total_price_column.innerHTML;
    if (total_price_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        total_price_column.innerHTML = "Total Price <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from most to least money gained';
        total_price_column.title = 'Sort Store Sales from least to most money gained';
    }
    if (total_price_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        total_price_column.innerHTML = "Total Price <span class=\"las la-sort-down\"></span>";
        sortTable(4, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from least to most money gained';
        total_price_column.title = 'Sort Store Sales from most to least money gained';
    }
    if (total_price_column_innerHTML == "Total Price") {
        total_price_column.innerHTML = "Total Price <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from most to least money gained';
        total_price_column.title = 'Sort Store Sales from least to most money gained';
    }
});

const date_column = document.getElementById('date-column');
date_column.addEventListener('click', function SetSorting() {
    var date_column_innerHTML = date_column.innerHTML;
    if (date_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        date_column.innerHTML = "Date <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from most to least recent';
        date_column.title = 'Sort Store Sales from least to most recent';
    }
    if (date_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        date_column.innerHTML = "Date <span class=\"las la-sort-down\"></span>";
        sortTable(5, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from least to most recent';
        date_column.title = 'Sort Store Sales from most to least recent';
    }
    if (date_column_innerHTML == "Date") {
        date_column.innerHTML = "Date <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Store Sales from most to least recent';
        date_column.title = 'Sort Store Sales from least to most recent';
    }
});



function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('store_sales_table');
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

//sales table (form)
var survey_options = document.getElementById('survey_options');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');
var options = document.getElementById('products');
const clone = options.cloneNode(true);


add_more_fields.onclick = function () {
    var newField1 = document.createElement('input');
    var newField2 = document.createElement('input');
    var label1 = document.createElement('label');
    label1.setAttribute("for", "products");
    label1.innerHTML = "Choose a product";
    label1.appendChild(clone);
    label1.setAttribute('id', 'choose-product');
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
    var label2 = survey_options.getElementsByTagName('label');

    if (input_tags.length > 4 && label2.length > 1) {
        survey_options.removeChild(input_tags[(input_tags.length) - 1]);
        survey_options.removeChild(label2[(label2.length) - 1]);

    }
}
