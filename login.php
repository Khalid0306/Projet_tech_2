<?php

    require_once('functions.php');

    if (isset($_POST["send"])) {
        $bdd = connect();
        $sql = "SELECT * FROM users WHERE `email` = :email;";
        
        $sth = $bdd->prepare($sql);


        if (!$sth) {
            die("Error during prepare: " . $bdd->errorInfo()[2]);
        }

        
        $sth->execute([
            'email'     => $_POST['email']
        ]);

        $user = $sth->fetch();
        
        if ($user && password_verify($_POST['password'], $user['password']) ) {
             //dd($user);
            //$_SESSION['user'] = $user;
            header('Location: admin.php');
        } else {
            $msg = "Email ou mot de passe incorrect !";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <?php require_once('_nave.php'); ?>
    <form action="" method="post">
        <h1>Connexion</h1>

        <?php if (isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

        <div>
            <label for="email">Email</label>
            <input 
                type="email" 
                placeholder="Entrez votre email" 
                name="email" 
                id="email" 
            />
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input 
                type="password" 
                placeholder="Entrez votre mot de passe" 
                name="password" 
                id="password" 
            />
        </div>
        <div>
            <input type="submit" name="send" value="Connexion" />
        </div>
    </form>
</body>
</html>