<?php
session_start();
include("includes/connect.php");

if(!isset($_SESSION['user_id'])){
    header("location: index.php");
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM compte WHERE compte_id = $id";
mysqli_query($conn, $sql);

header("location: account.php");
exit;
?>
