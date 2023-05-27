<?php








require_once('functions.php');






if (isset($_POST["Augmenter"])) {



    $bdd = connect();

    // Récupérer la liste des utilisateurs en attente de validation
    $sql = "SELECT * FROM produit ";
    $sth = $bdd->prepare($sql);
    $sth->execute();
    $prod = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    
    
    




//recupere les donnés des produits
    
    $quantite=$_POST['quantite'];




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
            // Mettre à jour la quantité a jour







            $bdd = connect();

            $currentTime = date('Y-m-d H:i:s'); // Obtenir l'heure actuelle
        
            $updateSql = "UPDATE produit SET quantite = :quantite, updated_at = :currentTime WHERE  id_produit = :id_produit";
            $updateSth = $bdd->prepare($updateSql);
            $updateSth->bindValue(':quantite', $quantite);
            $updateSth->bindValue(':currentTime', $currentTime);
            $updateSth->bindValue(':id_produit', $id_produit);
            $updateSth->execute();
        
        
        



            // ...
            echo "Le produit a été mis a jour avec succès.";
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
    <title>augmenter produit</title>
    <!-- styles CSS et autres balises head nécessaires -->
</head>
<body>
    <h2>augmenter la quantie des produits </h2>
    <form method="post" action="">
        <label for="id_produit">ID du produit :</label>
        <input type="text" id="id_produit" name="id_produit" required><br><br>



        <label for="quantite"> nouvelle quantite :</label>
    <input type="number" id="quantite" name="quantite"><br><br>


        <input type="submit" name="Augmenter" value="Augmenter">
    </form>
</body>
</html>