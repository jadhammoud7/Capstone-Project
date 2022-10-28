var Description;
var ProductImage;
var ProductTypeInnerHtml;
var ProductCategoryInnerHtml;

function EditProduct1() {
    const product_name = document.getElementById('product_name');
    product_name.removeAttribute('readonly');
    product_name.classList.remove('is-valid');

    const product_price = document.getElementById('price');
    product_price.removeAttribute('readonly');
    product_price.classList.remove('is-valid');

    // const product_type = document.getElementById('type');
    // product_type.removeAttribute('readonly');
    // product_type.classList.remove('is-valid');

    const product_category = document.getElementById('category');
    product_category.removeAttribute('readonly');
    product_category.classList.remove('is-valid');

    const product_description = document.getElementById('description');
    const description_text = product_description.innerHTML;
    Description = description_text;
    product_description.innerHTML = "<textarea name=\"description\" id=\"description-textarea\" cols=\"50\" rows=\"10\" placeholder=\"Write brief product description\" value=\"\"></textarea>";
    document.getElementById('description-textarea').value = description_text;

    const product_age = document.getElementById('age');
    product_age.removeAttribute('readonly');
    product_age.classList.remove('is-valid');

    const product_inventory = document.getElementById('inventory');
    product_inventory.removeAttribute('readonly');
    product_inventory.classList.remove('is-valid');

    const product_image = document.getElementById('product_image');
    ProductImage = product_image.innerHTML;
    product_image.innerHTML = "<input type=\"file\" name=\"product_image\" id=\"product_image\" value=\"\">";

    const edit_product_submit = document.getElementById('edit-product-submit');
    edit_product_submit.style.visibility = 'visible';

    const edit_button = document.getElementById('edit-button');
    edit_button.innerHTML = '<span class="las la-times-circle"></span> Exit Edit Product';
    edit_button.style.backgroundColor = 'red';
    edit_button.title = 'Exit Editting Product';
    edit_button.setAttribute('onclick', 'ExitEditProduct()');
}

function ExitEditProduct() {
    const product_name = document.getElementById('product_name');
    product_name.setAttribute('readonly', true);
    product_name.classList.add('is-valid');

    const product_price = document.getElementById('price');
    product_price.setAttribute('readonly', true);
    product_price.classList.add('is-valid');

    const product_type = document.getElementById('type');
    product_type.setAttribute('readonly', true);
    product_type.classList.add('is-valid');

    const product_category = document.getElementById('category');
    product_category.setAttribute('readonly', true);
    product_category.classList.add('is-valid');

    const product_description = document.getElementById('description');
    product_description.innerHTML = Description;

    const product_age = document.getElementById('age');
    product_age.setAttribute('readonly', true);
    product_age.classList.add('is-valid');

    const product_inventory = document.getElementById('inventory');
    product_inventory.setAttribute('readonly', true);
    product_inventory.classList.add('is-valid');

    const product_image = document.getElementById('product_image');
    product_image.innerHTML = ProductImage;

    const edit_product_submit = document.getElementById('edit-product-submit');
    edit_product_submit.style.visibility = 'hidden';

    const edit_button = document.getElementById('edit-button');
    edit_button.innerHTML = '<span class="las la-edit"></span> Edit Product';
    edit_button.style.backgroundColor = 'royalblue';
    edit_button.title = 'Edit Product';
    edit_button.setAttribute('onclick', 'EditProduct()');
}

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