<?php
require_once('functions.php');



?>


<?php
require_once('_head.php');


?>


<!-- start tri-corps -->
<div class="container">
  <div id="electrique" class="section">
    <div class="content">
      <h1>Découvrez notre rebrique 
        100/% Africaine</h1>
      <h4><a href="afrique.php">Decouvrez l'Afrique en peinture.</a></h4>
    </div>
    <div class="overlay"></div>
  </div>
  <div id="disponibles" class="section">
    <div class="content">
    <h1>Nos modèles disponibles immédiatement</h1>
      <h4><a href="afrique.php">Accedez a la boutique et decouvrez.</a></h4>
    </div>
    <div class="overlay"></div>
  </div>
  <div id="rs" class="section">
    <div class="content">
<div class="row">
  <div class="col-sm-4"> <span> <div class="rhombus"></div></span>
    <h1>VOGUE</h1>
    </div>
</div>
      <h4><a href="sape.php">Decouvrez notre 
        rubriques 100% mode.</a></h4>
    </div>
    <div class="overlay"></div>
  </div>
</div>

<!-- fin tri-corps -->
<p> 
  <br>
  <!-- START etage 2-->
  <body>
    
<header>
   
</header>

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
      width: 300px;
      margin: 5px;
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }
    
    .product-item img {
      width: 100%;
      max-height: 400px;
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
    </style>

<div class="video-bar">
    <!-- Insérez ici le code pour intégrer votre vidéo -->
</div>
<div class="product-container">
<div class="product">
    <?php
    // Connexion à la base de données
    $bdd = connect();

    // Récupérer les produits de la base de données
    $sql = "SELECT * FROM produit WHERE id_produit  IN( 112,113,114,115,116,117,118,61,62,63,64,65,67,68,69,70)";
    $sth = $bdd->prepare($sql);
    $sth->execute();
    $products = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        echo '<div class="product-item">';
        echo '<img src="img/' . $product["picture"] . '" alt="' . utf8_encode($product["nom_produit"]) . '">';
        echo '<h2>' . utf8_encode($product["nom_produit"]) . '</h2>';
        echo '<p>' . utf8_encode($product["description_produit"]) . '</p>';

        echo '<p>' . number_format($product["prix"], 2, ',', '.') . ' €</p>';


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