<?php
session_start();
include("connection.php");
if(!isset($_SESSION['logged_bool'])){
    header("Location: ../login/login.php");
}
echo $_SESSION['logged_id'];
?>