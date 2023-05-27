<?php
require_once('functions.php');

if (isset($_POST["Envoyer"])) {
    $bdd = connect();
    
    $sql = "INSERT INTO produit (`nom_produit`, `description_produit`, `picture`, `categorie`, `quantite`) VALUES (:nom_produit, :description_produit, :picture, :categorie, :quantite)";
    
    $sth = $bdd->prepare($sql);
    
    $success = $sth->execute([
        ':nom_produit' => $_POST['nom_produit'],
        ':description_produit' => $_POST['description_produit'],
        ':picture' => $_POST['picture'],
        ':categorie' => $_POST['categorie'],
        ':quantite' => $_POST['quantite']
    ]);

    if ($success) {
        echo "Les valeurs ont été insérées avec succès dans la base de données.";
    } else {
        echo "Erreur lors de l'insertion des valeurs : " . $sth->errorInfo()[2];
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
        <label for="produit">Nom de produit :</label>
        <input type="text" id="nom_produit" name="nom_produit" required><br><br>

        <label for="description">description du produit:</label>
        <input type="text" id=" description_produit " name="description_produit" required><br><br>

        <label for="photo">nom de la photo:</label><br>
 <input type="text" id=" picture " name="picture" required><br><br>


 
 <label for="categorie ">nom de la photo:</label><br>
 <input type="text" id=" categorie " name="categorie" required><br><br>

 <label for="quantite">Quantité :</label>
    <input type="number" id="quantite" name="quantite"><br><br>
    

        <input type="submit" name="Envoyer" value="create"  >
    </form>
</body>
</html>
