<?php
include("includes/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bankly Login</title>

    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #e6eef5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box{
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-box h2{
            margin-bottom: 25px;
            color: #003366;
        }

        .login-box input{
            width: 95%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .login-box button{
            width: 100%;
            background: #0066cc;
            padding: 12px;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .login-box button:hover{
            background: #004c99;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>Bankly Login</h2>

    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Nom d'utilisateur">
        <input type="password" name="password" placeholder="Mot de passe">
        <button type="submit">Se Connecter</button>
    </form>
</div>

</body>
</html>

