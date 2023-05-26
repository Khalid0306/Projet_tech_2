<!DOCTYPE html>
<html>
<head>
    <title>Page Produit</title>
    <link rel="stylesheet" type="text/css" href="style_b.css">
</head>
<body>
    <div class="container">
        <div class="product-image">
            <img src="img/La Pieta.jpg" alt="Image du produit">
        </div>
        <div class="product-info">
            <h1>Nom de l'œuvre d'art</h1>
            <p>Description du produit</p>
            <p>Prix : $XX</p>
            <form action="process_command.php" method="post">
                <input type="hidden" name="product_id" value="ID_DU_PRODUIT">
                <input type="number" name="quantity" min="1" max="10" value="1">
                <input type="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
</body>



</html>


