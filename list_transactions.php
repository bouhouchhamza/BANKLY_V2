<?php
session_start();
include("includes/connect.php");

if(!isset($_SESSION['user_id'])){
    header("location: index.php");
    exit;
}


$sql = "
    SELECT 
        t.transaction_id,
        t.type,
        t.montant,
        t.created_at,
        c.compte_id,
        c.type_compte,
        cl.name AS client_name
    FROM transactions t
    JOIN compte c ON t.compte_id = c.compte_id
    JOIN client cl ON c.client_id = cl.client_id
    ORDER BY t.created_at DESC
";

$trs = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Historique des Transactions</title>
    <link rel="stylesheet" href="style.css">
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
    <h2>Historique des Transactions</h2>

    <div class="actions">
        <a href="make_transaction.php" class="btn-add">
            + Ajouter Transaction
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Compte</th>
                <th>Type</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php while($t = mysqli_fetch_assoc($trs)){ ?>
            <tr>
                <td><?= $t['transaction_id'] ?></td>
                <td><?= $t['client_name'] ?></td>
                <td><?= $t['compte_id'] ?> (<?= $t['type_compte'] ?>)</td>
                <td class="<?= $t['type'] ?>">
                    <?= strtoupper($t['type']) ?>
                </td>
                <td><?= $t['montant'] ?> DH</td>
                <td><?= $t['created_at'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


</body>
</html>
