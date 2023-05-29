


<?php

 require_once('functions.php');

if(!isset($_SESSION['user']));{
  header('Location: login.php');
}



$email=$_SESSION['user']['email'];

$bdd = connect();
$sql = "SELECT * FROM message where email:email ";
$sth = $bdd->prepare($sql);

$sth->bindValue(':email', $email);
if (!$sth) {
    die("Error during prepare: " . $bdd->errorInfo()[2]);
}
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_ASSOC);


?>




<?php require_once('_header.php'); ?>
<div class="container1">
    
    <div class="container">
    <h1>email</h1>

    <?php foreach ($users as $user): ?>
        <div class="notification">

            
            <p class="sujet">sujet: <?php echo $user['sujet']; ?></p>


            
            <p class="sujet">message: <?php echo $user['msg']; ?></p>

            

                <form action="mail.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <input type="submit" name="repondre" value="repondre">
                    <input type="submit" name="reject" value="Refuser">
                </form>
        
        </div>
        <hr>
    <?php endforeach; ?>
</div>


</body>
<head>
 <style>
/* Styles pour le conteneur principal */
.container1 {
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Styles pour le conteneur des emails */
.container {
  width: 80%;
  margin: 0 auto;
}

/* Styles pour l'en-tête */
h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

/* Styles pour les notifications d'email */
.notification {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 20px;
}

.email {
  font-weight: bold;
}

.sujet {
  margin-top: 10px;
}

/* Styles pour les boutons */
input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 10px;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

input[type="hidden"] {
  display: none;
} 
    </style>
</head>

    

</html>




