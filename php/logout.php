<?php

session_start();
include("connection.php");
//unset all sessions
unset($_SESSION["logged_id"]);
unset($_SESSION["logged_bool"]);
header("Location:../login/login.php");
