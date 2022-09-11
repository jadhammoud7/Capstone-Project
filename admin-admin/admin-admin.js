function OpenAddUser() {
    window.location.href = window.location.href + '?open_add_user=true';
}

if (window.location.href.includes('open_add_user=true')) {
    const gift_div = document.getElementById("id01");
    gift_div.style.display = "block";
}

function CloseAddUser() {
    window.location.href = 'admin-admin.php';
    const gift_div = document.getElementById("id01");
    gift_div.style.display = "none";
}

//open logout popup
function OpenLogOutPopUp() {
    let logout_popup = document.getElementById('logout-confirmation');
    logout_popup.classList.add('open-popup');
}

//close logout popup
function CloseLogOutPopUp() {
    let logout_popup = document.getElementById('logout-confirmation');
    logout_popup.classList.remove('open-popup');
}

//go to login
function GoToLogIn() {
    window.location.href = '../php/logout.php';
    CloseLogOutPopUp();
}