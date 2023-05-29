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
      

        //mtre a jour le temps
        
        $bdd = connect();
        $sql = "DELETE FROM users WHERE id = :user_id";
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':user_id', $userId);
        $sth->execute();


        echo "compte supprimé  avec succès.";
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



        <input type="submit" name="Envoyer" value="delette"  >
    </form>
</body>
</html>