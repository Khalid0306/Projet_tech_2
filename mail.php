

<?php


require_once('functions.php');

if (isset($_POST["Envoyer"])) {
    $bdd = connect();
    

    $sql = "INSERT INTO messagerie (`email`, `message`,`nom`,`sujet`) VALUES (:email, :message ,:nom,:sujet);";
    


    

    $sth = $bdd->prepare($sql);
    


    $success = $sth->execute([
        'email'     => $_POST['email'],


        'message'     => $_POST['message'],


        'nom'     => $_POST['nom'],



        'sujet'     => $_POST['sujet']


       
    ]);
   
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
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="sujet">Sujet :</label>
        <input type="text" id="sujet" name="sujet" required><br><br>

        <label for="message">Message :</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <input type="submit" name="Envoyer" value="create"  >
    </form>
</body>
</html>


