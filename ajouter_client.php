<?php
include('includes/connect.php');
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $data=$_POST;
 $name=$data['name'];
 $email=$data['email'];
 $phone=$data['telephone'];
 $cin=$data['cin']; 
$aj_sql="INSERT INTO client(name , email , cin , telephone)
        VALUES('$name' , '$email' , '$cin' , '$phone')";
mysqli_query($conn,$aj_sql);  
header("location: account.php");
exit;
}?>

