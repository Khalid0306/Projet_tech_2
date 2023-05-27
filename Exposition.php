<?php
require_once('functions.php');
require_once('_header.php');

?>
<!DOCTYPE html>
<html>

<head>

    <style>
        .container1 {
            margin-bottom: 100px;
        }

        .artwork {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .artwork-item {
            width: 300px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .artwork-image {
            max-width: 100%;
            max-height: 275px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .artwork-details {
            padding: 10px;
            text-align: center;
        }

        .artwork-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .artwork-artist {
            font-style: italic;
            color: #888;
            margin-bottom: 5px;
        }

        .artwork-category {
            color: #888;
        }

        .artwork-description {
            color: #888;
            display: none;
        }

        .artwork-item:hover .artwork-image {
            transform: scale(1.2);
        }

        .artwork-item:hover .artwork-details {
            display: block;
            /* Afficher les détails lorsque la souris survole l'élément */
        }

        .filter-buttons {
            margin-bottom: 20px;
            text-align: center;
        }

        .filter-buttons button {
            margin: 0 5px;
            padding: 5px 10px;
            font-size: 14px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
        }

        .filter-buttons button.active {
            background-color: #999;
        }

        .like-button {
            cursor: pointer;
            margin-top: 10px;
            background-color: #ddd;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .likes-counter {
            font-size: 14px;
            margin-top: 5px;
        }

        .logo-coeur {
            width: 20px;
            height: 20px;
            justify-content: center;
        }

        .like-button.liked {
            background-color: #ff0000;
            color: #ffffff;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const artworkItems = document.querySelectorAll('.artwork-item');


            artworkItems.forEach(function(item) {

                const artworkImage = item.querySelector('.artwork-image');

                const artworkDetails = item.querySelector('.artwork-description');

                artworkImage.addEventListener('mouseover', function() {
                    artworkImage.style.border = '2px solid red';
                    artworkImage.style.transform = 'scale(1.2)';

                    artworkDetails.style.display = 'block';
                });


                artworkImage.addEventListener('mouseout', function() {

                    artworkImage.style.border = '1px solid #ccc';
                    artworkImage.style.transform = 'scale(1)';

                    artworkDetails.style.display = 'none';
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const artworkItems = document.querySelectorAll('.artwork-item');
            const filterButtons = document.querySelectorAll('.filter-buttons button');

            filterButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Supprime la classe 'active' de tous les boutons
                    filterButtons.forEach(function(btn) {
                        btn.classList.remove('active');
                    });

                    // Ajoute la classe 'active' au bouton cliqué
                    button.classList.add('active');

                    const selectedCategory = button.getAttribute('data-category');

                    artworkItems.forEach(function(item) {
                        const artworkCategory = item.querySelector('.artwork-category').textContent;

                        if (selectedCategory === 'all' || selectedCategory === artworkCategory) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.like-button').on('click', function() {
                var artworkId = $(this).data('id_oeuvre');
                var likesCounter = $(this).find('.like-count');
                var likeButton = $(this);

                $.ajax({
                    url: 'update_likes.php',
                    type: 'POST',
                    data: {
                        id: artworkId
                    },
                    dataType: 'json',
                    success: function(response) {
                        likesCounter.text(response.likes);
                        likeButton.addClass('liked');
                    },
                    error: function() {
                        console.log('Erreur lors de la mise à jour des likes.');
                    }
                });
            });
        });;
    </script>

</head>

<body>
    <?php
    $bdd = connect();
    // Récupération des œuvres d'art de la base de données
    $sql = "SELECT * FROM oeuvre";
    $stmt = $bdd->query($sql);
    $artworks = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Récupération de l'utilisateur connecté à partir de la base de données
    $userId = $_SESSION['user']['id']; // Remplacez par la variable appropriée contenant l'ID de l'utilisateur connecté
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    ?>

    <div class="container1">
        <center><b>
                <h1>Exposition d'œuvres d'art</h1>
            </b></center>
        <div class="filter-buttons">
            <h4>filtre :</h4>
            <button class="active" data-category="all">Toutes</button>
            <button data-category="peinture">peinture</button>
            <button data-category="sculpture">sculpture</button>
        </div>
        <div class="artwork">
            <?php foreach ($artworks as $artwork) : ?>
                <div class="artwork-item">
                    <?php if ($artwork['premium_only']==1 && !$user['premium']==1) : ?>
                        <!-- Si l'œuvre est réservée aux utilisateurs premium et l'utilisateur n'est pas premium -->
                        <img class="artwork-image" src="img/flou.png" alt="Image floutée">
                    <?php else : ?>
                        <!-- Sinon, afficher l'image normalement -->
                        <img class="artwork-image" src="img/<?php echo $artwork['picture']; ?>" alt="<?php echo $artwork['nom_oeuvre']; ?>">
                    <?php endif; ?>
                    <div class="artwork-details">
                        <div class="artwork-title"><?php echo $artwork['nom_oeuvre']; ?></div>
                        <div class="artwork-artist"><?php echo $artwork['nom_artiste']; ?></div>
                        <div class="artwork-category"><?php echo $artwork['categorie']; ?></div>
                        <div class="artwork-description"><?php echo $artwork['description_oeuvre']; ?></div>
                        <div class="like-button likes-counter" data-id_oeuvre="<?php echo $artwork['id_oeuvre']; ?>">
                            Like <span class="like-count"><?php echo $artwork['likes']; ?></span>
                            <img src="img/coeur.png" class="logo-coeur">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <footer><?php require_once('_footer.php'); ?></footer>
</body>

</html>