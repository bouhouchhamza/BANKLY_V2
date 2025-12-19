<?php
include("includes/connect.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id        = $_POST['id'];
    $type      = $_POST['type_compte'];
    $solde     = $_POST['solde'];
    $client_id = $_POST['client_id'];

    $sql = "UPDATE compte SET
            type_compte = '$type',
            balance = '$solde',
            client_id = '$client_id'
            WHERE compte_id = $id";

    mysqli_query($conn, $sql);

    header("location: account.php");
    exit;
}
?>
