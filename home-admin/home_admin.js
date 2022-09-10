const btn=document.getElementsByClassName('btn_done_work');
for(let i=0;i<btn.length;i++){
    const initialText="Set Work To Done";
    btn[i].addEventListener('click',function handleClick(){
        if(btn[i].textContent.toLowerCase().includes(initialText.toLowerCase())){
            btn[i].textContent="Set to pending";
            Window.location =" ../home-admin/home-admin.php?set_to_done=true";
            //yaane heye pending w bade hawela la done
            btn[i].style.color="black";
            btn[i].style.background="red";
        }else{
            btn[i].textContent=initialText;
            btn[i].style.color="white";
            btn[i].style.background="royalblue";
            Window.location =" ../home-admin/home-admin.php?set_to_done=false";
            //yane heye done w bade hawela la pending

        }
    });    
}
