<?php
include("includes/connect.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $type      = $_POST['type_compte'];
    $solde     = $_POST['solde'];
    $client_id = $_POST['client_id'];

    $sql = "INSERT INTO compte (type_compte, balance, client_id)
            VALUES ('$type', '$solde', '$client_id')";

    mysqli_query($conn, $sql);

    header("location: account.php");
    exit;
}
?>
