<?php
session_start();

require_once('function.php');
$bdd = connect();

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];

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
    if ($_FILES['avatar']['name']) {
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
    }

    // Vérification des erreurs
    if (count($errors) === 0) {
        // Mise à jour des coordonnées dans la base de données
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
}

// Récupération des données de l'utilisateur depuis la base de données
$sql = "SELECT * FROM users WHERE id = :id;";
$sth = $bdd->prepare($sql);
$sth->execute([
    'id' => $user['id']
]);

$user = $sth->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil utilisateur</title>
    <style>
        body {
            background-image: url(img/csm_img_bandeau_musee_ec5567aba3.jpg);
            background-size: cover;
            background-position: center;
        }
    </style>
    <link rel="stylesheet" href="Style/login.css">
</head>
<body>
    <?php require_once('_header.php'); ?>

    <div class="center">
        <h1>Profil utilisateur</h1>

        <?php
        // Affichage des erreurs
        if (isset($errors) && count($errors) > 0) {
            echo '<div class="errors">';
            foreach ($errors as $error) {
                echo '<div>' . $error . '</div>';
            }
            echo '</div>';
        }

        // Affichage du message de succès après la mise à jour des coordonnées
        if (isset($_GET['success']) && $_GET['success'] === '1') {
            echo '<div class="success">Vos coordonnées ont été mises à jour avec succès.</div>';
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="txt_field">
                <input type="text" name="nom" id="nom" value="<?php echo $user['nom']; ?>" required />
                <label for="nom">Nom</label>
            </div>

            <div class="txt_field">
                <input type="text" name="prenom" id="prenom" value="<?php echo $user['prenom']; ?>" required />
                <label for="prenom">Prénom</label>
            </div>

            <div class="txt_field">
                <input type="password" name="password" id="password" />
                <label for="password">Mot de passe</label>
            </div>

            <div class="txt_field">
                <select name="sexe" id="sexe" required>
                    <option value="">Sélectionnez le sexe</option>
                    <option value="homme" <?php echo ($user['sexe'] === 'homme') ? 'selected' : ''; ?>>Homme</option>
                    <option value="femme" <?php echo ($user['sexe'] === 'femme') ? 'selected' : ''; ?>>Femme</option>
                </select>
                <label for="sexe">Sexe</label>
            </div>

            <div class="txt_field">
                <input type="text" name="adresse" id="adresse" value="<?php echo $user['adresse']; ?>" required />
                <label for="adresse">Adresse postale</label>
            </div>

            <div class="txt_field">
                <input type="text" name="pays" id="pays" value="<?php echo $user['pays']; ?>" required />
                <label for="pays">Pays</label>
            </div>

            <div class="txt_field">
                <input type="file" name="avatar" id="avatar" accept="image/*" />
                <label for="avatar">Avatar</label>
            </div>

            <div>
                <input type="submit" class="btn btn-green" name="update" value="Enregistrer" />
            </div>
        </form>
    </div>
</body>
</html>
