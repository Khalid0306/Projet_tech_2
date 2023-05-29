<?php
require_once('functions.php');
$bdd = connect();

// Vérification de l'authentification de l'utilisateur
if (isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

//$user = $_SESSION['user'];

// Traitement du formulaire de modification des coordonnées
if (isset($_POST['update'])) {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $adresse = $_POST['adresse'];
    $pays = $_POST['pays'];

    // Validation des données
    $errors = array();

    if (empty($nom)) {
        $errors[] = "Le nom est obligatoire.";
    }

    if (empty($prenom)) {
        $errors[] = "Le prénom est obligatoire.";
    }

    if (!empty($password)) {
        // Si un nouveau mot de passe est saisi, on le met à jour
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE id = :id;";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'password' => $hashedPassword,
            'id' => $user['id']
        ]);
    }

    if (empty($sexe)) {
        $errors[] = "Le sexe est obligatoire.";
    }

    if (empty($adresse)) {
        $errors[] = "L'adresse est obligatoire.";
    }

    if (empty($pays)) {
        $errors[] = "Le pays est obligatoire.";
    }

    // Gestion de l'avatar
    if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])) {
        $avatar = $_FILES['avatar'];

        $allowedTypes = array('image/jpeg', 'image/png');
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Vérification du type de fichier
        if (!in_array($avatar['type'], $allowedTypes)) {
            $errors[] = "Le type de fichier de l'avatar n'est pas valide. Veuillez choisir une image au format JPEG ou PNG.";
        }

        // Vérification de la taille du fichier
        if ($avatar['size'] > $maxSize) {
            $errors[] = "La taille de l'avatar dépasse la limite autorisée (2MB). Veuillez choisir une image plus petite.";
        }

        // Génération d'un nom de fichier unique pour l'avatar
        $avatarName = uniqid() . '_' . $avatar['name'];

        // Déplacement du fichier temporaire vers le dossier des avatars
        $destination = 'avatars/' . $avatarName;
        move_uploaded_file($avatar['tmp_name'], $destination);

        // Mise à jour du nom de fichier de l'avatar dans la base de données
        $sql = "UPDATE users SET avatar = :avatar WHERE id = :id;";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'avatar' => $avatarName,
            'id' => $user['id']
        ]);

        // Mettre à jour l'avatar de l'utilisateur dans la session
        $_SESSION['user']['avatar'] = $avatarName;
    }

    // Mise à jour des autres coordonnées de l'utilisateur
    $sql = "UPDATE users SET nom = :nom, prenom = :prenom, sexe = :sexe, adresse = :adresse, pays = :pays WHERE id = :id;";
    $sth = $bdd->prepare($sql);
    $sth->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'sexe' => $sexe,
        'adresse' => $adresse,
        'pays' => $pays,
        'id' => $user['id']
    ]);

    // Redirection vers la page de profil avec un message de succès
    header('Location: profil_user.php?success=1');
    exit();
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
            Vos coordonnées ont été mises à jour avec succès.
        </div>
    <?php endif; ?>

    <h1>Profil</h1>
    <h2>Bienvenue, <?php echo htmlspecialchars($user['prenom']); ?>!</h2>

    <h3>Informations personnelles</h3>
    <form method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required /><br/><br/>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required /><br/><br/>

        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" id="password" /><br/><br/>

        <label for="sexe">Sexe :</label>
        <select name="sexe" id="sexe" required>
            <option value="">Sélectionnez</option>
            <option value="Masculin" <?php if (isset($user['sexe']) && $user['sexe'] === 'Masculin') echo 'selected'; ?>>Masculin</option>
            <option value="Féminin" <?php if (isset($user['sexe']) && $user['sexe'] === 'Féminin') echo 'selected'; ?>>Féminin</option>
        </select><br/><br/>

        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" value="<?php echo htmlspecialchars($user['adresse']); ?>" required /><br/><br/>

        <label for="pays">Pays :</label>
        <input type="text" name="pays" id="pays" value="<?php echo isset($user['pays']) ? htmlspecialchars($user['pays']) : ''; ?>" required /><br/><br/>

        <label for="avatar">Avatar :</label>
        <input type="file" name="avatar" id="avatar" /><br/><br/>

        <input type="submit" name="update" value="Mettre à jour" />
    </form>
</body>
</html>
