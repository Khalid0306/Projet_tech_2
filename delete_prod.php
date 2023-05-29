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






<style>
body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
}

.container {
  max-width: 600px;
  margin: 50px auto;
  padding: 20px;
  background-color: #ffffff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.notification {
  margin-bottom: 20px;
  padding: 10px;
  border-radius: 5px;
  background-color: #f9f9f9;
  border: 1px solid #cccccc;
}

.notification h3 {
  margin: 0;
  font-size: 18px;
  color: #333333;
}

.notification p {
  margin: 10px 0;
  font-size: 14px;
  color: #666666;
}

.notification hr {
  border: none;
  border-top: 1px solid #cccccc;
  margin: 10px 0;
}




</style>
<title>Barre de navigation</title>
  <style>
    /* Styles pour la barre de navigation */
    ul.nav {
      list-style-type: none;
      margin: 0;
      padding: 0;
      background-color: #279BE4;
    }
    ul.nav li {
      display: inline-block;
    }
    ul.nav li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    ul.nav li a:hover {
      background-color: #01A9F0;
    }
  </style>

<!DOCTYPE html>
<html>
<head>
  <title>Notification</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Ajouter une animation de fade-in aux notifications
      $(".notification").hide().fadeIn(1000);

      // Ajouter une fonctionnalité de fermeture aux notifications
      $(".close-btn").click(function() {
        $(this).closest(".notification").fadeOut(500);
      });
    });
  </script>

<ul class="nav">
      <li><a href="dasboard.php">Dashboard</a></li>
      <li><a href="#">Notifications</a></li>
      <li><a href="https://mail.google.com/mail/u/1/#inbox">Mail</a></li>
    </ul>







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
