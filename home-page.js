let slideIndex = 0;
showSlides();

function showSlides(){
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for(i = 0; i < slides.length; i++)
        slides[i].style.display = "none";
    slideIndex++;
    if(slideIndex > slides.length)
        slideIndex = 1;
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 2000);
}
function plusSlides(n){
    showSlides(slideIndex += n);
}

function currentSlide(n){
    showSlides(slideIndex = n);
}

function showSlides(n){
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if(n > slides.length)
        slideIndex = 1;
    if(n < 1)
        slideIndex = slides.length;
    for(i = 0; i < slides.length; i++)
        slides[i].style.display = "none";
    for(i = 0; i < dots.length; i++)
        dots[i].className = dots[i].className.replace(" active", "");
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides(n + 1), 4000);
}

var modal = document.getElementById('id01');

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
