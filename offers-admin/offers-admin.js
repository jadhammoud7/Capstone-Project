function OpenAddProductOffer() {
    window.location = '?open_add_product_offer=true';
}

if (window.location.href.includes('open_add_product_offer=true')) {
    const add_product_offer_form = document.getElementById('add_product_offer_form');
    add_product_offer_form.style.display = 'block';
}

//for product added popup
if (window.location.href.includes('product_offer_added=1')) {
    OpenProductOfferAddedPopUp();
}

function OpenProductOfferAddedPopUp() {
    const product_offer_added_popup = document.getElementById('product-offer-added-confirmation');
    product_offer_added_popup.classList.add('open-popup');
}

function CloseProductOfferAddedPopUp() {
    window.location.href = 'offers-admin.php';
}

function CloseAddProductOffer() {
    window.location.href = 'offers-admin.php';
    const add_product_offer_form = document.getElementById('add_product_offer_form');
    add_product_offer_form.style.display = 'none';
}

if (window.location.href.includes('product_offer_deleted=1')) {
    OpenProductOfferDeletedPopUp();
}

function OpenProductOfferDeletedPopUp() {
    const product_offer_deleted_popup = document.getElementById('product-offer-deleted-confirmation');
    product_offer_deleted_popup.classList.add('open-popup');
}

function CloseProductOfferDeletedPopUp() {
    window.location.href = 'offers-admin.php';
}

const table_sort = document.getElementById('table-sort');
const filter_text = document.getElementById('filter-text');

const product_name_column = document.getElementById('product-name-column');
product_name_column.addEventListener('click', function SetSorting() {
    var product_name_column_innerHTML = product_name_column.innerHTML;
    if (product_name_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_name_column.innerHTML = "Product Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        table_sort.innerHTML = 'Product Name by descending order';
        filter_text.innerHTML = 'Filter';
        product_name_column.title = 'Sort Product Name by ascending';
    }
    if (product_name_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_name_column.innerHTML = "Product Name <span class=\"las la-sort-down\"></span>";
        sortTable(0, "asc");
        table_sort.innerHTML = 'Product Name by ascending order';
        filter_text.innerHTML = 'Filter';
        product_name_column.title = 'Sort Product Name by descending';
    }
    if (product_name_column_innerHTML == "Product Name") {
        product_name_column.innerHTML = "Product Name <span class=\"las la-sort-up\"></span>";
        sortTable(0, "desc");
        table_sort.innerHTML = 'Product Name by descending order';
        filter_text.innerHTML = 'Filter';
        product_name_column.title = 'Sort Product Name by ascending';
    }
});


const old_price_column = document.getElementById('old-price-column');
old_price_column.addEventListener('click', function SetSorting() {
    var old_price_column_innerHTML = old_price_column.innerHTML;
    if (old_price_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        old_price_column.innerHTML = "Old Price <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products of highest to lowest old prices';
        old_price_column.title = 'Sort Old Price by ascending';
    }
    if (old_price_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        old_price_column.innerHTML = "Old Price <span class=\"las la-sort-down\"></span>";
        sortTable(1, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products of lowest to highest old prices';
        old_price_column.title = 'Sort Old Price by descending';
    }
    if (old_price_column_innerHTML == "Old Price") {
        old_price_column.innerHTML = "Old Price <span class=\"las la-sort-up\"></span>";
        sortTable(1, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products of highest to lowest old prices';
        old_price_column.title = 'Sort Old Price by ascending';
    }
});

const new_price_column = document.getElementById('new-price-column');
new_price_column.addEventListener('click', function SetSorting() {
    var new_price_column_innerHTML = new_price_column.innerHTML;
    if (new_price_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        new_price_column.innerHTML = "New Price <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products by descending order of new price';
        new_price_column.title = 'Sort New Price by ascending';
    }
    if (new_price_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        new_price_column.innerHTML = "New Price <span class=\"las la-sort-down\"></span>";
        sortTable(2, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products by ascending order of new price';
        new_price_column.title = 'Sort New Price by descending';
    }
    if (new_price_column_innerHTML == "New Price") {
        new_price_column.innerHTML = "New Price <span class=\"las la-sort-up\"></span>";
        sortTable(2, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products by descending order of new price';
        new_price_column.title = 'Sort New Price by ascending';
    }
});


const offer_percentage_column = document.getElementById('offer-percentage-column');
offer_percentage_column.addEventListener('click', function SetSorting() {
    var offer_percentage_column_innerHTML = offer_percentage_column.innerHTML;
    if (offer_percentage_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        offer_percentage_column.innerHTML = "Offer Percentage <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products offers from most to least percentage';
        offer_percentage_column.title = 'Sort Offer Percentage by ascending';
    }
    if (offer_percentage_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        offer_percentage_column.innerHTML = "Offer Percentage <span class=\"las la-sort-down\"></span>";
        sortTable(3, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products offers from least to most percentage';
        offer_percentage_column.title = 'Sort Offer Percentage by descending';
    }
    if (offer_percentage_column_innerHTML == "Offer Percentage") {
        offer_percentage_column.innerHTML = "Offer Percentage <span class=\"las la-sort-up\"></span>";
        sortTable(3, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products offers from most to least percentage';
        offer_percentage_column.title = 'Sort Offer Percentage by ascending';
    }
});


const offer_begin_date_column = document.getElementById('offer-begin-date-column');
offer_begin_date_column.addEventListener('click', function SetSorting() {
    var offer_begin_date_column_innerHTML = offer_begin_date_column.innerHTML;
    if (offer_begin_date_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        offer_begin_date_column.innerHTML = "Offer Begin Date <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Offer Begin Date by descending order';
        offer_begin_date_column.title = 'Sort Offer Begin Date by ascending';
    }
    if (offer_begin_date_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        offer_begin_date_column.innerHTML = "Offer Begin Date <span class=\"las la-sort-down\"></span>";
        sortTable(4, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Offer Begin Date by ascending order';
        offer_begin_date_column.title = 'Sort Offer Begin Date by descending';
    }
    if (offer_begin_date_column_innerHTML == "Offer Begin Date") {
        offer_begin_date_column.innerHTML = "Offer Begin Date <span class=\"las la-sort-up\"></span>";
        sortTable(4, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Offer Begin Date by descending order';
        offer_begin_date_column.title = 'Sort Offer Begin Date by ascending';
    }
});

const offer_end_date_column = document.getElementById('offer-end-date-column');
offer_end_date_column.addEventListener('click', function SetSorting() {
    var offer_end_date_column_innerHTML = offer_end_date_column.innerHTML;
    if (offer_end_date_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        offer_end_date_column.innerHTML = "Offer End Date <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Sort Offer End Date by descending';
        offer_end_date_column.title = 'Sort Offer End Date by ascending';
    }
    if (offer_end_date_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        offer_end_date_column.innerHTML = "Offer End Date <span class=\"las la-sort-down\"></span>";
        sortTable(5, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Sort Offer End Date by ascending';
        offer_end_date_column.title = 'Sort Offer End Date by descending';
    }
    if (offer_end_date_column_innerHTML == "Offer End Date") {
        offer_end_date_column.innerHTML = "Offer End Date <span class=\"las la-sort-up\"></span>";
        sortTable(5, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Sort Offer End Date by descending';
        offer_end_date_column.title = 'Sort Offer End Date by ascending';
    }
});

const product_last_modified_by_column = document.getElementById('product-last-modified-by-column');
product_last_modified_by_column.addEventListener('click', function SetSorting() {
    var product_last_modified_by_column_innerHTML = product_last_modified_by_column.innerHTML;
    if (product_last_modified_by_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_last_modified_by_column.innerHTML = "Last Modified By <span class=\"las la-sort-up\"></span>";
        sortTable(6, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products Offers by descending order of Last Modified By';
        product_last_modified_by_column.title = 'Sort Last Modified By by ascending';
    }
    if (product_last_modified_by_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_last_modified_by_column.innerHTML = "Last Modified By <span class=\"las la-sort-down\"></span>";
        sortTable(6, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products Offers by ascending order of Last Modified By';
        product_last_modified_by_column.title = 'Sort Last Modified By by descending';
    }
    if (product_last_modified_by_column_innerHTML == "Last Modified By") {
        product_last_modified_by_column.innerHTML = "Last Modified By <span class=\"las la-sort-up\"></span>";
        sortTable(6, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products Offers by descending order of Last Modified By';
        product_last_modified_by_column.title = 'Sort Last Modified By by ascending';
    }
});

const product_last_modified_on_column = document.getElementById('product-last-modified-on-column');
product_last_modified_on_column.addEventListener('click', function SetSorting() {
    var product_last_modified_on_column_innerHTML = product_last_modified_on_column.innerHTML;
    if (product_last_modified_on_column_innerHTML.includes("<span class=\"las la-sort-down\"></span>")) {
        product_last_modified_on_column.innerHTML = "Last Modified On <span class=\"las la-sort-up\"></span>";
        sortTable(7, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products Offers by descending order of Last Modified On';
        product_last_modified_on_column.title = 'Sort Last Modified On by ascending';
    }
    if (product_last_modified_on_column_innerHTML.includes("<span class=\"las la-sort-up\"></span>")) {
        product_last_modified_on_column.innerHTML = "Last Modified On <span class=\"las la-sort-down\"></span>";
        sortTable(7, "asc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products Offers by ascending order of Last Modified On';
        product_last_modified_on_column.title = 'Sort Last Modified On by descending';
    }
    if (product_last_modified_on_column_innerHTML == "Last Modified On") {
        product_last_modified_on_column.innerHTML = "Last Modified On <span class=\"las la-sort-up\"></span>";
        sortTable(7, "desc");
        filter_text.innerHTML = 'Filter';
        table_sort.innerHTML = 'Products Offers by descending order of Last Modified On';
        product_last_modified_on_column.title = 'Sort Last Modified On by ascending';
    }
});

function sortTable(n, dir) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById('products_offers_table');
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

function FilterTable() {
    var input, filter, table, td, i, j, textValue;
    input = document.getElementById("SearchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("products_offers_table");

    var tr = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (i = 0; i < tr.length; i++) {
        var td = [];
        var display = 'none';
        for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
            if (j == 0) {
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

function FilterTableRecommendation() {
    var input, filter, table, td, i, j, textValue;
    input = document.getElementById("SearchInput2");
    filter = input.value.toUpperCase();
    table = document.getElementById("products_recommendation_offers_table");

    var tr = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (i = 0; i < tr.length; i++) {
        var td = [];
        var display = 'none';
        for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
            if (j == 0) {
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
//for remove product offer popup
var product_id;

function OpenRemoveProductOfferPopUp(Name, ID) {
    var remove_product_offer_popup = document.getElementById('remove-product-offer-confirmation');
    remove_product_offer_popup.classList.add('open-popup');
    product_id = ID;
    var remove_product_offer_confirmation_text = document.getElementById('remove-product-offer-confirmation-text');
    remove_product_offer_confirmation_text.innerHTML = 'Remove "' + Name + '" from products offers list?';
}

function CloseRemoveProductOfferPopUp() {
    var remove_product_offer_popup = document.getElementById('remove-product-offer-confirmation');
    remove_product_offer_popup.classList.remove('open-popup');
}

function DeleteProductOffer() {
    window.location.href = 'offers-admin.php?getProducttoRemove=' + product_id;
}

//calculate offer percentage
function SetOfferPercentage() {
    var old_price = document.getElementById('product_old_price').value;
    var new_price = document.getElementById('product_new_price').value;
    document.getElementById('offer_percentage').value = (1 - new_price / old_price) * 100;
}
