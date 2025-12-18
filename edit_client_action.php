<?php
include("includes/connect.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $cin   = $_POST['cin'];
    $tel   = $_POST['telephone'];

    $sql = "UPDATE client SET 
            name='$name',
            email='$email',
            cin='$cin',
            telephone='$tel'
            WHERE client_id=$id";

    mysqli_query($conn, $sql);

    header("location: clients.php");
    exit;
}
?>
