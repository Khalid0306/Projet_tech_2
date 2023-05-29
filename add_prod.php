





















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





<?php
require_once('functions.php');

if (isset($_POST["Envoyer"])) {
    $bdd = connect();
    
    $sql = "INSERT INTO produit (`nom_produit`, `description_produit`, `picture`, `categorie`, `quantite`,`prix`) VALUES (:nom_produit, :description_produit, :picture, :categorie, :quantite,:prix)";
    
    $sth = $bdd->prepare($sql);
    
    $success = $sth->execute([
        ':nom_produit' => $_POST['nom_produit'],
        ':description_produit' => $_POST['description_produit'],
        ':picture' => $_POST['picture'],
        ':categorie' => $_POST['categorie'],
        ':quantite' => $_POST['quantite'],
        ':prix' => $_POST['prix']
    ]);

    if ($success) {
        echo "Les valeurs ont été insérées avec succès dans la base de données.";
    } else {
        echo "Erreur lors de l'insertion des valeurs : " . $sth->errorInfo()[2];
    }
}
?>









<!DOCTYPE html>
<html>
<head>
    <title>Messagerie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f1f1f1;
        }

        h2 {
            margin-top: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Envoyer un message à l'administrateur</h2>
    <form method="post" action="">
        <label for="produit">Nom de produit :</label>
        <input type="text" id="nom_produit" name="nom_produit" required><br><br>

        <label for="description">description du produit:</label>
        <input type="text" id=" description_produit " name="description_produit" required><br><br>

        <label for="photo">nom de la photo:</label><br>
 <input type="text" id=" picture " name="picture" required><br><br>


 
 <label for="categorie ">nom de la categorie:</label><br>
 <input type="text" id=" categorie " name="categorie" required><br><br>

 <label for="quantite">Quantité :</label>
    <input type="number" id="quantite" name="quantite"><br><br>
    

    <label for="prix">prix :</label>
    <input type="number" id="prix" name="prix"><br><br>



        <input type="submit" name="Envoyer" value="create"  >
    </form>
</body>
</html>
