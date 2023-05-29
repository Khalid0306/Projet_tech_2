<?php
require_once('functions.php');

//definit l'heure de mis a jour au format paris

date_default_timezone_set('Europe/Paris');


if (isset($_POST['envoyer'])) {


    $email = $_POST['email'];

    $new_passwordd = $_POST['password'];

    $bdd = connect();
    $sql = "SELECT * FROM users WHERE `email` = :email;";
    ///$sth->bindValue(':email', $email);
    $sth = $bdd->prepare($sql);

    //if (!$sth) {
    // die("Error during prepare: " . $bdd->errorInfo()[2]);
    //}

    $sth->execute([
        'email'     => $_POST['email']
    ]);

    $user = $sth->fetch();


    if ($user && password_verify($_POST['password_old'], $user['password'])) {


        
            $msg = "votre demande a bien ete transmise !";

            
    }
        else {

            $msg = " verifier les donnés saisie !";  

           
        }
    } else {
        $msg = "Email ou mot de passe incorrect !";
    }


?>

<?php require_once('_header.php'); ?>
<link rel="stylesheet" href="Style/login.css">
<style>
    body {
        background-image: url(img/csm_img_bandeau_musee_ec5567aba3.jpg);
        background-size: cover;
        background-position: center;
    }
</style>
<div class="center">
    <form action="" method="post">
        <h1>Welcome back !</h1>

        <?php if (isset($msg)) {
            echo "<div>" . $msg . "</div>";
        } ?>

        <div class="txt_field">

            <input type="email" name="email" id="email" required />
            <label for="email">email</label>

        </div>


        <div class="txt_field">

            <input type="password" name="password_old" id="password_old" required />
            <label for="password_old">ancien mot de passe</label>

        </div>
        <div class="txt_field">
            <input type="password" name="password" id="password" required />
            <label for="password">nouveau password</label>
        </div>


        <div class="pass"><a class="pass" href=" login.php "> Forgot Password ?</a></div>
        <div>
            <input type="submit" name="envoyer" value="renitialiser" />
        </div>

    </form>
</div>

</body>

</html>


</div>