<?php
    include('includes/connect.php');
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List</title>
    <style>
         *{
    padding: 0;
    margin: 0;
 }
.navbar{
    width:100%;
    background:#003366;
    color:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-around;
    align-items:center;
}

.navbar h2 a{
    color:white;
    text-decoration:none;
}

.navbar a{
    background:#0066cc;
    padding:8px 15px;
    text-decoration:none;
    border-radius:6px;
    color:white;
    font-weight:bold;
}

.navbar a:hover{
    background:#004c99;
}

.lis_cl{
    text-align:center;
    margin-top:30px;
    font-size:28px;
    color:#003366;
    text-transform:uppercase;
}
.add-btn{
    display:inline-block;
    position:relative;
    left:150px;
    margin:20px 0;
    background:#28a745;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:6px;
    font-weight:bold;
}

.add-btn:hover{
    background:#1e7e34;
}
#ajouter-comp{
    margin:20px 0;
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
table{
    width:90%;
    margin:0 auto;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

table tr td, table th{
    padding:12px 15px;
    text-align:center;
}

table tr:nth-child(1){
    background:#003366;
    color:white;
    font-weight:bold;
}

table tr:nth-child(even){
    background:#f2f2f2;
}

.edit-btn{
    background:#ffc107;
    color:black;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}

.edit-btn:hover{
    background:#e0a800;
}

.delete-btn{
    background:#dc3545;
    color:white;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}

.delete-btn:hover{
    background:#b52a37;
}
/* الخلفية المعتمة */
.overlay{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(3px);
    z-index: 9;
}

/* صندوق البوب أب */
.popup{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 380px;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0px 5px 20px rgba(0,0,0,0.25);
    z-index: 10;
    animation: fadeIn 0.25s ease-out;
}

/* form style */
.popup form{
    display: flex;
    flex-direction: column;
}

.popup input{
    padding: 10px;
    margin-top: 6px;
    margin-bottom: 12px;
    border-radius: 6px;
    border: 1px solid #aaa;
}

.close-btn{
    margin-top: 10px;
    background: #dc3545;
    padding: 8px 14px;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
}

.hidden{
    display: none;
}

@keyframes fadeIn{
    from {opacity: 0; transform: translate(-50%, -45%);}
    to   {opacity: 1; transform: translate(-50%, -50%);}
}


    </style>
</head>
<body>
<section></section>
<div class="navbar">
<h2><a href="dashbord.php">Bankly Dashboard</a></h2>
<div>
        Bienvenue, <b><?php echo $_SESSION['username']; ?></b>
        <a href="logout.php">Logout</a>
</div>
</div>
<h3 class="lis_cl">Liste des Clients</h3>
<button id="openPopup" class="add-btn" type="button">+ Ajouter un client</button>
<table>
    <tr>
        <td>client id</td>
        <td>Name</td>
        <td>Email</td>
        <td>CIN</td>
        <td>Telephone</td>
        <td>created at</td>
        <td>Actions</td>
    </tr>
    <?php
    $sql="SELECT * FROM client";
    $result=mysqli_query($conn,$sql);
    ;
   ?>
   <?php while($row=mysqli_fetch_assoc($result)){?>
        <tr>
        <td><?php echo $row['client_id']?></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['cin']?></td>
        <td><?php echo $row['telephone']?></td>
        <td><?php echo $row['created_at']?></td>
        <td>
            <a class="edit-btn"
   href="#"
   data-id="<?php echo $row['client_id']; ?>"
   data-name="<?php echo $row['name']; ?>"
   data-email="<?php echo $row['email']; ?>"
   data-cin="<?php echo $row['cin']; ?>"
   data-telephone="<?php echo $row['telephone']; ?>"
   onclick="openEditPopup(this)">
   Edit
</a>

            <a class="delete-btn" href="delete_client.php?id=<?php echo $row['client_id']; ?>"
               onclick="return confirm('Supprimer ce client ?');">Delete</a>
        </td>
    </tr>
    <?php }  ?>
</table>
</section>
<section>
<div id="popupOverlay" class="overlay hidden"></div>

<div id="popupForm" class="popup hidden">
    <h2>Ajouter un client</h2>

    <form action="ajouter_client.php" method="POST">

        <label>Nom complet :</label>
        <input type="text" name="name" required>

        <label>Email :</label>
        <input type="email" name="email" required>

        <label>CIN :</label>
        <input type="text" name="cin" required>

        <label>Téléphone :</label>
        <input type="text" name="telephone" required>

        <button type="submit" id="ajouter-comp">Ajouter</button>
    </form>

    <button id="closePopup" class="close-btn">Fermer</button>
</div>
</section>
<section>
    <div id="editOverlay" class="overlay hidden"></div>

<div id="editPopup" class="popup hidden">
    <h2>Modifier Client</h2>

    <form id="editForm" method="POST" action="edit_client_action.php">

        <input type="hidden" name="id" id="edit_id">

        <label>Nom complet :</label>
        <input type="text" name="name" id="edit_name" required>

        <label>Email :</label>
        <input type="email" name="email" id="edit_email" required>

        <label>CIN :</label>
        <input type="text" name="cin" id="edit_cin" required>

        <label>Téléphone :</label>
        <input type="text" name="telephone" id="edit_telephone" required>

        <button type="submit" class="add-btn">Modifier</button>
    </form>

    <button id="closeEditPopup" class="close-btn">Fermer</button>
</div>

</section>
 <script>
    const openBtn = document.getElementById("openPopup");
    const closeBtn = document.getElementById("closePopup");
    const popup = document.getElementById("popupForm");
    const overlay = document.getElementById("popupOverlay");

    openBtn.onclick = function(){
        popup.classList.remove("hidden");
        overlay.classList.remove("hidden");
    };

    closeBtn.onclick = function(){
        popup.classList.add("hidden");
        overlay.classList.add("hidden");
    };

    overlay.onclick = function(){
        popup.classList.add("hidden");
        overlay.classList.add("hidden");
    };
    function openEditPopup(button) {

        // نجبد البيانات من data attributes
        document.getElementById("edit_id").value = button.dataset.id;
        document.getElementById("edit_name").value = button.dataset.name;
        document.getElementById("edit_email").value = button.dataset.email;
        document.getElementById("edit_cin").value = button.dataset.cin;
        document.getElementById("edit_telephone").value = button.dataset.telephone;

        // نبينو popup
        document.getElementById("editPopup").classList.remove("hidden");
        document.getElementById("editOverlay").classList.remove("hidden");
    }

    // زر الإغلاق
    document.getElementById("closeEditPopup").onclick = function(){
        document.getElementById("editPopup").classList.add("hidden");
        document.getElementById("editOverlay").classList.add("hidden");
    };

    // إغلاق عند الضغط على الخلفية
    document.getElementById("editOverlay").onclick = function(){
        document.getElementById("editPopup").classList.add("hidden");
        document.getElementById("editOverlay").classList.add("hidden");
    };

</script>
  
</body>
</html>    