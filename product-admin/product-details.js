function EditProfile() {
    const product_name = document.getElementById('product_name');
    product_name.removeAttribute('readonly');
    product_name.classList.remove('is-valid');

    const product_price = document.getElementById('price');
    product_price.removeAttribute('readonly');
    product_price.classList.remove('is-valid');

    const product_type = document.getElementById('type');
    product_type.removeAttribute('readonly');
    product_type.classList.remove('is-valid');

    const product_category = document.getElementById('category');
    product_category.removeAttribute('readonly');
    product_category.classList.remove('is-valid');

    const product_description = document.getElementById('description');
    product_description.innerHTML = 
    "<textarea name=\"description\" cols=\"50\" rows=\"10\" placeholder=\"Write brief product description\"><?php if (isset($row_product)) { echo $row_product[\'description\'];} ?>></textarea>";
}