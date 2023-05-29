

















<?php
require_once('functions.php');


if (isset($_POST['email'])) {

$bdd= connect();

// Récupérer la liste des utilisateurs en attente de validation
$sql = "SELECT * FROM users ";
$sth = $bdd->prepare($sql);
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_ASSOC);




    

if ($users) {
    // Vérifier si l'ID du produit saisi existe dans la base de données


    $email=$_POST["email"];
    $userExists = false;

    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $userExists = true;
            break;
        }
    }

    if ($userExists) {
        // Mettre à jour la quantité du produit à 0




   

         // Obtenir l'heure actuelle
    



if (isset($_POST['email'])) {
    $email =   $_POST['email']  ;


    if (isset($_POST['activer'])) {
        // Mettre à jour le champ 'validated' de l'utilisateur à 1 (accepté)
        $bdd = connect();
        $sql = "UPDATE users SET valide = 1 WHERE email = :email";
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':email', $email);
        $sth->execute();
    }
elseif (isset($_POST['desactiver'])) {
       
    $bdd = connect();
    $sql = "UPDATE users SET valide = 0 WHERE email = :email";
    $sth = $bdd->prepare($sql);
    $sth->bindValue(':email', $email);
    $sth->execute();


    }



}
    }
else{
    echo"email incorrect";
}




}
}
// 
?>










<!DOCTYPE html>
<html>
<head>
    <title>Messagerie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f1f1f1;
        }

        h2 {
            margin-top: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Envoyer un message à l'administrateur</h2>
    <form method="post" action="">

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        
        
        
        <input type="submit" name="desactiver" value="desactiver"  >

        <input type="submit" name="activer" value="activer"  >
    </form>
</body>
</html>