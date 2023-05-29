





<?php


require_once('functions.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    // Affichez les informations saisies

    
    // Vous pouvez également enregistrer les données dans votre base de données si nécessaire
    // Assurez-vous d'avoir une connexion à votre base de données active avant d'exécuter les requêtes



// Connectez-vous à votre base de données
$bdd = connect();

// Récupérez les valeurs des paramètres depuis les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$password = $_POST['password'];
$sexe = $_POST['sexe'];
$adresse = $_POST['adresse'];
$pays = $_POST['pays'];
$avatar = $_POST['avatar'];

// Préparez la requête d'insertion
$sql = "INSERT INTO users (nom, prenom, password, sexe, adresse, pays, avatar) VALUES (:nom, :prenom, :password, :sexe, :adresse, :pays, :avatar)";
$sth = $bdd->prepare($sql);
if (!$sth) {
    die("Error during prepare: " . $bdd->errorInfo()[2]);
}

// Associez les valeurs des paramètres à partir des données du formulaire
$sth->bindParam(':nom', $nom);
$sth->bindParam(':prenom', $prenom);
$sth->bindParam(':password', $password);
$sth->bindParam(':sexe', $sexe);
$sth->bindParam(':adresse', $adresse);
$sth->bindParam(':pays', $pays);
$sth->bindParam(':avatar', $avatar);

// Exécutez la requête d'insertion
if ($sth->execute()) {
    echo "Données insérées avec succès dans la base de données.";
} else {
    echo "Erreur lors de l'insertion des données : " . $sth->errorInfo()[2];
}





    // ... Code pour insérer les données dans votre base de données ...
}
?>
<img src="img/<?php echo $avatar; ?>" alt="Avatar" style="float: left;">
