<?php
require_once('functions.php');

if (isset($_POST["send"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $bdd = connect();
    $sql = "SELECT * FROM users WHERE email = :email;";
    
    $sth = $bdd->prepare($sql);
    $sth->bindValue(':email', $email);

    if (!$sth) {
        die("Error during prepare: " . $bdd->errorInfo()[2]);
    }

    $sth->execute();
    
    $user = $sth->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Utilisateur et mot de passe corrects, redirigez vers la page d'inscription
        header('Location: page_d_acceuil.php');
        exit(); // Assurez-vous de terminer le script après une redirection
    } else {
        $msg = "Email ou mot de passe incorrect !";
    }
}

require_once('_header.php');
?>
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
            <label for="email">Email</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" id="password" required />
            <label for="password">Password</label>
        </div>
        <div class="pass"><a class="pass" href="#"> Forgot Password ?</a></div>
        <div>
            <input type="submit" name="send" value="Connexion" />
        </div>
        <div class="signup_link">
            Not a member ?<a href="register.php">Sign in</a>
            <br>
            Are you an admin ?<a href="login.php">log in</a>
        </div>
    </form>
</div>

</body>

</html>
