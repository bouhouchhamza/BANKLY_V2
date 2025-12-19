<?php
include("includes/connect.php");

$client_id = $_GET['client_id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM compte WHERE client_id = $client_id"
);

while($row = mysqli_fetch_assoc($result)){
    echo "<option value='{$row['compte_id']}'>
            Compte #{$row['compte_id']} ({$row['type_compte']})
          </option>";
}
