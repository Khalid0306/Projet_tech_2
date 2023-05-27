<?php
require_once('functions.php');

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
      echo '<h2>' . utf8_encode($product["nom_produit"]) . '</h2>';
      echo '<p>' . utf8_encode($product["description_produit"]) . '</p>';

      // Formulaire d'achat pour le produit sélectionné
      echo '<form id="buy-form-' . $product["id_produit"] . '" class="buy-form" method="POST">';
      echo '<label>Quantité :</label>';
      echo '<input type="number" name="quantity" min="1" max="' . $product["quantite"] . '" required>';
      echo '<input type="hidden" name="product_id" value="' . $product["id_produit"] . '">';
      echo '<button type="submit">Terminer l\'achat</button>';
      echo '</form>';

      echo '</div>';
    } else {
      echo '<p>Le produit sélectionné n\'existe pas.</p>';
    }
  } 

 else {
    echo '<p>Aucun produit sélectionné.</p>';
  }
}
?>
