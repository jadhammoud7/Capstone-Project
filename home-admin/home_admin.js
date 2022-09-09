const edit_btn_status = document.querySelector(".edit_btn_status");
const btn=document.querySelector(".work_set_to_done");
const btn1=document.querySelector(".btn_done_work");



function edit_status() {

    console.log("edit status btn clicked");
        // 👇️ this SHOWS the form
        edit_btn_status.innerHTML="<button  onclick=\"back()\" class=\"work_set_to_done\"><strong>Return to pending</strong></button>";
        btn.style.display = 'block';
        btn1.style.display = 'none';

    // else {
    //     btn_div.innerHTML = " <button onclick=\"edit_status()\" class=\"btn_done_work\" title=\"Work Is Done!\" >Done Work</button>";
    //     // 👇️ this HIDES the form
    //     firstname.style.display = 'none';
    //     lastname.style.display = 'none';
    //     email.style.display = 'none';
    //     phonenumber.style.display = 'none';
    //     address.style.display = 'none';
    // }

}
function back() {

    console.log("edit status btn clicked");
        // 👇️ this SHOWS the form
        edit_btn_status.innerHTML="<button   style=\"display:block;\" onclick=\"edit_status()\" class=\"btn_done_work\"><strong>Done Work</strong></button>";
        btn.style.display = 'none';
        btn1.style.display = 'block';


}