<?php
include('includes/connect.php');
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}
$clientsCount = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM client"))[0];
$accountsCount = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM compte"))[0];
$transactionsCount = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM transactions"))[0];
$totalBalance = mysqli_fetch_row(mysqli_query($conn,"SELECT SUM(balance) FROM compte"))[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bankly Dashboard</title>

    <style>
        *{
            margin:0;
            padding:0;
        }
        body{
            margin:0;
            padding:0;
            font-family: Arial, sans-serif;
            background:#f0f4f8;
        }

        .navbar{
            width:100%;
            background:#003366;
            padding:15px 25px;
            color:white;
            display:flex;
            justify-content:space-around;
            align-items:center;
        }

        .navbar h2{
            margin:0;
            color:white;
        }

        .navbar a{
            color:white;
            text-decoration:none;
            font-weight:bold;
            background:#0066cc;
            padding:8px 15px;
            border-radius:6px;
            transition:0.3s;
        }

        .navbar a:hover{
            background:#004c99;
        }

        .container{
            width:90%;
            margin:40px auto;
            display:grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap:20px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
            text-align:center;
            transition:0.3s;
        }

        .card:hover{
            transform:scale(1.03);
        }

        .card h3{
            color:#003366;
            margin-bottom:10px;
        }

        .card p{
            font-size:18px;
            color:#555;
        }
        .card a{
            text-decoration:none;
        }

    </style>
</head>
<body>

<div class="navbar">
    <h2><a href="dashbord.php">Bankly Dashboard</a></h2>
    <div>
        Bienvenue, <b><?php echo $_SESSION['username']; ?></b>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <div class="card">
        <h3><a href="clients.php">Clients</a></h3>
        <p><?= $clientsCount ?></p>
    </div>

    <div class="card">
        <h3><a href="account.php">Comptes</a></h3>
        <p><?= $accountsCount ?></p>
    </div>

    <div class="card">
        <h3><a href="list_transactions.php">Transactions</a></h3>
        <p><?= $transactionsCount ?></p>
    </div>
      <div class="card">
    <h3>Solde total</h3>
    <p><?= number_format($totalBalance,2) ?> DH</p>
  </div>
</div>

</body>
</html>
