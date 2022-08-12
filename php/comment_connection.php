<?php
include("connection.php");
 

 
function comment_connection($username,$comment){
    

    $element = "
    <div class=\"testimonial_cover\">
    <img src=\"../images/wallpaper3.jpg\" alt=\"profile\" class=\"test_profile_img\">
    <p class=\"name_test\"><span><i> <strong>$username</strong></i></span></p>
    <p>$comment</p>
</div>
    ";
    echo $element;
}

?>