<?php
// Configuration de la base de données
$servername = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "projet_tech_musee.sql";

// Connexion à la base de données
//$conn = new mysqli($servername, $username, $password, $dbname);
//if ($conn->connect_error) {
 //   die("Échec de la connexion à la base de données : " . $conn->connect_error);
//}


$errors = array();
$success = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données
    $nom = validateInput($_POST["nom"]);
    $prenom = validateInput($_POST["prenom"]);
    $sexe = validateInput($_POST["sexe"]);
    $pays = validateInput($_POST["pays"]);
    $email = validateInput($_POST["email"]);

    // Validation de l'avatar
    $avatar = $_FILES["avatar"];
    $avatarName = $avatar["name"];
    $avatarTmpName = $avatar["tmp_name"];
    $avatarSize = $avatar["size"];
    $avatarError = $avatar["error"];

    // Vérification des champs obligatoires
    if (empty($nom)) {
        $errors[] = "Le champ Nom est obligatoire.";
    }

    if (empty($prenom)) {
        $errors[] = "Le champ Prénom est obligatoire.";
    }

    if (empty($email)) {
        $errors[] = "Le champ Adresse e-mail est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse e-mail n'est pas valide.";
    }

    // Vérification des erreurs avant la sauvegarde des données
    if (empty($errors)) {
        // Vérification et traitement de l'avatar
        if ($avatarError === UPLOAD_ERR_OK) {
            $avatarPath = "avatars/" . $avatarName;
            move_uploaded_file($avatarTmpName, $avatarPath);
        } elseif ($avatarError !== UPLOAD_ERR_NO_FILE) {
            $errors[] = "Une erreur est survenue lors du téléchargement de l'avatar.";
        }

        // Échappement des données pour éviter les injections SQL
        $nom = $conn->real_escape_string($nom);
        $prenom = $conn->real_escape_string($prenom);
        $sexe = $conn->real_escape_string($sexe);
        $pays = $conn->real_escape_string($pays);
        $email = $conn->real_escape_string($email);
        $avatarPath = $conn->real_escape_string($avatarPath);

        // Requête SQL pour la mise à jour des données de l'utilisateur
        $sql = "UPDATE utilisateurs SET nom='$nom', prenom='$prenom', sexe='$sexe', pays='$pays', email='$email', avatar='$avatarPath' WHERE id=$userId";

        if ($conn->query($sql) === TRUE) {
            $success = true;
        } else {
            $errors[] = "Une erreur est survenue lors de la mise à jour des données : " . $conn->error;
        }
    }
}


function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$userId = 1; // ID de l'utilisateur à récupérer (à adapter selon votre système)
$sql = "SELECT * FROM utilisateurs WHERE id=$userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nom = $row["nom"];
    $prenom = $row["prenom"];
    $sexe = $row["sexe"];
    $pays = $row["pays"];
    $email = $row["email"];
    $avatar = $row["avatar"];
} else {
    $errors[] = "Utilisateur non trouvé.";
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Utilisateur</title>
</head>
<body>
    <h1>Profil Utilisateur</h1>

    <?php if ($success): ?>
        <div class="success">Les données ont été mises à jour avec succès.</div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo $nom; ?>">

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="<?php echo $prenom; ?>">

        <label for="sexe">Sexe :</label>
        <select name="sexe">
            <option value="homme" <?php if ($sexe === "homme") echo "selected"; ?>>Homme</option>
            <option value="femme" <?php if ($sexe === "femme") echo "selected"; ?>>Femme</option>
        </select>

        <label for="pays">Pays :</label>
        <input type="text" name="pays" value="<?php echo $pays; ?>">

        <label for="email">Adresse e-mail :</label>
        <input type="text" name="email" value="<?php echo $email; ?>">

        <label for="avatar">Avatar :</label>
        <input type="file" name="avatar">

        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
