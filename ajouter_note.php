<?php
require_once('functions.php');
require_once('_header.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

if (isset($_POST["Envoyer"])) {
    $bdd = connect();

    $username = $_POST['username'];
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];

    // Validation de la note
    if ($note < 1 || $note > 10) {
        echo "Veuillez saisir une note valide (entre 1 et 10).";
    } else {
        $sql = "INSERT INTO notes (`username`, `note`, `commentaire`) VALUES (:username, :note, :commentaire);";
        
        $sth = $bdd->prepare($sql);
        
        $success = $sth->execute([
            'username' => $username,
            'note' => $note,
            'commentaire' => $commentaire
        ]);

        if ($success) {
            echo "Note ajoutée avec succès.";
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la note.";
        }
    }
}
?>

// Connexion à la base de données





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
    <label for="sujet">username :</label>
        <input type="text" id="username" name="username" required><br><br>
    
    <label for="note">Note :</label>
    <input type="number" id="note"   name="note" min="1" max="10" required>
    
    


    

        <label for="sujet">commentaire :</label>
        <input type="text" id="commentaire" name="commentaire" required><br><br>
   



        <input type="submit" name="Envoyer"  value="create" >

        </form>
</body>
<title>Messagerie</title>
    <style>
        /* Styles CSS existants */

        /* ... */

        /* Nouveau style pour le bouton de consultation */
        .consultation-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Formulaire existant -->

    <!-- ... -->

    <a href="affiche_avis.php"  class="consultation-link" >Consulter les avis d'autres utilisateurs du site</a>
</body>
</html>
<?php 

require_once('_footer.php');?>