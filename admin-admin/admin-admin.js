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
