<?php
require_once('functions.php');

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];


    if (isset($_POST['accept'])) {
        // Mettre à jour le champ 'validated' de l'utilisateur à 1 (accepté)
        $bdd = connect();
        $sql = "UPDATE users SET validated = 1 WHERE id = :user_id";
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':user_id', $user_id);
        $sth->execute();
    }
elseif (isset($_POST['reject'])) {
        // Supprimer l'utilisateur de la base de données
        $bdd = connect();
        $sql = "DELETE FROM users WHERE id = :user_id";
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':user_id', $user_id);
        $sth->execute();
    }
}

// Rediriger l'administrateur vers la page de notifications après le traitement
header('Location: admin.php');
exit();
?>
