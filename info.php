<?php

require_once('functions.php');

// Vérifier si l'administrateur est connecté
session_start();
if (!isset($_SESSION['admin'])) {
    // Rediriger l'administrateur vers la page de connexion
    header('Location: login_admin.php');
    exit;
}

$bdd = connect();

// Récupérer la liste des utilisateurs en attente de validation
$sql = "SELECT * FROM users WHERE validated = 0";
$sth = $bdd->prepare($sql);
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_ASSOC);

// Valider un utilisateur
if (isset($_GET['validate'])) {
    $userId = $_GET['validate'];

    // Mettre à jour le statut de l'utilisateur comme validé
    $sql = "UPDATE users SET validated = 1 WHERE id = :userId";
    $sth = $bdd->prepare($sql);
    $sth->execute(['userId' => $userId]);

    // Rediriger l'administrateur vers la page des notifications après validation
    header('Location: notifications.php');
    exit;
}

?>

<?php require_once('_header.php'); ?>
<div class="container1">
    <h1>Notifications</h1>
    <?php if (count($users) > 0): ?>
        <ul>
            <?php foreach ($users as $user): ?>
                <li>
                    Email: <?php echo $user['email']; ?>
                    <a href="notifications.php?validate=<?php echo $user['id']; ?>">Valider</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No new notifications.</p>
    <?php endif; ?>
</div>
</body>
</html>
