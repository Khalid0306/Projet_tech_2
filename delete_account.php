
<?php 
    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    $bdd = connect();

    if (isset($_POST['confirm'])) {
        $password = $_POST['password'];

        // Verify the password
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT * FROM users WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute(['id' => $user_id]);
        $user = $sth->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            // Password is correct, delete the account
            $sql="DELETE FROM users WHERE id = :id;";
            $sth = $bdd->prepare($sql);
            $sth->execute(['id' => $user_id]);

            session_destroy();

            header('Location: login.php?msg=Compte bien supprimé !');
        } else {
            // Password is incorrect, show an error message
            $error_msg = "Mot de passe incorrect";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le compte</title>
    <link rel="stylesheet" href="delete.css">
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <form action="" method="post">
        <h1>Supprimer le compte</h1>
        <p>Etes-vous sûr de vouloir supprimer votre compte ?</p>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" />
            <input type="submit" name="confirm" value="Confirmer la suppression" />
        </div>
        <?php if (isset($error_msg)) { ?>
            <p class="error"><?php echo $error_msg ?></p>
        <?php } ?>
    </form>
</body>
</html>
