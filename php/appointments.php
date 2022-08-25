<?php

session_start();

include("connection.php");

if(isset($_GET['name'])){
  header("Location: '../appointments/appointments.php'"); 
}

?>
