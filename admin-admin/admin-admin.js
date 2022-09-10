const logout_btn=document.getElementsByClassName("logout-btn");
logout_btn.addEventListener('click', function handleClick(){
    window.location.href = '../php/logout.php';
});
