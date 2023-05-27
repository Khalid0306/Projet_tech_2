<?php








require_once('functions.php');






if (isset($_POST["Supprimer"])) {




//recupere les donnés des produits
    

$bdd = connect();

// Récupérer la liste des utilisateurs en attente de validation
$sql = "SELECT * FROM produit ";
$sth = $bdd->prepare($sql);
$sth->execute();
$prod = $sth->fetchAll(PDO::FETCH_ASSOC);







$quantite=0;

    


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
    
        $updateSql = "UPDATE produit SET quantite = :quantite, updated_at = :currentTime WHERE  id_produit = :id_produit";
        $updateSth = $bdd->prepare($updateSql);
        $updateSth->bindValue(':quantite', $quantite);
        $updateSth->bindValue(':currentTime', $currentTime);
        $updateSth->bindValue(':id_produit', $id_produit);
        $updateSth->execute();
    





        // ...
        echo "Le produit a été supprimé avec succès.";
    } else {
        echo "Le produit n'existe pas.";
    }
} else {
    echo "La base de données est vide.";
}

    //$bdd = connect();

    //$sql = "DELETE FROM produit WHERE id_produit = :id_produit";

    //$sth = $bdd->prepare($sql);

   // $success = $sth->execute([
    //    ':id_produit' => $_POST['id_produit']
   // ]);

    //if ($success) {
    //    echo "Le produit a été supprimé avec succès de la base de données.";
   // } else {
   //     echo "Erreur lors de la suppression du produit : " . $sth->errorInfo()[2];
   // }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un produit</title>
    <!-- styles CSS et autres balises head nécessaires -->
</head>
<body>
    <h2>Supprimer un produit de la base de données</h2>
    <form method="post" action="">
        <label for="id_produit">ID du produit :</label>
        <input type="text" id="id_produit" name="id_produit" required><br><br>

        <input type="submit" name="Supprimer" value="Supprimer">
    </form>
</body>
</html>
