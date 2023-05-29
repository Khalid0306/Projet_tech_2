




<style>
body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
}

.container {
  max-width: 600px;
  margin: 50px auto;
  padding: 20px;
  background-color: #ffffff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.notification {
  margin-bottom: 20px;
  padding: 10px;
  border-radius: 5px;
  background-color: #f9f9f9;
  border: 1px solid #cccccc;
}

.notification h3 {
  margin: 0;
  font-size: 18px;
  color: #333333;
}

.notification p {
  margin: 10px 0;
  font-size: 14px;
  color: #666666;
}

.notification hr {
  border: none;
  border-top: 1px solid #cccccc;
  margin: 10px 0;
}

.notification input[type="submit"] {
            padding: 5px 10px;
            border-radius: 3px;
            border: none;
            color: #fff;
            background-color: #4CAF50;
            cursor: pointer;
        }

        .notification input[type="submit"]:hover {
            background-color: #45a049;
        }

        .notification hr {
            margin-top: 20px;
        }


</style>
<title>Barre de navigation</title>
  <style>
    /* Styles pour la barre de navigation */
    ul.nav {
      list-style-type: none;
      margin: 0;
      padding: 0;
      background-color: #279BE4;
    }
    ul.nav li {
      display: inline-block;
    }
    ul.nav li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    ul.nav li a:hover {
      background-color: #01A9F0;
    }
  </style>

<!DOCTYPE html>
<html>
<head>
  <title>Notification</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Ajouter une animation de fade-in aux notifications
      $(".notification").hide().fadeIn(1000);

      // Ajouter une fonctionnalité de fermeture aux notifications
      $(".close-btn").click(function() {
        $(this).closest(".notification").fadeOut(500);
      });
    });
  </script>

<ul class="nav">
      <li><a href="dasboard.php">Dashboard</a></li>
      <li><a href="#">Notifications</a></li>
      <li><a href="https://mail.google.com/mail/u/1/#inbox">Mail</a></li>
    </ul>




</head>
<body>

<?php

 require_once('functions.php');

 

if (isset($_SESSION['admin'])) {

    header('Location: login_admin.php');

    exit();

    // Afficher les informations de tous les utilisateurs
} 









$bdd = connect();
$sql = "SELECT * FROM users";
$sth = $bdd->prepare($sql);
if (!$sth) {
    die("Error during prepare: " . $bdd->errorInfo()[2]);
}
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_ASSOC);


?>

<?php// require_once('_header.php'); ?>
<div class="container1">
    
    <div class="container">
    <h1>RENITIALISATION</h1>

   
    <?php foreach ($users as $user): ?>
        <div class="notification">
        <p class="email">Nom: <?php echo $user['nom'] . "  à envoyez une demande de renitialisation " ; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>

            <p>heure: <?php echo $user['created_at']; ?></p>
            
            <?php if ($user['valide'] == 0): ?>
                <form action="renit_validate.php" method="POST">
                    <input type="hidden" name="email" value="<?php echo $user['email']; ?>">

                    <input type="hidden" name="password" value="<?php echo $user['password']; ?>">
                    <input type="submit" name="accept" value="Accepter">
                    <input type="submit" name="reject" value="Refuser">
                </form>
            <?php endif; ?>
        </div>
        <hr>
    <?php endforeach; ?>
    <</div>