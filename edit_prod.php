<?php
require_once('functions.php');

if (isset($_POST["Envoyer"])) {
   






$bdd = connect();

// Récupérer la liste des utilisateurs en attente de validation
$sql = "SELECT * FROM produit ";
$sth = $bdd->prepare($sql);
$sth->execute();
$prod = $sth->fetchAll(PDO::FETCH_ASSOC);







    
$nom_produit =$_POST['nom_produit'];
        $description_produit = $_POST['description_produit'];
        $picture = $_POST['picture'];
        $categorie= $_POST['categorie'];
        $quantite = $_POST['quantite'];

$id_produit=$_POST["id_produit"];
if ($prod) {
    // Vérifier si l'ID du produit saisi existe dans la base de données

    $productExists = false;

    foreach ($prod as $product) {
        if ($product['id_produit'] == $id_produit) {
            $productExists = true;
            break;
        }
    }

    if ($productExists) {
        // Mettre à jour la quantité du produit à 0




        $bdd = connect();

        $currentTime = date('Y-m-d H:i:s'); // Obtenir l'heure actuelle
    
        $updateSql = "UPDATE produit SET nom_produit = :nom_produit, description_produit = :description_produit, picture = :picture, categorie = :categorie, quantite = :quantite, updated_at = :currentTime WHERE id_produit = :id_produit";
        $updateSth = $bdd->prepare($updateSql); 
        $updateSth->bindValue(':currentTime', $currentTime);
        $updateSth->bindValue(':id_produit', $id_produit);
        $updateSth->bindValue(':nom_produit', $nom_produit);
        $updateSth->bindValue(':description_produit', $description_produit);
        $updateSth->bindValue(':picture', $picture);
        $updateSth->bindValue(':categorie', $categorie);
        $updateSth->bindValue(':quantite', $quantite);
        $updateSth->execute();
        




        // ...
        echo "Le produit a été modifié avec succès.";
    } else {
        echo "Le produit n'existe pas.";
    }
} else {
    echo "La base de données est vide.";
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


    <label for="id_produit">Entrez l'Id du produit a modifier     :</label>
        <input type="text" id="id_produit" name="id_produit" required><br><br>


        <label for="produit">Nom de produit :</label>
        <input type="text" id="nom_produit" name="nom_produit" required><br><br>

        <label for="description">description du produit:</label>
        <input type="text" id=" description_produit " name="description_produit" required><br><br>

        <label for="photo">nom de la photo:</label><br>
 <input type="text" id=" picture " name="picture" required><br><br>


 
 <label for="categorie ">categorie:</label><br>
 <input type="text" id=" categorie " name="categorie" required><br><br>

 <label for="quantite">Quantité :</label>
    <input type="number" id="quantite" name="quantite"><br><br>
    

        <input type="submit" name="Envoyer" value="modifier"  >
    </form>
</body>
</html>