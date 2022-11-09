var Description;
var ProductImage;

if (window.location.href.includes('product-updated=1')) {
    OpenProductUpdatedPopUp();
}

function OpenProductUpdatedPopUp() {
    var product_updated_popup = document.getElementById('product-updated-confirmation');
    product_updated_popup.classList.add('open-popup');
}

function CloseProductUpdatedPopUp() {
    var product_updated_popup = document.getElementById('product-updated-confirmation');
    product_updated_popup.classList.remove('open-popup');
    window.location.href = 'product-admin.php';
}

var product_id = 0;

function ShowDeleteProductPopUp(ProductID) {
    product_id = ProductID;
    var product_delete_popup = document.getElementById('product-delete-confirmation');
    product_delete_popup.classList.add('open-popup');
}

function CloseProductDeletePopUp() {
    var product_delete_popup = document.getElementById('product-delete-confirmation');
    product_delete_popup.classList.remove('open-popup');
}

function DeleteProduct() {
    window.location.href = window.location.href + '&ProductIDToRemove=' + product_id;
}