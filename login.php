<?php
include("includes/connect.php");
 session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $DATA=$_POST;

if(empty($DATA['username']) || empty($DATA['password'])){
    die('username and Password are required');
}

$username=$DATA['username'];
$password=$DATA['password'];

$sql="SELECT * FROM utilisateur WHERE username='$username'";
$result= mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);

if($count==0){
   
   echo "
   <script>alert('User Not Found');
   window.location.href='index.php';
   </script>";
   exit;
}

$user=mysqli_fetch_assoc($result);

if($user['password'] != $password){
    echo "
   <script>alert('Password Not correct');
   window.location.href='index.php';
   </script>";
   exit;
}

$_SESSION['user_id']=$user['user_id'];
$_SESSION['username']=$user['username'];

header("location:dashbord.php");

}

?>