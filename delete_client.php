<?php
    include('includes/connect.php');
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location: clients.php');
        exit;
    }
    
    $id=$_GET['id'];

    $del_sql="DELETE FROM client WHERE client_id=$id";
    mysqli_query($conn,$del_sql);

    header('location: clients.php');
    exit;
?>