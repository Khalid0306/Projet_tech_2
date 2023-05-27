<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['produits'])) {
        $selectedProducts = $_POST['produits'];
        
        // Traitez les produits sélectionnés selon vos besoins
        // par exemple, enregistrez-les dans la base de données, générez une facture, etc.

        // Exemple de sortie pour vérification
        echo "Produits sélectionnés : ";
        foreach ($selectedProducts as $product) {
            echo $product . ", ";
        }
    } else {
        echo "Aucun produit sélectionné.";
    }
}
?>
