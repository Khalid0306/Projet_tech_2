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

    if ($user && password_verify($_POST['password'], $user['password'])) {
        //dd($user);


        if ($_SESSION['user']['validated'] == 0) {
            $_SESSION['user'] = $user;
            header('Location: login.php');
        } else {

            header('Location: register.php');
        }
    } else {
        $msg = "Email ou mot de passe incorrect !";
    }

    header('Location: index.php');
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


</div>