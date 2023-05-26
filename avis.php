<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notes et commentaires</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    require_once('functions.php');

    // Vérifier si l'administrateur est connecté
    if (!isset($_SESSION['admin'])) {
        // Rediriger l'administrateur vers la page de connexion
        header('Location: login_admin.php');
        exit;
    }

    // Connexion à la base de données
    $conn = connect();

    // Récupérer les données des notes et commentaires
    $sql = "SELECT notes.note, notes.commentaire, users.nom FROM notes INNER JOIN users ON notes.user_id = users.id";
    $result = $conn->query($sql);
    ?>

    <h1>Notes et commentaires</h1>

    <table>
        <tr>
            <th>Nom de l'utilisateur</th>
            <th>Note</th>
            <th>Commentaire</th>
        </tr>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['note']; ?></td>
                <td><?php echo $row['commentaire']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <?php
    $conn->close();
    ?>
</body>
</html>
