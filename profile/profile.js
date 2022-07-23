const hamBurger = document.querySelector(".hamburger");
const nav_menu = document.querySelector(".nav-menu");

hamBurger.addEventListener("click", () => {
    hamBurger.classList.toggle("active");
    nav_menu.classList.toggle("active");
})
document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {

    hamBurger.classList.remove("active");
    nav_menu.classList.remove("active");
}))

var profile_part = document.querySelector(".profile");
var basket_part = document.querySelector(".basket");
var favorites_part = document.querySelector(".favorites");
var edit_part = document.querySelector(".edit");

function ShowProfile(){
    profile_part.style.display = "block";
    basket_part.style.display = "none";
    favorites_part.style.display = "none";
    edit_part.style.display = "none";
}

function ShowBasket(){
    profile_part.style.display = "none";
    basket_part.style.display = "block";
    favorites_part.style.display = "none";
    edit_part.style.display = "none";
}

function ShowFavorites(){
    profile_part.style.display = "none";
    basket_part.style.display = "none";
    favorites_part.style.display = "block";
    edit_part.style.display = "none";
}

//edit profile button down
const btn = document.querySelector(".edit_profile_btn");

btn.addEventListener('click', () => {
    const firstname = document.querySelector(".first_name_editprofile");
    const lastname = document.querySelector(".last_name_editprofile");
    const email = document.querySelector(".email_profile_btn");
    const phonenumber = document.querySelector(".phone_number_editprofile");
    const address = document.querySelector(".address_editprofile");


    console.log("edit profile btn clicked");

  if (firstname.style.display === 'none' ) {
    btn.innerHTML="Back";
    btn.style.color="red";
    // 👇️ this SHOWS the form
    firstname.style.display = 'block';
    lastname.style.display = 'block';
    // email.style.display = 'block';
    // phonenumber.style.display = 'block';
    // address.style.display = 'block';
  } else {
    btn.innerHTML="Edit Profile";
    btn.style.color="black";
    // 👇️ this HIDES the form
    firstname.style.display = 'none';
    lastname.style.display = 'none';
    // email.style.display = 'none';
    // phonenumber.style.display = 'none';
    // address.style.display = 'none';
  }
});



// && lastname.style.display === 'none' && email.style.display === 'none' && phonenumber.style.display === 'none' && address.style.display === 'none'
