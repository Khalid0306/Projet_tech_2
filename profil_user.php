<?php
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
    $email = $_POST['email'];

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

    if (empty($email)) {
        $errors[] = "L'adresse e-mail est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse e-mail n'est pas valide.";
    }

    // Gestion de l'avatar
    if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])) {
        // ...
    }

    // Vérification s'il y a des erreurs
    if (empty($errors)) {
        // Mise à jour des coordonnées dans la base de données
        $sql = "UPDATE users SET nom = :nom, prenom = :prenom, sexe = :sexe, adresse = :adresse, pays = :pays, email = :email WHERE id = :id;";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'sexe' => $sexe,
            'adresse' => $adresse,
            'pays' => $pays,
            'email' => $email,
            'id' => $user['id']
        ]);

        // Redirection vers la page du profil
        header('Location: profil_user.php');
        exit();
    }
}

// Récupération des informations du profil depuis la base de données
$sql = "SELECT * FROM users WHERE id = :id;";
$sth = $bdd->prepare($sql);
$sth->execute(['id' => $user['id']]);
$profil = $sth->fetch();

// Récupération de l'historique de l'utilisateur
$sql = "SELECT * FROM historique WHERE user_id = :user_id;";
$sth = $bdd->prepare($sql);
$sth->execute(['user_id' => $user['id']]);
$historique = $sth->fetchAll();

// Récupération de la liste des commandes en cours
$sql = "SELECT * FROM commandes WHERE user_id = :user_id AND etat = 'en cours';";
$sth = $bdd->prepare($sql);
$sth->execute(['user_id' => $user['id']]);
$commandesEnCours = $sth->fetchAll();

// Récupération de la liste des commandes déjà achetées
$sql = "SELECT * FROM commandes WHERE user_id = :user_id AND etat = 'acheté';";
$sth = $bdd->prepare($sql);
$sth->execute(['user_id' => $user['id']]);
$commandesAchetees = $sth->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Espace utilisateur</title>
</head>
<body>
    <h1>Espace utilisateur</h1>

    <h2>Profil utilisateur</h2>

    <!-- Affichage des erreurs -->
    <?php if (!empty($errors)) : ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Affichage du formulaire de modification des coordonnées -->
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?php echo $profil['nom']; ?>" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?php echo $profil['prenom']; ?>" required>
        </div>
        <div>
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="sexe">Sexe :</label>
            <select name="sexe" required>
                <option value="M" <?php if ($profil['sexe'] == 'M') echo 'selected'; ?>>Masculin</option>
                <option value="F" <?php if ($profil['sexe'] == 'F') echo 'selected'; ?>>Féminin</option>
            </select>
        </div>
        <div>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" value="<?php echo $profil['adresse']; ?>" required>
        </div>
        <div>
            <label for="pays">Pays :</label>
            <input type="text" name="pays" value="<?php echo $profil['pays']; ?>" required>
        </div>
        <div>
            <label for="email">Adresse e-mail :</label>
            <input type="email" name="email" value="<?php echo $profil['email']; ?>" required>
        </div>
        <div>
            <label for="avatar">Avatar :</label>
            <input type="file" name="avatar">
        </div>
        <div>
            <input type="submit" name="update" value="Enregistrer les modifications">
        </div>
    </form>

    <!-- Affichage de l'avatar actuel -->
    <div>
        <?php if (!empty($profil['avatar'])) : ?>
            <img src="<?php echo $profil['avatar']; ?>" alt="Avatar">
        <?php endif; ?>
    </div>

    <h2>Historique</h2>
    <ul>
        <?php foreach ($historique as $item) : ?>
            <li><?php echo $item['action']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Liste des commandes en cours</h2>
    <ul>
        <?php foreach ($commandesEnCours as $commande) : ?>
            <li><?php echo $commande['nom_produit']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Liste des commandes déjà achetées</h2>
    <ul>
        <?php foreach ($commandesAchetees as $commande) : ?>
            <li><?php echo $commande['nom_produit']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
