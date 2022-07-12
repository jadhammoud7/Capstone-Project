
var modal = document.getElementById('id01');

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// const hamBurger=document.querySelector(".hamburger");
// const nav_menu=document.querySelector(".nav-menu");

// hamBurger.addEventListener("click",()=>{
//   hamBurger.classList.toggle("active");
//   nav_menu.classList.toggle("active");
// })
// document.querySelectorAll(".nav-link").forEach(n=> n.addEventListener("click", () =>{
//   hamBurger.classList.remove("active");
//   nav_menu.classList.remove("active");
// }))
