if (window.location.href.includes("account_created=true")) {
    OpenAccountCreatedPopUp();
}

function OpenAccountCreatedPopUp() {
    let account_created_popup = document.getElementById('account-created-confirmation');
    account_created_popup.classList.add('open-popup');
}

function RemoveAccountCreatedPopUp() {
    window.location = '../login/login.php';
    let account_created_popup = document.getElementById('account-created-confirmation');
    account_created_popup.classList.remove('open-popup');
}