<?php
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $artworkId = $_POST['id'];
        $userId = $_SESSION['user']['id']; // Remplacez par la variable appropriée contenant l'ID de l'utilisateur connecté

        // Vérifier si l'utilisateur a déjà liké cette œuvre
        $bdd = connect();
        $sql = "SELECT * FROM likes WHERE id = :userId AND id_oeuvre = :artworkId";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':artworkId', $artworkId);
        $stmt->execute();
        $like = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($like) {
            // L'utilisateur a déjà liké cette œuvre, ne rien faire
            echo json_encode(['message' => 'Vous avez déjà liké cette œuvre.']);
            exit;
        }

        // Ajouter le like dans la table "likes"
        $sql = "INSERT INTO likes (id, id_oeuvre, likes) VALUES (:userId, :artworkId, 1)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':artworkId', $artworkId);
        $stmt->execute();

        // Mettre à jour le nombre de likes dans la table "œuvre"
        $sql = "UPDATE oeuvre SET likes = likes + 1 WHERE id_oeuvre = :artworkId";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':artworkId', $artworkId);
        $stmt->execute();

        // Récupérer le nombre de likes mis à jour
        $sql = "SELECT likes FROM oeuvre WHERE id_oeuvre = :artworkId";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':artworkId', $artworkId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retourner le nombre de likes au format JSON
        echo json_encode(['likes' => $result['likes']]);
    }
}
?>
