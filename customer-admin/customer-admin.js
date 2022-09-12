var customer_id;
var first_name;
var last_name;

var remove_confirmation_text = document.getElementById('remove-confirmation-text');
function OpenRemoveCustomerPopUp(CustomerID, FirstName, LastName) {
    var remove_customer_popup = document.getElementById('remove-confirmation');
    remove_customer_popup.classList.add('open-popup');
    customer_id = CustomerID;
    first_name = FirstName;
    last_name = LastName;
    remove_confirmation_text.innerHTML = 'Remove "' + first_name + ' ' + last_name + '" from customers list?';
}

function CloseRemoveCustomerPopUp() {
    var remove_customer_popup = document.getElementById('remove-confirmation');
    remove_customer_popup.classList.remove('open-popup');
}

function DeleteCustomer() {
    window.location.href = 'customer-admin.php?getCustomerIDtoRemove=' + customer_id;
    CloseRemoveCustomerPopUp();
}
