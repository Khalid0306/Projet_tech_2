<?php
require_once('functions.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Inclure le fichier de configuration de la base de données
require_once 'config.php';

$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur depuis la base de données
$sql = "SELECT * FROM users WHERE id = :id";
$sth = $bdd->prepare($sql);
$sth->bindParam(':id', $user_id, PDO::PARAM_INT);
$sth->execute();
$user = $sth->fetch(PDO::FETCH_ASSOC);

// Vérifier si le formulaire de mise à jour a été soumis
if (isset($_POST['update'])) {
    $errors = array();

    // Récupérer les nouvelles informations depuis le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $adresse = $_POST['adresse'];
    $pays = $_POST['pays'];
    $avatar = $_FILES['avatar'];

    // Vérifier les erreurs de téléchargement de l'avatar
    if ($avatar['error'] === UPLOAD_ERR_OK) {
        // Vérifier le type de fichier
        $mime = mime_content_type($avatar['tmp_name']);
        if (strpos($mime, 'image') === false) {
            $errors[] = "Le fichier téléchargé n'est pas une image valide.";
        } else {
            // Générer un nom unique pour l'avatar
            $avatarName = uniqid() . '.' . pathinfo($avatar['name'], PATHINFO_EXTENSION);
            // Déplacer l'avatar téléchargé vers le dossier d'avatars
            move_uploaded_file($avatar['tmp_name'], 'avatar/' . $avatarName);
            // Supprimer l'ancien avatar s'il existe
            if (!empty($user['avatar'])) {
                unlink('avatar/' . $user['avatar']);
            }
        }
    }

    // Vérifier s'il y a des erreurs
    if (empty($errors)) {
        // Mise à jour des autres coordonnées de l'utilisateur
        $sql = "UPDATE users SET nom = :nom, prenom = :prenom, sexe = :sexe, adresse = :adresse, pays = :pays, avatar = :avatar WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'sexe' => $sexe,
            'adresse' => $adresse,
            'pays' => $pays,
            'avatar' => $avatarName,
            'id' => $user_id
        ]);

        // Redirection vers la page de profil avec un message de succès
        header('Location: profil_user.php?success=1');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
    <?php if (!empty($errors)) : ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1) : ?>
        <div class="success">
            <p>Profil mis à jour avec succès.</p>
        </div>
    <?php endif; ?>

    <h1>Profil de <?php echo $user['nom']; ?></h1>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?php echo $user['nom']; ?>" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="<?php echo $user['prenom']; ?>" required><br>

        <label for="sexe">Sexe :</label>
        <select name="sexe" id="sexe" required>
            <option value="M" <?php if ($user['sexe'] == 'M') echo 'selected'; ?>>Masculin</option>
            <option value="F" <?php if ($user['sexe'] == 'F') echo 'selected'; ?>>Féminin</option>
        </select><br>

        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" value="<?php echo $user['adresse']; ?>" required><br>

        <label for="pays">Pays :</label>
        <input type="text" name="pays" id="pays" value="<?php echo $user['pays']; ?>" required><br>

        <label for="avatar">Avatar :</label>
        <input type="file" name="avatar" id="avatar" accept="image/*"><br>
        <?php if (!empty($user['avatar'])) : ?>
            <img src="avatar/<?php echo $user['avatar']; ?>" alt="Avatar" width="100"><br>
        <?php else : ?>
            <p>Aucun avatar.</p>
        <?php endif; ?>

        <input type="submit" name="update" value="Mettre à jour">
    </form>
</body>
</html>
