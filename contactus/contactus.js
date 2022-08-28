if (window.location.href.includes("comment_submitted=true")) {
    OpenCommentReceivedPopUp();
}

function OpenCommentReceivedPopUp() {
    let comment_received_popup = document.getElementById('comment-received-confirmation');
    comment_received_popup.classList.add('open-popup');
}

function RemoveCommentReceivedPopUp() {
    window.location = '../contactus/contactus.php';
    let comment_received_popup = document.getElementById('comment-received-confirmation');
    comment_received_popup.classList.remove('open-popup');
}