
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




  <div class="container">
    

  <?php


  require_once('functions.php');

    
   
    $bdd = connect();

    $sql = "SELECT * FROM form_data";
    $result = $bdd->query($sql);

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="notification">';
            echo '<h3>Nom: ' . $row['first_name'] . ' ' . $row['last_name'] . ' a passé une commande</h3>';
            echo '<p>Email: ' . $row['email'] . '</p>';
            echo '<p>Téléphone: ' . $row['phone'] . '</p>';
            // Afficher les autres informations du formulaire
            echo '<hr>';
            echo '<button class="close-btn">Fermer</button>';
            echo '</div>';
        }
    } else {
        echo "Aucune donnée trouvée.";
    }
    ?>
  </div>
</body>
</html>


