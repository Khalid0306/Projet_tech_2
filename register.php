<?php




require_once('functions.php');

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
<link rel="stylesheet" href="Style/login.css">
<style>
    body {
        background-image: url(img/woman-1283009_1920.jpg);
        background-size: cover;
        background-position: center;
    }
</style>
<div class="center">
<form action="" method="post">
        <h1>Create your account</h1>
        
        <div class="txt_field">
            <input 
                type="email"  
                name="email" 
                id="email"
                required  
            />
            <label for="email">Email</label>
        </div>
        <div class="txt_field">
            <input 
                type="password" 
                name="password" 
                id="password"
                required  
            />
            <label for="password">Password</label>
        </div>
        <div>
            <input type="submit" name="send" value="Create" class="btn btn-green" />
        </div>
        <div class="signup_link">
            Already a member ?<a href="login.php">log in</a>
        </div>
    </form>
</div>
</body>
</html>
