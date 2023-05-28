<?php
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $artworkId = $_POST['id'];

        // Mettez à jour le nombre de likes dans la base de données
        $bdd = connect();
        $sql = "UPDATE oeuvre SET likes = likes + 1 WHERE id_oeuvre = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $artworkId);
        $stmt->execute();

        // Récupérer le nombre de likes mis à jour
        $sql = "SELECT likes FROM oeuvre WHERE id_oeuvre = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $artworkId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retourner le nombre de likes au format JSON
        echo json_encode(['likes' => $result['likes']]);
    }
}
?>
