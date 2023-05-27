
<?php

require_once('functions.php');

$bdd = connect();

$query = "SELECT picture FROM produit";

$sth = $bdd->prepare($sql);


    $picture = $row['picture'];
    header("Content-type: img/T-shirt la Cene.jpg "); // Remplacez "image/jpeg" par le type de contenu approprié de votre image
    echo $picture;

?>