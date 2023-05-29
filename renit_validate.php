<?php
require_once('functions.php');

date_default_timezone_set('Europe/Paris');

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $new_password = $_POST['password'];

    if (isset($_POST['accept'])) {
        // Mettre à jour le champ 'validated' de l'utilisateur à 1 (accepté)

        $bdd = connect();
        
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $currentTime = date('Y-m-d H:i:s'); // Obtenir l'heure actuelle
        
        $updateSql = "UPDATE users SET password = :password, updated_at = :currentTime WHERE email = :email";
        $updateSth = $bdd->prepare($updateSql);
        $updateSth->bindValue(':password', $hashedPassword);
        $updateSth->bindValue(':currentTime', $currentTime);
        $updateSth->bindValue(':email', $email);
        $updateSth->execute();


        
        
        $sql = "UPDATE users SET valide = 1 WHERE email = :email";
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':email', $email);
        $sth->execute();
        
        header('Location: login.php');
        exit();
    }
    elseif (isset($_POST['reject'])) {
        $bdd = connect();
        $sql = "UPDATE users SET valide = 0 WHERE email = :email";
        $sth = $bdd->prepare($sql);
        $sth->bindValue(':email', $email);
        $sth->execute();
        
        header('Location: login.php');
         
        exit();
    }
}
?>
