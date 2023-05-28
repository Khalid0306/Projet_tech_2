<?php
require_once('functions.php');
require_once('_header.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit; // Terminer le script pour éviter l'exécution du reste de la page
}

if (isset($_POST["Envoyer"])) {
    $bdd = connect();

    $username = $_POST['username'];
    $note = $_POST['rating'];
    $commentaire = $_POST['commentaire'];

    // Validation de la note
    if ($note < 1 || $note > 10) {
        echo "Veuillez saisir une note valide (entre 1 et 10).";
    } else {
        $sql = "INSERT INTO notes (`username`, `note`, `commentaire`) VALUES (:username, :note, :commentaire);";
        
        $sth = $bdd->prepare($sql);
        
        $success = $sth->execute([
            'username' => $username,
            'note' => $note,
            'commentaire' => $commentaire
        ]);

        if ($success) {
            echo "Note ajoutée avec succès.";
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la note.";
        }
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
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .rating {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        
        }

        .rating input[type="radio"] {
            display: none;
        }

        .rating label {
            color: #ddd;
            font-size: 30px;
            margin-left: 5px;
            cursor: pointer;
        }

        .rating label:hover,
        .rating label:hover ~ label,
        .rating input[type="radio"]:checked ~ label {
            color: #ffcc00;
        }

        textarea {
            height: 100px;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .consultation-link {
            display: block;
            margin-top: 20px;
        }
         /* Styles pour le conteneur du slider */
         .slider-container {
            width: 600px;
            height: 400px;
            overflow: hidden;
            position: relative;
        }
        
        /* Styles pour les images du slider */
        .slider-image {
            width: 100%;
            height: 100%;
            display: none;
            position: absolute;
        }
        
        /* Style pour les boutons de navigation */
        .slider-nav {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .slider-nav button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            margin: 0 5px;
            font-size: 24px;
            outline: none;
        }
    </style>
</head>
<body>
    <h1>Envoyer un message à l'administrateur</h1>
    <form method="post" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>

        <label>Note :</label>
        <div class="rating">
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3">
        <label for="star3">&#9733;</label>
        <input type="radio" id="star4" name="rating" value="4">
        <label for="star4">&#9733;</label>
        <input type="radio" id="star5" name="rating" value="5">
        <label for="star5">&#9733;</label>
        <input type="radio" id="star6" name="rating" value="6">
        <label for="star6">&#9733;</label>
        <input type="radio" id="star7" name="rating" value="7">
        <label for="star7">&#9733;</label>
        <input type="radio" id="star8" name="rating" value="8">
        <label for="star8">&#9733;</label>
        <input type="radio" id="star9" name="rating" value="9">
        <label for="star9">&#9733;</label>
            <input type="radio" id="star10" name="rating" value="10">
            <label for="star10">&#9733;</label>
        </div>

        <label for="commentaire">Commentaire :</label>
        <textarea id="commentaire" name="commentaire" required></textarea>

        <input type="submit" name="Envoyer" value="Envoyer" class="submit-btn">
    </form>

    

</body>
<body>
    <div class="slider-container">
        <img class="slider-image" src="img/La Guerre et la Paix.jpg" alt="Image 1">
        <img class="slider-image" src="img/L'Homme qui marche.jpg" alt="Image 2">
        <img class="slider-image" src="img/n.webp" alt="Image 3">

        <div class="slider-nav">
            <button onclick="previousSlide()">&#10094;</button>
            <button onclick="nextSlide()">&#10095;</button>
        </div>
    </div>

    <script>
        var slideIndex = 0;
        var slides = document.getElementsByClassName("slider-image");

        function showSlide(n) {
            // Masquer toutes les images du slider
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            // Afficher l'image spécifiée par l'index
            slides[n].style.display = "block";
        }

        function previousSlide() {
            slideIndex--;
            if (slideIndex < 0) {
                slideIndex = slides.length - 1;
            }
            showSlide(slideIndex);
        }

        function nextSlide() {
            slideIndex++;
            if (slideIndex >= slides.length) {
                slideIndex = 0;
            }
            showSlide(slideIndex);
        }

        // Afficher la première image au chargement de la page
        showSlide(slideIndex);
    </script>
</body>
</html>
<?php 
require_once('affiche_avis.php');
?>
<?php 
require_once('_footer.php');
?>
