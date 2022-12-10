<?php


session_start();

include("connection.php");

//handling post request for slideshow
$slide1_text = "";
$slide2_text = "";
$slide3_text = "";

$select_slideshow = $connection->prepare("SELECT * FROM slideshow_slides");
$select_slideshow->execute();
$result_slideshow = $select_slideshow->get_result();
$row_slideshow = $result_slideshow->fetch_assoc();

if (isset($_POST['slide1_text'])) {
    $slide1_text = $_POST['slide1_text'];
}

if ($slide1_text != "" && !empty($row_slideshow)) {
    $stmt_update_slide1_slideshow = $connection->prepare("UPDATE slideshow_slides SET slide1_text = '" . $slide1_text . "'");
    $stmt_update_slide1_slideshow->execute();
}

if (isset($_POST['slide2_text'])) {
    $slide2_text = $_POST['slide2_text'];
}

if ($slide2_text != "" && !empty($row_slideshow)) {
    $stmt_update_slide2_slideshow = $connection->prepare("UPDATE slideshow_slides SET slide2_text = '" . $slide2_text . "'");
    $stmt_update_slide2_slideshow->execute();
}

if (isset($_POST['slide3_text'])) {
    $slide3_text = $_POST['slide3_text'];
}

if ($slide3_text != "" && !empty($row_slideshow)) {
    $stmt_update_slide3_slideshow = $connection->prepare("UPDATE slideshow_slides SET slide3_text = '" . $slide3_text . "'");
    $stmt_update_slide3_slideshow->execute();
}

if ($_FILES['slide1_image']['name'] != "") {
    rmdir('../images/Slideshow/Slide1/');
    mkdir('../images/Slideshow/Slide1/');

    $target_dir = '../images/Slideshow/Slide1/';

    $filename = basename($_FILES['slide1_image']['name']);

    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['slide1_image']['tmp_name'], $target_file)) {
            $slide1_image = $filename;
            $stmt_update_slide1_image_slideshow = $connection->prepare("UPDATE slideshow_slides SET slide1_image=?");
            $stmt_update_slide1_image_slideshow->bind_param("s", $slide1_image);
            $stmt_update_slide1_image_slideshow->execute();
        }
    }
}

if ($_FILES['slide2_image']['name'] != "") {
    rmdir('../images/Slideshow/Slide2/');
    mkdir('../images/Slideshow/Slide2/');

    $target_dir = '../images/Slideshow/Slide2/';

    $filename = basename($_FILES['slide2_image']['name']);

    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['slide2_image']['tmp_name'], $target_file)) {
            $slide2_image = $filename;
            $stmt_update_slide2_image_slideshow = $connection->prepare("UPDATE slideshow_slides SET slide2_image=?");
            $stmt_update_slide2_image_slideshow->bind_param("s", $slide2_image);
            $stmt_update_slide2_image_slideshow->execute();
        }
    }
}

if ($_FILES['slide3_image']['name'] != "") {
    rmdir('../images/Slideshow/Slide3/');
    mkdir('../images/Slideshow/Slide3/');

    $target_dir = '../images/Slideshow/Slide3/';

    $filename = basename($_FILES['slide2_image']['name']);

    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['slide3_image']['tmp_name'], $target_file)) {
            $slide3_image = $filename;
            $stmt_update_slide3_image_slideshow = $connection->prepare("UPDATE slideshow_slides SET slide3_image=?");
            $stmt_update_slide3_image_slideshow->bind_param("s", $slide3_image);
            $stmt_update_slide3_image_slideshow->execute();
        }
    }
}

echo "<script>window.location='../home-admin/home-admin.php?slideshow_modified=1';</script>";
