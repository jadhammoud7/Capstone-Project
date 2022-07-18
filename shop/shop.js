let tabs=document.querySelectorAll(".tabs button");
let tabsArray=Array.from(tabs);
 

let divs=document.querySelectorAll(".content> div ");
let divArray=Array.from(divs);

tabsArray.forEach((element)=>{
    element.addEventListener("click",function(e){
        tabsArray.forEach((element)=>{
            element.classList.remove("active"); 
        });
        e.currentTarget.classList.add("active");
        divArray.forEach((divs)=>{
            divs.style.display="none";
        });
        document.querySelector(e.currentTarget.dataset.cont).style.display="block"; 
        });
});
 