const btn=document.getElementsByClassName('btn_done_work');
for(let i=0;i<btn.length;i++){
    const initialText="Done Work";
    btn[i].addEventListener('click',function handleClick(){
        if(btn[i].textContent.toLowerCase().includes(initialText.toLowerCase())){
            btn[i].textContent="Return to pending";
            btn[i].style.color="black";
            btn[i].style.background="red";
        }else{
            btn[i].textContent=initialText;
            btn[i].style.color="white";
            btn[i].style.background="royalblue";
        }
    });    
}
