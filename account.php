<?php
include("includes/connect.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Comptes</title>

    <style>
        body{
            margin:0;
            padding:0;
            font-family: Arial;
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
        }

        .navbar a{
            background:#0066cc;
            padding:8px 15px;
            border-radius:6px;
            color:white;
            text-decoration:none;
            font-weight:bold;
        }

        .add-btn{
            background:#28a745;
            color:white;
            position:relative;
            left:50px;
            padding:10px 15px;
            border-radius:6px;
            font-weight:bold;
            margin-left: 40px;
            display:inline-block;
        }
        .add-bt{
            background:#28a745;
            color:white;
            border-radius:6px;
            font-weight:bold;
            display:inline-block;
            margin-top:15px;
        }

        table{
            width:90%;
            margin:30px auto;
            border-collapse:collapse;
            background:white;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 3px 10px rgba(0,0,0,0.1);
        }

        table th, table td{
            padding:12px;
            text-align:center;
        }

        table th{
            background:#003366;
            color:white;
        }

        table tr:nth-child(even){
            background:#f2f2f2;
        }

        .edit-btn, .delete-btn{
            padding:6px 12px;
            border-radius:6px;
            text-decoration:none;
            font-weight:bold;
        }

        .edit-btn{
            background:#ffc107;
            color:black;
        }

        .delete-btn{
            background:#dc3545;
            color:white;
        }

        .overlay{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.55);
            display:none;
        }

        .popup{
            position:fixed;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            background:white;
            width:350px;
            padding:20px;
            border-radius:10px;
            display:none;
            animation:fadeIn 0.3s;
        }

        @keyframes fadeIn{
            from{opacity:0; transform:translate(-50%,-45%);}
            to{opacity:1; transform:translate(-50%,-50%);}
        }

        .popup input, .popup select{
            width:100%;
            padding:10px;
            margin-top:10px;
            border-radius:6px;
            border:1px solid #aaa;
        }

        .close-btn{
            background:#dc3545;
            padding:8px 15px;
            border:none;
            color:white;
            border-radius:6px;
            margin-top:10px;
            cursor:pointer;
        }
        #ajouter-comp{

    background:#28a745;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:6px;
    font-weight:bold;
}
#ajouter-comp:hover{
    background:#1e7e34;
    transform: scale(1.05);
}


    </style>
</head>
<body>

<div class="navbar">
    <h2><a href="dashbord.php">Bankly – Comptes</a></h2>
    <div>
        Bienvenue, <b><?php echo $_SESSION['username']; ?></b>
        <a href="logout.php">Logout</a>
    </div>
</div>

<h2 style="text-align:center; color:#003366;">Liste des Comptes</h2>

<button id="openAdd" class="add-btn">+ Ajouter un compte</button>

<table>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Solde</th>
        <th>Client</th>
        <th>Actions</th>
    </tr>

    <?php
    $sql = "SELECT compte.*, client.name 
            FROM compte 
            JOIN client ON compte.client_id = client.client_id";

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
    ?>
        <tr>
            <td><?php echo $row['compte_id']; ?></td>
            <td><?php echo $row['type_compte']; ?></td>
            <td><?php echo $row['balance']; ?> DH</td>
            <td><?php echo $row['name']; ?></td>
            <td>
                <a class="edit-btn"
   href="#"
   data-id="<?php echo $row['compte_id']; ?>"
   data-type="<?php echo $row['type_compte']; ?>"
   data-solde="<?php echo $row['balance']; ?>"
   data-client="<?php echo $row['client_id']; ?>"
   onclick="openEditCompte(this)">Edit</a>
   <a href="list_transactions.php?id=<?php echo $row['compte_id']; ?>">
    Transactions
</a>


                <a class="delete-btn"
   href="delete_account.php?id=<?php echo $row['compte_id']; ?>"
   onclick="return confirm('Supprimer ce compte ?');">
   Delete
</a>
            </td>
        </tr>
    <?php } ?>
</table>


<div id="overlay" class="overlay"></div>

<div id="popupAdd" class="popup">
    <h2>Ajouter un compte</h2>

    <form method="POST" action="ajouter-account.php">

        <label>Type de compte :</label>
        <select name="type_compte" required>
            <option value="courant">Courant</option>
            <option value="épargne">Épargne</option>
            <option value="commercial">Commercial</option>
        </select>

        <label>Solde initial :</label>
        <input type="number" name="solde" required>

        <label>Client :</label>
        <select name="client_id" required>
            <?php
            $cl = mysqli_query($conn, "SELECT * FROM client");
            while($c = mysqli_fetch_assoc($cl)){
                echo "<option value='".$c['client_id']."'>".$c['name']."</option>";
            }
            ?>
        </select>

        <button type="submit" class="add-bt">Ajouter</button>
    </form>

    <button id="closeAdd" class="close-btn">Fermer</button>
</div>
<div id="overlayEdit" class="overlay"></div>

<div id="popupEdit" class="popup">

    <h2>Modifier Compte</h2>

    <form method="POST" action="edit-account.php">

        <input type="hidden" name="id" id="edit_compte_id">

        <label>Type :</label>
        <select name="type_compte" id="edit_type">
            <option value="courant">Courant</option>
            <option value="épargne">Épargne</option>
            <option value="commercial">Commercial</option>
        </select>

        <label>Solde :</label>
        <input type="number" name="solde" id="edit_solde">

        <label>Client :</label>
        <select name="client_id" id="edit_client">
            <?php
            $cc = mysqli_query($conn, "SELECT * FROM client");
            while($cli = mysqli_fetch_assoc($cc)){
                echo "<option value='".$cli['client_id']."'>".$cli['name']."</option>";
            }
            ?>
        </select>

        <button type="submit" id="ajouter-comp">Modifier</button>
    </form>

    <button id="closeEditCompte" class="close-btn">Fermer</button>
</div>

<script>
    const openAdd = document.getElementById("openAdd");
    const closeAdd = document.getElementById("closeAdd");
    const popupAdd = document.getElementById("popupAdd");
    const overlay = document.getElementById("overlay");

    openAdd.onclick = () => {
        popupAdd.style.display = "block";
        overlay.style.display = "block";
    }

    closeAdd.onclick = () => {
        popupAdd.style.display = "none";
        overlay.style.display = "none";
    }

    overlay.onclick = () => {
        popupAdd.style.display = "none";
        overlay.style.display = "none";
    }
    function openEditCompte(btn){

    document.getElementById("edit_compte_id").value = btn.dataset.id;
    document.getElementById("edit_type").value      = btn.dataset.type;
    document.getElementById("edit_solde").value     = btn.dataset.solde;
    document.getElementById("edit_client").value    = btn.dataset.client;

    document.getElementById("popupEdit").style.display = "block";
    document.getElementById("overlayEdit").style.display = "block";
}

document.getElementById("closeEditCompte").onclick = function(){
    document.getElementById("popupEdit").style.display = "none";
    document.getElementById("overlayEdit").style.display = "none";
};

document.getElementById("overlayEdit").onclick = function(){
    document.getElementById("popupEdit").style.display = "none";
    document.getElementById("overlayEdit").style.display = "none";
};
</script>

</body>
</html>
