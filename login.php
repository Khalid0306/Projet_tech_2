<?php

require_once('function.php');

$bdd = connect();

if (isset($_POST["send"])) {
    $sql = "SELECT * FROM users WHERE `email` = :email;";
    $sth = $bdd->prepare($sql);
    {
        die("Error during prepare: " . $bdd->errorInfo()[2]);
    }
    $sth->execute([
        'email' => $_POST['email']
    ]);if (!$success) {
        die("Error during execute: " . $sth->errorInfo()[2]);
    }

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
<?php require_once('_header.php'); ?>
<div class="container">
<form action="" method="post">
        <h1>Welcome back !</h1>

        <?php if (isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

        <div>
            <label for="email">Email</label>
            <input 
                type="email" 
                placeholder="Enter your email" 
                name="email" 
                id="email" 
            />
        </div>
        <div>
            <label for="password">Password</label>
            <input 
                type="password" 
                placeholder="Enter your password" 
                name="password" 
                id="password" 
            />
        </div>
        <div>
            <input type="submit" class="btn btn-green" name="send" value="Log in" />
        </div>
    </form>
</body>
</html>


</div>

