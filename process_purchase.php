<?php
require_once('functions.php');

// Vérifier si le formulaire d'achat a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $name = $_POST['name'];
  $credit_card = $_POST['credit_card'];

  // Connexion à la base de données
  $bdd = connect();

  // Vérifier si le produit existe
  $sql = "SELECT * FROM produit WHERE id_produit = :product_id";
  $sth = $bdd->prepare($sql);
  $sth->bindParam(':product_id', $product_id, PDO::PARAM_INT);
  $sth->execute();
  $product = $sth->fetch(PDO::FETCH_ASSOC);

  if ($product) {
    // Vérifier si la quantité demandée est disponible
    if ($product['quantité'] >= $quantity) {
      // Mettre à jour la quantité dans la base de données
      $new_quantity = $product['quantité'] - $quantity;
      $sql = "UPDATE produit SET quantité = :new_quantity WHERE id_produit = :product_id";
      $sth = $bdd->prepare($sql);
      $sth->bindParam(':new_quantity', $new_quantity, PDO::PARAM_INT);
      $sth->bindParam(':product_id', $product_id, PDO::PARAM_INT);
      $sth->execute();

      // Effectuer d'autres opérations d'achat, par exemple, enregistrer les coordonnées bancaires, envoyer un e-mail de confirmation, etc.

      // Afficher un message de succès
      echo "Achat effectué avec succès !";
    } else {
      // La quantité demandée n'est pas disponible
      echo "La quantité demandée n'est pas disponible.";
    }
  } else {
    // Le produit n'existe pas
    echo "Le produit n'existe pas.";
  }
} else {
  // Rediriger vers la page d'accueil si le formulaire n'a pas été soumis
  header('Location: index.php');
  exit;
}
?>
