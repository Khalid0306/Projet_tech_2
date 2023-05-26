<?php
require_once('functions.php');

//definit l'heure de mis a jour au format paris

date_default_timezone_set('Europe/Paris');





if (isset($_POST['Envoyer'])) {


    //recupere l'email envoyé par l'utilisateur
    $email = $_POST['email'];

    //recupere le mot de passe envoyé par l'utilisateur
    $newPassword = $_POST['msg'];

    // Recherche de l'utilisateur dans la base de données
    $bdd = connect();
    $sql = "SELECT * FROM users WHERE email = :email";
    $sth = $bdd->prepare($sql);
    $sth->bindValue(':email', $email);
    $sth->execute();
    $user = $sth->fetch();

    if ($user) {
        // Mettre à jour le mot de passe de l'utilisateur correspondant
        $userId = $user['id'];

//crypte le password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      

        //mtre a jour le temps
        $currentTime = gmdate('Y-m-d H:i:s'); // Obtenir l'heure GMT
        $timeZone = new DateTimeZone('Europe/Paris'); // Fuseau horaire souhaité
        $dateTime = new DateTime($currentTime, $timeZone);//defini l'heure souhaiter au format paris
        $adjustedTime = $dateTime->format('Y-m-d H:i:s');//ajuste le temps
        



        $updateSql = "UPDATE users SET password = :password, updated_at = :currentTime WHERE id = :userId";
        $updateSth = $bdd->prepare($updateSql);

        //assure que la valeur du mot de passe haché est correctement liée au paramètre :password dans la requête SQL
        $updateSth->bindValue(':password', $hashedPassword);
        //
        $updateSth->bindValue(':currentTime', $currentTime);
        $updateSth->bindValue(':userId', $userId);
        $updateSth->execute();
    
        echo "Mot de passe mis à jour avec succès.";
    } else {
        echo "Aucun utilisateur correspondant à cet e-mail.";
    }
    



}














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

        <label for="message">Message :</label><br>
        <textarea id="msg" name="msg" required></textarea><br><br>



        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>



        <input type="submit" name="Envoyer" value="create"  >
    </form>
</body>
</html>