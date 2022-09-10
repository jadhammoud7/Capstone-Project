const btn=document.getElementById('btn_done_work');


btn.addEventListener('click', function handleClick() {
    const initialText="Done Work";
    if(btn.textContent.toLowerCase().includes(initialText.toLowerCase())){
        btn.textContent="Return to pending";
        btn.style.color="black";
        btn.style.background="red";
    }else{
        btn.textContent=initialText;
        btn.style.color="white";
        btn.style.background="royalblue";
    }


  });
