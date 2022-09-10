const table=document.getElementById("container1");
const btn=document.getElementById("add_user1");


function myFunction() {
    if(btn.innerHTML=="Add Admin Account"){
        btn.innerHTML="Return";
        btn.style.background="red";
        btn.style.color="black";
        table.style.display = "block";
    }else{
        btn.innerHTML="Add Admin Account";
        btn.style.background="royalblue";
        btn.style.color="white";
        table.style.display = "none";
    }

  }