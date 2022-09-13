function OpenAddProduct() {
    window.location.href = window.location.href + '?open_add_product=true';
}

if (window.location.href.includes('open_add_product=true')) {
    const gift_div = document.getElementById("id01");
    gift_div.style.display = "block";
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

function OpenRemoveAdminPopUp(AdminID, FirstName, LastName){
    var remove_admin_popup = document.getElementById('remove-confirmation');
    remove_admin_popup.classList.add('open-popup');
    admin_id = AdminID;
    first_name = FirstName;
    last_name = LastName;
    remove_confirmation_text.innerHTML = 'Remove "' + first_name + ' ' + last_name + '" from admins list?';
}

function CloseRemoveAdminPopUp(){
    var remove_admin_popup = document.getElementById('remove-confirmation');
    remove_admin_popup.classList.remove('open-popup');
}

// function DeleteAdmin(){
//     window.location.href = 'product-admin.php?getAdminIDtoRemove' + admin_id;
//     CloseRemoveAdminPopUp();
// }