



<?php
require_once('functions.php');?>





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
      display: flex; /* Ajout de cette ligne */
      flex-direction: column; /* Ajout de cette ligne */
      justify-content: space-between; /* Ajout de cette ligne */
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

    .add-to-cart {
  position: fixed;
  top: 20px;
  right: 20px;
  padding: 10px 20px;
  background-color: green;
  color: #fff;
  text-decoration: none;
}




    
    .video-bar {
      background-color: #333;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .shop-now-btn {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-top: 20px;
      cursor: pointer;
    }


    .product-containere {
  overflow: hidden;
  width: 100%;
}

.product {
  display: flex;
  animation: scrollImages 10s infinite;
}

@keyframes scrollImages {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-100%);
  }
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
    <a href="#">Products</a>

    <a href="#" class="add-to-cart">Ajouter au panier</a>


</nav>

<div class="video-bar">
    <!-- Insérez ici le code pour intégrer votre vidéo -->
</div>
<div class="product-container">
<div class="product">
    <?php
    // Connexion à la base de données
    $bdd = connect();

    // Récupérer les produits de la base de données
    $sql = "SELECT * FROM produit WHERE id_produit IN (61, 62, 65, 69)";
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
</div>
<div class="shop-now">
    <a href="#" class="shop-now-btn">Shop Now</a>
</div>
</body>

<script>
  // Fonction pour faire défiler les images du carrousel
  function carouselScroll() {
    var productContainer = document.querySelector('.product');
    var productItems = document.querySelectorAll('.product-item');
    var scrollAmount = 1; // Quantité de défilement par frame (ajustez selon vos besoins)
    var scrollDelay = 10; // Délai entre chaque frame (ajustez selon vos besoins)
    var scrollPosition = 0;
    var imageWidth = productItems[0].offsetWidth; // Largeur d'une image

    // Clone de la première image
    var firstItemClone = productItems[0].cloneNode(true);
    productContainer.appendChild(firstItemClone);

    // Fonction pour effectuer un défilement par frame
    function scrollFrame() {
      if (scrollPosition < imageWidth) {
        productContainer.scrollLeft += scrollAmount;
        scrollPosition += scrollAmount;
        setTimeout(scrollFrame, scrollDelay);
      } else {
        scrollPosition = 0; // Réinitialiser la position du défilement à zéro
        productContainer.scrollLeft -= imageWidth; // Défiler d'une image vers la gauche
        setTimeout(scrollFrame, scrollDelay);
      }
    }

    // Appeler la fonction de défilement par frame
    scrollFrame();
  }

  // Appeler la fonction de défilement des images au chargement de la page
  window.onload = function() {
    carouselScroll();
  };
</script>








</html>
