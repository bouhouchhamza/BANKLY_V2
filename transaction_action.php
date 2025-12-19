<?php
session_start();
include("includes/connect.php");
if(!isset($_SESSION['user_id'])){
    $_SESSION['error'] = "Utilisateur non authentifié";
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];


$compte_id = $_POST['compte_id'];
$type      = $_POST['type'];
$montant   = $_POST['montant'];

$acc = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT balance FROM compte WHERE compte_id = $compte_id")
);

$solde = $acc['balance'];

if($type == "withdraw"){
    if($solde < $montant){
        die("Solde insuffisant !");
    }

    mysqli_query($conn, 
        "UPDATE compte SET balance = balance - $montant WHERE compte_id = $compte_id");
}

if($type == "deposit"){
    mysqli_query($conn, 
        "UPDATE compte SET balance = balance + $montant WHERE compte_id = $compte_id");
}


mysqli_query($conn, 
    $sql = "INSERT INTO transactions (compte_id, type, montant, user_id)
        VALUES ('$compte_id', '$type', '$montant', '$user_id')");

header("location: list_transactions.php?id=$compte_id");
exit;
?>
