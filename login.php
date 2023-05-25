<?php
require_once('function.php');

$bdd = connect();

if (isset($_POST["send"])) {
    $sql = "SELECT * FROM users WHERE `email` = :email;";
    $sth = $bdd->prepare($sql);
    $sth->execute([
        'email' => $_POST['email']
    ]);

    $user = $sth->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: page_d_acceuil.php');
        exit();
    } else {
        $msg = "Incorrect email or password!";
    }
}
?>
<style>
    body {
        background-image: url(img/);
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
            Not a member ?<a href="register.php">Sign in</a>
            <br>
            Are you an admin ?<a href="login.php">log in</a>
        </div>
    </form>
</div>

</body>
</html>
