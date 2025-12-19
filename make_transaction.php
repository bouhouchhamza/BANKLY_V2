<?php
session_start();
include("includes/connect.php");

if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit;
}

$clients = mysqli_query($conn, "SELECT * FROM client");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Nouvelle Transaction</title>
<script>
function loadAccounts(clientId){
    if(clientId == ""){
        document.getElementById("accounts").innerHTML =
            "<option value=''>-- Choisir compte --</option>";
        return;
    }

    fetch("get_accounts.php?client_id=" + clientId)
        .then(response => response.text())
        .then(data => {
            document.getElementById("accounts").innerHTML = data;
        });
}
</script>

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
<div class="form-box">
    <h2>Nouvelle Transaction</h2>

    <form method="POST" action="transaction_action.php">

        <label>Client</label>
<select name="client_id" onchange="loadAccounts(this.value)" required>
    <option value="">-- Choisir client --</option>
    <?php while($c = mysqli_fetch_assoc($clients)){ ?>
        <option value="<?= $c['client_id'] ?>">
            <?= $c['name'] ?>
        </option>
    <?php } ?>
</select>

        <label>Compte</label>
<select name="compte_id" id="accounts" required>
    <option value="">-- Choisir compte --</option>
</select>


        <label>Type de transaction</label>
        <select name="type" required>
            <option value="deposit">Dépôt</option>
            <option value="withdraw">Retrait</option>
        </select>

        <label>Montant (DH)</label>
        <input type="number" name="montant" placeholder="Ex: 500" required>

        <button type="submit">Valider la transaction</button>
    </form>

    <a href="list_transactions.php" class="back-link">← Retour aux transactions</a>
</div>

</body>
</html>
