<?php
require_once('functions.php');

$bdd = connect();

if (isset($_POST["send"])) {
    $sql = "SELECT * FROM admin WHERE `email` = :email;";
    $sth = $bdd->prepare($sql);
    $sth->execute([
        'email' => $_POST['email']
    ]);

    $admin = $sth->fetch();

    if ($admin && password_verify($_POST['password'], $admin['password'])) {
        $_SESSION['user'] = $admin;
        header('Location: page_d_acceuil.php');
        exit();
    } else {
        $msg = "Incorrect email or password!";
    }
}
?>
<style>
    body {
        background-image: url(img/csm_img_bandeau_musee_ec5567aba3.jpg);
        background-size: cover;
        background-position: center;
    }
</style>
<?php require_once('_header.php'); ?>
<link rel="stylesheet" href="Style/login.css">
<div class="center">
<h1>Welcome back!</h1>
    <form action="" method="post">
        

        <?php if (isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

        <div class="txt_field">
            <input type="email"  name="email" id="email" required />
            <label for="email">Email</label>
        </div>

        <div class="txt_field">
            <input type="password"  name="password" id="password" required />
            <label for="password">Password</label>
        </div>
        <div class="pass"><a class="pass" href="#"> Forgot Password ?</a></div>
        <div>
            <input type="submit" class="btn btn-green" name="send" value="Log in" />
        </div>
        <div class="signup_link">
            Are you a client ?<a href="login.php">log in</a>
        </div>
    </form>
</div>

</body>
</html>
