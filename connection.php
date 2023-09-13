<?php
$servername="localhost";
$username="root";
$password="";
$db = "workers";


$conn = mysqli_connect($servername,$username,$password,$db);


if($conn -> connect_error){
    die("connection failed".$conn->connect_error);
}





?>
