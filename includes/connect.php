<?php
$conn = mysqli_connect('localhost','root','','BANKLY_V2');

if(!$conn){
    die("connection failed ". mysqli_connect_error());
}
?>