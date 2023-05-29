






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    /* Réinitialisation des styles par défaut */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Styles généraux */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      color: #333;
      line-height: 1.4;
    }

    .container {
      width: 7000px;
      max-width: 2500px;
      margin: 20px auto;
      padding: 20px;
    }

    .product-item {
      background-color: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(255, 255, 255, 35);
      display: flex;
    }

    .product-item img {
      width: 20%;
      max-height: 300px;
      object-fit: cover;
      border-radius: 4px;
      margin-bottom: 10px;
    }

   


    .product-item h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .product-item p {
      margin-bottom: 20px;
    }

    .buy-form {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
    }

    .buy-form label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    .buy-form input[type="number"] {
      width: 60px;
      padding: 5px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    .buy-form button {
      padding: 10px 20px;
      background-color: #ccc;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      align-self: flex-start;
      margin-top: 10px;
    }

    .buy-form button:hover {
      background-color: #999;
    }

    .error-message {
      color: #ff0000;
      margin-bottom: 10px;
    }

    .product-item {
      display: flex;

      margin-top: 100px;
      width: 30%;
      
      
    }

    .product-item img {
      width: 30%;
      margin-right: 20px;

      
      max-height: 200px;
      object-fit: cover;
      margin-bottom: 50px;
    }

    .product-item .product-details {
      flex-grow: 1;
    }

    .buy-form button {
      padding: 12px 24px;
      font-size: 16px;
      background-color: #555;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }



    body {
  font-family: Arial, sans-serif;
  line-height: 1.4;
  
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}


  </style>
</head>

<body>






 



<body>
  <div class="container">

  
    <?php
require_once ('functions.php');
  



    // Vérifier si le formulaire d'achat a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupérer les données du formulaire
      $productId = $_POST['product_id'];
      $quantity = $_POST['quantity'];

      // Connexion à la base de données
      $bdd = connect();

      // Vérifier la disponibilité du produit
      $sql = "SELECT quantite FROM produit WHERE id_produit = :id";
      $sth = $bdd->prepare($sql);
      $sth->bindValue(':id', $productId, PDO::PARAM_INT);
      $sth->execute();
      $product = $sth->fetch(PDO::FETCH_ASSOC);

      if ($product && $product['quantite'] >= $quantity) {
        // Mettre à jour la quantité du produit dans la base de données
  

        $newQuantity = $product['quantite'] - $quantity;
        $sql = "UPDATE produit SET quantite = :quantity WHERE id_produit = :id";
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':quantity', $newQuantity, PDO::PARAM_INT);
        $sth->bindValue(':id', $productId, PDO::PARAM_INT);
        $sth->execute();

        // Afficher un message de confirmation
        echo '<p>Votre achat a été effectué avec succès.</p>';


        header('Location: carte.php');

echo '<p>Votre achat a été effectué avec succès.</p>';


      } else {
        // Afficher un message d'erreur si le produit n'est pas disponible en quantité suffisante
        echo '<p>Le produit sélectionné n\'est pas disponible en quantité suffisante.</p>';
      }
    } else {
      // Vérifier si un produit a été sélectionné
      if (isset($_GET['id'])) {
        // Connexion à la base de données
        $bdd = connect();

        // Récupérer le produit correspondant à l'ID spécifié
        $productId = $_GET['id'];
        $sql = "SELECT * FROM produit WHERE id_produit = :id";
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':id', $productId, PDO::PARAM_INT);
        $sth->execute();
        $product = $sth->fetch(PDO::FETCH_ASSOC);

        if ($product) {
          echo '<div class="product-item">';
          echo '<img src="img/' . $product["picture"] . '" alt="' . utf8_encode($product["nom_produit"]) . '">';
          echo '<div class="product-details">';
          echo '<h2>' . utf8_encode($product["nom_produit"]) . '</h2>';
          echo '<p>' . utf8_encode($product["description_produit"]) . '</p>';

          // Formulaire d'achat pour le produit sélectionné
          echo '<form id="buy-form-' . $product["id_produit"] . '" class="buy-form" method="POST">';
          echo '<label>Quantité :</label>';
          echo '<input type="number" name="quantity" min="1" max="' . $product["quantite"] . '" required>';
          echo '<input type="hidden" name="product_id" value="' . $product["id_produit"] . '">';



          echo '<button type="submit">Terminer l\'achat</button>';
          echo '</form>';

          echo '</div>'; // Ferme la div .product-details
          echo '</div>'; // Ferme la div .product-item
        } else {
          echo '<p>Le produit sélectionné n\'existe pas.</p>';
        }
      } else {
        echo '<p>Aucun produit sélectionné.</p>';
      }
    }
    ?>
  </div>


  <script>
  // Récupérer tous les éléments de la classe "product-item" dans le DOM
  const productItems = document.querySelectorAll('.product-item');

  // Ajouter la classe "horizontal-scroll" à la div container pour activer le défilement horizontal
  document.querySelector('.container').classList.add('horizontal-scroll');

  // Parcourir les éléments de la classe "product-item"
  productItems.forEach((item) => {
    // Ajouter la classe "horizontal-scroll-item" à chaque élément pour les aligner horizontalement
    item.classList.add('horizontal-scroll-item');
  });
</script>




<style>
.container.horizontal-scroll {
  overflow-x: auto;
  white-space: nowrap;
}

.product-item.horizontal-scroll-item {
  display: inline-block;
  margin-right: 20px;
}

</style>




</body>

</html>


<?php
require_once ('_nav.php');
?>




