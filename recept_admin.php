





<?php

 require_once('functions.php');











$bdd = connect();
$sql = "SELECT * FROM messagerie";
$sth = $bdd->prepare($sql);
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
            <p class="email">Email: <?php echo $user['email']; ?></p>

            <p class="email">nom: <?php echo $user['nom']; ?></p>

            
            <p class="sujet">sujet: <?php echo $user['sujet']; ?></p>


            
            <p class="sujet">message: <?php echo $user['message']; ?></p>

            

                <form action="answer_admin.php" method="POST">
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