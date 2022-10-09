var Description;
var RepairImage;

function EditRepair() {
    const repair_type = document.getElementById('repair_type');
    repair_type.removeAttribute('readonly');
    repair_type.classList.remove('is-valid');

    const price_per_hour = document.getElementById('price_per_hour');
    price_per_hour.removeAttribute('readonly');
    price_per_hour.classList.remove('is-valid');

    const repair_description = document.getElementById('description');
    const description_text = repair_description.innerHTML;
    Description = description_text;
    repair_description.innerHTML = "<textarea name=\"description\" id=\"description-textarea\" cols=\"50\" rows=\"10\" placeholder=\"Write brief repair description\" value=\"\"></textarea>";
    document.getElementById('description-textarea').value = description_text;

    const repair_image = document.getElementById('repair_image');
    ProductImage = repair_image.innerHTML;
    repair_image.innerHTML = "<input type=\"file\" name=\"repair_image\" id=\"repair_image\" value=\"\">";

    const edit_repair_submit = document.getElementById('edit-repair-submit');
    edit_repair_submit.style.visibility = 'visible';

    const edit_button = document.getElementById('edit-button');
    edit_button.innerHTML = '<span class="las la-times-circle"></span> Exit Edit Repair';
    edit_button.style.backgroundColor = 'red';
    edit_button.title = 'Exit Editting Repair';
    edit_button.setAttribute('onclick', 'ExitEditRepair()');
}

function ExitEditRepair() {
    const repair_type = document.getElementById('repair_type');
    repair_type.setAttribute('readonly', true);
    repair_type.classList.add('is-valid');

    const price_per_hour = document.getElementById('price_per_hour');
    price_per_hour.setAttribute('readonly', true);
    price_per_hour.classList.add('is-valid');

    const repair_description = document.getElementById('description');
    repair_description.innerHTML = Description;

    const repair_image = document.getElementById('repair_image');
    repair_image.innerHTML = ProductImage;

    const edit_repair_submit = document.getElementById('edit-repair-submit');
    edit_repair_submit.style.visibility = 'hidden';

    const edit_button = document.getElementById('edit-button');
    edit_button.innerHTML = '<span class="las la-edit"></span> Edit Repair';
    edit_button.style.backgroundColor = 'royalblue';
    edit_button.title = 'Edit Repair';
    edit_button.setAttribute('onclick', 'EditRepair()');
}

if (window.location.href.includes('repair-updated=1')) {
    OpenProductUpdatedPopUp();
}

function OpenRepairUpdatedPopUp() {
    var repair_updated_popup = document.getElementById('repair-updated-confirmation');
    repair_updated_popup.classList.add('open-popup');
}

function CloseRepairUpdatedPopUp() {
    var repair_updated_popup = document.getElementById('repair-updated-confirmation');
    repair_updated_popup.classList.remove('open-popup');
    window.location.href = 'repair-admin-details.php';
}