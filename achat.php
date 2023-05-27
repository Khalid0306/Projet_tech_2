<?php
require_once('functions.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Site de vente</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    
    nav {
      background-color: #f1f1f1;
      padding: 10px;
      text-align: center;
    }
    
    nav a {
      text-decoration: none;
      color: #333;
      padding: 10px;
      margin: 0 5px;
    }
    
    .product {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
    }
    
    .product-item {
      width: 200px;
      margin: 20px;
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }
    
    .product-item img {
      width: 100%;
      max-height: 150px;
      object-fit: cover;
      margin-bottom: 10px;
    }
    
    .add-to-cart-btn {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 12px;
      margin-top: 10px;
      cursor: pointer;
    }

    .purchase-form {
      margin-top: 20px;
      padding: 20px;
      background-color: #f1f1f1;
    }

    .purchase-form label {
      display: block;
      margin-bottom: 10px;
    }

    .purchase-form input[type="text"],
    .purchase-form input[type="number"] {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }

    .purchase-form input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 12px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <header>
    <h1>Site de vente</h1>
  </header>
  
  <nav>
    <a href="#">Accueil</a>
    <a href="#">Visite</a>
    <a href="#" class="add-to-cart-btn">Ajouter au panier</a>
  </nav>
  
  <div class="product">
    <?php
    // Connexion à la base de données
    $bdd = connect();

    // Récupérer les produits de la base de données
    $sql = "SELECT * FROM produit";
    $sth = $bdd->prepare($sql);
    $sth->execute();
    $products = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        echo '<div class="product-item">';
        echo '<img src="img/' . $product["picture"] . '" alt="' . utf8_encode($product["nom_produit"]) . '">';
        echo '<h2>' . utf8_encode($product["nom_produit"]) . '</h2>';
        echo '<p>' . utf8_encode($product["description_produit"]) . '</p>';
        echo '<a href="payement.php?id=' . $product["id_produit"] . '" class="add-to-cart-btn">Acheter</a>';
        echo '</div>';
      }
      
    ?>
  </div>
</body>
</html>
