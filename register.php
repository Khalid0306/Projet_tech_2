<?php


require_once('function.php');

if (isset($_POST["send"])) {
    $bdd = connect();
    

    $sql = "INSERT INTO users (`email`, `password`) VALUES (:email, :password);";
    ;
    $sth = $bdd->prepare($sql);
    if (!$sth) {
        die("Error during prepare: " . $bdd->errorInfo()[2]);
    }


    $success = $sth->execute([
        'email'     => $_POST['email'],
        'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);if (!$success) {
        die("Error during execute: " . $sth->errorInfo()[2]);
    }

    header('Location: login.php');
    
}

?>

<?php require_once('_header.php'); ?>
<div class="container1">
<form action="" method="post">
        <h1>Create your account</h1>
        <div>
            <label for="email">Email : </label>
            <input 
                type="email" 
                placeholder="Enter your email" 
                name="email" 
                id="email" 
            />
        </div>
        <div>
            <label for="password">Password : </label>
            <input 
                type="password" 
                placeholder="Enter your password" 
                name="password" 
                id="password" 
            />
        </div>
        <div class="mt-4">
            <input type="submit" name="send" value="Create" class="btn btn-green" />
        </div>
    </form>
</div>
</body>
</html>
