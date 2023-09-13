<?php 
session_start(); 

unset($_SESSION['indicate']);

header("Location:login.php");
?>